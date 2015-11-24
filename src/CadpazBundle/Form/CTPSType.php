<?php

namespace CadpazBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityRepository;

class CTPSType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {

        
        $builder
            ->add('numero', null, ['required'=>false, 'attr' => ['style' => 'width: 95%']])
            ->add('serie', null, ['required'=>false, 'attr' => ['style' => 'width: 95%']])
            ->add('uf', 'entity', ['class' => 'CadpazBundle:Estado',
                'choice_label' => 'nome',
                'attr' => ['style' => 'width: 97%'],
                'required'=>false,
                'multiple' => false,
                'placeholder' => 'Selecione a UF',
                'label' => 'UF'
                ])
            //->add('save', 'submit', array('label' => 'Salvar'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CadpazBundle\Entity\CTPS',
            'attr' => ['id' => 'newCtpsForm']
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cadpazbundle_ctps';
    }
}
