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
            ->add('nome', 'text', array('label'=>'Nome'))
            ->add('dataNascimento', 'date', [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'label' => 'Data de Nascimento',
                'attr' => [
                    'class' => 'form-control input-inline datepicker',
                    'data-provide'          => 'datepicker',
                    'data-date-format'      => 'dd-mm-yyyy',
                    'data-date-language'    => 'pt-BR',
                    'data-date-class'       => 'date',
                    'data-date-autoclose'   => 'true',
                    'data-date-startView'   => '2',
                    'autocomplete'          => 'off',
                    'onKeyDown'             => 'return false'
                ]
            ])
            ->add('sexo', 'choice', array(
                'choices' => array(
                    'M' => 'Masculino',
                    'F' => 'Feminino',
                    'O' => 'Outros'
                ),
                'multiple' => false,
                'placeholder' => 'Selecione o Sexo'
            ))
            ->add('cpf', 'hidden')
            ->add('certidaoNascimento', 'checkbox', array(
                'label'    => 'Possui certidão de nascimento?',
                'required' => false,
            ))
            ->add('certidaoCasamento', 'checkbox', array(
                'label'    => 'Possui certidão de casamento?',
                'required' => false,
            ))
            ->add('cartaoVacina', 'checkbox', array(
                'label'    => 'Possui cartão de vacina?',
                'required' => false,
            ))
            ->add('estadoCivil', 'choice', array(
                'choices' => array(
                    'Casado'              =>'Casado(a)',
                    'Solteiro'            => 'Solteiro(a)',
                    'União Estável'       => 'União Estável',
                    'Separado/Divorciado' => 'Separado(a)/Divorciado(a)',
                    'Viúvo'               => 'Viúvo(a)',
                    'Outros'              => 'Outros'
                ),
                'multiple' => false,
                'placeholder' => 'Selecione o estado civil'
            ))
            ->add('nomeMae', 'text', array('label'=>'Nome da mãe'))
            ->add('corInformada', 'choice', array(
                'choices' => array(
                    'Branco'        => 'Branco',
                    'Negro'         => 'Negro',
                    'Pardo'         => 'Pardo',
                    'Amarelo'       => 'Amarelo',
                    'Indígena'      => 'Indígena',
                    'Não informado' => 'Não informado'
                ),
                'multiple' => false,
                'placeholder' => 'Selecione a cor'
            ))
            ->add('email', 'text', ['label'=>'Email'])
            ->add('save', 'submit', ['label' => 'Salvar'])
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CadpazBundle\Entity\Pessoa',
            'attr' => ['id' => 'newUserForm']
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
