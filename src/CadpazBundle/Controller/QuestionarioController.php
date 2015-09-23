<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use CadpazBundle\Entity\Questionario;
use CadpazBundle\Entity\Pessoa;
use CadpazBundle\Form\QuestionarioType;

class QuestionarioController extends Controller
{
    public function viewAction($id)
    {
        $questionario = $this->getDoctrine()
            ->getRepository('CadpazBundle:Questionario')
            ->find($id);
        
        dump($questionario);
        
        return $this->render('CadpazBundle:Questionario:view.html.twig',  array('questionario'=>$questionario));
    }
    
    public function newAction(Request $request, $pessoa_id)
    {
        //$pis = new PIS();
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($pessoa_id);
        
        $questinario = new Questionario();

        
        $questinario->setPessoa($pessoa);
        $form = $this->createForm(new QuestionarioType(), $questinario);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($questinario);
            $em->flush();

            $pessoa->setQuestionario($questinario);
            return $this->render('CadpazBundle:Pessoa:view.html.twig',  array('pessoa'=>$pessoa));
        }
        
        
        return $this->render('CadpazBundle:Questionario:new.html.twig',  ['form' => $form->createView(), 'id'=>$pessoa_id]);
    }
}