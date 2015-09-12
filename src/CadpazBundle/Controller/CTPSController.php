<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class CTPSController extends Controller
{
    /**
     * Visualiza uma ctps
     * 
     * @param type $pessoa_id
     * @return Response Uma instancia de Response
     */
    public function viewAction($pessoa_id)
    {
        $ctps = $this->getDoctrine()
            ->getRepository('CadpazBundle:CTPS')
            ->findOneBy(array( 'pessoa' => $pessoa_id));
        
        return $this->render('CadpazBundle:CTPS:view.html.twig',  array('ctps'=>$ctps));
    }
}
