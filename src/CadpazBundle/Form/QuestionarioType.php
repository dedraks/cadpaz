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
            ->add('moradia')
            ->add('moraSozinho')
            ->add('moraComFilhos')
            ->add('moraComPaiMae')
            ->add('moraComIrmaos')
            ->add('moraComConjuge')
            ->add('moraComParentesAmigosColegas')
            ->add('moraComOutraSituacao')
            ->add('quantasPessoasMoramNaCasa')
            ->add('numeroDeFilhos')
            ->add('moradiaTemColetaDeLixo')
            ->add('moradiaTemRedeDeEsgoto')
            ->add('moradiaTemRuaPavimentada')
            ->add('moradiaSituadaEmZonaRural')
            ->add('moradiaTemAguaEncanada')
            ->add('moradiaSituadaEmComunidadeQuilombolaOuIndigena')
            ->add('moradiaTemEletricidade')
            ->add('tipoDeMoradia')
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
            'data_class' => 'CadpazBundle\Entity\Questionario'
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
