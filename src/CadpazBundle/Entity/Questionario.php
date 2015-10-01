<?php

namespace CadpazBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Questionario
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CadpazBundle\Entity\QuestionarioRepository")
 */
class Questionario
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="moradiaOutra", type="string", length=100)
     */
    private $moradia;
    // Exibir ComboBox com opcoes pre definidas
    // Moradia própria quitada
    // Moradia própria financiada
    // Moradia alugada
    // Em habitação coletiva
    // Em moradia cedida
    // Outra

    /**
     * @var boolean
     *
     * @ORM\Column(name="moraSozinho", type="boolean")
     */
    private $moraSozinho;

    /**
     * @var boolean
     *
     * @ORM\Column(name="moraComFilhos", type="boolean")
     */
    private $moraComFilhos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="moraComPaiMae", type="boolean")
     */
    private $moraComPaiMae;

    /**
     * @var boolean
     *
     * @ORM\Column(name="moraComIrmaos", type="boolean")
     */
    private $moraComIrmaos;

    /**
     * @var boolean
     *
     * @ORM\Column(name="moraComConjuge", type="boolean")
     */
    private $moraComConjuge;

    /**
     * @var boolean
     *
     * @ORM\Column(name="moraComParentesAmigosColegas", type="boolean")
     */
    private $moraComParentesAmigosColegas;

    /**
     * @var boolean
     *
     * @ORM\Column(name="moraComOutraSituacao", type="boolean")
     */
    private $moraComOutraSituacao;

    /**
     * @var integer
     *
     * @ORM\Column(name="quantasPessoasMoramNaCasa", type="integer")
     */
    private $quantasPessoasMoramNaCasa;

    /**
     * @var integer
     *
     * @ORM\Column(name="numeroDeFilhos", type="integer")
     */
    private $numeroDeFilhos = 0;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="moradiaTemColetaDeLixo", type="boolean")
     */
    private $moradiaTemColetaDeLixo;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="moradiaTemRedeDeEsgoto", type="boolean")
     */
    private $moradiaTemRedeDeEsgoto;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="moradiaTemRuaPavimentada", type="boolean")
     */
    private $moradiaTemRuaPavimentada;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="moradiaSituadaEmZonaRural", type="boolean")
     */
    private $moradiaSituadaEmZonaRural;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="moradiaTemAguaEncanada", type="boolean")
     */
    private $moradiaTemAguaEncanada;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="moradiaSituadaEmComunidadeQuilombolaOuIndigena", type="boolean")
     */
    private $moradiaSituadaEmComunidadeQuilombolaOuIndigena;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="moradiaTemEletricidade", type="boolean")
     */
    private $moradiaTemEletricidade;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="tipoDeMoradia", type="string", length=100)
     */
    private $tipoDeMoradia;
    // Exibir ComboBox com opcoes pre definidas
    // Casa
    // Barracão
    // Apartamento
    // Galpão
    
    /**
     * @var string
     *
     * @ORM\Column(name="escolaridade", type="string", length=100)
     */
    private $escolaridade;
    // Exibir ComboBox com opções pré definidas
    // Analfabeto
    // 1 Serie - Fundamental
    // 2 Serie - Fundamental
    // ...
    // Fundamental completo
    // Ens. Medio incompleto
    // Ens. Medio completo
    // Superior incompleto
    // Superior completo
    // Pos Graduação
    // Mestrado
    // Doutorado
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="estudaAtualmente", type="boolean")
     */
    private $estudaAtualmente;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="temInteresseEmVoltarAEstudar", type="boolean")
     */
    private $temInteresseEmVoltarAEstudar = false;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="temFilhosEmIdadeEscolar", type="boolean")
     */
    private $temFilhosEmIdadeEscolar;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="temFilhosMatriculadosEmEscola", type="boolean")
     */
    private $temFilhosMatriculadosEmEscola = false;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="deficienciaFisica", type="boolean")
     */
    private $deficienciaFisica;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="deficienciaAuditiva", type="boolean")
     */
    private $deficienciaAuditiva;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="deficienciaMental", type="boolean")
     */
    private $deficienciaMental;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="deficienciaVisual", type="boolean")
     */
    private $deficienciaVisual;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="fezOuFazAcompanhamentoNeurologico", type="boolean")
     */
    private $fezOuFazAcompanhamentoNeurologico;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="fezOuFazAcompanhamentoPsicologico", type="boolean")
     */
    private $fezOuFazAcompanhamentoPisicologico;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="fezOuFazOutrosAcompanhamentos", type="boolean")
     */
    private $fezOuFazOutrosAcompanhamentos;
    
    /**
     * @var string
     *
     * @ORM\Column(name="fezOuFazOutrosAcompnhamentosQuais", type="string", length=100, nullable=true)
     */
    private $fezOuFazOutrosAcompanhamentosQuais;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="fazUsoDeMedicacaoConstante", type="boolean")
     */
    private $fazUsoDeMedicacaoConstante;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="redebeMedicacaoDaFarmaciaDistrital", type="boolean")
     */
    private $recebeMedicacaoDaFarmaciaDistrital = false;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="domicilioCobertoPorUBSOuPSF", type="boolean")
     */
    private $domicilioCobertoPorUBSOuPSF;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="pessoaIdosaOuGestanteNaFamilia", type="boolean")
     */
    private $pessoaIdosaOuGestanteNaFamilia;
    
    /**
     * @var string
     *
     * @ORM\Column(name="rendaFamiliar", type="string", length=50)
     */
    private $rendaFamiliar;
    // Exibir ComboBox com opções pré definidas
    // Até 1 Sal. Min
    // Entre 1 e 2 Sal. Min
    // De 3 a 5 Sal. Min
    // De 6 a 10 Sal. Min
    // De 11 a 30 Sal. Min
    // Acima de 30 sal. min
    // Nenhuma renda
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="participaOuRecebePETIBolsaCriancaCidada", type="boolean")
     */
    private $participaOuRecebePETIBolsaCriancaCidada;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="participaOuRecebeAgenteJovem", type="boolean")
     */
    private $participaOuRecebeAgenteJovem;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="participaOuRecebeBolsaFamilia", type="boolean")
     */
    private $participaOuRecebeBolsaFamilia;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="participaOuRecebeBCP", type="boolean")
     */
    private $participaOuRecebeBCP;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="participaOuRecebeNaoRespondeu", type="boolean")
     */
    private $participaOuRecebeNaoRespondeu;
    
    /**
     * @var boolean
     *
     * @ORM\Column(name="participaOuRecebeNaoSabe", type="boolean")
     */
    private $participaOuRecebeNaoSabe;
    
    /**
     * @var string
     *
     * @ORM\Column(name="condicaoDeTrabalho", type="string", length=50)
     */
    private $condicaoDeTrabalho;
    // Exibir ComboBox com opcoes pre definidas
    // Assalariado com CTPS
    // Assalariado sem CTPS
    // Bico
    // Aposentado/Pensionista
    // Autônomo
    // Trabalhador Rural
    // Desempregado
    // Não trabalha
    
    /**
     * @var float
     *
     * @ORM\Column(name="despesasMensaisAluguel", type="float")
     */
    private $despesasMensaisAluguel = 0;
    
    /**
     * @var float
     *
     * @ORM\Column(name="despesasMensaisPrestacaoHabitacao", type="float")
     */
    private $despesasMensaisPrestacaoHabitacao = 0;
    
    /**
     * @var float
     *
     * @ORM\Column(name="despesasMensaisAgua", type="float")
     */
    private $despesasMensaisAgua = 0;
    
    /**
     * @var float
     *
     * @ORM\Column(name="despesasMensaisLuz", type="float")
     */
    private $despesasMensaisLuz = 0;
    
    /**
     * @var float
     *
     * @ORM\Column(name="despesasMensaisTelefone", type="float")
     */
    private $despesasMensaisTelefone = 0;
    
    /**
     * @var float
     *
     * @ORM\Column(name="despesasMensaisMedicamentos", type="float")
     */
    private $despesasMensaisMedicamentos = 0;
    
    /**
     * @var float
     *
     * @ORM\Column(name="despesasMensaisOutras", type="float")
     */
    private $despesasMensaisOutras = 0;
    
    /**
     * @var string
     *
     * @ORM\Column(name="encaminhamentoAoProjeto", type="string", length=100)
     */
    private $encaminhamentoAoProjeto;
    // Exibir ComboBox com opções pré definidas
    // CRAS (Casa da Família)
    // Igrejas, Pastorais
    // CREAS
    // Gerência Regional da Assistência Social
    // Escolas
    // Serviçoes de Saúde
    // Forum
    // Procura espontânea
    // Busca ativa
    // Outras entidades
    // Outros
    
    /**
     * @var string
     *
     * @ORM\Column(name="comoFicouSabendoDoProjeto", type="string", length=100)
     */
    private $comoFicouSabendoDoProjeto;
    // Exibir ComboBox com opções pré definidas
    // Jornal
    // Igrejas
    // Rádio
    // Internet
    // Panfleto
    // Mobilização da universidade
    // Boca a boa
    // Amigos
    // Forum
    // Outros
    
    /**
     * @var string
     *
     * @ORM\Column(name="observacoes", type="text")
     */
    private $observacoes;
    // Fatos informados pelo beneficiário

    /**
     * @ORM\OneToOne(targetEntity="Pessoa", inversedBy="questionario")
     * @ORM\JoinColumn(name="pessoa_id", referencedColumnName="id")
     */
    protected $pessoa;

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set moradia
     *
     * @param string $moradia
     * @return Questionario
     */
    public function setMoradia($moradia)
    {
        $this->moradia = $moradia;

        return $this;
    }

    /**
     * Get moradia
     *
     * @return string 
     */
    public function getMoradia()
    {
        return $this->moradia;
    }

    /**
     * Set moraSozinho
     *
     * @param boolean $moraSozinho
     * @return Questionario
     */
    public function setMoraSozinho($moraSozinho)
    {
        $this->moraSozinho = $moraSozinho;

        return $this;
    }

    /**
     * Get moraSozinho
     *
     * @return boolean 
     */
    public function getMoraSozinho()
    {
        return $this->moraSozinho;
    }

    /**
     * Set moraComFilhos
     *
     * @param boolean $moraComFilhos
     * @return Questionario
     */
    public function setMoraComFilhos($moraComFilhos)
    {
        $this->moraComFilhos = $moraComFilhos;

        return $this;
    }

    /**
     * Get moraComFilhos
     *
     * @return boolean 
     */
    public function getMoraComFilhos()
    {
        return $this->moraComFilhos;
    }

    /**
     * Set moraComPaiMae
     *
     * @param boolean $moraComPaiMae
     * @return Questionario
     */
    public function setMoraComPaiMae($moraComPaiMae)
    {
        $this->moraComPaiMae = $moraComPaiMae;

        return $this;
    }

    /**
     * Get moraComPaiMae
     *
     * @return boolean 
     */
    public function getMoraComPaiMae()
    {
        return $this->moraComPaiMae;
    }

    /**
     * Set moraComIrmaos
     *
     * @param boolean $moraComIrmaos
     * @return Questionario
     */
    public function setMoraComIrmaos($moraComIrmaos)
    {
        $this->moraComIrmaos = $moraComIrmaos;

        return $this;
    }

    /**
     * Get moraComIrmaos
     *
     * @return boolean 
     */
    public function getMoraComIrmaos()
    {
        return $this->moraComIrmaos;
    }

    /**
     * Set moraComConjuge
     *
     * @param boolean $moraComConjuge
     * @return Questionario
     */
    public function setMoraComConjuge($moraComConjuge)
    {
        $this->moraComConjuge = $moraComConjuge;

        return $this;
    }

    /**
     * Get moraComConjuge
     *
     * @return boolean 
     */
    public function getMoraComConjuge()
    {
        return $this->moraComConjuge;
    }

    /**
     * Set moraComParentesAmigosColegas
     *
     * @param boolean $moraComParentesAmigosColegas
     * @return Questionario
     */
    public function setMoraComParentesAmigosColegas($moraComParentesAmigosColegas)
    {
        $this->moraComParentesAmigosColegas = $moraComParentesAmigosColegas;

        return $this;
    }

    /**
     * Get moraComParentesAmigosColegas
     *
     * @return boolean 
     */
    public function getMoraComParentesAmigosColegas()
    {
        return $this->moraComParentesAmigosColegas;
    }

    /**
     * Set moraComOutraSituacao
     *
     * @param string $moraComOutraSituacao
     * @return Questionario
     */
    public function setMoraComOutraSituacao($moraComOutraSituacao)
    {
        $this->moraComOutraSituacao = $moraComOutraSituacao;

        return $this;
    }

    /**
     * Get moraComOutraSituacao
     *
     * @return string 
     */
    public function getMoraComOutraSituacao()
    {
        return $this->moraComOutraSituacao;
    }

    /**
     * Set quantasPessoasMoramNaCasa
     *
     * @param integer $quantasPessoasMoramNaCasa
     * @return Questionario
     */
    public function setQuantasPessoasMoramNaCasa($quantasPessoasMoramNaCasa)
    {
        $this->quantasPessoasMoramNaCasa = $quantasPessoasMoramNaCasa;

        return $this;
    }

    /**
     * Get quantasPessoasMoramNaCasa
     *
     * @return integer 
     */
    public function getQuantasPessoasMoramNaCasa()
    {
        return $this->quantasPessoasMoramNaCasa;
    }

    /**
     * Set numeroDeFilhos
     *
     * @param integer $numeroDeFilhos
     * @return Questionario
     */
    public function setNumeroDeFilhos($numeroDeFilhos)
    {
        $this->numeroDeFilhos = $numeroDeFilhos;

        return $this;
    }

    /**
     * Get numeroDeFilhos
     *
     * @return integer 
     */
    public function getNumeroDeFilhos()
    {
        return $this->numeroDeFilhos;
    }

    /**
     * Set moradiaTemColetaDeLixo
     *
     * @param boolean $moradiaTemColetaDeLixo
     * @return Questionario
     */
    public function setMoradiaTemColetaDeLixo($moradiaTemColetaDeLixo)
    {
        $this->moradiaTemColetaDeLixo = $moradiaTemColetaDeLixo;

        return $this;
    }

    /**
     * Get moradiaTemColetaDeLixo
     *
     * @return boolean 
     */
    public function getMoradiaTemColetaDeLixo()
    {
        return $this->moradiaTemColetaDeLixo;
    }

    /**
     * Set moradiaTemRedeDeEsgoto
     *
     * @param boolean $moradiaTemRedeDeEsgoto
     * @return Questionario
     */
    public function setMoradiaTemRedeDeEsgoto($moradiaTemRedeDeEsgoto)
    {
        $this->moradiaTemRedeDeEsgoto = $moradiaTemRedeDeEsgoto;

        return $this;
    }

    /**
     * Get moradiaTemRedeDeEsgoto
     *
     * @return boolean 
     */
    public function getMoradiaTemRedeDeEsgoto()
    {
        return $this->moradiaTemRedeDeEsgoto;
    }

    /**
     * Set moradiaTemRuaPavimentada
     *
     * @param boolean $moradiaTemRuaPavimentada
     * @return Questionario
     */
    public function setMoradiaTemRuaPavimentada($moradiaTemRuaPavimentada)
    {
        $this->moradiaTemRuaPavimentada = $moradiaTemRuaPavimentada;

        return $this;
    }

    /**
     * Get moradiaTemRuaPavimentada
     *
     * @return boolean 
     */
    public function getMoradiaTemRuaPavimentada()
    {
        return $this->moradiaTemRuaPavimentada;
    }

    /**
     * Set moradiaSituadaEmZonaRural
     *
     * @param boolean $moradiaSituadaEmZonaRural
     * @return Questionario
     */
    public function setMoradiaSituadaEmZonaRural($moradiaSituadaEmZonaRural)
    {
        $this->moradiaSituadaEmZonaRural = $moradiaSituadaEmZonaRural;

        return $this;
    }

    /**
     * Get moradiaSituadaEmZonaRural
     *
     * @return boolean 
     */
    public function getMoradiaSituadaEmZonaRural()
    {
        return $this->moradiaSituadaEmZonaRural;
    }

    /**
     * Set moradiaTemAguaEncanada
     *
     * @param boolean $moradiaTemAguaEncanada
     * @return Questionario
     */
    public function setMoradiaTemAguaEncanada($moradiaTemAguaEncanada)
    {
        $this->moradiaTemAguaEncanada = $moradiaTemAguaEncanada;

        return $this;
    }

    /**
     * Get moradiaTemAguaEncanada
     *
     * @return boolean 
     */
    public function getMoradiaTemAguaEncanada()
    {
        return $this->moradiaTemAguaEncanada;
    }

    /**
     * Set moradiaSituadaEmComunidadeQuilombolaOuIndigena
     *
     * @param boolean $moradiaSituadaEmComunidadeQuilombolaOuIndigena
     * @return Questionario
     */
    public function setMoradiaSituadaEmComunidadeQuilombolaOuIndigena($moradiaSituadaEmComunidadeQuilombolaOuIndigena)
    {
        $this->moradiaSituadaEmComunidadeQuilombolaOuIndigena = $moradiaSituadaEmComunidadeQuilombolaOuIndigena;

        return $this;
    }

    /**
     * Get moradiaSituadaEmComunidadeQuilombolaOuIndigena
     *
     * @return boolean 
     */
    public function getMoradiaSituadaEmComunidadeQuilombolaOuIndigena()
    {
        return $this->moradiaSituadaEmComunidadeQuilombolaOuIndigena;
    }

    /**
     * Set moradiaTemEletricidade
     *
     * @param boolean $moradiaTemEletricidade
     * @return Questionario
     */
    public function setMoradiaTemEletricidade($moradiaTemEletricidade)
    {
        $this->moradiaTemEletricidade = $moradiaTemEletricidade;

        return $this;
    }

    /**
     * Get moradiaTemEletricidade
     *
     * @return boolean 
     */
    public function getMoradiaTemEletricidade()
    {
        return $this->moradiaTemEletricidade;
    }

    /**
     * Set tipoDeMoradia
     *
     * @param string $tipoDeMoradia
     * @return Questionario
     */
    public function setTipoDeMoradia($tipoDeMoradia)
    {
        $this->tipoDeMoradia = $tipoDeMoradia;

        return $this;
    }

    /**
     * Get tipoDeMoradia
     *
     * @return string 
     */
    public function getTipoDeMoradia()
    {
        return $this->tipoDeMoradia;
    }

    /**
     * Set escolaridade
     *
     * @param boolean $escolaridade
     * @return Questionario
     */
    public function setEscolaridade($escolaridade)
    {
        $this->escolaridade = $escolaridade;

        return $this;
    }

    /**
     * Get escolaridade
     *
     * @return boolean 
     */
    public function getEscolaridade()
    {
        return $this->escolaridade;
    }

    /**
     * Set estudaAtualmente
     *
     * @param boolean $estudaAtualmente
     * @return Questionario
     */
    public function setEstudaAtualmente($estudaAtualmente)
    {
        $this->estudaAtualmente = $estudaAtualmente;

        return $this;
    }

    /**
     * Get estudaAtualmente
     *
     * @return boolean 
     */
    public function getEstudaAtualmente()
    {
        return $this->estudaAtualmente;
    }

    /**
     * Set temInteresseEmVoltarAEstudar
     *
     * @param boolean $temInteresseEmVoltarAEstudar
     * @return Questionario
     */
    public function setTemInteresseEmVoltarAEstudar($temInteresseEmVoltarAEstudar)
    {
        $this->temInteresseEmVoltarAEstudar = $temInteresseEmVoltarAEstudar;

        return $this;
    }

    /**
     * Get temInteresseEmVoltarAEstudar
     *
     * @return boolean 
     */
    public function getTemInteresseEmVoltarAEstudar()
    {
        return $this->temInteresseEmVoltarAEstudar;
    }

    /**
     * Set temFilhosEmIdadeEscolar
     *
     * @param boolean $temFilhosEmIdadeEscolar
     * @return Questionario
     */
    public function setTemFilhosEmIdadeEscolar($temFilhosEmIdadeEscolar)
    {
        $this->temFilhosEmIdadeEscolar = $temFilhosEmIdadeEscolar;

        return $this;
    }

    /**
     * Get temFilhosEmIdadeEscolar
     *
     * @return boolean 
     */
    public function getTemFilhosEmIdadeEscolar()
    {
        return $this->temFilhosEmIdadeEscolar;
    }

    /**
     * Set temFilhosMatriculadosEmEscola
     *
     * @param boolean $temFilhosMatriculadosEmEscola
     * @return Questionario
     */
    public function setTemFilhosMatriculadosEmEscola($temFilhosMatriculadosEmEscola)
    {
        $this->temFilhosMatriculadosEmEscola = $temFilhosMatriculadosEmEscola;

        return $this;
    }

    /**
     * Get temFilhosMatriculadosEmEscola
     *
     * @return boolean 
     */
    public function getTemFilhosMatriculadosEmEscola()
    {
        return $this->temFilhosMatriculadosEmEscola;
    }

    /**
     * Set deficienciaFisica
     *
     * @param boolean $deficienciaFisica
     * @return Questionario
     */
    public function setDeficienciaFisica($deficienciaFisica)
    {
        $this->deficienciaFisica = $deficienciaFisica;

        return $this;
    }

    /**
     * Get deficienciaFisica
     *
     * @return boolean 
     */
    public function getDeficienciaFisica()
    {
        return $this->deficienciaFisica;
    }

    /**
     * Set deficienciaAuditiva
     *
     * @param boolean $deficienciaAuditiva
     * @return Questionario
     */
    public function setDeficienciaAuditiva($deficienciaAuditiva)
    {
        $this->deficienciaAuditiva = $deficienciaAuditiva;

        return $this;
    }

    /**
     * Get deficienciaAuditiva
     *
     * @return boolean 
     */
    public function getDeficienciaAuditiva()
    {
        return $this->deficienciaAuditiva;
    }

    /**
     * Set deficienciaMental
     *
     * @param boolean $deficienciaMental
     * @return Questionario
     */
    public function setDeficienciaMental($deficienciaMental)
    {
        $this->deficienciaMental = $deficienciaMental;

        return $this;
    }

    /**
     * Get deficienciaMental
     *
     * @return boolean 
     */
    public function getDeficienciaMental()
    {
        return $this->deficienciaMental;
    }

    /**
     * Set deficienciaVisual
     *
     * @param boolean $deficienciaVisual
     * @return Questionario
     */
    public function setDeficienciaVisual($deficienciaVisual)
    {
        $this->deficienciaVisual = $deficienciaVisual;

        return $this;
    }

    /**
     * Get deficienciaVisual
     *
     * @return boolean 
     */
    public function getDeficienciaVisual()
    {
        return $this->deficienciaVisual;
    }

    /**
     * Set fezOuFazAcompanhamentoNeurologico
     *
     * @param boolean $fezOuFazAcompanhamentoNeurologico
     * @return Questionario
     */
    public function setFezOuFazAcompanhamentoNeurologico($fezOuFazAcompanhamentoNeurologico)
    {
        $this->fezOuFazAcompanhamentoNeurologico = $fezOuFazAcompanhamentoNeurologico;

        return $this;
    }

    /**
     * Get fezOuFazAcompanhamentoNeurologico
     *
     * @return boolean 
     */
    public function getFezOuFazAcompanhamentoNeurologico()
    {
        return $this->fezOuFazAcompanhamentoNeurologico;
    }

    /**
     * Set fezOuFazAcompanhamentoPisicologico
     *
     * @param boolean $fezOuFazAcompanhamentoPisicologico
     * @return Questionario
     */
    public function setFezOuFazAcompanhamentoPisicologico($fezOuFazAcompanhamentoPisicologico)
    {
        $this->fezOuFazAcompanhamentoPisicologico = $fezOuFazAcompanhamentoPisicologico;

        return $this;
    }

    /**
     * Get fezOuFazAcompanhamentoPisicologico
     *
     * @return boolean 
     */
    public function getFezOuFazAcompanhamentoPisicologico()
    {
        return $this->fezOuFazAcompanhamentoPisicologico;
    }

    /**
     * Set fezOuFazOutrosAcompanhamentos
     *
     * @param boolean $fezOuFazOutrosAcompanhamentos
     * @return Questionario
     */
    public function setFezOuFazOutrosAcompanhamentos($fezOuFazOutrosAcompanhamentos)
    {
        $this->fezOuFazOutrosAcompanhamentos = $fezOuFazOutrosAcompanhamentos;

        return $this;
    }

    /**
     * Get fezOuFazOutrosAcompanhamentos
     *
     * @return boolean 
     */
    public function getFezOuFazOutrosAcompanhamentos()
    {
        return $this->fezOuFazOutrosAcompanhamentos;
    }

    /**
     * Set fezOuFazOutrosAcompanhamentosQuais
     *
     * @param string $fezOuFazOutrosAcompanhamentosQuais
     * @return Questionario
     */
    public function setFezOuFazOutrosAcompanhamentosQuais($fezOuFazOutrosAcompanhamentosQuais)
    {
        $this->fezOuFazOutrosAcompanhamentosQuais = $fezOuFazOutrosAcompanhamentosQuais;

        return $this;
    }

    /**
     * Get fezOuFazOutrosAcompanhamentosQuais
     *
     * @return string 
     */
    public function getFezOuFazOutrosAcompanhamentosQuais()
    {
        return $this->fezOuFazOutrosAcompanhamentosQuais;
    }

    /**
     * Set fazUsoDeMedicacaoConstante
     *
     * @param boolean $fazUsoDeMedicacaoConstante
     * @return Questionario
     */
    public function setFazUsoDeMedicacaoConstante($fazUsoDeMedicacaoConstante)
    {
        $this->fazUsoDeMedicacaoConstante = $fazUsoDeMedicacaoConstante;

        return $this;
    }

    /**
     * Get fazUsoDeMedicacaoConstante
     *
     * @return boolean 
     */
    public function getFazUsoDeMedicacaoConstante()
    {
        return $this->fazUsoDeMedicacaoConstante;
    }

    /**
     * Set recebeMedicacaoDaFarmaciaDistrital
     *
     * @param boolean $recebeMedicacaoDaFarmaciaDistrital
     * @return Questionario
     */
    public function setRecebeMedicacaoDaFarmaciaDistrital($recebeMedicacaoDaFarmaciaDistrital)
    {
        $this->recebeMedicacaoDaFarmaciaDistrital = $recebeMedicacaoDaFarmaciaDistrital;

        return $this;
    }

    /**
     * Get recebeMedicacaoDaFarmaciaDistrital
     *
     * @return boolean 
     */
    public function getRecebeMedicacaoDaFarmaciaDistrital()
    {
        return $this->recebeMedicacaoDaFarmaciaDistrital;
    }

    /**
     * Set domicilioCobertoPorUBSOuPSF
     *
     * @param boolean $domicilioCobertoPorUBSOuPSF
     * @return Questionario
     */
    public function setDomicilioCobertoPorUBSOuPSF($domicilioCobertoPorUBSOuPSF)
    {
        $this->domicilioCobertoPorUBSOuPSF = $domicilioCobertoPorUBSOuPSF;

        return $this;
    }

    /**
     * Get domicilioCobertoPorUBSOuPSF
     *
     * @return boolean 
     */
    public function getDomicilioCobertoPorUBSOuPSF()
    {
        return $this->domicilioCobertoPorUBSOuPSF;
    }

    /**
     * Set pessoaIdosaOuGestanteNaFamilia
     *
     * @param boolean $pessoaIdosaOuGestanteNaFamilia
     * @return Questionario
     */
    public function setPessoaIdosaOuGestanteNaFamilia($pessoaIdosaOuGestanteNaFamilia)
    {
        $this->pessoaIdosaOuGestanteNaFamilia = $pessoaIdosaOuGestanteNaFamilia;

        return $this;
    }

    /**
     * Get pessoaIdosaOuGestanteNaFamilia
     *
     * @return boolean 
     */
    public function getPessoaIdosaOuGestanteNaFamilia()
    {
        return $this->pessoaIdosaOuGestanteNaFamilia;
    }

    /**
     * Set rendaFamiliar
     *
     * @param string $rendaFamiliar
     * @return Questionario
     */
    public function setRendaFamiliar($rendaFamiliar)
    {
        $this->rendaFamiliar = $rendaFamiliar;

        return $this;
    }

    /**
     * Get rendaFamiliar
     *
     * @return string 
     */
    public function getRendaFamiliar()
    {
        return $this->rendaFamiliar;
    }

    /**
     * Set participaOuRecebePETIBolsaCriancaCidada
     *
     * @param boolean $participaOuRecebePETIBolsaCriancaCidada
     * @return Questionario
     */
    public function setParticipaOuRecebePETIBolsaCriancaCidada($participaOuRecebePETIBolsaCriancaCidada)
    {
        $this->participaOuRecebePETIBolsaCriancaCidada = $participaOuRecebePETIBolsaCriancaCidada;

        return $this;
    }

    /**
     * Get participaOuRecebePETIBolsaCriancaCidada
     *
     * @return boolean 
     */
    public function getParticipaOuRecebePETIBolsaCriancaCidada()
    {
        return $this->participaOuRecebePETIBolsaCriancaCidada;
    }

    /**
     * Set participaOuRecebeAgenteJovem
     *
     * @param boolean $participaOuRecebeAgenteJovem
     * @return Questionario
     */
    public function setParticipaOuRecebeAgenteJovem($participaOuRecebeAgenteJovem)
    {
        $this->participaOuRecebeAgenteJovem = $participaOuRecebeAgenteJovem;

        return $this;
    }

    /**
     * Get participaOuRecebeAgenteJovem
     *
     * @return boolean 
     */
    public function getParticipaOuRecebeAgenteJovem()
    {
        return $this->participaOuRecebeAgenteJovem;
    }

    /**
     * Set participaOuRecebeBolsaFamilia
     *
     * @param boolean $participaOuRecebeBolsaFamilia
     * @return Questionario
     */
    public function setParticipaOuRecebeBolsaFamilia($participaOuRecebeBolsaFamilia)
    {
        $this->participaOuRecebeBolsaFamilia = $participaOuRecebeBolsaFamilia;

        return $this;
    }

    /**
     * Get participaOuRecebeBolsaFamilia
     *
     * @return boolean 
     */
    public function getParticipaOuRecebeBolsaFamilia()
    {
        return $this->participaOuRecebeBolsaFamilia;
    }

    /**
     * Set participaOuRecebeBCP
     *
     * @param boolean $participaOuRecebeBCP
     * @return Questionario
     */
    public function setParticipaOuRecebeBCP($participaOuRecebeBCP)
    {
        $this->participaOuRecebeBCP = $participaOuRecebeBCP;

        return $this;
    }

    /**
     * Get participaOuRecebeBCP
     *
     * @return boolean 
     */
    public function getParticipaOuRecebeBCP()
    {
        return $this->participaOuRecebeBCP;
    }

    /**
     * Set participaOuRecebeNaoRespondeu
     *
     * @param boolean $participaOuRecebeNaoRespondeu
     * @return Questionario
     */
    public function setParticipaOuRecebeNaoRespondeu($participaOuRecebeNaoRespondeu)
    {
        $this->participaOuRecebeNaoRespondeu = $participaOuRecebeNaoRespondeu;

        return $this;
    }

    /**
     * Get participaOuRecebeNaoRespondeu
     *
     * @return boolean 
     */
    public function getParticipaOuRecebeNaoRespondeu()
    {
        return $this->participaOuRecebeNaoRespondeu;
    }

    /**
     * Set participaOuRecebeNaoSabe
     *
     * @param boolean $participaOuRecebeNaoSabe
     * @return Questionario
     */
    public function setParticipaOuRecebeNaoSabe($participaOuRecebeNaoSabe)
    {
        $this->participaOuRecebeNaoSabe = $participaOuRecebeNaoSabe;

        return $this;
    }

    /**
     * Get participaOuRecebeNaoSabe
     *
     * @return boolean 
     */
    public function getParticipaOuRecebeNaoSabe()
    {
        return $this->participaOuRecebeNaoSabe;
    }

    /**
     * Set condicaoDeTrabalho
     *
     * @param string $condicaoDeTrabalho
     * @return Questionario
     */
    public function setCondicaoDeTrabalho($condicaoDeTrabalho)
    {
        $this->condicaoDeTrabalho = $condicaoDeTrabalho;

        return $this;
    }

    /**
     * Get condicaoDeTrabalho
     *
     * @return string 
     */
    public function getCondicaoDeTrabalho()
    {
        return $this->condicaoDeTrabalho;
    }

    /**
     * Set despesasMensaisAluguel
     *
     * @param float $despesasMensaisAluguel
     * @return Questionario
     */
    public function setDespesasMensaisAluguel($despesasMensaisAluguel)
    {
        $this->despesasMensaisAluguel = $despesasMensaisAluguel;

        return $this;
    }

    /**
     * Get despesasMensaisAluguel
     *
     * @return float 
     */
    public function getDespesasMensaisAluguel()
    {
        return $this->despesasMensaisAluguel;
    }

    /**
     * Set despesasMensaisPrestacaoHabitacao
     *
     * @param float $despesasMensaisPrestacaoHabitacao
     * @return Questionario
     */
    public function setDespesasMensaisPrestacaoHabitacao($despesasMensaisPrestacaoHabitacao)
    {
        $this->despesasMensaisPrestacaoHabitacao = $despesasMensaisPrestacaoHabitacao;

        return $this;
    }

    /**
     * Get despesasMensaisPrestacaoHabitacao
     *
     * @return float 
     */
    public function getDespesasMensaisPrestacaoHabitacao()
    {
        return $this->despesasMensaisPrestacaoHabitacao;
    }

    /**
     * Set despesasMensaisAgua
     *
     * @param float $despesasMensaisAgua
     * @return Questionario
     */
    public function setDespesasMensaisAgua($despesasMensaisAgua)
    {
        $this->despesasMensaisAgua = $despesasMensaisAgua;

        return $this;
    }

    /**
     * Get despesasMensaisAgua
     *
     * @return float 
     */
    public function getDespesasMensaisAgua()
    {
        return $this->despesasMensaisAgua;
    }

    /**
     * Set despesasMensaisLuz
     *
     * @param float $despesasMensaisLuz
     * @return Questionario
     */
    public function setDespesasMensaisLuz($despesasMensaisLuz)
    {
        $this->despesasMensaisLuz = $despesasMensaisLuz;

        return $this;
    }

    /**
     * Get despesasMensaisLuz
     *
     * @return float 
     */
    public function getDespesasMensaisLuz()
    {
        return $this->despesasMensaisLuz;
    }

    /**
     * Set despesasMensaisTelefone
     *
     * @param float $despesasMensaisTelefone
     * @return Questionario
     */
    public function setDespesasMensaisTelefone($despesasMensaisTelefone)
    {
        $this->despesasMensaisTelefone = $despesasMensaisTelefone;

        return $this;
    }

    /**
     * Get despesasMensaisTelefone
     *
     * @return float 
     */
    public function getDespesasMensaisTelefone()
    {
        return $this->despesasMensaisTelefone;
    }

    /**
     * Set despesasMensaisMedicamentos
     *
     * @param float $despesasMensaisMedicamentos
     * @return Questionario
     */
    public function setDespesasMensaisMedicamentos($despesasMensaisMedicamentos)
    {
        $this->despesasMensaisMedicamentos = $despesasMensaisMedicamentos;

        return $this;
    }

    /**
     * Get despesasMensaisMedicamentos
     *
     * @return float 
     */
    public function getDespesasMensaisMedicamentos()
    {
        return $this->despesasMensaisMedicamentos;
    }

    /**
     * Set despesasMensaisOutras
     *
     * @param float $despesasMensaisOutras
     * @return Questionario
     */
    public function setDespesasMensaisOutras($despesasMensaisOutras)
    {
        $this->despesasMensaisOutras = $despesasMensaisOutras;

        return $this;
    }

    /**
     * Get despesasMensaisOutras
     *
     * @return float 
     */
    public function getDespesasMensaisOutras()
    {
        return $this->despesasMensaisOutras;
    }

    /**
     * Set encaminhamentoAoProjeto
     *
     * @param string $encaminhamentoAoProjeto
     * @return Questionario
     */
    public function setEncaminhamentoAoProjeto($encaminhamentoAoProjeto)
    {
        $this->encaminhamentoAoProjeto = $encaminhamentoAoProjeto;

        return $this;
    }

    /**
     * Get encaminhamentoAoProjeto
     *
     * @return string 
     */
    public function getEncaminhamentoAoProjeto()
    {
        return $this->encaminhamentoAoProjeto;
    }

    /**
     * Set comoFicouSabendoDoProjeto
     *
     * @param string $comoFicouSabendoDoProjeto
     * @return Questionario
     */
    public function setComoFicouSabendoDoProjeto($comoFicouSabendoDoProjeto)
    {
        $this->comoFicouSabendoDoProjeto = $comoFicouSabendoDoProjeto;

        return $this;
    }

    /**
     * Get comoFicouSabendoDoProjeto
     *
     * @return string 
     */
    public function getComoFicouSabendoDoProjeto()
    {
        return $this->comoFicouSabendoDoProjeto;
    }

    /**
     * Set observacoes
     *
     * @param string $observacoes
     * @return Questionario
     */
    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;

        return $this;
    }

    /**
     * Get observacoes
     *
     * @return string 
     */
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    /**
     * Set pessoa
     *
     * @param \CadpazBundle\Entity\Pessoa $pessoa
     * @return Questionario
     */
    public function setPessoa(\CadpazBundle\Entity\Pessoa $pessoa = null)
    {
        $this->pessoa = $pessoa;

        return $this;
    }

    /**
     * Get pessoa
     *
     * @return \CadpazBundle\Entity\Pessoa 
     */
    public function getPessoa()
    {
        return $this->pessoa;
    }
}
