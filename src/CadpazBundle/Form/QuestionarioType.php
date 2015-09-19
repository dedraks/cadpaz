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
            ->add('moraComPaiMae', 'checkbox', ['label'=>'Mora com pai e/ou mãe'], ['required'=>false])
            ->add('moraComIrmaos', 'checkbox', ['required'=>false])
            ->add('moraComConjuge', 'checkbox', ['required'=>false])
            ->add('moraComParentesAmigosColegas', 'checkbox', ['label'=>'Mora com parentes e/ou amigos e/ou colegas'], ['required'=>false])
            ->add('moraComOutraSituacao', 'checkbox', ['label'=>'Outra situação', 'required'=>false])
            ->add('quantasPessoasMoramNaCasa')
            ->add('numeroDeFilhos')
            ->add('moradiaTemColetaDeLixo')
            ->add('moradiaTemRedeDeEsgoto')
            ->add('moradiaTemRuaPavimentada')
            ->add('moradiaSituadaEmZonaRural')
            ->add('moradiaTemAguaEncanada')
            ->add('moradiaSituadaEmComunidadeQuilombolaOuIndigena')
            ->add('moradiaTemEletricidade')
            ->add('tipoDeMoradia', 'choice', array(
                'choices' => array(
                    'Casa',
                    'Barracão',
                    'Apartamento',
                    'Galpão',
                    ),
                'label'=>'Tipo de moradia'
            ))
            ->add('escolaridade')
            ->add('estudaAtualmente')
            ->add('temInteresseEmVoltarAEstudar')
            ->add('temFilhosEmIdadeEscolar')
            ->add('temFilhosMatriculadosEmEscola')
            ->add('deficienciaFisica')
            ->add('deficienciaAuditiva')
            ->add('deficienciaMental')
            ->add('deficienciaVisual')
            ->add('fezOuFazAcompanhamentoNeurologico')
            ->add('fezOuFazAcompanhamentoPisicologico')
            ->add('fezOuFazOutrosAcompanhamentos')
            ->add('fezOuFazOutrosAcompanhamentosQuais')
            ->add('fazUsoDeMedicacaoConstante')
            ->add('recebeMedicacaoDaFarmaciaDistrital')
            ->add('domicilioCobertoPorUBSOuPSF')
            ->add('pessoaIdosaOuGestanteNaFamilia')
            ->add('rendaFamiliar')
            ->add('participaOuRecebePETIBolsaCriancaCidada')
            ->add('participaOuRecebeAgenteJovem')
            ->add('participaOuRecebeBolsaFamilia')
            ->add('participaOuRecebeBCP')
            ->add('participaOuRecebeNaoRespondeu')
            ->add('participaOuRecebeNaoSabe')
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
