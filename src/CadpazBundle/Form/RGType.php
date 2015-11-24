<?php

namespace CadpazBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class RGType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero', null, ['required'=>false])
            ->add('dataExpedicao', 'date', [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'label' => 'Data de Expedição',
                'attr' => [
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy',
                    'data-date-language' => 'pt-BR',
                    'data-date-class' => 'date',
                    'data-date-autoclose' => 'true',
                    'data-date-startView' => '2',
                    'autocomplete' => 'off',
                    'onKeyDown' => 'return false'
                ],
                'required'=>false
            ])
            ->add('orgaoExpedidor', null, ['required'=>false])
            //->add('save', 'submit', array('label' => 'Salvar'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CadpazBundle\Entity\RG',
            'attr' => ['id' => 'newRgForm']
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cadpazbundle_rg';
    }
}
