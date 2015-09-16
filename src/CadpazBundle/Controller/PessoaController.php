<?php
// src/CadpazBundle/Controller/PessoaController.php

namespace CadpazBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use \JMS\Serializer\SerializerBuilder;

use CadpazBundle\Entity\Pessoa;
use CadpazBundle\Entity\Titulo;
use CadpazBundle\Entity\RG;

use CadpazBundle\Form\RGType;
use CadpazBundle\Form\TituloType;

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
    
    /**
     * Realiza uma busca no BD pelo CPF ou parte do nome enviado 
     * 
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\JsonResponse
     */
    public function buscaAction(Request $request)
    {
        // Obtém o CPF enviado
        $cpf = $request->get('cpf');
        if (!empty($cpf))
        {
            // Remove as formatações do CPF
            $cpf = str_replace(".","", $cpf);
            $cpf = str_replace("-","", $cpf);

            // Efetua a busca no BD
            $pessoa = $this->getDoctrine()
                ->getRepository('CadpazBundle:Pessoa')
                ->findOneBy(array('cpf'=>$cpf));
            
            dump($pessoa);
            
            if ($pessoa != null)
                    $pessoa = array($pessoa);
            //return $this->render('CadpazBundle:Pessoa:view.html.twig', array('pessoa' => $pessoa));

        }
        else // Se não há CPF enviado então a consulta será por nome
        {
            // Obtém o nome enviado
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
            
            // Consulta no BDtodos os nomes que contenham o texto enviado
            $em = $this->getDoctrine()->getManager();
                $query = $em->createQuery(
                    'SELECT p
                    FROM CadpazBundle:Pessoa p
                    WHERE p.nome LIKE :nome
                    ORDER BY p.nome ASC'
                )->setParameter('nome', '%'.$nome.'%');

                // Atribui o resultado da consulta para a variável pessoa
                $pessoa = $query->getResult();
            
            //dump($pessoa);
            
        }
        //sleep(1);
        
        // Renderiza um template com os clientes encontrados
        return $this->render('CadpazBundle:Pessoa:list.html.twig', array('pessoas' => $pessoa));
        
        
        // Converte o resultado da consulta para json e retorna
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        $json = $serializer->serialize($pessoa, 'json');
        //dump($json);
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
        //$pessoa->setCpf($cpf);
        
        // Chama a funcao para criar o formulário
        $form = $this->createPessoaForm($pessoa, $cpf);

        // Manipula os dados enviados pelo formulário
        $form->handleRequest($request);

        // Se forem válidos, executa as operações no BD e exibe os
        // dados salvos
        if ($form->isValid()) {
            // perform some action, such as saving the task to the database
            $em = $this->getDoctrine()->getManager();
            $pessoa->setDataCadastro(new \DateTime());
            $em->persist($pessoa);
            $em->flush();
            

            return $this->render('CadpazBundle:Pessoa:view.html.twig', array('pessoa' => $pessoa));
        }
        
        return $this->render('CadpazBundle:Pessoa:new.html.twig',array('form' => $form->createView(),'cpf'=>$cpf));
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
    
    public function newTituloAction($id, Request $request)
    {
        $titulo = new Titulo();
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($id);
        $titulo->setPessoa($pessoa);
        
        $form = $this->createForm(new TituloType(), $titulo);
        
        /*
        $form = $this->createFormBuilder($titulo, ['attr' => ['id' => 'newTituloForm']])
            ->add('numero', 'text')
            ->add('zona', 'text')
            ->add('secao', 'text')
            ->add('dataEmissao', 'date', [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => [
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy',
                    'data-date-language' => 'pt-BR',
                    'data-date-class' => 'date',
                    'data-date-autoclose' => 'true',
                    'data-date-startView' => '2'
                ]
            ])
            ->add('municipio', 'text')
            ->add('uf', 'choice', array(
                'choices' => array(
                    'AM'   => 'Amazonas',
                    'AP' => 'Amapá',
                    'MG' => 'Minas Gerais'
                ),
                'multiple' => false,
                'placeholder' => 'Selecione a UF',
                'label' => 'UF'
            ))
            ->add('save', 'submit', array('label' => 'Salvar'))
            //->add('cancel', 'submit', array('label' => 'Cancelar'))
            ->getForm();
        */
        
        $form->handleRequest($request);
        //if ($form->get('cancel')->isClicked()) {
        //    return $this->render('CadpazBundle:Pessoa:view.html.twig',  array('pessoa'=>$pessoa));
        //}
        
        
        //dump($form->get("dataEmissao"));
        if ($form->isValid()) {
            
            
            
            $em = $this->getDoctrine()->getManager();
            //$titulo->setDataEmissao(new \DateTime());
            $em->persist($titulo);
            $em->flush();
            

            $pessoa->setTitulo($titulo);
            return $this->render('CadpazBundle:Pessoa:view.html.twig',  array('pessoa'=>$pessoa));
        }
        
        return $this->render('CadpazBundle:Pessoa:newTitulo.html.twig',array('form' => $form->createView(),'id'=>$id));
    }
    
    public function newRgAction($id, Request $request)
    {
        $rg = new RG();
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($id);
        $rg->setPessoa($pessoa);
        $form = $this->createForm(new RGType(), $rg);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            //$titulo->setDataEmissao(new \DateTime());
            $em->persist($rg);
            $em->flush();
            

            $pessoa->setRg($rg);
            return $this->render('CadpazBundle:Pessoa:view.html.twig',  array('pessoa'=>$pessoa));
        }
        
        
        return $this->render('CadpazBundle:Pessoa:newRG.html.twig',array('form' => $form->createView(),'id'=>$id));
    }


    /**
     * Cria o formulario
     * 
     * @param Pessoa $pessoa Um objeto da Entidade Pessoa
     * @return Form O formulario criado
     */
    private function createPessoaForm($pessoa, $cpf)
    {
        $d = getdate();
        $anos = array();
        $ano = $d['year'];
        for($i=$ano; $i > $ano-100; $i--)
        {
            $anos[$i] = $i;
        }
        
        if ($pessoa->getCpf() == "")
            $pessoa->setCpf($cpf);
        
        
        return $this->createFormBuilder($pessoa, ['attr' => ['id' => 'newUserForm']])

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
            /*->add('dataNascimento', 'date', array(
                'input'  => 'datetime',
                //'widget' => 'choice',
                'format' => 'dd/MM/yyyy',
                'label' => 'Data de nascimento',
                'years' => $anos
            ))*/
            ->add('dataNascimento', 'date', [
                'widget' => 'single_text',
                'format' => 'dd-MM-yyyy',
                'attr' => [
                    'class' => 'form-control input-inline datepicker',
                    'data-provide' => 'datepicker',
                    'data-date-format' => 'dd-mm-yyyy',
                    'data-date-language' => 'pt-BR'
                ]
            ])
            ->add('cpf', 'hidden')
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
                    'OUTROS' => 'Outros'
                ),
                'multiple' => false,
                'placeholder' => 'Selecione o estado civil'
            ))
            ->add('nomeMae', 'text', array('label'=>'Nome da mãe'))
            ->add('corInformada', 'choice', array(
                'choices' => array(
                    'BRANCO'   => 'Branco',
                    'NEGRO' => 'Negro',
                    'PARDO' => 'Pardo',
                ),
                'multiple' => false,
                'placeholder' => 'Selecione a cor'
            ))
            ->add('save', 'submit', array('label' => 'Salvar'))
            ->getForm();
    }
}
