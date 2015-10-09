<?php

namespace Dedraks\ConfigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



use Dedraks\ConfigBundle\Entity\Encaminhamento;
use Dedraks\ConfigBundle\Form\EncaminhamentoType;

/**
 * Description of CasoController
 *
 * @author carlos
 */
class EncaminhamentoController extends Controller 
{
    public function indexAction(Request $request)
    {
        $expandir = $request->get('expandir');
        
        
        dump($expandir);
        
        if ($expandir === 'encaminhamento')
            $expandir = true;
        else
            $expandir = false;
        
        $encaminhamentos = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Encaminhamento')
            ->findAll();
        
        return $this->render('DedraksConfigBundle:Encaminhamento:list.html.twig', array(
            'encaminhamentos'    => $encaminhamentos,
            'expandir' => $expandir
        ));  
    }
}
