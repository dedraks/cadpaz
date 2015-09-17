<?php

namespace CadpazBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CTPSType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('numero')
            ->add('serie')
            ->add('uf', 'choice', array(
                'choices' => array(
                    'AC' => 'Acre',
                    'AL' => 'Alagoas',
                    'AP' => 'Amapá',
                    'AM' => 'Amazonas',
                    'BA' => 'Bahia',
                    'CE' => 'Ceará',
                    'DF' => 'Distrito Federal',
                    'ES' => 'Espírito Santo',
                    'GO' => 'Goiás',
                    'MA' => 'Maranhão',
                    'MT' => 'Mato Grosso',
                    'MS' => 'Mato Grosso do Sul',
                    'MG' => 'Minas Gerais',
                    'PR' => 'Paraná',
                    'PB' => 'Paraíba',
                    'PA' => 'Pará',
                    'PE' => 'Pernambuco',
                    'PI' => 'Piauí',
                    'RJ' => 'Rio de Janeiro',
                    'RN' => 'Rio Grande do Norte',
                    'RS' => 'Rio Grande do Sul',
                    'RO' => 'Rondônia',
                    'RR' => 'Roraima',
                    'SC' => 'Santa Catarina',
                    'SE' => 'Sergipe',
                    'SP' => 'São Paulo',
                    'TO' => 'Tocantins'
                ),
                'multiple' => false,
                'placeholder' => 'Selecione a UF',
                'label' => 'UF'
            ))
            ->add('save', 'submit', array('label' => 'Salvar'))
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
