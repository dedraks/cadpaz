<?php

namespace CadpazBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TituloType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('zona')
            ->add('secao')
            ->add('dataEmissao', 'date', [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'label' => 'Data de Emissão',
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
                ]
            ])
            ->add('municipio')
            ->add('uf', 'entity', ['class' => 'CadpazBundle:Estado',
                'choice_label' => 'nome',
                //'expanded' => true,
                'multiple' => false,
                'placeholder' => 'Selecione a UF',
                'label' => 'UF'
                ])
            ->add('save', 'submit', array('label' => 'Salvar'))
            //->setDisabled(true);
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CadpazBundle\Entity\Titulo',
            'attr' => ['id' => 'newTituloForm']
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cadpazbundle_titulo';
    }
}
