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
            ->add('nome')
            ->add('padrao', 'checkbox', ['required' => false, 'disabled'=>$options['ro']])
            ->add('logradouro')
            ->add('numero')
            ->add('complemento', 'text', ['required' => false])
            ->add('bairro')
            ->add('municipio')
            ->add('cep')
            ->add('uf', 'entity', ['class' => 'CadpazBundle:Estado',
                'choice_label' => 'nome',
                //'expanded' => true,
                'multiple' => false,
                'placeholder' => 'Selecione a UF',
                'label' => 'UF'
                ])
            ->add('obs', 'textarea', ['required'=>false])
            //->add('pessoa')
            ->add('save', 'submit', ['label' => 'Salvar'])
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
