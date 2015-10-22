<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Ob\HighchartsBundle\Highcharts\Highchart;

class RelatoriosController extends Controller
{
    public function indexAction(Request $request)
    {
        $data = array();
        
        $customForm = $this->createFormBuilder($data, ['attr' => ['id' => 'customRelForm']])
            ->add('camposSelect', 'choice', array(
                'label' => ' ', 
                'multiple'=>true, 
                'choices'=>array(
                    'nome' => 'Nome',
                    'sexo' => 'Sexo',
                    'cor' => 'Cor informada',
                    'estadoCivil' => 'Estado civil',
                    'email' => 'Email',
                    'telefone' => 'Telefone',
                    'endereco' => 'Endereço',
                )
            ))
            ->add('save', 'submit', array('label' => 'Create Post'))
        ->getForm();
        
        $padraoForm = $this->createFormBuilder($data, ['attr' => ['id' => 'padraoRelForm']])
            ->add('casos', 'checkbox', array('label' => 'Tipos de Casos', 'required'=>false))
            ->add('origens', 'checkbox', array('label' => 'Origens (quem enviou o cliente para atendimento)', 'required'=>false))
            ->add('encaminhamentos', 'checkbox', array('label' => 'Encaminhamentos (para onde o cliente foi encaminhado)', 'required'=>false))
            ->add('renda', 'checkbox', array('label' => 'Renda familiar', 'required'=>false))
            ->add('idade', 'checkbox', array('label' => 'Idade', 'required'=>false))
            ->add('sexo', 'checkbox', array('label' => 'Sexo', 'required'=>false))
            ->add('cor', 'checkbox', array('label' => 'Cor', 'required'=>false))
            ->add('save', 'submit', array('label' => 'Create Post'))
        ->getForm();
        

        if ($request->isMethod('POST')) {
            $customForm->handleRequest($request);

            // $data is a simply array with your form fields 
            // like "query" and "category" as defined above.
            $data = $customForm->getData();
            
            $pessoas = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->findAll();

            $res = array();
            
            $i = 0;
            $campos = array();
            foreach($pessoas as $pessoa)
            {
                foreach ($data['camposSelect'] as $campo)
                {
                    switch ($campo)
                    {
                        case 'nome':
                            $res[$i]['nome'] = $pessoa->getNome();
                            $campos['nome'] = '';
                        break;
                        case 'sexo':
                            $res[$i]['sexo'] = $pessoa->getSexo();
                            $campos['sexo'] = '';
                        break;
                        case 'cor':
                            $res[$i]['cor'] = $pessoa->getCorInformada();
                            $campos['cor'] = '';
                        break;
                        case 'estadoCivil':
                            $res[$i]['estadoCivil'] = $pessoa->getEstadoCivil();
                            $campos['estadoCivil'] = '';
                        break;
                        case 'email':
                            $res[$i]['email'] = $pessoa->getEmail();
                            $campos['email'] = '';
                        break;
                        case 'telefone':
                            $campos['telefone'] = '';
                            $res[$i]['telefone'] = '';
                            foreach($pessoa->getTelefones() as $telefone)
                            {
                                $res[$i]['telefone'] = $telefone->getPadrao() ? $telefone->getNumero() : '';
                                if ($telefone->getPadrao()) break;
                            }
                        break;
                        case 'endereco':
                            $campos['endereco'] = '';
                            $res[$i]['endereco'] = '';
                            foreach($pessoa->getEnderecos() as $endereco)
                            {
                                $res[$i]['endereco'] = $endereco->getPadrao() ? $endereco->getNome() . ': ' . $endereco->getLogradouro() . ', ' . $endereco->getNumero() . ' - ' . $endereco->getBairro() . ' - ' . $endereco->getComplemento() . ' - ' . $endereco->getMunicipio() . ' - CEP: ' . $endereco->getCep() . ' - ' . $endereco->getUf() : '';
                                if ($endereco->getPadrao()) break;
                            }
                        break;
                    }
                }
                $i += 1;
            }
            
            dump($res);
            
                
            return $this->render('CadpazBundle:Relatorios:custom.html.twig', array(
                    'dados' => $res,
                    'campos' => $campos
                ));
        }
        
        
        
        
        
        
        
        
        
        /*
        $form = $this->createForm(new \CadpazBundle\Form\RelatorioCustomType(), $data);
        
        $form->handleRequest($request);
        dump($request);
        
        dump($form);
        
        if ($form->isSubmitted()) {
            
            dump($form->getData());
            
            return new Response('a');
        }
        */
        
        return $this->render('CadpazBundle:Relatorios:index.html.twig', array(
                    'customForm' => $customForm->createView(),
                    'padraoForm' => $padraoForm->createView()
                ));
    }
    
    
    public function casosAction()
    {
        $casos = $this->getDoctrine()
                ->getRepository('CadpazBundle:Caso')
                ->findAll();
        $total_casos = count($casos);
        
        $casos = $this->getDoctrine()
                ->getRepository('CadpazBundle:Caso')
                ->findAllDistinctOrderedByTotal();
        $casos_array = array();
        foreach($casos as $caso) 
        {
            $casos_array[] =
                    [$caso["nome"], intval($caso["total"])/$total_casos*100  ];
        }
        
        
        $ob = new Highchart();
        $ob->chart->renderTo('piechart_casos');
        $ob->title->text('Tipos de casos atendidos');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '<b>{point.name}</b>: {point.y:.1f}%',),
            'showInLegend'  => true
        ));

        $data = $casos_array;
        
        //dump($data);
        //dump($casos_array);
        
        $ob->series(array(array('type' => 'pie','name' => 'Total de casos', 'data' => $data)));

                return $this->render('CadpazBundle:Relatorios:casos.html.twig', array(
                    'chart' => $ob,
                    'casos' => $casos,
                    'total_casos' => $total_casos
                ));
    }
    
    public function encaminhamentosAction()
    {
        $encaminhamentos = $this->getDoctrine()
                ->getRepository('CadpazBundle:Encaminhamento')
                ->findAll();
        $total_encaminhamentos = count($encaminhamentos);
        
        $encaminhamentos = $this->getDoctrine()
                ->getRepository('CadpazBundle:Encaminhamento')
                ->findAllDistinctOrderedByTotal();
        //$total_casos = count($casos);
        $encaminhamentos_array = array();
        foreach($encaminhamentos as $encaminhamento) 
        {
            $encaminhamentos_array[] =
                    [$encaminhamento["encaminhado"], intval($encaminhamento["total"])/$total_encaminhamentos*100 ];
        }
        
        
        $ob = new Highchart();
        $ob->chart->renderTo('piechart_encaminhamentos');
        $ob->title->text('Encaminhado para');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '<b>{point.name}</b>: {point.y:.1f}%',),
            'showInLegend'  => true
        ));
        $data = $encaminhamentos_array;
        
        //dump($data);
        //dump($casos_array);
        
        $ob->series(array(array('type' => 'pie','name' => 'Total de casos', 'data' => $data)));

                return $this->render('CadpazBundle:Relatorios:encaminhamentos.html.twig', array(
                    'chart' => $ob,
                    'encaminhamentos' => $encaminhamentos,
                ));
    }
    
    public function origensAction()
    {
        $origens = $this->getDoctrine()
                ->getRepository('CadpazBundle:Questionario')
                ->findAllOriginsDistinctOrderedByTotal();
        $total_origens = count($origens);
        $origens_array = array();
        foreach($origens as $origem) 
        {
            $origens_array[] =
                    [
                        $origem["origem"], 
                        (intval($origem["total"])/$total_origens) * 100,
                    ];
        }
        
        
        $ob = new Highchart();
        $ob->chart->renderTo('piechart_origens');
        $ob->title->text('Como foi encaminhado para o projeto');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '<b>{point.name}</b>: {point.y:.1f}%',),
            'showInLegend'  => true
        ));
        $data = $origens_array;
        
        //dump($data);
        //dump($casos_array);
        
        $ob->series(array(array('type' => 'pie','name' => 'Total de origens', 'data' => $data)));

                return $this->render('CadpazBundle:Relatorios:origens.html.twig', array(
                    'chart' => $ob,
                    'origens' => $origens,
                    'total_origens' => count($origens)
                ));
    }
    
    public function idadesAction()
    {
        /*$idades = $this->getDoctrine()
                ->getRepository('CadpazBundle:Pessoa')
                ->findAllAgesOrderedByTotal();*/
        
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT p.dataNascimento, p.dataCadastro
            FROM CadpazBundle:Pessoa p'
        );

        $pessoas = $query->getResult();
        $total = count($pessoas);
        
        $idades_array = [
            "Menos de 18" => 0,
            "18-30" => 0,
            "31-40" => 0,
            "41-50" => 0,
            "51-60" => 0,
            "Mais de 60" => 0,
        ];
        
        foreach ($pessoas as $pessoa)
        {
            $dataCadastro = $pessoa["dataCadastro"];
            $inter = $dataCadastro->diff($pessoa["dataNascimento"]);
            $idadec = $inter->y;
            
            
            switch (true)
            {
                case ($idadec < 18):
                    $idades_array["Menos de 18"]++;
                break;
                case ($idadec <= 30):
                    $idades_array["18-30"]++;
                break;
                case ($idadec <= 40):
                    $idades_array["31-40"]++;
                break;
                case ($idadec <= 50):
                    $idades_array["41-50"]++;
                break;
                case ($idadec <= 60):
                    $idades_array["51-60"]++;
                break;
                default:
                    $idades_array["Mais de 60"]++;
                break;
            }                
        }
        
        dump($idades_array);
        
        
        
        $ob = new Highchart();
        $ob->chart->renderTo('piechart_idades');
        $ob->title->text('Idade dos atendidos');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '<b>{point.name}</b>: {point.y:.1f}%',),
            'showInLegend'  => true
        ));
        
        
        $data = array();
        foreach (array_keys($idades_array) as $key)
        {
            $data[]=
                [$key,  $idades_array[$key]/$total*100 ]
            ;
        }
        
        dump($data);
        //dump($casos_array);
        
        $ob->series(array(array('type' => 'pie','name' => 'Idade', 'data' => $data)));

                return $this->render('CadpazBundle:Relatorios:idades.html.twig', array(
                    'chart' => $ob,
                    //'idades' => $idades,
                    //'total_origens' => count($origens)
                ));
    }
    
    public function sexosAction()
    {
        $sexos = $this->getDoctrine()
                ->getRepository('CadpazBundle:Pessoa')
                ->findAllGrouppedBySexo();
        
        $total = 0;
        for ($i=0;$i<count($sexos);$i++)
        {
            $total += $sexos[$i]["total"];
            if ($sexos[$i]["sexo"] == "M")
            {
                $sexos[$i]["sexo"] = "Masculino";
            }
            elseif ($sexos[$i]["sexo"] == "F") {
                $sexos[$i]["sexo"] = "Feminino";
            }
            else {
                $sexos[$i]["sexo"] = "Outros";
            }
        }
        
        $sexos_array = array();
        foreach($sexos as $sexo) 
        {
            $sexos_array[] =
                    [$sexo["sexo"], (intval($sexo["total"])/$total) * 100 ];
        }
        
        //dump($sexos);
        //dump($total);
        
        $ob = new Highchart();
        $ob->chart->renderTo('piechart_sexos');
        $ob->title->text('Sexo dos atendidos');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '<b>{point.name}</b>: {point.y:.1f}%',),
            'showInLegend'  => true
        ));
        $data = $sexos_array;
        
        //dump($data);
        //dump($casos_array);
        
        $ob->series(array(array('type' => 'pie','name' => 'Sexos', 'data' => $data)));

                return $this->render('CadpazBundle:Relatorios:sexos.html.twig', array(
                    'chart' => $ob,
                    'sexos' => $sexos,
                ));
    }
    
    
    public function coresAction()
    {
        $pessoas = $this->getDoctrine()
                ->getRepository('CadpazBundle:Pessoa')
                ->findAll();
        $total = count($pessoas);
        unset($pessoas);
        
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT
                p.corInformada as cor, count(p.corInformada) as total
            FROM
                CadpazBundle:Pessoa p
            GROUP BY
                cor
                '
        );
        
        $cores = $query->getResult();
        dump($cores);
        
        
        
        
        $cores_array = array();
        foreach($cores as $cor) 
        {
            $c = intval($cor["total"]);
        
            
            $cores_array[] =
                    [$cor["cor"], ($c/$total) * 100 ];
        }
        dump($total);
        dump($cores_array);
        //dump($sexos);
        //dump($total);
        
        $ob = new Highchart();
        $ob->chart->renderTo('piechart_cores');
        $ob->title->text('Cor/Raça dos atendidos');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '<b>{point.name}</b>: {point.y:.1f}%',),
            'showInLegend'  => true
        ));
        $data = $cores_array;
        
        //dump($data);
        //dump($casos_array);
        
        $ob->series(array(array('type' => 'pie','name' => 'Sexos', 'data' => $data)));

                return $this->render('CadpazBundle:Relatorios:cores.html.twig', array(
                    'chart' => $ob,
                    'cores' => $cores,
                    'total' => $total
                ));
    }
 
    public function rendaFamiliarAction()
    {
        $questionarios = $this->getDoctrine()
                ->getRepository('CadpazBundle:Questionario')
                ->findAll();
        $total = count($questionarios);
        unset($questionarios);
        
        
        $em = $this->getDoctrine()->getManager();
        $query = $em->createQuery(
            'SELECT 
                q.rendaFamiliar as renda, count(q.id) as total 
            FROM
                CadpazBundle:Questionario q
            GROUP BY
                renda'
                
        );
        
        $rendas = $query->getResult();
        //dump($cores);
        
        
        
        
        $rendas_array = array();
        foreach($rendas as $renda) 
        {
            $c = intval($renda["total"]);
        
            
            $rendas_array[] =
                    [$renda["renda"], ($c/$total) * 100 ];
        }
        //dump($total);
        //dump($rendas_array);
        
        
        $ob = new Highchart();
        $ob->chart->renderTo('piechart_rendas');
        $ob->title->text('Faixa de renda dos atendidos');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '<b>{point.name}</b>: {point.y:.1f}%',),
            'showInLegend'  => true
        ));
        $data = $rendas_array;
        
        //dump($data);
        //dump($casos_array);
        
        $ob->series(array(array('type' => 'pie','name' => 'Renda', 'data' => $data)));

                return $this->render('CadpazBundle:Relatorios:rendas.html.twig', array(
                    'chart' => $ob,
                    'rendas' => $rendas,
                    'total' => $total
                ));
    }


    public function atendimentosPorAtendente()
    {
        
    }
    
    
   
    public function pessoaNumFilhosAction()
    {
        
    }
    
    
}
