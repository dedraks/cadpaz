<?php

namespace CadpazBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Atendimento
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Atendimento
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
     * @var \DateTime
     *
     * @ORM\Column(name="dataHora", type="datetime")
     */
    private $dataHora;

    /**
     * @var string
     *
     * @ORM\Column(name="historico", type="text")
     */
    private $historico;

    /**
     * @ORM\ManyToOne(targetEntity="Pessoa", inversedBy="atendimentos")
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
     * Set dataHora
     *
     * @param \DateTime $dataHora
     * @return Atendimento
     */
    public function setDataHora($dataHora)
    {
        $this->dataHora = $dataHora;

        return $this;
    }

    /**
     * Get dataHora
     *
     * @return \DateTime 
     */
    public function getDataHora()
    {
        return $this->dataHora;
    }

    /**
     * Set historico
     *
     * @param string $historico
     * @return Atendimento
     */
    public function setHistorico($historico)
    {
        $this->historico = $historico;

        return $this;
    }

    /**
     * Get historico
     *
     * @return string 
     */
    public function getHistorico()
    {
        return $this->historico;
    }

    /**
     * Set pessoa
     *
     * @param \CadpazBundle\Entity\Pessoa $pessoa
     * @return Atendimento
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
