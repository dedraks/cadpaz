<?php

namespace CadpazBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TelefoneType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('padrao', 'checkbox', ['required' => false, 'readonly' => $readonly])
            ->add('numero')
            ->add('tipo')
            ->add('obs', 'textarea', ['required' => false])
            //->add('pessoa')
            ->add('save', 'submit', array('label' => 'Salvar'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CadpazBundle\Entity\Telefone',
            'attr' => ['id' => 'newTelefoneForm','padrao'=>false]
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cadpazbundle_telefone';
    }
}
