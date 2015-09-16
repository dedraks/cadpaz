<?php

namespace CadpazBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PessoaType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nome')
            ->add('dataNascimento')
            ->add('sexo')
            ->add('cpf')
            ->add('certidaoNascimento')
            ->add('certidaoCasamento')
            ->add('cartaoVacina')
            ->add('estadoCivil')
            ->add('nomeMae')
            ->add('corInformada')
            ->add('email')
            ->add('dataCadastro')
            ->add('rg')
            ->add('titulo')
            ->add('ctps')
            ->add('pis')
            ->add('questionario')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CadpazBundle\Entity\Pessoa'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cadpazbundle_pessoa';
    }
}
