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
     * @ORM\ManyToOne(targetEntity="User", inversedBy="atendimentos")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;
    
    /**
     * @ORM\ManyToOne(targetEntity="Caso", inversedBy="atendimentos")
     * @ORM\JoinColumn(name="caso_id", referencedColumnName="id")
     */
    protected $caso;
    

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
     * Set user
     *
     * @param \CadpazBundle\Entity\User $user
     * @return Atendimento
     */
    public function setUser(\CadpazBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \CadpazBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set caso
     *
     * @param \CadpazBundle\Entity\Caso $caso
     * @return Atendimento
     */
    public function setCaso(\CadpazBundle\Entity\Caso $caso = null)
    {
        $this->caso = $caso;

        return $this;
    }

    /**
     * Get caso
     *
     * @return \CadpazBundle\Entity\Caso 
     */
    public function getCaso()
    {
        return $this->caso;
    }
}
