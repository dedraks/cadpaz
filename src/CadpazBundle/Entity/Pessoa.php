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

        /**
         * @ORM\OneToOne(targetEntity="RG", mappedBy="pessoa")
         */
        protected $rg;

        /**
         * @ORM\OneToOne(targetEntity="Titulo", mappedBy="pessoa")
         */
        protected $titulo;

        /**
         * @ORM\OneToOne(targetEntity="CTPS", mappedBy="pessoa")
         */
        protected $ctps;

        /**
         * @ORM\OneToOne(targetEntity="PIS", mappedBy="pessoa")
         */
        protected $pis;

        // Comentário de teste
        public function isPessoa()
        {
            return $this->nome;
        }

        /**
         * Set rg
         *
         * @param \CadpazBundle\Entity\RG $rg
         * @return Pessoa
         */
        public function setRg(\CadpazBundle\Entity\RG $rg = null)
        {
            $this->rg = $rg;

            return $this;
        }

        /**
         * Get rg
         *
         * @return \CadpazBundle\Entity\RG 
         */
        public function getRg()
        {
            return $this->rg;
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
         * Set titulo
         *
         * @param \CadpazBundle\Entity\Titulo $titulo
         * @return Pessoa
         */
        public function setTitulo(\CadpazBundle\Entity\Titulo $titulo = null)
        {
            $this->titulo = $titulo;

            return $this;
        }

        /**
         * Get titulo
         *
         * @return \CadpazBundle\Entity\Titulo 
         */
        public function getTitulo()
        {
            return $this->titulo;
        }

        /**
         * Set ctps
         *
         * @param \CadpazBundle\Entity\CTPS $ctps
         * @return Pessoa
         */
        public function setCtps(\CadpazBundle\Entity\CTPS $ctps = null)
        {
            $this->ctps = $ctps;

            return $this;
        }

        /**
         * Get ctps
         *
         * @return \CadpazBundle\Entity\CTPS 
         */
        public function getCtps()
        {
            return $this->ctps;
        }

        /**
         * Set pis
         *
         * @param \CadpazBundle\Entity\PIS $pis
         * @return Pessoa
         */
        public function setPis(\CadpazBundle\Entity\PIS $pis = null)
        {
            $this->pis = $pis;

            return $this;
        }

        /**
         * Get pis
         *
         * @return \CadpazBundle\Entity\PIS 
         */
        public function getPis()
        {
            return $this->pis;
        }
    }
