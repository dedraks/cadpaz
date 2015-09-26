<?php
// src/CadpazBundle/Controller/PessoaController.php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use CadpazBundle\Entity\Atendimento;
use CadpazBundle\Form\AtendimentoType;

/**
 * Atendimento Controller
 * 
 * Classe para controlar os atendimentos.
 * 
 * @author Carlos Alberto Borges Garcia Jr <dedraks@gmail.com>
 */
class AtendimentoController extends Controller
{
    /**
     * Index Controller's action
     * 
     * @return Response Uma instancia de Response
     */
    public function indexAction()
    {
        return $this->render('CadpazBundle:Atendimento:index.html.twig', array(
                // ...
            ));
    }
    
    public function newAction(Request $request, $caso_id) 
    {
        $caso = $this->getDoctrine()
            ->getRepository('CadpazBundle:Caso')
            ->find($caso_id);
        
        $atendimento = new Atendimento();
        
        $atendimento->setCaso($caso);
        $form = $this->createForm(new AtendimentoType(), $atendimento);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $atendimento->setDataHora(new \DateTime());
            
            $em->persist($atendimento);
            
            
            $caso->addAtendimento($atendimento);
            $em->flush();
            
            return $this->render('CadpazBundle:Caso:view.html.twig',  array('caso'=>$caso));
        }
        
        
        return $this->render('CadpazBundle:Atendimento:new.html.twig',array('form' => $form->createView(),'caso_id'=>$caso_id));
    }
}
