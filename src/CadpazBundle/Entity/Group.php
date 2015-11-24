<?php
// src/MyProject/MyBundle/Entity/Group.php

namespace CadpazBundle\Entity;

use FOS\UserBundle\Model\Group as BaseGroup;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="fos_group")
 */
class Group extends BaseGroup
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
     protected $id;
    
    public function __construct($nome)
        {
            parent::__construct($nome);
        }
        
    public function __toString() {
        return $this->getName();
    }
}
