<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;



class ConfiguracoesController extends Controller
{
    public function indexAction(Request $request)
    {        
        return $this->render('CadpazBundle:Configuracoes:index.html.twig', array(
            //...
        ));    
    }

}
