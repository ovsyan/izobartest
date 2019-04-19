<?php

namespace AppBundle\Admin;

use AppBundle\Entity\Unit;
use Sonata\AdminBundle\Admin\AbstractAdmin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;
use FOS\UserBundle\Model\UserManagerInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class EmployerAdmin extends AbstractAdmin
{
    protected function configureFormFields(FormMapper $form)
    {
        $form->add('username', TextType::class);
        $form->add('plainPassword', PasswordType::class);
        $form->add('first_name', TextType::class);
        $form->add('last_name', TextType::class);
        $form->add('surname', TextType::class,[
            'required' => false
        ]);
        $form->add('email', TextType::class);
        $form->add('unit', EntityType::class, [
            'class' => Unit::class,
            'choice_label' => 'name',
        ]);
        $form->add('position', TextType::class);
        $form->add('enabled', CheckboxType::class,[
            'required' => false
        ]);
        $form->add('phone_number', TextType::class,[
            'required' => false
        ]);
        $form->add('photo', FileType::class,[
            'required' => false
        ]);//@TODO file
    }

    protected function configureDatagridFilters(DatagridMapper $filter)
    {
        $filter->add('email');
        $filter->add('unit.name');
    }

    protected function configureListFields(ListMapper $list)
    {
        $list->add('first_name');
        $list->addIdentifier('last_name');
        $list->add('username');
        $list->addIdentifier('email');
        $list->add('unit.name');
    }

    public function preUpdate($user)
    {
        $this->getUserManager()->updateCanonicalFields($user);
        $this->getUserManager()->updatePassword($user);
    }

    public function setUserManager(UserManagerInterface $userManager)
    {
        $this->userManager = $userManager;
    }

    public function getUserManager()
    {
        return $this->userManager;
    }
}