<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Ob\HighchartsBundle\Highcharts\Highchart;

class RelatoriosController extends Controller
{
    public function indexAction()
    {
        return $this->render('CadpazBundle:Relatorios:index.html.twig', array(
                    
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

        $products = $query->getResult();
        
        
        //$total_casos = count($casos);
        $idades_array = array();
        foreach($idades as $idade) 
        {
            $idades_array[] =
                    [$idade["idade"], intval($idade["total"])];
        }
        
        
        $ob = new Highchart();
        $ob->chart->renderTo('piechart_idades');
        $ob->title->text('Como foi encaminhado para o projeto');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '<b>{point.name}</b>: {point.y:.0f}',),
            'showInLegend'  => true
        ));
        $data = $idades_array;
        
        //dump($data);
        //dump($casos_array);
        
        $ob->series(array(array('type' => 'pie','name' => 'Idade', 'data' => $data)));

                return $this->render('CadpazBundle:Relatorios:idades.html.twig', array(
                    'chart' => $ob,
                    'origens' => $idades,
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
        
        dump($sexos);
        dump($total);
        
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
    
    public function atendimentosPorAtendente()
    {
        
    }
    
    
    
    public function pessoaCoresAction()
    {
        
    }
    
    public function pessoaNumFilhosAction()
    {
        
    }
    
    
}
