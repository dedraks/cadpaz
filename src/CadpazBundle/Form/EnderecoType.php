<?php

namespace CadpazBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EnderecoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome', null, ['attr'=>['style'=>'width:98%']])
            ->add('padrao', 'checkbox', ['required' => false, 'disabled'=>$options['ro'], 'label'=>'Padrão'])
            ->add('logradouro', null, ['attr'=>['style'=>'width:96%']])
            ->add('numero', null, ['attr'=>['style'=>'width:98%']])
            ->add('complemento', 'text', ['attr'=>['style'=>'width:96%'],'required' => false])
            ->add('bairro', null, ['attr'=>['style'=>'width:98%']])
            ->add('municipio', null, ['attr'=>['style'=>'width:96%']])
            ->add('cep', null, ['label'=>'CEP', 'attr'=>['style'=>'width:99%']])
            ->add('uf', 'entity', ['attr'=>['style'=>'width:98%'], 'class' => 'CadpazBundle:Estado', 
                'choice_label' => 'nome',
                //'expanded' => true,
                'multiple' => false,
                'placeholder' => 'Selecione a UF',
                'label' => 'UF'
                ])
            ->add('obs', 'textarea', ['attr'=>['style'=>'width:96%'],'required'=>false])
            //->add('pessoa')
            //->add('save', 'submit', ['label' => 'Salvar'])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CadpazBundle\Entity\Endereco',
            'attr' => ['id' => 'newEnderecoForm'],
            'ro' => false
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cadpazbundle_endereco';
    }
}
