<?php

namespace App\Controller;

use App\Form\Type\ProfileType;
use App\Form\Type\UserType;
use App\Model\AdQuery;
use App\Model\Subscriber;
use App\Model\SubscriberQuery;
use App\Model\User;
use App\Model\UserDetailQuery;
use App\Model\UserQuery;
use App\Model\Users;
use App\Model\UsersQuery;
use App\Security\MessageDigestPasswordEncoder;
use Gumlet\ImageResize;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class UsersController extends Controller
{
    /**
     * @Route("/users", name="users")
     */
    public function indexAction()
    {
        return $this->render('user/index.html.twig', array());
    }

    /**
     * @Route("/user/list", name="user_list", requirements={"_format": "json"}, defaults={"_format": "json"})
     */
    public function listAction(Request $request)
    {
        $query = $this->getQuery();

        $total_count = $query->count();

        $query
            ->filter(
                $this->getFilters($request),
                $this->getSearchColumns()
            );

        $filtered_count = $query
            ->count();

        $limit = $this->getLimit($request);
        $offset = $this->getOffset($request);

        $users = $query
            ->sort($this->getSortOrder($request))
            ->limit($limit)
            ->offset($offset)
            ->find();

        return $this->render('user/list.json.twig', array(
            'total_count' => $total_count,
            'filtered_count' => $filtered_count,
            'users' => $users
        ));
    }

    /**
     * @Route("/user/add", name="user_add")
     */
    public function createAction(Request $request)
    {
        $user = new User();

        $form = $this->createForm(
            UserType::class,
            $user,
            array(
                'action' => $this->generateUrl('user_add'),
            )
        );

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $name = $request->request->get('user')['username'];
            $password = $request->request->get('user')['plainPassword']['first'];
//            $code = $request->request->get('user')['code'];

            if (!$name || !$password) {
                $this->get('session')->getFlashBag()->set(
                    'error', 'Required field is missing!'
                );
                return $this->redirect($this->generateUrl('user_add'));
            }

            $existing_user = UserQuery::create()
                ->filterByUsername($name)
                ->findOne();

            if ($existing_user) {
                $this->get('session')->getFlashBag()->set(
                    'error', 'Username already used!'
                );
                return $this->redirect($this->generateUrl('user_add'));
            }

            $user = new User();
            $user->setUsername($name);
            $user->setUsernameCanonical($name);
            $user->setPlainPassword($password);
            $user->setPassword($password);
//            $user->setCode($code);
            $user->setEnabled(1);
//            $user->setCreatedAt(new \DateTime());
            $user->save();

            $encoder = new MessageDigestPasswordEncoder();
            $password = $encoder->encodePassword($password, $user->getSalt());

            $user->setPassword($password);
            $user->save();


            $this->get('session')->getFlashBag()->set(
                'success', 'User successfully created!'
            );
            return $this->redirect($this->generateUrl('users'));

        }

        return $this->render('user/create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/user/{id}/edit", name="user_edit")
     */
    public function editAction(Request $request, $id)
    {
        $user = $this->getUsers($id);

        $form = $this->createForm(
            UserType::class,
            $user,
            array(
                'action' => $this->generateUrl('user_edit', array('id' => $id)),
            )
        );

        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $password = $request->request->get('user_list')['plainPassword']['first'];

            $user->setPlainPassword($password);
            $user->setPassword($password);
            $user->save();

            $encoder = new MessageDigestPasswordEncoder();
            $password = $encoder->encodePassword($password, $user->getSalt());

            $user->setPassword($password);
            $user->save();

            $this->get('session')->getFlashBag()->add(
                'success',
                'User successfully updated.'
            );

            return $this->redirect($this->generateUrl('users'));
        }

        return $this->render('user/edit.html.twig', [
            'form' => $form->createView(),
            'user' => $user
        ]);
    }

    /**
     * @Route("/user/{id}/delete", name="user_delete")
     */
    public function deleteAction(Request $request, $id)
    {
        $user = $this->getUsers($id);
        $user->delete();

        $this->get('session')->getFlashBag()->add(
            'success',
            'User deleted successfully'
        );

        return $this->redirect($this->generateUrl('users'));
    }

    public function getUsers($id)
    {
        $user = UserQuery::create()
            ->findPk($id);

        if (!$user) {
            throw new \Exception('No user detail found');
        }

        return $user;
    }

    protected function getQuery()
    {
        return UserQuery::create();
    }

    protected function getFilters(Request $request)
    {
        return $request->query->get('user_filter', array());
    }

    protected function getSearchColumns()
    {
        return array(
            'email' => 'user.email LIKE "%%%s%%"'
        );
    }

    protected function getSortOrder(Request $request)
    {
        $sort = array();

        $order = $request->query->get('order', array());

        $columns = $this->getSortColumns();

        foreach ($order as $setting) {
            $index = $setting['column'];

            if (array_key_exists($index, $columns)) {
                if (!is_array($columns[$index])) {
                    $columns[$index] = array($columns[$index]);
                }

                foreach ($columns[$index] as $sort_column) {
                    $sort[] = array(
                        $sort_column,
                        $setting['dir'],
                    );
                }
            }
        }

        if (empty($sort)) {
            $sort[] = array(
                'fos_user.id',
                'asc',
            );
        }

        return $sort;
    }

    protected function getSortColumns()
    {
        return array(
            0 => 'fos_user.id'
        );
    }

    protected function getLimit(Request $request)
    {
        return min(100, $request->query->get('length', 10));
    }

    protected function getOffset(Request $request)
    {
        return max($request->query->get('start', 0), 0);
    }
}
