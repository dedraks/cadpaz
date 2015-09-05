<?php
// src/CadpazBundle/Controller/PessoaController.php

namespace CadpazBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \JMS\Serializer\SerializerBuilder;
use CadpazBundle\Entity\Pessoa;

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
     * Lista todos os registros e renderiza um template
     * 
     * @return Response Uma instancia de Response
     */
    public function listAction()
    {
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->findAll();
        
        $serializer = SerializerBuilder::create()->build();
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
                    WHERE p.nome LIKE :nome
                    ORDER BY p.nome ASC'
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
    public function newAction(Request $request)
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
        
        // Instancia um objeto do tipo Pessoa
        $pessoa = new Pessoa();
        $pessoa->setCpf($cpf);
        
        // Chama a funcao para criar o formulário
        $form = $this->createPessoaForm($pessoa);

        // Manipula os dados enviados pelo formulário
        $form->handleRequest($request);

        // Se forem válidos, executa as operações no BD e exibe os
        // dados salvos
        if ($form->isValid()) {
            // perform some action, such as saving the task to the database

            return $this->render('CadpazBundle:Pessoa:view.html.twig', array('pessoa' => $pessoa));
        }
        
        return $this->render('CadpazBundle:Pessoa:new.html.twig',array('form' => $form->createView()));
    }
    
    /**
     * Visualiza uma pessoa
     * 
     * @param type $id
     * @return Response Uma instancia de Response
     */
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
        $d = getdate();
        $anos = array();
        $ano = $d['year'];
        for($i=$ano; $i > $ano-100; $i--)
        {
            $anos[$i] = $i;
        }
        
        
        
        return $this->createFormBuilder($pessoa)
                
                
            ->add('nome', 'text')
            ->add('email', 'text')
            ->add('sexo', 'choice', array(
                'choices' => array(
                    'M'   => 'Masculino',
                    'F' => 'Feminino',
                ),
                'multiple' => false,
                'placeholder' => 'Selecione o Sexo'
            ))
            ->add('dataNascimento', 'date', array(
                'input'  => 'datetime',
                //'widget' => 'choice',
                'format' => 'dd/MM/yyyy',
                'label' => 'Data de nascimento',
                'years' => $anos
            ))
            ->add('cpf', 'text', array('label'=>'CPF', 'disabled'=>true))
            ->add('cartaoVacina', 'checkbox', array(
                'label'    => 'Possui cartão de vacina?',
                'required' => false,
            ))
            ->add('certidaoNascimento', 'checkbox', array(
                'label'    => 'Possui certidão de nascimento?',
                'required' => false,
            ))
            ->add('certidaoCasamento', 'checkbox', array(
                'label'    => 'Possui certidão de casamento?',
                'required' => false,
            ))
            ->add('estadoCivil', 'choice', array(
                'choices' => array(
                    'CASADO'   => 'Casado',
                    'SOLTEIRO' => 'Solteiro',
                    'OUTROS' => 'Outros',
                    'placeholder' => 'Selecione o estado civil'
                ),
                'multiple' => false,
            ))
            ->add('nomeMae', 'text', array('label'=>'Nome da mãe'))
            ->add('corInformada', 'choice', array(
                'choices' => array(
                    'BRANCO'   => 'Branco',
                    'NEGRO' => 'Negro',
                    'PARDO' => 'Pardo',
                    'placeholder' => 'Selecione a cor'
                ),
                'multiple' => false,
            ))
            ->add('save', 'submit', array('label' => 'Salvar'))
            ->getForm();
    }
}
