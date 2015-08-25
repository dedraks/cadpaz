<?php
// src/CadpazBundle/Controller/PessoaController.php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Atendimento Controller
 * 
 * Classe para controlar os atendimentos.
 * 
 * @author Carlos Alberto Borges Garcia Jr <dedraks@gmail.com>
 */
class AtendimentoController extends Controller
{
    /**
     * Index Controller's action
     * 
     * @return Response Uma instancia de Response
     */
    public function indexAction()
    {
        return $this->render('CadpazBundle:Atendimento:index.html.twig', array(
                // ...
            ));
    }
}
