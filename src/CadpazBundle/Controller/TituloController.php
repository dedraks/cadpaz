<?php
namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use CadpazBundle\Entity\Titulo;
use CadpazBundle\Entity\Pessoa;
use CadpazBundle\Form\TituloType;

class TituloController extends Controller
{
    public function viewAction($pessoa_id)
    {
        $titulo = $this->getDoctrine()
            ->getRepository('CadpazBundle:Titulo')
            ->findOneBy(array( 'pessoa' => $pessoa_id));
        
        return $this->render('CadpazBundle:Titulo:view.html.twig',  array('titulo'=>$titulo));
    }
    
    public function deleteAction($id)
    {
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($id);
        $titulo = $pessoa->getTitulo();
        $pessoa->setTitulo(null);
        $em = $this->getDoctrine()->getManager();
        $em->remove($titulo);
        $em->flush();
        
        return $this->render('CadpazBundle:Pessoa:view.html.twig',  array('pessoa'=>$pessoa));
    }
}