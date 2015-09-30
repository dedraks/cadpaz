<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
 
use CadpazBundle\Entity\Encaminhamento;
use CadpazBundle\Form\EncaminhamentoType;

/**
 * Description of EncaminhamentoController
 *
 * @author carlos
 */
class EncaminhamentoController extends Controller
{
    public function newAction(Request $request, $atendimento_id) 
    {
        $atendimento = $this->getDoctrine()
            ->getRepository('CadpazBundle:Atendimento')
            ->find($atendimento_id);
        
        $encaminhamento = new Encaminhamento();
        
        $encaminhamento->setAtendimento($atendimento);
        $form = $this->createForm(new EncaminhamentoType(), $encaminhamento);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($encaminhamento);
           
          
            $atendimento->setEncaminhamento($encaminhamento);
            $em->flush();

            
            
            
            
            
            return $this->render('CadpazBundle:Caso:view.html.twig',  array('caso'=>$atendimento->getCaso()));
        }
        
        
        return $this->render('CadpazBundle:Encaminhamento:new.html.twig',array('form' => $form->createView(), 'atendimento_id'=>$atendimento->getId()));        
    }
}
