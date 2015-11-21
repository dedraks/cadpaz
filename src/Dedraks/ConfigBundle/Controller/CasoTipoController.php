<?php

namespace Dedraks\ConfigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



use Dedraks\ConfigBundle\Entity\Caso;
use Dedraks\ConfigBundle\Form\CasoType;
 

/**
 * Description of CasoController
 *
 * @author carlos
 */
class CasoTipoController extends Controller 
{
    public function indexAction(Request $request)
    {
        $expandir = $request->get('expandir');
        
        
        //dump($expandir);
        
        if ($expandir === 'caso')
            $expandir = true;
        else
            $expandir = false;
        
        $casos = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Caso')
            ->findAll();
        
        return $this->render('DedraksConfigBundle:Caso:list.html.twig', array(
            'casos'    => $casos,
            'expandir' => $expandir
        ));    
    }
}
