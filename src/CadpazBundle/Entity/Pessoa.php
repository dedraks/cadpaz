<?php

namespace CadpazBundle\Entity;
use Doctrine\Common\Collections\ArrayCollection;

use Doctrine\ORM\Mapping as ORM;

/**
 * Pessoa
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Pessoa
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
     * @ORM\Column(name="nome", type="string", length=100)
     */
    private $nome;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataNascimento", type="date")
     */
    private $dataNascimento;

    /**
     * @var string
     *
     * @ORM\Column(name="sexo", type="string", length=1)
     */
    private $sexo;

    /**
     * @var string
     *
     * @ORM\Column(name="cpf", type="string", length=11)
     */
    private $cpf;

    /**
     * @var string
     *
     * @ORM\Column(name="rgNumero", type="string", length=20)
     */
    private $rgNumero;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="rgDataExpedicao", type="date")
     */
    private $rgDataExpedicao;
    
    /**
     * @var string
     *
     * @ORM\Column(name="rgOrgaoExpedidor", type="string", length=20)
     */
    private $rgOrgaoExpedidor;

    /**
     * @var string
     *
     * @ORM\Column(name="tituloEleitoralNumero", type="string", length=30)
     */
    private $tituloEleitoralNumero;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tituloEleitoralZona", type="string", length=10)
     */
    private $tituloEleitoralZona;
    
    /**
     * @var string
     *
     * @ORM\Column(name="tituloEleitoralSecao", type="string", length=10)
     */
    private $tituloEleitoralSecao;

    /**
     * @var string
     *
     * @ORM\Column(name="pis", type="string", length=20)
     */
    private $pis;

    /**
     * @var string
     *
     * @ORM\Column(name="ctpsNumero", type="string", length=20)
     */
    private $ctpsNumero;
    
    /**
     * @var string
     *
     * @ORM\Column(name="ctpsSerie", type="string", length=10)
     */
    private $ctpsSerie;

    /**
     * @var boolean
     *
     * @ORM\Column(name="certidaoNascimento", type="boolean")
     */
    private $certidaoNascimento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="certidaoCasamento", type="boolean")
     */
    private $certidaoCasamento;

    /**
     * @var boolean
     *
     * @ORM\Column(name="cartaoVacina", type="boolean")
     */
    private $cartaoVacina;

    /**
     * @var string
     *
     * @ORM\Column(name="estadoCivil", type="string", length=20)
     */
    private $estadoCivil;

    /**
     * @var string
     *
     * @ORM\Column(name="nomeMae", type="string", length=100)
     */
    private $nomeMae;

    /**
     * @var string
     *
     * @ORM\Column(name="corInformada", type="string", length=20)
     */
    private $corInformada;
    
    /**
     * @var string
     * 
     * @ORM\Column(name="email", type="string", length=50)
     */
    private $email;

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
     * Set nome
     *
     * @param string $nome
     * @return Pessoa
     */
    public function setNome($nome)
    {
        $this->nome = $nome;
    
        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set dataNascimento
     *
     * @param \DateTime $dataNascimento
     * @return Pessoa
     */
    public function setDataNascimento($dataNascimento)
    {
        $this->dataNascimento = $dataNascimento;
    
        return $this;
    }

    /**
     * Get dataNascimento
     *
     * @return \DateTime 
     */
    public function getDataNascimento()
    {
        return $this->dataNascimento;
    }

    /**
     * Set sexo
     *
     * @param string $sexo
     * @return Pessoa
     */
    public function setSexo($sexo)
    {
        $this->sexo = $sexo;
    
        return $this;
    }

    /**
     * Get sexo
     *
     * @return string 
     */
    public function getSexo()
    {
        return $this->sexo;
    }

    /**
     * Set cpf
     *
     * @param string $cpf
     * @return Pessoa
     */
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;
    
        return $this;
    }

    /**
     * Get cpf
     *
     * @return string 
     */
    public function getCpf()
    {
        return $this->cpf;
    }

    /**
     * Set rgNumero
     *
     * @param string $rgNumero
     * @return Pessoa
     */
    public function setRgNumero($rgNumero)
    {
        $this->rgNumero = $rgNumero;
    
        return $this;
    }

    /**
     * Get rgNumero
     *
     * @return string 
     */
    public function getRgNumero()
    {
        return $this->rgNumero;
    }

    /**
     * Set rgDataExpedicao
     *
     * @param \DateTime $rgDataExpedicao
     * @return Pessoa
     */
    public function setRgDataExpedicao($rgDataExpedicao)
    {
        $this->rgDataExpedicao = $rgDataExpedicao;
    
        return $this;
    }

    /**
     * Get rgDataExpedicao
     *
     * @return \DateTime 
     */
    public function getRgDataExpedicao()
    {
        return $this->rgDataExpedicao;
    }

    /**
     * Set rgOrgaoExpedidor
     *
     * @param string $rgOrgaoExpedidor
     * @return Pessoa
     */
    public function setRgOrgaoExpedidor($rgOrgaoExpedidor)
    {
        $this->rgOrgaoExpedidor = $rgOrgaoExpedidor;
    
        return $this;
    }

    /**
     * Get rgOrgaoExpedidor
     *
     * @return string 
     */
    public function getRgOrgaoExpedidor()
    {
        return $this->rgOrgaoExpedidor;
    }
    
    /**
     * Set tiuloEleitoralNumero
     *
     * @param string $tiuloEleitoralNumero
     * @return Pessoa
     */
    public function setTituloEleitoralNumero($tituloEleitoralNumero)
    {
        $this->tituloEleitoralNumero = $tituloEleitoralNumero;
    
        return $this;
    }

    /**
     * Get tituloEleitoralNumero
     *
     * @return string 
     */
    public function getTituloEleitoralNumero()
    {
        return $this->tituloEleitoralNumero;
    }

    /**
     * Set tituloEleitoralZona
     *
     * @param string $tituloEleitoralZona
     * @return Pessoa
     */
    public function setTituloEleitoralZona($tituloEleitoralZona)
    {
        $this->tituloEleitoralZona = $tituloEleitoralZona;
    
        return $this;
    }

    /**
     * Get tituloEleitoralZona
     *
     * @return string 
     */
    public function getTituloEleitoralZona()
    {
        return $this->tituloEleitoralZona;
    }

    /**
     * Set tituloEleitoralSecao
     *
     * @param string $tituloEleitoralSecao
     * @return Pessoa
     */
    public function setTituloEleitoralSecao($tituloEleitoralSecao)
    {
        $this->tituloEleitoralSecao = $tituloEleitoralSecao;
    
        return $this;
    }

    /**
     * Get tituloEleitoralSecao
     *
     * @return string 
     */
    public function getTituloEleitoralSecao()
    {
        return $this->tituloEleitoralSecao;
    }

    /**
     * Set pis
     *
     * @param string $pis
     * @return Pessoa
     */
    public function setPis($pis)
    {
        $this->pis = $pis;
    
        return $this;
    }

    /**
     * Get pis
     *
     * @return string 
     */
    public function getPis()
    {
        return $this->pis;
    }

    /**
     * Set ctpsNumero
     *
     * @param string $ctpsNumero
     * @return Pessoa
     */
    public function setCtpsNumero($ctpsNumero)
    {
        $this->ctpsNumero = $ctpsNumero;
    
        return $this;
    }

    /**
     * Get ctpsNumero
     *
     * @return string 
     */
    public function getCtpsNumero()
    {
        return $this->ctpsNumero;
    }

    /**
     * Set ctpsSerie
     *
     * @param string $ctpsSerie
     * @return Pessoa
     */
    public function setCtpsSerie($ctpsSerie)
    {
        $this->ctpsSerie = $ctpsSerie;
    
        return $this;
    }

    /**
     * Get ctpsSerie
     *
     * @return string 
     */
    public function getCtpsSerie()
    {
        return $this->ctpsSerie;
    }
    
    /**
     * Set certidaoNascimento
     *
     * @param boolean $certidaoNascimento
     * @return Pessoa
     */
    public function setCertidaoNascimento($certidaoNascimento)
    {
        $this->certidaoNascimento = $certidaoNascimento;
    
        return $this;
    }

    /**
     * Get certidaoNascimento
     *
     * @return boolean 
     */
    public function getCertidaoNascimento()
    {
        return $this->certidaoNascimento;
    }

    /**
     * Set certidaoCasamento
     *
     * @param boolean $certidaoCasamento
     * @return Pessoa
     */
    public function setCertidaoCasamento($certidaoCasamento)
    {
        $this->certidaoCasamento = $certidaoCasamento;
    
        return $this;
    }

    /**
     * Get certidaoCasamento
     *
     * @return boolean 
     */
    public function getCertidaoCasamento()
    {
        return $this->certidaoCasamento;
    }

    /**
     * Set cartaoVacina
     *
     * @param boolean $cartaoVacina
     * @return Pessoa
     */
    public function setCartaoVacina($cartaoVacina)
    {
        $this->cartaoVacina = $cartaoVacina;
    
        return $this;
    }

    /**
     * Get cartaoVacina
     *
     * @return boolean 
     */
    public function getCartaoVacina()
    {
        return $this->cartaoVacina;
    }

    /**
     * Set estadoCivil
     *
     * @param string $estadoCivil
     * @return Pessoa
     */
    public function setEstadoCivil($estadoCivil)
    {
        $this->estadoCivil = $estadoCivil;
    
        return $this;
    }

    /**
     * Get estadoCivil
     *
     * @return string 
     */
    public function getEstadoCivil()
    {
        return $this->estadoCivil;
    }

    /**
     * Set nomeMae
     *
     * @param string $nomeMae
     * @return Pessoa
     */
    public function setNomeMae($nomeMae)
    {
        $this->nomeMae = $nomeMae;
    
        return $this;
    }

    /**
     * Get nomeMae
     *
     * @return string 
     */
    public function getNomeMae()
    {
        return $this->nomeMae;
    }

    /**
     * Set corInformada
     *
     * @param string $corInformada
     * @return Pessoa
     */
    public function setCorInformada($corInformada)
    {
        $this->corInformada = $corInformada;
    
        return $this;
    }

    /**
     * Get corInformada
     *
     * @return string 
     */
    public function getCorInformada()
    {
        return $this->corInformada;
    }
    
    /**
     * Set email
     * 
     * @param string $email
     * @return Pessoa
     */
    public function setEmail($email)
    {
        $this->email = $email;
        
        return $this;
    }
    
    /**
     * Get email
     * 
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * @ORM\OneToMany(targetEntity="Telefone", mappedBy="pessoa")
     */
    protected $telefones;
    
    /**
     * @ORM\OneToMany(targetEntity="Endereco", mappedBy="pessoa")
     */
    protected $enderecos;
    
    public function __construct()
    {
        $this->telefones = new ArrayCollection();
        $this->enderecos = new ArrayCollection();
    }

    /**
     * Add telefones
     *
     * @param \CadpazBundle\Entity\Telefone $telefones
     * @return Pessoa
     */
    public function addTelefone(\CadpazBundle\Entity\Telefone $telefones)
    {
        $this->telefones[] = $telefones;
    
        return $this;
    }

    /**
     * Remove telefones
     *
     * @param \CadpazBundle\Entity\Telefone $telefones
     */
    public function removeTelefone(\CadpazBundle\Entity\Telefone $telefones)
    {
        $this->telefones->removeElement($telefones);
    }

    /**
     * Get telefones
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTelefones()
    {
        return $this->telefones;
    }

    /**
     * Add enderecos
     *
     * @param \CadpazBundle\Entity\Endereco $enderecos
     * @return Pessoa
     */
    public function addEndereco(\CadpazBundle\Entity\Endereco $enderecos)
    {
        $this->enderecos[] = $enderecos;
    
        return $this;
    }

    /**
     * Remove enderecos
     *
     * @param \CadpazBundle\Entity\Endereco $enderecos
     */
    public function removeEndereco(\CadpazBundle\Entity\Endereco $enderecos)
    {
        $this->enderecos->removeElement($enderecos);
    }

    /**
     * Get enderecos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getEnderecos()
    {
        return $this->enderecos;
    }
    
    // Comentário de teste
    public function isPessoa()
    {
        return $this->nome;
    }
}
