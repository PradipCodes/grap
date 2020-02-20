<?php

namespace App\Controller;

use App\Form\Type\ProfileType;
use App\Model\DataCountryQuery;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request)
    {

        return $this->render('home/index.html.twig', []);
    }

    /**
     * @Route("/change-password", name="change_password")
     */
    public function passwordAction(Request $request)
    {
        $user = $this->getUser();

        $form = $this->createForm(
            ProfileType::class,
            $user
        );

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userManager = $this->container->get('fos_user.user_manager');
            $userManager->updateUser($user);

            $this->get('session')->getFlashBag()->add(
                'success',
                'Password was successfully updated.'
            );

            return $this->redirect($this->generateUrl('change_password'));
        }

        return $this->render('home/password.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/graph", name="graph")
     */
    public function graphAction(Request $request)
    {

        $dtact = array();
        $dtaco = array();
        $dta = DataCountryQuery::create()->limit(10)->find();


        foreach ($dta as $dtas) {
            $dtact[] = $dtas->getCountry();
            $dtaco[] = $dtas->getCount();
        }

        $dtact = implode('","', $dtact);
        $dtact = sprintf('%s%s%s', '"', $dtact, '"');
        $dtaco = implode(',', $dtaco);


        return $this->render('home/graph.html.twig', ['country' => $dtact, 'count' => $dtaco]);
    }
}
