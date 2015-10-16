<?php

namespace Dedraks\ConfigBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;



use CadpazBundle\Entity\User;
use CadpazBundle\Entity\Type;

/**
 * Description of UsuarioController
 *
 * @author carlos
 */
class UsuarioController extends Controller 
{
    public function indexAction(Request $request)
    {
        $expandir = $request->get('expandir');
        
        
        dump($expandir);
        
        if ($expandir === 'usuario')
        {
            $expandir = true;
        }
        else 
        {
            $expandir = false;
        }
        
        $users = $this->getDoctrine()
            ->getRepository('CadpazBundle:User')
            ->findAll();
        
        return $this->render('DedraksConfigBundle:User:list.html.twig', array(
            'users'    => $users,
            'expandir' => $expandir
        ));  
    }
}
