<?php

namespace Dedraks\ConfigBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CasoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tipo')
            ->add('descricao')
            ->add('save', 'submit', ['label'=>'salvar'])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Dedraks\ConfigBundle\Entity\Caso',
            'attr' => ['id' => 'newTipoCasoForm']
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'dedraks_configbundle_caso';
    }
}
