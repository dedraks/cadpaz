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
     * @return Response A Response instance
     */
    public function indexAction()
    {
        return $this->render('CadpazBundle:Pessoa:index.html.twig', array(
                // ...
            ));
    }

    /**
     * Lists all records and renders a template
     * 
     * @return Response A Response instance
     */
    public function listAction()
    {
        return $this->render('CadpazBundle:Pessoa:index.html.twig');
    }
    
    /**
     * Register a new record
     * 
     * Create a form and handles its submission
     * 
     * @return Response A Response instance
     */
    public function newAction()
    {
        return $this->render('CadpazBundle:Pessoa:index.html.twig');
    }
    
    public function editAction()
    {
        return $this->render('CadpazBundle:Pessoa:index.html.twig');
    }
    
    public function deleteAction()
    {
        $this->render('CadpazBundle:Pessoa:index.html.twig');
    }
}
