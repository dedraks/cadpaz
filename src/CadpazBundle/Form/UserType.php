<?php

namespace CadpazBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UserType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nomeCompleto')
            ->add('groups')
            ->add('enabled', 'checkbox', ['required'=>false, 'label'=>'Habilitado'])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CadpazBundle\Entity\User',
            'attr' => ['id' => 'userForm']
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'app_user_registration';
    }
    
    public function getParent()
    {
        return 'fos_user_registration';
    }
}
