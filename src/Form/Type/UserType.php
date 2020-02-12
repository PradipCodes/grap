<?php

namespace App\Form\Type;

use App\Model\UserTypeQuery;
use Symfony\Component\DependencyInjection\Compiler\RepeatedPass;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;

class UserType extends AbstractType
{
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'show_legend' => false,
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', TextType::class, [
                'label' => 'Username',
                'required' => true,
                'attr' => [
                    'class' => 'form-control'
                ]
            ])
            ->add('plainPassword', RepeatedType::class, array(
                'type' => PasswordType::class,
                'first_options' => array('label' => 'New Password',
                    'attr' => array(
                        'class' => 'form-control'
                    )
                ),
                'second_options' => array('label' => 'Confirm Password',
                    'attr' => array(
                        'class' => 'form-control '
                    )
                ),
                'invalid_message' => 'Password mismatched',

            ))
            /*->add('code', ChoiceType::class, [
                'label' => "Role",
                'required' => true,
                'attr' => ['class' => 'form-control'],
                'choices' => $this->getUserType()
            ])*/
            ->add('save', SubmitType::class, [
                'label' => 'Save',
                'attr' => [
                    'class' => 'btn btn-primary',
                    'style' => 'margin-top:1em;'
                ]
            ]);
    }

    public function getName()
    {
        return 'users';
    }

    protected function getUserType()
    {
        $types = array();

        $query = UserTypeQuery::create();

        foreach ($query->find() as $type) {
            $types[$type->getTypeName()] = $type->getCode();
        }

        return $types;
    }
}
