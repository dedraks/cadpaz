<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



use Dedraks\ConfigBundle\Entity\Caso;
use Dedraks\ConfigBundle\Form\CasoType;

class ConfiguracoesController extends Controller
{
    public function indexAction(Request $request)
    {        
        $casos = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Caso')
            ->findAll();
        
        return $this->render('CadpazBundle:Configuracoes:index.html.twig', array(
            'casos' => $casos
        ));    
    }
    
    public function newCasoTipoAction(Request $request)
    {
        $caso = new Caso();
        
        $form = $this->createForm(new CasoType(), $caso);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caso);
            $em->flush();
           
            
            
            return $this->forward('CadpazBundle:Configuracoes:index');
        }
        
        
        return $this->render('DedraksConfigBundle:Caso:new.html.twig',array(
            'form' => $form->createView(),
            'create' => 'sim'
            )
        );   
    }
    
    public function editCasoTipoAction(Request $request, $id)
    {
        $caso = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Caso')
            ->find($id);
        
        $form = $this->createForm(new CasoType(), $caso);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            //$em->persist($caso);
            //$em->merge($caso);
            $em->flush();
            
            return $this->forward('CadpazBundle:Configuracoes:index');
        }
        
        
        return $this->render('DedraksConfigBundle:Caso:new.html.twig',array(
            'form' => $form->createView(),
            'create' => "não",
            'id'=>$id
            )
        );   
    }
    
    public function deleteCasoTipoAction($id)
    {
        $caso = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Caso')
            ->find($id);
        dump($id);
        
            $em = $this->getDoctrine()->getManager();
            $em->remove($caso);
            $em->flush();
           
            
            
            return $this->forward('CadpazBundle:Configuracoes:index');
    }
}
