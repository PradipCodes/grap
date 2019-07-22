<?php

namespace App\Security;

use App\Model\User;
use FOS\UserBundle\Model\UserInterface;
use Propel\Runtime\ActiveQuery\PropelQuery;
use FOS\UserBundle\Model\UserManager as BaseUserManager;
use FOS\UserBundle\Util\CanonicalizerInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Security\Core\Encoder\EncoderFactoryInterface;

class UserManager extends BaseUserManager
{
    protected $container;

    public function findUserByUsername($username)
    {
        return $this->findUserBy(array('username' => $username));
    }

    /**
     * {@inheritDoc}
     */
    protected function createQuery()
    {
        return PropelQuery::from($this->getClass());
    }


    /**
     * Deletes a user.
     *
     * @param UserInterface $user
     */
    public function deleteUser(UserInterface $user)
    {
        $user->delete();
    }

    /**
     * Finds one user by the given criteria.
     *
     * @param array $criteria
     *
     * @return UserInterface|null
     */
    public function findUserBy(array $criteria)
    {
        $query = $this->createQuery();

        foreach ($criteria as $field => $value) {
            $method = 'filterBy'.ucfirst($field);
            $query->$method($value);
        }

        return $query->findOne();
    }

    /**
     * Returns a collection with all user instances.
     *
     * @return \Traversable
     */
    public function findUsers()
    {
        return $this->createQuery()
            ->find();
    }

    /**
     * Returns the user's fully qualified class name.
     *
     * @return string
     */
    public function getClass()
    {
        return User::class;
    }

    /**
     * Reloads a user.
     *
     * @param UserInterface $user
     */
    public function reloadUser(UserInterface $user)
    {
        // TODO: Implement reloadUser() method.
    }

    /**
     * Updates a user.
     *
     * @param UserInterface $user
     */
    public function updateUser(UserInterface $user)
    {
        // TODO: Implement updateUser() method.
    }
}
