<?php
    // src/AppBundle/Entity/User.php

    namespace CadpazBundle\Entity;

    use FOS\UserBundle\Model\User as BaseUser;
    use Doctrine\ORM\Mapping as ORM;

    /**
     * @ORM\Entity
     * @ORM\Table(name="fos_user")
     */
    class User extends BaseUser
    {
        /**
         * @ORM\Id
         * @ORM\Column(type="integer")
         * @ORM\GeneratedValue(strategy="AUTO")
         */
        protected $id;
        
        /**
         * @var string
         *
         * @ORM\Column(name="nomeCompleto", type="string", length=100, nullable=true)
         */
        private $nomeCompleto;
        
        /**
         * @ORM\OneToMany(targetEntity="Atendimento", mappedBy="user")
         */
        protected $atendimentos;

        public function __construct()
        {
            parent::__construct();
            // your own logic
            
            $this->atendimentos = new ArrayCollection();
        }

    /**
     * Set nomeCompleto
     *
     * @param string $nomeCompleto
     * @return User
     */
    public function setNomeCompleto($nomeCompleto)
    {
        $this->nomeCompleto = $nomeCompleto;

        return $this;
    }

    /**
     * Get nomeCompleto
     *
     * @return string 
     */
    public function getNomeCompleto()
    {
        return $this->nomeCompleto;
    }

    /**
     * Add atendimentos
     *
     * @param \CadpazBundle\Entity\Atendimento $atendimentos
     * @return User
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
