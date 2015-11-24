<?php

namespace CadpazBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Encaminhamento
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="CadpazBundle\Entity\EncaminhamentoRepository")
 */
class Encaminhamento
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
     * @ORM\Column(name="encaminhado", type="string", length=100)
     */
    private $encaminhado;


    /**
     * @var string
     *
     * @ORM\Column(name="observacoes", type="text", nullable=true)
     */
    private $observacoes;
    
    /**
     * @ORM\OneToOne(targetEntity="Atendimento", inversedBy="encaminhamento")
     * @ORM\JoinColumn(name="atendimento_id", referencedColumnName="id")
     */
    protected $atendimento;


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
     * Set encaminhado
     *
     * @param string $encaminhado
     * @return Encaminhamento
     */
    public function setEncaminhado($encaminhado)
    {
        $this->encaminhado = $encaminhado;

        return $this;
    }

    /**
     * Get encaminhado
     *
     * @return string 
     */
    public function getEncaminhado()
    {
        return $this->encaminhado;
    }

    /**
     * Set atendimento
     *
     * @param \CadpazBundle\Entity\Atendimento $atendimento
     * @return Encaminhamento
     */
    public function setAtendimento(\CadpazBundle\Entity\Atendimento $atendimento = null)
    {
        $this->atendimento = $atendimento;

        return $this;
    }

    /**
     * Get atendimento
     *
     * @return \CadpazBundle\Entity\Atendimento 
     */
    public function getAtendimento()
    {
        return $this->atendimento;
    }

    /**
     * Set observacoes
     *
     * @param string $observacoes
     * @return Encaminhamento
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
}
