<?php

namespace CadpazBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class QuestionarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('moradia', 'choice', array(
                'choices' => array(
                    'Própria quitada',
                    'Própria financiada',
                    'Aluguada',
                    'Habitação coletiva',
                    'Cedida',
                    'Outra'),
                'label'=>'Tipo de moradia'
            ))
            ->add('moraSozinho', 'checkbox', ['required'=>false])
            ->add('moraComFilhos', 'checkbox', ['required'=>false])
            ->add('moraComPaiMae', 'checkbox', ['label'=>'Mora com pai e/ou mãe', 'required'=>false])
            ->add('moraComIrmaos', 'checkbox', ['required'=>false])
            ->add('moraComConjuge', 'checkbox', ['required'=>false])
            ->add('moraComParentesAmigosColegas', 'checkbox', ['label'=>'Mora com parentes e/ou amigos e/ou colegas', 'required'=>false])
            ->add('moraComOutraSituacao', 'checkbox', ['label'=>'Outra situação', 'required'=>false])
            ->add('quantasPessoasMoramNaCasa')
            ->add('numeroDeFilhos')
            ->add('moradiaTemColetaDeLixo', 'checkbox', ['required'=>false])
            ->add('moradiaTemRedeDeEsgoto', 'checkbox', ['required'=>false])
            ->add('moradiaTemRuaPavimentada', 'checkbox', ['required'=>false])
            ->add('moradiaSituadaEmZonaRural', 'checkbox', ['required'=>false])
            ->add('moradiaTemAguaEncanada', 'checkbox', ['required'=>false])
            ->add('moradiaSituadaEmComunidadeQuilombolaOuIndigena', 'checkbox', ['required'=>false])
            ->add('moradiaTemEletricidade', 'checkbox', ['required'=>false])
            ->add('tipoDeMoradia', 'choice', array(
                'choices' => array(
                    'Casa',
                    'Barracão',
                    'Apartamento',
                    'Galpão',
                    ),
                'label'=>'Tipo de moradia'
            ))
            ->add('escolaridade', 'choice', array(
                'choices' => array(
                    'Analfabeto',
                    '1 Serie - Ensino Fundamental',
                    '2 Serie - Ensino Fundamental',
                    '3 Serie - Ensino Fundamental',
                    '4 Serie - Ensino Fundamental',
                    '5 Serie - Ensino Fundamental',
                    '6 Serie - Ensino Fundamental',
                    '7 Serie - Ensino Fundamental',
                    '8 Serie - Ensino Fundamental',
                    'Ensino Fundamental completo',
                    'Ensino Medio incompleto',
                    'Ensino Medio completo',
                    'Superior incompleto',
                    'Superior completo',
                    'Pós graduação',
                    'Mestrado',
                    'Doutorado'
                    ),
                'label'=>'Escolaridade'
            ))
            ->add('estudaAtualmente', 'checkbox', ['required'=>false])
            ->add('temInteresseEmVoltarAEstudar', 'checkbox', ['required'=>false])
            ->add('temFilhosEmIdadeEscolar', 'checkbox', ['required'=>false])
            ->add('temFilhosMatriculadosEmEscola', 'checkbox', ['required'=>false])
            ->add('deficienciaFisica', 'checkbox', ['required'=>false])
            ->add('deficienciaAuditiva', 'checkbox', ['required'=>false])
            ->add('deficienciaMental', 'checkbox', ['required'=>false])
            ->add('deficienciaVisual', 'checkbox', ['required'=>false])
            ->add('fezOuFazAcompanhamentoNeurologico', 'checkbox', ['required'=>false])
            ->add('fezOuFazAcompanhamentoPisicologico', 'checkbox', ['required'=>false])
            ->add('fezOuFazOutrosAcompanhamentos', 'checkbox', ['required'=>false])
            ->add('fezOuFazOutrosAcompanhamentosQuais')
            ->add('fazUsoDeMedicacaoConstante', 'checkbox', ['required'=>false])
            ->add('recebeMedicacaoDaFarmaciaDistrital', 'checkbox', ['required'=>false])
            ->add('domicilioCobertoPorUBSOuPSF', 'checkbox', ['required'=>false])
            ->add('pessoaIdosaOuGestanteNaFamilia', 'checkbox', ['required'=>false])
            ->add('rendaFamiliar')
            ->add('participaOuRecebePETIBolsaCriancaCidada', 'checkbox', ['required'=>false])
            ->add('participaOuRecebeAgenteJovem', 'checkbox', ['required'=>false])
            ->add('participaOuRecebeBolsaFamilia', 'checkbox', ['required'=>false])
            ->add('participaOuRecebeBCP', 'checkbox', ['required'=>false])
            ->add('participaOuRecebeNaoRespondeu', 'checkbox', ['required'=>false])
            ->add('participaOuRecebeNaoSabe', 'checkbox', ['required'=>false])
            ->add('condicaoDeTrabalho')
            ->add('despesasMensaisAluguel')
            ->add('despesasMensaisPrestacaoHabitacao')
            ->add('despesasMensaisAgua')
            ->add('despesasMensaisLuz')
            ->add('despesasMensaisTelefone')
            ->add('despesasMensaisMedicamentos')
            ->add('despesasMensaisOutras')
            ->add('encaminhamentoAoProjeto')
            ->add('comoFicouSabendoDoProjeto')
            ->add('observacoes')
            //->add('pessoa')
            ->add('save', 'submit', array('label' => 'Salvar'))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'CadpazBundle\Entity\Questionario',
            'attr' => ['id' => 'newQuestionarioForm'],
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'cadpazbundle_questionario';
    }
}
