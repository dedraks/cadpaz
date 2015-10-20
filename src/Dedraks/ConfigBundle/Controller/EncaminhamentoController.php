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
    
    public function newAction(Request $request)
    {
        $encaminhamento = new Encaminhamento();
        
        $form = $this->createForm(new EncaminhamentoType(), $encaminhamento);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($encaminhamento);
            $em->flush();
            
            return $this->forward('DedraksConfigBundle:Default:index',
                    ['expand'=>'encaminhamento']
                    );
        }
        
        return $this->render('DedraksConfigBundle:Encaminhamento:new.html.twig',array(
            'form' => $form->createView(),
            )
        );   
    }
    
    public function editAction(Request $request, $id)
    {
        // Obtém uma instância do objeto com o id informado
        $encaminhamento = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Encaminhamento')
            ->find($id);
        
        dump($encaminhamento);
        
        // Gera o formulário
        $form = $this->createForm(new EncaminhamentoType(), $encaminhamento);
        
        // Trata os dados enviados pelo formulário
        $form->handleRequest($request);
        
        // Verifica se o formulário é válido
        if ($form->isValid()) {
            
            // Atualiza o tipo (nome) da opção
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            return $this->forward('DedraksConfigBundle:Default:index',
                    ['expand'=>'encaminhamento']
                    );
        }
        
        // Exibe o formulário
        return $this->render('DedraksConfigBundle:Encaminhamento:new.html.twig',array(
            'form' => $form->createView(),
            'id'=>$id
            )
        );   
    }
    
    public function deleteAction($id)
    {
        $encaminhamento = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Encaminhamento')
            ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($encaminhamento);
        $em->flush();
           
        return $this->forward('DedraksConfigBundle:Default:index',
                ['expand'=>'encaminhamento']
                );
    }
}
