<?php
// src/CadpazBundle/Controller/PessoaController.php

namespace CadpazBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \JMS\Serializer\SerializerBuilder;

/**
 * Pessoa Controller
 * 
 * Classe para controlar o gerenciamento do cadastro de pessoas do sistema.
 * 
 * @author Carlos Alberto Borges Garcia Jr <dedraks@gmail.com>
 */
class PessoaController extends Controller
{
    /**
     * Index Controller's action
     * 
     * @return Response Uma instancia de Response
     */
    public function indexAction()
    {
        return $this->render('CadpazBundle:Pessoa:index.html.twig', array(
                // ...
            ));
    }

    /**
     * Lista todos os registro e renderiza um template
     * 
     * @return Response Uma instancia de Response
     */
    public function listAction()
    {
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->findAll();
        
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        $json = $serializer->serialize($pessoa, 'json');
        
        
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($json);
    }
    
    public function buscaAction(Request $request)
    {
        
        $cpf = $request->get('cpf');
        if (!empty($cpf))
        {
            $cpf = str_replace(".","", $cpf);
            $cpf = str_replace("-","", $cpf);

            $pessoa = $this->getDoctrine()
                ->getRepository('CadpazBundle:Pessoa')
                ->findOneBy(array('cpf'=>$cpf));
        }
        else
        {
            $nome = $request->get('nome');
            /*$pessoa = $this->getDoctrine()
                ->getRepository('CadpazBundle:Pessoa')
                ->findBy(array('nome'=>$nome));*/
            /*
            $pessoa = $this->getDoctrine()->getRepository('CadpazBundle:Pessoa')->createQueryBuilder('p')
                ->where('p.nome LIKE :nome')
                ->setParameter('nome', $nome)
                ->getQuery()
                ->getResult();*/
            
            $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                    'SELECT p
                    FROM CadpazBundle:Pessoa p
                    WHERE p.nome LIKE :nome'
                )->setParameter('nome', '%'.$nome.'%');

                $pessoa = $query->getResult();
            
            dump($pessoa);
        }
        
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        $json = $serializer->serialize($pessoa, 'json');
        dump($json);
        return new \Symfony\Component\HttpFoundation\JsonResponse($json);
    }
    
    /**
     * Cadastra um novo registro no bd
     * 
     * Cria um formulario e manupula os dados submetidos
     * 
     * @param Request $request A requisicao http
     * @return Response Uma instancia de Response
     */
    public function newAction()
    {
        return $this->render('CadpazBundle:Pessoa:index.html.twig');
    }
    
    public function viewAction($id)
    {
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($id);
        
        return $this->render('CadpazBundle:Pessoa:view.html.twig',  array('pessoa'=>$pessoa));
    }
    
    /**
     * Edita o registro
     * 
     * @param Request $request A requisicao http
     * @param int $id O id do registro
     * @return Response Uma instancia de Response
     */
    public function editAction(/*Request $request, int $id*/)
    {
        return $this->render('CadpazBundle:Pessoa:index.html.twig');
    }
    
    /**
     * Remove o registro
     * 
     * @param Request $request A requisicao http
     * @param int $id O id do registro
     * @return Response Uma instancia de Response
     */
    public function deleteAction()
    {
        $this->render('CadpazBundle:Pessoa:index.html.twig');
    }
    
    /**
     * Cria o formulario
     * 
     * @param Pessoa $pessoa Um objeto da Entidade Pessoa
     * @return Form O formulario criado
     */
    private function createPessoaForm($pessoa)
    {
        
    }
}
