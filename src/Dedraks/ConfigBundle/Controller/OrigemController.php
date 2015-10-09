<?php

namespace Dedraks\ConfigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



use Dedraks\ConfigBundle\Entity\Origem;
use Dedraks\ConfigBundle\Form\OrigemType;

/**
 * Description of CasoController
 *
 * @author carlos
 */
class OrigemController extends Controller 
{
    public function indexAction(Request $request)
    {
        $expandir = $request->get('expandir');
        
        
        dump($expandir);
        
        if ($expandir === 'origem')
            $expandir = true;
        else
            $expandir = false;
        
        $origens = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Origem')
            ->findAll();
        
        return $this->render('DedraksConfigBundle:Origem:list.html.twig', array(
            'origens'    => $origens,
            'expandir' => $expandir
        ));  
    }
}
