<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use CadpazBundle\Entity\CTPS;
use CadpazBundle\Entity\Pessoa;
use CadpazBundle\Form\CTPSType;

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
    
    public function newCtpsAction($id, Request $request)
    {
        //$pis = new PIS();
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($id);
        
        $ctps = $pessoa->getCtps();
        
        if ($ctps == null)
        {
            $ctps = new CTPS();
        }
        
        /*
        $repository = $this->getDoctrine()
            ->getRepository('CadpazBundle:Estado');
        $estados = $repository->findAll();
        $ufs = array();
        foreach ($estados as $es) 
        {
            $ufs[$es->getUf()] = $es->getNome();
        }*/
        
        //dump($ufs);
        
        $ctps->setPessoa($pessoa);
        $form = $this->createForm(new CTPSType(), $ctps);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($ctps);
            $em->flush();

            $pessoa->setCtps($ctps);
            return $this->render('CadpazBundle:Pessoa:view.html.twig',  array('pessoa'=>$pessoa));
        }
        
        
        return $this->render('CadpazBundle:CTPS:new.html.twig',array('form' => $form->createView(),'id'=>$id));
    }
    
    public function deleteAction($id)
    {
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($id);
        $ctps = $pessoa->getCtps();
        $pessoa->setCtps(null);
        $em = $this->getDoctrine()->getManager();
        $em->remove($ctps);
        //$em->persist($pessoa);
        $em->flush();
        
        return $this->render('CadpazBundle:Pessoa:view.html.twig',  array('pessoa'=>$pessoa));
    }
}
