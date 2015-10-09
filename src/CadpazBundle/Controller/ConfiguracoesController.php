<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



use Dedraks\ConfigBundle\Entity\Caso;
use Dedraks\ConfigBundle\Form\CasoType;

class ConfiguracoesController extends Controller
{
    
    
    public function newCasoTipoAction(Request $request)
    {
        $caso = new Caso();
        
        $form = $this->createForm(new CasoType(), $caso);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($caso);
            $em->flush();
            
            return $this->forward('DedraksConfigBundle:Default:index',
                    ['expand'=>'caso']
                    );
        }
        
        return $this->render('DedraksConfigBundle:Caso:new.html.twig',array(
            'form' => $form->createView(),
            )
        );   
    }
    
    public function editCasoTipoAction(Request $request, $id)
    {
        // Obtém uma instância do objeto com o id informado
        $caso = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Caso')
            ->find($id);
        
        // Guarda o atributo tipo (nome) do objeto
        $tipo = $caso->getTipo();
        
        // Gera o formulário
        $form = $this->createForm(new CasoType(), $caso);
        
        // Trata os dados enviados pelo formulário
        $form->handleRequest($request);
        
        // Verifica se o formulário é válido
        if ($form->isValid()) {
            
            // Obtém uma lista de todos os casos já cadastrados com o nome antigo
            $casos = $this->getDoctrine()
                ->getRepository('CadpazBundle:Caso')
                ->findBy(['nome'=>$tipo]);
            
            // Percorre a lista de todos os casos e atualiza o nome (tipo)
            foreach($casos as $c)
            {
                $c->setNome($caso->getTipo());
            }
            
            // Atualiza o tipo (nome) da opção
            $em = $this->getDoctrine()->getManager();
            $em->flush();
            
            // Exibe a lista de opções
            return $this->forward('DedraksConfigBundle:Default:index',
                    ['expand'=>'caso']
                    );
        }
        
        // Exibe o formulário
        return $this->render('DedraksConfigBundle:Caso:new.html.twig',array(
            'form' => $form->createView(),
            'id'=>$id
            )
        );   
    }
    
    public function deleteCasoTipoAction($id)
    {
        $caso = $this->getDoctrine()
            ->getRepository('DedraksConfigBundle:Caso')
            ->find($id);
        
        $em = $this->getDoctrine()->getManager();
        $em->remove($caso);
        $em->flush();
           
        return $this->forward('DedraksConfigBundle:Default:index',
                ['expand'=>'caso']
                );
    }
}
