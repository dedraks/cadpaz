<?php

namespace CadpazBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * RG
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class RG
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
     * @var \DateTime
     *
     * @ORM\Column(name="dataExpedicao", type="date", nullable=true)
     */
    private $dataExpedicao;

    /**
     * @var string
     *
     * @ORM\Column(name="orgaoExpedidor", type="string", length=20, nullable=true)
     */
    private $orgaoExpedidor;


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
     * @return RG
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
     * Set dataExpedicao
     *
     * @param \DateTime $dataExpedicao
     * @return RG
     */
    public function setDataExpedicao($dataExpedicao)
    {
        $this->dataExpedicao = $dataExpedicao;
    
        return $this;
    }

    /**
     * Get dataExpedicao
     *
     * @return \DateTime 
     */
    public function getDataExpedicao()
    {
        return $this->dataExpedicao;
    }

    /**
     * Set orgaoExpedidor
     *
     * @param string $orgaoExpedidor
     * @return RG
     */
    public function setOrgaoExpedidor($orgaoExpedidor)
    {
        $this->orgaoExpedidor = $orgaoExpedidor;
    
        return $this;
    }

    /**
     * Get orgaoExpedidor
     *
     * @return string 
     */
    public function getOrgaoExpedidor()
    {
        return $this->orgaoExpedidor;
    }
    
    /**
     * @ORM\OneToOne(targetEntity="Pessoa", inversedBy="rg")
     * @ORM\JoinColumn(name="pessoa_id", referencedColumnName="id")
     */
    protected $pessoa;

    /**
     * Set pessoa
     *
     * @param \CadpazBundle\Entity\Pessoa $pessoa
     * @return RG
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
