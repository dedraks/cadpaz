<?php

namespace CadpazBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EncaminhamentoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('encaminhado', 'entity', ['class' => 'DedraksConfigBundle:Encaminhamento',
                'choice_label' => 'nome',
                //'expanded' => true,
                'multiple' => false
                ])
            ->add('observacoes', null, ['required'=>false, 'label'=>'Observações (opcional)'])
            ->add('save', 'submit', ['label' => 'Salvar'])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CadpazBundle\Entity\Encaminhamento',
            'attr' => ['id' => 'newEncaminhamentoForm'],
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cadpazbundle_encaminhamento';
    }
}
