<?php

namespace CadpazBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Caso
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Caso
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
     * @var string
     *
     * @ORM\Column(name="descricao", type="text")
     */
    private $descricao;

    /**
     * @ORM\ManyToOne(targetEntity="Pessoa", inversedBy="casos")
     * @ORM\JoinColumn(name="pessoa_id", referencedColumnName="id")
     */
    protected $pessoa;
    
    /**
     * @ORM\OneToMany(targetEntity="Atendimento", mappedBy="caso")
     * * @ORM\OrderBy({"dataHora" = "DESC"})
     */
    protected $atendimentos;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->atendimentos = new \Doctrine\Common\Collections\ArrayCollection();
    }

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
     * @return Caso
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
     * Set descricao
     *
     * @param string $descricao
     * @return Caso
     */
    public function setDescricao($descricao)
    {
        $this->descricao = $descricao;

        return $this;
    }

    /**
     * Get descricao
     *
     * @return string 
     */
    public function getDescricao()
    {
        return $this->descricao;
    }

    /**
     * Set pessoa
     *
     * @param \CadpazBundle\Entity\Pessoa $pessoa
     * @return Caso
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
     * Add atendimentos
     *
     * @param \CadpazBundle\Entity\Atendimento $atendimentos
     * @return Caso
     */
    public function addAtendimento(\CadpazBundle\Entity\Atendimento $atendimentos)
    {
        $this->atendimentos[] = $atendimentos;

        return $this;
    }

    /**
     * Remove atendimentos
     *
     * @param \CadpazBundle\Entity\Atendimento $atendimentos
     */
    public function removeAtendimento(\CadpazBundle\Entity\Atendimento $atendimentos)
    {
        $this->atendimentos->removeElement($atendimentos);
    }

    /**
     * Get atendimentos
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getAtendimentos()
    {
        return $this->atendimentos;
    }
}
