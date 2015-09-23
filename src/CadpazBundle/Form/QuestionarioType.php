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
                    'Própria quitada'       =>'Própria quitada',
                    'Própria financiada'    =>'Própria financiada',
                    'Aluguada'              =>'Aluguada',
                    'Habitação coletiva'    =>'Habitação coletiva',
                    'Cedida'                =>'Cedida',
                    'Outra'                 =>'Outra'
                ),
                'label'=>'Tipo de moradia',
                'placeholder'=>'Informe'
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
                    'Casa'          => 'Casa',
                    'Barracão'      => 'Barracão',
                    'Apartamento'   => 'Apartamento',
                    'Galpão'        => 'Galpão',
                    ),
                'label'=>'Tipo de moradia',
                'placeholder'=>'Informe'
            ))
            ->add('escolaridade', 'choice', array(
                'choices' => array(
                    'Analfabeto'                    => 'Analfabeto',
                    '1 Serie - Ensino Fundamental'  => '1 Serie - Ensino Fundamental',
                    '2 Serie - Ensino Fundamental'  => '2 Serie - Ensino Fundamental',
                    '3 Serie - Ensino Fundamental'  => '3 Serie - Ensino Fundamental',
                    '4 Serie - Ensino Fundamental'  => '4 Serie - Ensino Fundamental',
                    '5 Serie - Ensino Fundamental'  => '5 Serie - Ensino Fundamental',
                    '6 Serie - Ensino Fundamental'  => '6 Serie - Ensino Fundamental',
                    '7 Serie - Ensino Fundamental'  => '7 Serie - Ensino Fundamental',
                    '8 Serie - Ensino Fundamental'  => '8 Serie - Ensino Fundamental',
                    'Ensino Fundamental completo'   => 'Ensino Fundamental completo',
                    'Ensino Medio incompleto'       => 'Ensino Medio incompleto',
                    'Ensino Medio completo'         => 'Ensino Medio completo',
                    'Superior incompleto'           => 'Superior incompleto',
                    'Superior completo'             => 'Superior completo',
                    'Pós graduação'                 => 'Pós graduação',
                    'Mestrado'                      => 'Mestrado',
                    'Doutorado'                     => 'Doutorado'
                    ),
                'label'=>'Escolaridade',
                'placeholder'=>'Informe'
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
            ->add('fezOuFazOutrosAcompanhamentosQuais', 'text', ['required'=>false])
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
            ->add('condicaoDeTrabalho', 'choice', array(
                'choices' => array(
                    'Assalariado com CTPS'      => 'Assalariado com CTPS',
                    'Assalariado sem CTPS'      => 'Assalariado sem CTPS',
                    'Servidor público'          => 'Servidor público',
                    'Autônomo'                  => 'Autônomo',
                    'Aposentado/Pensionista'    => 'Aposentado/Pensionista',
                    'Trabalhador rural'         => 'Trabalhador rural',
                    'Desempregado'              => 'Desempregado',
                    'Não trabalha'              => 'Não trabalha'
                    ),
                'label'=>'Condição de trabalho',
                'placeholder'=>'Informe'
            ))
            ->add('despesasMensaisAluguel', 'text', ['required'=>false])
            ->add('despesasMensaisPrestacaoHabitacao', 'text', ['required'=>false])
            ->add('despesasMensaisAgua', 'text', ['required'=>false])
            ->add('despesasMensaisLuz', 'text', ['required'=>false])
            ->add('despesasMensaisTelefone', 'text', ['required'=>false])
            ->add('despesasMensaisMedicamentos', 'text', ['required'=>false])
            ->add('despesasMensaisOutras', 'text', ['required'=>false])
            ->add('encaminhamentoAoProjeto', 'choice', array(
                'choices' => array(
                    'CRAS (Casa da Família)'                    => 'CRAS (Casa da Família)',
                    'Igrejas, Pastorais'                        => 'Igrejas, Pastorais',
                    'CREAS'                                     => 'CREAS',
                    'Gerência Regional da Assistência Social'   => 'Gerência Regional da Assistência Social',
                    'Procura espontânea'                        => 'Procura espontânea',
                    'Outras entidades sócio-assistenciais'      => 'Outras entidades sócio-assistenciais',
                    'Busca ativa'                               => 'Busca ativa',
                    'Escolas'                                   => 'Escolas',
                    'Serviço de Saúde'                          => 'Serviço de Saúde',
                    'Outras entidades'                          => 'Outras entidades',
                    'Forum'                                     => 'Forum',
                    'Outros'                                    => 'Outros'
                    ),
                'label'=>'Encaminhamento ao projeto',
                'placeholder' => 'Informe'
            ))
            ->add('comoFicouSabendoDoProjeto', 'choice', array(
                'choices' => array(
                    'Jornal'                        => 'Jornal',
                    'Igrejas'                       => 'Igrejas',
                    'Rádio'                         => 'Rádio',
                    'Internet'                      => 'Internet',
                    'Panfleto'                      => 'Panfleto',
                    'Mobilização da universidade'   => 'Mobilização da universidade',
                    'Boca a Boca'                   => 'Boca a Boca',
                    'Amigos'                        => 'Amigos',
                    'Forum'                         => 'Forum',
                    'Outros'                        => 'Outros'
                    ),
                'label'=>'Como ficou sabendo do projeto',
                'placeholder'=>'Informe'
            ))
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
