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
        dump($options);
        
        $builder
            ->add('padrao', 'checkbox', ['required' => false, 'disabled'=>$options['ro']])
            ->add('numero', 'text', ['label'=>'Número'])
            ->add('tipo', 'choice', array(
                'choices' => array(
                    'Celular'       => 'Celular',
                    'Residencial'   => 'Residencial',
                    'Comercial'     => 'Comercial',
                    'Favor'         => 'Favor',
                    'Outro'         => 'Outro',
                    ),
                'label'=>'Tipo',
                'placeholder'=>'Informe'
            ))
            ->add('obs', 'textarea', ['label'=>'Observações','required' => false])
            //->add('pessoa')
            //->add('save', 'submit', array('label' => 'Salvar'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CadpazBundle\Entity\Telefone',
            'attr' => ['id' => 'newTelefoneForm'],
            'ro'=>false
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
