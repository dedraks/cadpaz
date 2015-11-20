<?php

namespace CadpazBundle\Controller;
use \JMS\Serializer\SerializerBuilder;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use CadpazBundle\Entity\Caso;
use CadpazBundle\Form\CasoType;

class CasoController extends Controller
{
    public function newAction(Request $request, $pessoa_id)
    {
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($pessoa_id);
        
        $caso = new Caso();
        
        $caso->setPessoa($pessoa);
        $form = $this->createForm(new CasoType(), $caso);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($caso);
           
          
            $pessoa->addCaso($caso);
            $em->flush();

            
            
            
            
            
            return $this->render('CadpazBundle:Caso:list.html.twig',  array('casos'=>$pessoa->getCasos()));
        }
        
        
        return $this->render('CadpazBundle:Caso:new.html.twig',array('form' => $form->createView(),'id'=>$pessoa_id));        
    }
    
    public function listAction($pessoa_id)
    {
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($pessoa_id);
        
        return $this->render('CadpazBundle:Caso:list.html.twig',  array('casos'=>$pessoa->getCasos()));
    }
    
    public function listJsonAction() 
    {
        /*$qb = $this->getDoctrine()->getRepository('CadpazBundle:Caso')->createQueryBuilder('c')->groupBy('c.nome');

        $casos = $qb->getQuery()->getResult();*/
        
        $casos = $this->getDoctrine()
                ->getRepository('DedraksConfigBundle:Caso')
                //->findAllDistinctOrderedByTotal();
                ->findAll();
        //dump($casos);
        
        /*$teste = $this->getDoctrine()
                ->getRepository('CadpazBundle:Caso')
                ->countAll();
        dump($teste);*/
        
        
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        $json = $serializer->serialize($casos, 'json');
        //dump($json);
        return new \Symfony\Component\HttpFoundation\JsonResponse($json);
    }

    public function viewAction($id)
    {
        $caso = $this->getDoctrine()
            ->getRepository('CadpazBundle:Caso')
            ->find($id);
        
        return $this->render('CadpazBundle:Caso:view.html.twig', array(
                'caso'=>$caso
            ));    }

}
