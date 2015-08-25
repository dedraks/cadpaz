<?php
// src/CadpazBundle/Controller/PessoaController.php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        return $this->render('CadpazBundle:Pessoa:index.html.twig');
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
    private function createForm()
    {
        
    }
}
