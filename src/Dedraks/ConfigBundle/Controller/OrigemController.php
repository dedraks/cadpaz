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
        
        try {
           dump($expandir);
	}
	catch(Exception $e)
	{
	}
        
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
    
    public function newAction(Request $request)
    {
        $origem = new Origem();
        
        $form = $this->createForm(new OrigemType(), $origem);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($origem);
            $em->flush();
            
            return $this->forward('DedraksConfigBundle:Default:index',
                    ['expand'=>'origem']
                    );
        }
        
        return $this->render('DedraksConfigBundle:Origem:new.html.twig',array(
            'form' => $form->createView(),
            )
        );   
    }
    
    public function editAction(Request $request, $id)
    {
        // Obtém uma instância do objeto com o id informado
        $origem = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Origem')
            ->find($id);
        
        // Gera o formulário
        $form = $this->createForm(new OrigemType(), $origem);
        
        // Trata os dados enviados pelo formulário
        $form->handleRequest($request);
        
        // Verifica se o formulário é válido
        if ($form->isValid()) {
            
            // Atualiza o tipo (nome) da opção
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            return $this->forward('DedraksConfigBundle:Default:index',
                    ['expand'=>'origem']
                    );
        }
        
        // Exibe o formulário
        return $this->render('DedraksConfigBundle:Origem:new.html.twig',array(
            'form' => $form->createView(),
            'id'=>$id
            )
        );   
    }
    
    public function deleteAction($id)
    {
        $origem = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Origem')
            ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($origem);
        $em->flush();
           
        return $this->forward('DedraksConfigBundle:Default:index',
                ['expand'=>'origem']
                );
    }
}
