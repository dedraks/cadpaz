<?php

namespace CadpazBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Titulo
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Titulo
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
     * @ORM\Column(name="numero", type="string", length=20, nullable=true)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="zona", type="string", length=10, nullable=true)
     */
    private $zona;

    /**
     * @var string
     *
     * @ORM\Column(name="secao", type="string", length=10, nullable=true)
     */
    private $secao;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dataEmissao", type="date", nullable=true)
     */
    private $dataEmissao;

    /**
     * @var string
     *
     * @ORM\Column(name="municipio", type="string", length=50, nullable=true)
     */
    private $municipio;

    /**
     * @var string
     *
     * @ORM\Column(name="uf", type="string", length=2, nullable=true)
     */
    private $uf;


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
     * Set numero
     *
     * @param string $numero
     * @return Titulo
     */
    public function setNumero($numero)
    {
        $this->numero = $numero;
    
        return $this;
    }

    /**
     * Get numero
     *
     * @return string 
     */
    public function getNumero()
    {
        return $this->numero;
    }

    /**
     * Set zona
     *
     * @param string $zona
     * @return Titulo
     */
    public function setZona($zona)
    {
        $this->zona = $zona;
    
        return $this;
    }

    /**
     * Get zona
     *
     * @return string 
     */
    public function getZona()
    {
        return $this->zona;
    }

    /**
     * Set secao
     *
     * @param string $secao
     * @return Titulo
     */
    public function setSecao($secao)
    {
        $this->secao = $secao;
    
        return $this;
    }

    /**
     * Get secao
     *
     * @return string 
     */
    public function getSecao()
    {
        return $this->secao;
    }

    /**
     * Set dataEmissao
     *
     * @param \DateTime $dataEmissao
     * @return Titulo
     */
    public function setDataEmissao($dataEmissao)
    {
        $this->dataEmissao = $dataEmissao;
    
        return $this;
    }

    /**
     * Get dataEmissao
     *
     * @return \DateTime 
     */
    public function getDataEmissao()
    {
        return $this->dataEmissao;
    }

    /**
     * Set municipio
     *
     * @param string $municipio
     * @return Titulo
     */
    public function setMunicipio($municipio)
    {
        $this->municipio = $municipio;
    
        return $this;
    }

    /**
     * Get municipio
     *
     * @return string 
     */
    public function getMunicipio()
    {
        return $this->municipio;
    }

    /**
     * Set uf
     *
     * @param string $uf
     * @return Titulo
     */
    public function setUf($uf)
    {
        $this->uf = $uf;
    
        return $this;
    }

    /**
     * Get uf
     *
     * @return string 
     */
    public function getUf()
    {
        return $this->uf;
    }
    
    /**
     * @ORM\OneToOne(targetEntity="Pessoa", inversedBy="titulo")
     * @ORM\JoinColumn(name="pessoa_id", referencedColumnName="id")
     */
    protected $pessoa;

    /**
     * Set pessoa
     *
     * @param \CadpazBundle\Entity\Pessoa $pessoa
     * @return Titulo
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
