<?php
namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use CadpazBundle\Entity\Telefone;
use CadpazBundle\Entity\Pessoa;
use CadpazBundle\Form\TelefoneType;

class TelefoneController extends Controller
{
    public function indexAction($pessoa_id)
    {
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($pessoa_id);
        
        $telefones = $pessoa->getTelefones();
        
        return $this->render('CadpazBundle:Telefone:index.html.twig',  array('telefones'=>$telefones));
    }
    
    public function newAction(Request $request, $pessoa_id)
    {
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($pessoa_id);
        
        
        
        
        $telefone = new Telefone();
        
        $ro = false;
        if ($pessoa->getTelefones()->count()==0) {
            $telefone->setPadrao(true);
            $ro = true;
        }
        
        $telefone->setPessoa($pessoa);
        $form = $this->createForm(new TelefoneType(), $telefone, ['ro'=>$ro]);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($telefone);
            

            
            
            if ($telefone->getPadrao()) {
                foreach($pessoa->getTelefones() as $pessoa_tel) {
                    $pessoa_tel->setPadrao(false);
                    //$em->persist($pessoa);
                }
            }
            
            
            
            $pessoa->addTelefone($telefone);
            $em->flush();
            
            
            //dump($pessoa);
            
            //dump($pessoa);

            return $this->render('CadpazBundle:Telefone:index.html.twig',  array('telefones'=>$pessoa->getTelefones()));
        }
        
        
        return $this->render('CadpazBundle:Telefone:new.html.twig',array('form' => $form->createView(),'id'=>$pessoa_id, 'ro'=>$ro));
    }
}