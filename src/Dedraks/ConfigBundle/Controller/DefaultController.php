<?php

namespace Dedraks\ConfigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {        
        $casos = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Caso')
            ->findAll();
        
        return $this->render('CadpazBundle:Configuracoes:index.html.twig', array(
            'casos' => $casos
        ));    
    }
}
