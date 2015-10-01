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
                    [$caso["nome"], intval($caso["total"])];
        }
        
        
        $ob = new Highchart();
        $ob->chart->renderTo('piechart_casos');
        $ob->title->text('Tipos de casos atendidos');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '<b>{point.name}</b>: {point.y:.0f}',),
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
                ->findAllDistinctOrderedByTotal();
        //$total_casos = count($casos);
        $encaminhamentos_array = array();
        foreach($encaminhamentos as $encaminhamento) 
        {
            $encaminhamentos_array[] =
                    [$encaminhamento["encaminhado"], intval($encaminhamento["total"])];
        }
        
        
        $ob = new Highchart();
        $ob->chart->renderTo('piechart_encaminhamentos');
        $ob->title->text('Tipos de encaminhamentos');
        $ob->plotOptions->pie(array(
            'allowPointSelect'  => true,
            'cursor'    => 'pointer',
            'dataLabels'    => array('enabled' => true, 'format' => '<b>{point.name}</b>: {point.y:.0f}',),
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
    
    public function origemAction()
    {
        
    }
    
    public function atendimentosPorAtendente()
    {
        
    }
    
    public function pessoaSexosAction()
    {
        
    }
    
    public function pessoaCoresAction()
    {
        
    }
    
    public function pessoaNumFilhosAction()
    {
        
    }
    
    
}
