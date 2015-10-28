<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use CadpazBundle\Form\EventListener\AddFieldSubscriber;

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
                    'nomeMae' => 'Nome da mãe',
                    'sexo' => 'Sexo',
                    'dataNascimento' => 'Data de nascimento',
                    'idade_a' => 'Idade atual',
                    'idade_c' => 'Idade quando foi atendido',
                    'cor' => 'Cor informada',
                    'estadoCivil' => 'Estado civil',
                    'rendaFamiliar' => 'Renda familiar',
                    'email' => 'Email',
                    'telefone' => 'Telefone',
                    'endereco' => 'Endereço',
                    'origem' => 'Origem',
                    'beneficios' => 'Benefícios Sociais',
                )
            ))
                
            ->add('filtro', 'text', ['required'=>false,'label'=> ' ', 
                'attr' =>  ['style'=>'width: 100%'] ])
            
            ->add('filtroMostrar', 'text', ['required'=>false,'label'=>'Filtros'])
                
            ->add('save', 'submit', array('label' => 'Exibir relatório'))
        ->getForm();
        
        $padraoForm = $this->createFormBuilder($data, ['attr' => ['id' => 'padraoRelForm']])
            ->add('casos', 'checkbox', array('label' => 'Tipos de Casos', 'required'=>false))
            ->add('origens', 'checkbox', array('label' => 'Origens (quem enviou o cliente para atendimento)', 'required'=>false))
            ->add('encaminhamentos', 'checkbox', array('label' => 'Encaminhamentos (para onde o cliente foi encaminhado)', 'required'=>false))
            ->add('renda', 'checkbox', array('label' => 'Renda familiar', 'required'=>false))
            ->add('idade', 'checkbox', array('label' => 'Idade', 'required'=>false))
            ->add('sexo', 'checkbox', array('label' => 'Sexo', 'required'=>false))
            ->add('cor', 'checkbox', array('label' => 'Cor', 'required'=>false))
            ->add('save', 'submit', array('label' => 'Exibir relatório'))
        ->getForm();
        

        if ($request->isMethod('POST')) {
            $customForm->handleRequest($request);
            $padraoForm->handleRequest($request);
            

            if ($customForm->isValid())
            {
                // $data is a simply array with your form fields 
                // like "query" and "category" as defined above.
                $data = $customForm->getData();
                dump($data);
                
                $filtros = $this->parseFiltro($data['filtro']);
                //dump($filtros);

                $pessoas = $this->getDoctrine()
                ->getRepository('CadpazBundle:Pessoa')
                ->findAll();

                $res = array();

                $i = 0;
                $campos = array();
                $adicionar = true;
                foreach($pessoas as $pessoa)
                {
                    if (!$this->verificaFiltros($pessoa, $filtros)) continue;
                    
                    $questionario = $pessoa->getQuestionario();
                    foreach ($data['camposSelect'] as $campo)
                    {
                        switch ($campo)
                        {
                            case 'nome':
                                $res[$i]['nome'] = $pessoa->getNome();
                                $campos['nome'] = '';
                            break;
                            case 'nomeMae':
                                $res[$i]['nomeMae'] = $pessoa->getNomeMae();
                                $campos['nomeMae'] = '';
                            break;
                            case 'sexo':
                                $res[$i]['sexo'] = $pessoa->getSexo();
                                $campos['sexo'] = '';
                            break;
                            case 'dataNascimento':
                                $res[$i]['dataNascimento'] = $pessoa->getDataNascimento();
                                $campos['dataNascimento'] = '';
                            break;
                            case 'idade_c':
                                $res[$i]['idade_c'] = $pessoa->getSexo();
                                $res[$i]['dataNascimento'] = $pessoa->getDataNascimento();
                                $res[$i]['dataCadastro'] = $pessoa->getDataCadastro();
                                $campos['idade_c'] = '';
                            break;
                            case 'idade_a':
                                $res[$i]['idade_a'] = $pessoa->getSexo();
                                $res[$i]['dataNascimento'] = $pessoa->getDataNascimento();
                                $campos['idade_a'] = '';
                            break;
                            case 'cor':
                                $res[$i]['cor'] = $pessoa->getCorInformada();
                                $campos['cor'] = '';
                            break;
                            case 'estadoCivil':
                                $res[$i]['estadoCivil'] = $pessoa->getEstadoCivil();
                                $campos['estadoCivil'] = '';
                            break;
                            case 'rendaFamiliar':
                                $res[$i]['rendaFamiliar'] = 'Questionário não respondido';
                                if ( ! is_null($pessoa->getQuestionario()))
                                {
                                    $res[$i]['rendaFamiliar'] = $pessoa->getQuestionario()->getRendaFamiliar();
                                }
                                $campos['rendaFamiliar'] = '';
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
                            case 'origem':
                                $res[$i]['origem'] = 'Questionário não respondido';
                                if ( ! is_null($pessoa->getQuestionario()))
                                {
                                    $res[$i]['origem'] = $pessoa->getQuestionario()->getEncaminhamentoAoProjeto();
                                }
                                $campos['origem'] = '';
                            break;
                            case 'beneficios':
                                $res[$i]['beneficios'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    $beneficios = array();
                                    $beneficios['peti'] = $questionario->getParticipaOuRecebePETIBolsaCriancaCidada();
                                    $beneficios['agenteJovem'] = $questionario->getParticipaOuRecebeAgenteJovem();
                                    $beneficios['bolsaFamilia'] = $questionario->getParticipaOuRecebeBolsaFamilia();
                                    $beneficios['bcp'] = $questionario->getParticipaOuRecebeBCP();
                                    $beneficios['naoRespondeu'] = $questionario->getParticipaOuRecebeNaoRespondeu();
                                    $beneficios['naoSabe'] = $questionario->getParticipaOuRecebeNaoSabe();
                                    $beneficios['naoRecebe'] = ! ($beneficios['peti'] || $beneficios['agenteJovem'] || $beneficios['bolsaFamilia'] || $beneficios['bcp'] || $beneficios['naoSabe'] || $beneficios['naoRespondeu'] );
                                    
                                    $res[$i]['beneficios'] = $beneficios;
                                }
                                $campos['beneficios'] = '';
                            break;
                        }
                    }
                    $i += 1;
                }

                dump($res);


                if (count($res)<1)
                {
                    return $this->render('CadpazBundle:Relatorios:empty.html.twig', array(

                    ));
                }
                
                $texto = $this->geraTexto($campos, $filtros);
                
                return $this->render('CadpazBundle:Relatorios:custom.html.twig', array(
                        'dados' => $res,
                        'campos' => $campos,
                        'texto'  => $texto
                    ));
            }
            elseif ($padraoForm->isValid()) 
            {
                $relatorios = array();
                
                $data = $padraoForm->getData();
                
                foreach (array_keys($data) as $key)
                {
                    if ($data[$key])
                        $relatorios[$key]=true;
                }
                
                dump($data);
                dump($relatorios);
                
                
                return $this->render('CadpazBundle:Relatorios:padrao.html.twig', array(
                        'relatorios' => $relatorios
                    ));
            }
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
        $idades = array();
        foreach (array_keys($idades_array) as $key)
        {
            $data[]=
                [$key,  $idades_array[$key]/$total*100 ]
            ;
            
            $idades[]=
                [
                    'idade' =>  $key,
                    'total' => $idades_array[$key]
                ]
            ;
        }
        

        
        
        
        dump($data);
        dump($idades_array);
        
        $ob->series(array(array('type' => 'pie','name' => 'Idade', 'data' => $data)));
                
                return $this->render('CadpazBundle:Relatorios:idades.html.twig', array(
                    'chart' => $ob,
                    'idades' => $idades,
                    'total' => count($idades_array)
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

    public function filtrosAction()
    {
        $data = array();
        $fitroForm = $this->createFormBuilder($data, ['attr' => ['id' => 'filtroRelForm']])
            ->add('criterio', 'choice', array(
                'label' => 'Critério',
                'placeholder' => 'Selecione o critério',
                'choices' => array(
                    'cor' => 'Cor informada',
                    'idadeAtual' => 'Idade atual',
                    'idadeAtendimento' => 'Idade quando foi atendido',
                    'sexo' => 'Sexo',
                )))
            ->add('comparacao', 'choice', array(
                'label' => 'Comparação',
                'placeholder' => 'Selecione o comparador',
                'choices' => array(
                    '=' => 'Igual a',
                    '!=' => 'Diferente de',
                    '>' => 'Maior que',
                    '>=' => 'Maior que ou igual a',
                    '<' => 'Menor que',
                    '<=' => 'Menor que ou igual a',
                )
            ))
            ->add('valor')
            ->add('save', 'submit', ['label'=>'Adicionar'])
        ->getForm();
        
        return $this->render('CadpazBundle:Relatorios:filtros.html.twig', array(
            'form' => $fitroForm->createView()
        ));
    }
    

    public function atendimentosPorAtendente()
    {
        
    }
    
    
   
    public function pessoaNumFilhosAction()
    {
        
    }
    
    
    private function parseFiltro($str)
    {
        
        $filtros_adicionados = array();
        $filtros = explode('&', $str);
        
        foreach($filtros as $filtro)
        {
            if (strpos($filtro, '>=')) {
                $filtros_adicionados[] = array(explode('>=', $filtro)[0], explode('>=', $filtro)[1], '>=');
            }
            elseif (strpos($filtro, '<=')) {
                $filtros_adicionados[] = array(explode('<=', $filtro)[0], explode('<=', $filtro)[1], '<=');
            }
            elseif (strpos($filtro, '!=')) {
                $filtros_adicionados[] = array(explode('!=', $filtro)[0], explode('!=', $filtro)[1], '!=');
            }
            elseif (strpos($filtro, '='))
            {
                $filtros_adicionados[] = array(explode('=', $filtro)[0], explode('=', $filtro)[1], '=');
            }
            elseif (strpos($filtro, '>')) {
                $filtros_adicionados[] = array(explode('>', $filtro)[0], explode('>', $filtro)[1], '>');
            }
            elseif (strpos($filtro, '<')) {
                $filtros_adicionados[] = array(explode('<', $filtro)[0], explode('<', $filtro)[1], '<');
            }
        }
        
        
        return $filtros_adicionados;
    }
    
    /**
     * 
     * @param \CadpazBundle\Entity\Pessoa $pessoa
     * @param type $filtros
     * @return boolean
     * 
     * Filtros ativos:
     *      sexo:
     *          critério de comparação aceito '='
     *          valores de comparação: 'M', 'F', ou 'O'
     *          uso: sexo='M'
     * 
     *      idadeAtual:
     *          critérios de comparação aceitos: = != < <= > >=
     *          valores de comparação: número
     *          uso: idadeAtual>30
     * 
     *      idadeAtendimento:
     * 
     *      cor:
     *          criterios de comparação aceitos = !=
     *          calores de comparação: string
     *          uso: cor=pardo
     *               cor!=negro
     * 
     *      rendaFamiliar:
     * 
     *      possuiRG:
     * 
     *      possuiTituloEleitoral:
     * 
     *      possuiPIS:
     * 
     *      possuiCTPS:
     * 
     *      possuiCertidaoDeNascimento:
     * 
     *      possuiCertidaoDeCasamento:
     * 
     *      possuiCartaoDeVacina:
     * 
     *      EstadoCivil:
     * 
     *      dataDeCadastro:
     * 
     *      tipoDeMoradia:
     * 
     *      moraComSozinho:
     * 
     *      moraComFilhos:
     * 
     *      moraComPaiMae:
     * 
     *      moraComIrmaos:
     * 
     *      moraComConjuge:
     * 
     *      moraComParentesAmigos:
     * 
     *      moraComOutraSituacao:
     * 
     *      numeroDePessoasNaCasa:
     * 
     *      numeroDeFilhos:
     * 
     *      moradiaTemColetaDeLixo:
     * 
     *      moradiaTemRedeDeEsgoto:
     * 
     *      moradiaTemAguaEncanada:
     * 
     *      moradiaTemEletricidade:
     * 
     *      moradiaTemRuaPavimentada:
     * 
     *      moradiaSituadaEmZonaRural:
     * 
     *      moradiaSituadaEmQuilombola:
     * 
     *      tipoMoradia2:
     * 
     *      estudaAtualmente:
     * 
     *      temInteresseEmVoltarAEstudar:
     * 
     *      temFilhosEmIdadeEscolar:
     * 
     *      temFilhosMatriculadosEmEscola:
     * 
     *      temDeficiencia:
     * 
     *      fazAcompanhamento:
     * 
     *      usaMedicaoConstante:
     * 
     *      recebeMedicacaoDaFarmaciaDistrital:
     * 
     *      domicilioCobertoPorUBS:
     * 
     *      idosoOuGestanteNaFamilia:
     * 
     *      recebeBeneficioSocial:
     * 
     *      condicaoDeTrabalho:
     * 
     *      despesasMensais:
     * 
     *      origem:
     * 
     *      encaminhado:
     */
    private function verificaFiltros(\CadpazBundle\Entity\Pessoa $pessoa, $filtros)
    {
        foreach($filtros as $filtro)
        {
            $criterio = trim($filtro[0]);
            $valor = trim($filtro[1]);
            $valor = trim($valor,"'");        
            $operador = trim($filtro[2]);
            
            dump($criterio);
            switch ($criterio)
            {
                case 'sexo':
                    dump($pessoa->getSexo());
                    if ( strtolower($pessoa->getSexo()) != strtolower($valor))
                        return false;
                break;
                case 'idadeAtual':
                    $agora = new \DateTime();
                    $dataNascimento = $pessoa->getDataNascimento();
                    $idade = date_diff($agora, $dataNascimento)->y;
                    
                    switch ($operador)
                    {
                        case '=':
                            if ( ! ($idade == $valor) )
                                return false;
                        break;
                        case '!=':
                            if ( ! ($idade != $valor) )
                                return false;
                        break;
                        case '>=':
                            if ( ! ($idade >= $valor) )
                                return false;
                        break;
                        case '<=':
                            if ( ! ($idade <= $valor) )
                                return false;
                        break;
                        case '>':
                            if ( ! ($idade > $valor) )
                                return false;
                        break;
                        case '<':
                            if ( ! ($idade < $valor) )
                                return false;
                        break;
                    }
                    
                break;
                case 'idadeAtendimento':
                break;
                case 'cor':
                    if ($operador == '=') 
                    {
                        if (strtolower($pessoa->getCorInformada()) != strtolower($valor))
                            return false;
                    }
                    elseif ($operador == '!=') 
                    {
                        if (strtolower($pessoa->getCorInformada()) == strtolower($valor))
                            return false;
                    }
                break;
                case 'rendaFamiliar':
                    $questionario = $pessoa->getQuestionario();
                    if (is_null($questionario))
                        return false;
                    $rendaFamiliar = $questionario->getRendaFamiliar();
                    dump($rendaFamiliar);
                    switch ($operador)
                    {
                        case '=':
                            switch ($valor)
                            {
                                case 1:
                                    if (! ($rendaFamiliar == 'Até 1 salário mínimo'))
                                        return false;
                                break;
                                case 2:
                                    if (! ($rendaFamiliar == '1 a 2 salários mínimos'))
                                        return false;
                                break;
                                case 3:
                                    if (! ($rendaFamiliar == '3 a 5 salários mínimos'))
                                        return false;
                                break;
                                case 4:
                                    if (! ($rendaFamiliar == '6 a 10 salários mínimos'))
                                        return false;
                                break;
                                case 5:
                                    if (! ($rendaFamiliar == '11 a 30 salários mínimos'))
                                        return false;
                                break;
                                case 6:
                                    if (! ($rendaFamiliar == 'Acima de 30 salários mínimos'))
                                        return false;
                                break;
                                case 7:
                                    if (! ($rendaFamiliar == 'Nenuma renda'))
                                        return false;
                                break;
                            }
                        break;
                    }
                break;
            }
        }
        
        return true;
    }
    
    
    
    private function geraTexto($campos, $filtros)
    {
        $texto = "Exbindo ";
        foreach ( array_keys($campos) as $campo) 
        {   
            $texto .= $campo . ", ";
        }
        $texto = rtrim($texto);
        $texto = rtrim($texto, ',');
       
        
        $texto = str_replace('nomeMae', 'nome da mãe', $texto);
        $texto = str_replace('dataNascimento', 'data de nascimento', $texto);
        $texto = str_replace('idade_a', 'idade atual', $texto);
        $texto = str_replace('idade_c', 'idade quando foi atendido', $texto);
        $texto = str_replace('estadoCivil', 'estado civil', $texto);
        $texto = str_replace('endereco', 'endereço', $texto);
        
        $texto = $this->str_lreplace(',', ' e', $texto);
        
        $texto .= ' de todos os clientes';
        
        if (count($filtros)>0)
        {
            $texto .= " com ";
            
            foreach ($filtros as $filtro)
            {
                $texto .= $filtro[0] . ' ' . $filtro[2] . ' ' . $filtro[1] . ' e ';
                
                
            }
            
            $texto = $this->str_lreplace('e ', '.', $texto);
        }
        else
        {
            $texto .= '.';
        }
        
        
        
        
        $texto = str_replace('idadeAtual', 'idade atual', $texto);
        $texto = str_replace('=', 'igual a', $texto);
        $texto = str_replace('!=', 'diferente de', $texto);
        $texto = str_replace('>', 'maior que', $texto);
        $texto = str_replace('<', 'menor que', $texto);
        $texto = str_replace('>=', 'maior que ou igual a', $texto);
        $texto = str_replace('<=', 'menor que ou igual a', $texto);
        
        return $texto;
    }
    
    function str_lreplace($search, $replace, $subject)
    {
        return preg_replace('~(.*)' . preg_quote($search, '~') . '~', '$1' . $replace, $subject, 1);
    }

}
