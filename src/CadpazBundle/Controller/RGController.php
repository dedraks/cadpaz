<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use CadpazBundle\Entity\CTPS;
use CadpazBundle\Entity\Pessoa;
use CadpazBundle\Form\CTPSType;

class RGController extends Controller
{
    public function deleteAction($id)
    {
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($id);
        $rg = $pessoa->getRg();
        $pessoa->setRg(null);
        $em = $this->getDoctrine()->getManager();
        $em->remove($rg);
        $em->flush();
        
        return $this->render('CadpazBundle:Pessoa:view.html.twig',  array('pessoa'=>$pessoa));
    }
}