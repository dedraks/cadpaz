<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CadpazBundle\Entity\Endereco;
use CadpazBundle\Entity\Pessoa;
use CadpazBundle\Form\EnderecoType;

class EnderecoController extends Controller
{
    public function viewAction()
    {
        return $this->render('CadpazBundle:Endereco:view.html.twig', array(
                // ...
            ));    }

    public function newAction(Request $request, $pessoa_id)
    {
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($pessoa_id);
        
        $endereco = new Endereco();
        
        $ro = false;
        if ($pessoa->getEnderecos()->count()==0) {
            $endereco->setPadrao(true);
            $ro = true;
        }
        
        $endereco->setPessoa($pessoa);
        $form = $this->createForm(new EnderecoType(), $endereco, ['ro'=>$ro]);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($endereco);
            

            
            
            if ($endereco->getPadrao()) {
                foreach($pessoa->getEnderecos() as $pessoa_end) {
                    $pessoa_end->setPadrao(false);
                    //$em->persist($pessoa);
                }
            }
            
            
            
            $pessoa->addEndereco($endereco);
            $em->flush();
            
            
            //dump($pessoa);
            
            //dump($pessoa);

            return $this->render('CadpazBundle:Pessoa:view.html.twig',  array('pessoa'=>$pessoa));
        }
        
        
        return $this->render('CadpazBundle:Endereco:new.html.twig',array('form' => $form->createView(),'id'=>$pessoa_id, 'ro'=>$ro));
    }

    public function editAction()
    {
        return $this->render('CadpazBundle:Endereco:edit.html.twig', array(
                // ...
            ));    }

    public function deleteAction()
    {
        return $this->render('CadpazBundle:Endereco:delete.html.twig', array(
                // ...
            ));    }

}
