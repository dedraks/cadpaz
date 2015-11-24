<?php

namespace CadpazBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Telefone
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Telefone
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
     * @var boolean
     *
     * @ORM\Column(name="padrao", type="boolean")
     */
    private $padrao;
    
    /**
     * @var string
     *
     * @ORM\Column(name="numero", type="string", length=20)
     */
    private $numero;

    /**
     * @var string
     *
     * @ORM\Column(name="tipo", type="string", length=20)
     */
    private $tipo;

    /**
     * @var string
     *
     * @ORM\Column(name="obs", type="text", nullable=true)
     */
    private $obs;


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
     * @return Telefone
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
     * Set tipo
     *
     * @param string $tipo
     * @return Telefone
     */
    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
    
        return $this;
    }

    /**
     * Get tipo
     *
     * @return string 
     */
    public function getTipo()
    {
        return $this->tipo;
    }

    /**
     * Set obs
     *
     * @param string $obs
     * @return Telefone
     */
    public function setObs($obs)
    {
        $this->obs = $obs;
    
        return $this;
    }

    /**
     * Get obs
     *
     * @return string 
     */
    public function getObs()
    {
        return $this->obs;
    }
    
    /**
     * @ORM\ManyToOne(targetEntity="Pessoa", inversedBy="telefones")
     * @ORM\JoinColumn(name="pessoa_id", referencedColumnName="id")
     */
    protected $pessoa;

    /**
     * Set pessoa
     *
     * @param \CadpazBundle\Entity\Pessoa $pessoa
     * @return Telefone
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

    /**
     * Set nome
     *
     * @param string $nome
     * @return Telefone
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
     * Set padrao
     *
     * @param boolean $padrao
     * @return Telefone
     */
    public function setPadrao($padrao)
    {
        $this->padrao = $padrao;

        return $this;
    }

    /**
     * Get padrao
     *
     * @return boolean 
     */
    public function getPadrao()
    {
        return $this->padrao;
    }
}
