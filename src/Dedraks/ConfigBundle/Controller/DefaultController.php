<?php

namespace Dedraks\ConfigBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction(Request $request)
    {        
        $expand = $request->get('expand');
        
        if (is_null($expand))
            $expand = 'vazio';
        
        dump($expand);
        
        return $this->render('DedraksConfigBundle:Default:index.html.twig', array(
            'expandir'=>$expand
        ));    
    }
}
