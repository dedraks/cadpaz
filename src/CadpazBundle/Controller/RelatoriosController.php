<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use CadpazBundle\Form\EventListener\AddFieldSubscriber;

use Ob\HighchartsBundle\Highcharts\Highchart;

class RelatoriosController extends Controller
{
    /**
     * Exibe formulários para geração de relatórios padrão e personalizados
     * 
     * @param Request $request
     * @return Response
     */
    public function indexAction(Request $request)
    {
        $data = array();
        
        $customForm = $this->createFormBuilder($data, ['attr' => ['id' => 'customRelForm']])
            ->add('camposSelect', 'choice', array(
                'label' => ' ', 
                'multiple'=>true, 
                'choices'=>array(
                    'Pessoal' =>
                        [
                            'nome' => 'Nome',
                            'cpf' => 'CPF',
                            'nomeMae' => 'Nome da mãe',
                            'sexo' => 'Sexo',
                            'dataNascimento' => 'Data de nascimento',
                            'idade_a' => 'Idade atual',
                            'idade_c' => 'Idade quando foi atendido',
                            'cor' => 'Cor informada',
                            'estadoCivil' => 'Estado civil',
                            'email' => 'Email',
                            'telefone' => 'Telefone',
                            'endereco' => 'Endereço',
                        ],
                    'Composição familiar/Habitação' =>
                        [
                            'moradia' => 'Condição de moradia',
                            'moraCom' => 'Mora com',
                            'quantosMoram' => 'Quantos moram na casa',
                            'numeroDeFilhos' => 'Número de filhos',
                            //'urbanizacao' => 'Urbanização', //
                            'tipoDeMoradia' => 'Tipo de moradia'
                        ],
                    'Educação' =>
                        [
                            'escolaridade' => 'Escolaridade',
                            'estudaAtualmente' => 'Estuda atualmente',
                            'temInteresseEmVoltarAEstudar' => 'Tem interesse em voltar a estudar',
                            'temFilhosEmIdadeEscolar' => 'Tem filhos em idade escolar',
                            'temFilhosMatriculadosEmEscola' => 'Tem filhos matriculados em escola'
                        ],
                    'Renda' =>
                        [
                            'rendaFamiliar' => 'Renda familiar',
                            'beneficios' => 'Benefícios Sociais',
                            'condicaoDeTrabalho' => 'Condição de trabalho', //
                            'despesasMesais' => 'Total de despesas mensais' //
                        ],
                    'Outros' =>
                        [
                            'origem' => 'Origem (Quem encaminhou o cliente para atendimento?)',
                        ]
                )
            ))
                
            ->add('filtro', 'text', ['required'=>false,'label'=> ' ', 
                'attr' =>  ['style'=>'width: 99%'] ])
            
            ->add('adicionarFiltro', 'button', ['label'=>'Adicionar Filtro',  'attr' =>  ['style'=>'width: 100%'] ])
                
            ->add('limparFiltros', 'button', ['label'=>'Limpar Filtros', 'attr' =>  ['style'=>'width: 100%']])
                
            ->add('save', 'submit', array('label' => 'Exibir relatório', 'attr' =>  ['style'=>'width: 100%; margin-top: 10px; margin-bottom: 10px']))
                
        ->getForm();
        
        $padraoForm = $this->createFormBuilder($data, ['attr' => ['id' => 'padraoRelForm']])
            ->add('casos', 'checkbox', array('label' => 'Tipos de Casos', 'required'=>false, 'attr'=>['style'=>'float: left']))
            ->add('origens', 'checkbox', array('label' => 'Origens (quem enviou o cliente para atendimento)', 'required'=>false, 'attr'=>['style'=>'float: left']))
            ->add('encaminhamentos', 'checkbox', array('label' => 'Encaminhamentos (para onde o cliente foi encaminhado)', 'required'=>false, 'attr'=>['style'=>'float: left']))
            ->add('renda', 'checkbox', array('label' => 'Renda familiar', 'required'=>false, 'attr'=>['style'=>'float: left']))
            ->add('idade', 'checkbox', array('label' => 'Idade', 'required'=>false, 'attr'=>['style'=>'float: left']))
            ->add('sexo', 'checkbox', array('label' => 'Sexo', 'required'=>false, 'attr'=>['style'=>'float: left']))
            ->add('cor', 'checkbox', array('label' => 'Cor', 'required'=>false, 'attr'=>['style'=>'float: left']))
            ->add('save', 'submit', array('label' => 'Exibir relatório', 'attr' =>  ['style'=>'width: 100%']))
        ->getForm();
        

        if ($request->isMethod('POST')) {
            $customForm->handleRequest($request);
            $padraoForm->handleRequest($request);

            if ($customForm->isValid())
            {
                // $data is a simply array with your form fields 
                // like "query" and "category" as defined above.
                $data = $customForm->getData();
                //dump($data);
                
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
                    //dump("verificando: ");dump($pessoa); dump($filtros);
                    if (!$this->verificaFiltros($pessoa, $filtros)) continue;
                    
                    //dump('passou');
                    $questionario = $pessoa->getQuestionario();
                    foreach ($data['camposSelect'] as $campo)
                    {
                        switch ($campo)
                        {
                            case 'nome':
                                $res[$i]['nome'] = $pessoa->getNome();
                                $campos['nome'] = '';
                            break;
                            case 'cpf':
                                $res[$i]['cpf'] = $pessoa->getCpf();
                                $campos['cpf'] = '';
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
                            case 'moradia':
                                $res[$i]['moradia'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    $res[$i]['moradia'] = $questionario->getMoradia();
                                }
                                $campos['moradia'] = '';
                            break;
                            case 'moraCom':
                                $res[$i]['moraCom'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    $moraCom = array();
                                    
                                    
                                    if ($questionario->getMoraSozinho() ) {
                                        $moraCom[] = 'Sozinho';
                                    }
                                    else if ($questionario->getMoraComOutraSituacao() ) {
                                        $moraCom[] = 'Outra situação';
                                    }
                                    else 
                                    {
                                        if ($questionario->getMoraComFilhos() ) {
                                            $moraCom[] = 'Filhos';
                                        }

                                        if ($questionario->getMoraComPaiMae() ) {
                                            $moraCom[] = 'Pai/Mãe';
                                        }

                                        if ($questionario->getMoraComIrmaos() ) {
                                            $moraCom[] = 'Irmãos';
                                        }

                                        if ($questionario->getMoraComConjuge() ) {
                                            $moraCom[] = 'Conjuge';
                                        }
                                        
                                        if ($questionario->getMoraComParentesAmigosColegas() ) {
                                            $moraCom[] = 'Parentes/Amigos/Colegas';
                                        }
                                    }
                                    
                                    $res[$i]['moraCom'] = $moraCom;
                                }
                                else
                                {
                                    $res[$i]['moraCom'] = ['Questionário não respondido'];
                                }
                                $campos['moraCom'] = '';
                            break;
                            case 'quantosMoram':
                                $res[$i]['quantosMoram'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    $res[$i]['quantosMoram'] = $questionario->getQuantasPessoasMoramNaCasa();
                                }
                                $campos['quantosMoram'] = '';
                            break;
                            case 'numeroDeFilhos':
                                $res[$i]['numeroDeFilhos'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    $res[$i]['numeroDeFilhos'] = $questionario->getNumeroDeFilhos();
                                }
                                $campos['numeroDeFilhos'] = '';
                            break;
                            case 'tipoDeMoradia':
                                $res[$i]['tipoDeMoradia'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    $res[$i]['tipoDeMoradia'] = $questionario->getTipoDeMoradia();
                                }
                                $campos['tipoDeMoradia'] = '';
                            break;
                            case 'escolaridade':
                                $res[$i]['escolaridade'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    $res[$i]['escolaridade'] = $questionario->getEscolaridade();
                                }
                                $campos['escolaridade'] = '';
                            break;
                            case 'estudaAtualmente':
                                $res[$i]['estudaAtualmente'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    $res[$i]['estudaAtualmente'] = $questionario->getEstudaAtualmente()?"sim":"não";
                                }
                                $campos['estudaAtualmente'] = '';
                            break;
                            case 'temInteresseEmVoltarAEstudar':
                                $res[$i]['temInteresseEmVoltarAEstudar'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    if ($questionario->getEstudaAtualmente())
                                    {
                                        $res[$i]['temInteresseEmVoltarAEstudar'] = "não aplicável";
                                    }
                                    else
                                    {
                                        $res[$i]['temInteresseEmVoltarAEstudar'] = $questionario->getTemInteresseEmVoltarAEstudar()?"sim":"não";
                                    }
                                    
                                    //$res[$i]['temInteresseEmVoltarAEstudar'] = $questionario->getEstudaAtualmente()? ($questionario->getTemInteresseEmVoltarAEstudar()?"sim":"não") :"não aplicável";
                                }
                                $campos['temInteresseEmVoltarAEstudar'] = '';
                            break;
                            case 'temFilhosEmIdadeEscolar':
                                $res[$i]['temFilhosEmIdadeEscolar'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    $res[$i]['temFilhosEmIdadeEscolar'] = $questionario->getTemFilhosEmIdadeEscolar()?"sim":"não";
                                }
                                $campos['temFilhosEmIdadeEscolar'] = '';
                            break;
                            case 'temFilhosMatriculadosEmEscola':
                                $res[$i]['temFilhosMatriculadosEmEscola'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    if ( ! $questionario->getTemFilhosEmIdadeEscolar())
                                    {
                                        $res[$i]['temFilhosMatriculadosEmEscola'] = "não aplicável";
                                    }
                                    else
                                    {
                                        $res[$i]['temFilhosMatriculadosEmEscola'] = $questionario->getTemFilhosMatriculadosEmEscola()?"sim":"não";
                                    }
                                    
                                    //$res[$i]['temInteresseEmVoltarAEstudar'] = $questionario->getEstudaAtualmente()? ($questionario->getTemInteresseEmVoltarAEstudar()?"sim":"não") :"não aplicável";
                                }
                                $campos['temFilhosMatriculadosEmEscola'] = '';
                            break;
                            case 'rendaFamiliar':
                                $res[$i]['rendaFamiliar'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    $res[$i]['rendaFamiliar'] = $questionario->getRendaFamiliar();
                                }
                                $campos['rendaFamiliar'] = '';
                            break;
                            case 'email':
                                $res[$i]['email'] = $pessoa->getEmail();
                                $campos['email'] = '';
                            break;
                            case 'telefone':
                                $campos['telefone'] = '';
                                $res[$i]['telefone'] = 'Não cadastrado';
                                foreach($pessoa->getTelefones() as $telefone)
                                {
                                    $res[$i]['telefone'] = $telefone->getPadrao() ? $telefone->getNumero() : '';
                                    if ($telefone->getPadrao()) break; 
                                }
                            break;
                            case 'endereco':
                                $campos['endereco'] = '';
                                $res[$i]['endereco'] = 'Não cadastrado';
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
                                    
                                    $naorecebe = true;
                                    
                                    if ($questionario->getParticipaOuRecebeNaoSabe()) {
                                        $beneficios[] = 'Não Sabe';
                                        $naorecebe = false;
                                    }
                                    else if ($questionario->getParticipaOuRecebeNaoRespondeu()) {
                                        $beneficios[] = 'Não Respondeu';
                                        $naorecebe = false;
                                    }
                                    else 
                                    {
                                        if ($questionario->getParticipaOuRecebePETIBolsaCriancaCidada()) {
                                            $beneficios[] = 'PETI - Bolsa Criança Cidadã';
                                            $naorecebe = false;
                                        }

                                        if ($questionario->getParticipaOuRecebeAgenteJovem()) {
                                            $beneficios[] = 'Agente Jovem';
                                            $naorecebe = false;
                                        }

                                        if ($questionario->getParticipaOuRecebeBolsaFamilia()) {
                                            $beneficios[] = 'Bolsa Família';
                                            $naorecebe = false;
                                        }

                                        if ($questionario->getParticipaOuRecebeBCP()) {
                                            $beneficios[] = 'BCP';
                                            $naorecebe = false;
                                        }
                                    }
                                    
                                    if ($naorecebe)
                                        $beneficios[] = 'Não Recebe';
                                    
                                    $res[$i]['beneficios'] = $beneficios;
                                }
                                else
                                {
                                    $res[$i]['beneficios'] = ['Questionário não respondido'];
                                }
                                $campos['beneficios'] = '';
                            break;
                            case 'condicaoDeTrabalho':
                                $res[$i]['condicaoDeTrabalho'] = 'Questionário não respondido';
                                if ( ! is_null($pessoa->getQuestionario()))
                                {
                                    $res[$i]['condicaoDeTrabalho'] = $pessoa->getQuestionario()->getCondicaoDeTrabalho();
                                }
                                $campos['condicaoDeTrabalho'] = '';
                            break;
                            case 'despesasMesais':
                                $res[$i]['despesasMesais'] = 'Questionário não respondido';
                                if ( ! is_null($questionario) )
                                {
                                    $res[$i]['despesasMesais']  = $questionario->getDespesasMensaisAluguel();
                                    $res[$i]['despesasMesais'] += $questionario->getDespesasMensaisPrestacaoHabitacao();
                                    $res[$i]['despesasMesais'] += $questionario->getDespesasMensaisAgua();
                                    $res[$i]['despesasMesais'] += $questionario->getDespesasMensaisLuz();
                                    $res[$i]['despesasMesais'] += $questionario->getDespesasMensaisTelefone();
                                    $res[$i]['despesasMesais'] += $questionario->getDespesasMensaisMedicamentos();
                                    $res[$i]['despesasMesais'] += $questionario->getDespesasMensaisOutras();
                                }
                                $campos['despesasMesais'] = '';
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
    
    /**
     * Exibe gráfico de tipos de casos atendidos
     * 
     * @return Response
     */
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
    
    /**
     * Exibe gráficos dos encaminhamentos (para onde o cliente foi encaminhado)
     * 
     * @return Response
     */
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
    
    /**
     * Exibe gráficos das origens (quem enviou o cliente para atendimento)
     * 
     * @return Response
     */
    public function origensAction()
    {
        $origens = $this->getDoctrine()
            ->getRepository('CadpazBundle:Questionario')
            ->findAllOriginsDistinctOrderedByTotal();
        
        
        
        
        $total_origens = count($this->getDoctrine()->getRepository('CadpazBundle:Questionario')->findAll());
        $origens_array = array();
        foreach($origens as $origem) 
        {
            $origens_array[] =
                [
                    $origem["origem"], 
                    (intval($origem["total"])/$total_origens) * 100,
                ];
            
            
        }
        //dump($origens_array);
        //dump('Total: ' . $total_origens);
                
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
    
    /**
     * Exibe gráfico com as idades dos clientes
     * 
     * @return type
     */
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
    
    /**
     * 
     * @return type
     */
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
    
    /**
     * 
     * @return type
     */
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
 
    /**
     * 
     * @return type
     */
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

    /**
     * 
     * @return type
     */
    public function filtrosAction()
    {
        $data = array();
        $fitroForm = $this->createFormBuilder($data, ['attr' => ['id' => 'filtroRelForm']])
            ->add('criterio', 'choice', array(
                'label' => 'Critério',
                'placeholder' => 'Selecione o critério',
                'attr' =>  ['style'=>'width: 100%'],
                'choices' => array(
                    'Pessoal' => array (
                        'cor'               => 'Cor informada',
                        'idadeAtual'        => 'Idade atual',
                        'idadeAtendimento'  => 'Idade quando foi atendido',
                        'sexo'              => 'Sexo',
                        'estadoCivil'       => 'Estado civil',
                    ),
                    'Composição familiar/Habitação' => array (
                        'moradia'           => 'Moradia',
                        'moraCom'           => 'Mora com',
                        'quantosMoram'      => 'Número de pessoas que moram na casa',
                        'numeroDeFilhos'    => 'Número de filhos',
                        'coletaDeLixo'      => 'Moradia tem coleta de lixo',
                        'eletricidade'      => 'Moradia tem eletricidade',
                        'aguaEncanada'      => 'Moradia tem água encanada',
                        'redeDeEsgoto'      => 'Moradia tem rede de esgoto',
                        'ruaPavimentada'    => 'Moradia situada em rua pavimentada',
                        'zonaRural'         => 'Moradia situada em zona rural',
                        'quilombola'        => 'Moradia situada em quilombola',
                        'tipoDeMoradia'     => 'Tipo de moradia',
                    ),
                    'Educação' => array (
                        'escolaridade'      => 'Escolaridade',
                        'estudaAtualmente'  => 'Estuda atualmente',
                        'temInteresseEmVoltarAEstudar' => 'Tem interesse em voltar a estudar',
                        'temFilhosEmIdadeEscolar' => 'Tem filhos em idade escolar',
                        'temFilhosMatriculadosEmEscola' => 'Tem filhos matriculados em escola',
                    ),
                    'Saúde' => array (
                        'deficiencia'       => 'Possui alguma deficiência',
                        'acompanhamentos'   => 'Fez ou faz algum acompanhamento',
                        'usaMedicacaoConstante' => 'Faz uso de mecicação constante',
                        'recebeFarmacia'        => 'Recebe a medicação da farmácia distrital',
                        'ubs'   => 'Domicílio coberto por UBS/PSF',
                        'idosoGestante' => 'Gestante ou idoso na família'
                    ),
                    'Renda' => array (
                        'rendaFamiliar' => 'Renda familiar',
                        'programasSociais' => 'Recebe bolsa ou participa de algum programa socical',
                        'condicaoDeTrabalho' => 'Condição de trabalho',
                        'despesasMensais' => 'Total de despesas mensais',
                    ),
                    'Origem' => array (
                        'origem' => 'Quem encaminhou ao projeto',
                    )
                )))
            ->add('comparacao', 'choice', array(
                'label' => 'Comparação',
                'placeholder' => 'Selecione o comparador',
                'attr' =>  ['style'=>'width: 100%'],
                'choices' => array(
                    '=' => 'Igual a',
                    '!=' => 'Diferente de',
                    '>' => 'Maior que',
                    '>=' => 'Maior que ou igual a',
                    '<' => 'Menor que',
                    '<=' => 'Menor que ou igual a',
                )
            ))
            ->add('valor', null, array('attr' =>  ['style'=>'width: 98%']))
            ->add('save', 'submit', ['label'=>'Adicionar', 'attr' =>  ['style'=>'width: 100%; margin-top: 10px']])
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
    
    /**
     * Faz o parse da string de filtros
     * 
     * @param type $str
     * @return type
     */
    private function parseFiltro($str)
    {
        dump("parseFiltro(".$str.")");
        
        $filtros_adicionados = array();
        $filtros = explode('&', $str);
        dump($filtros);
        
        foreach($filtros as $filtro)
        {
            dump($filtro);
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
        
        dump($filtros_adicionados);
        return $filtros_adicionados;
    }
    
    /**
     *  Efetua as comparações entre os filtros e a pessoa
     * 
     *      Filtros ativos:
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
     * 
     * @param \CadpazBundle\Entity\Pessoa $pessoa
     * @param type $filtros
     * @return boolean
     */
    private function verificaFiltros(\CadpazBundle\Entity\Pessoa $pessoa, $filtros)
    {   
        foreach($filtros as $filtro)
        {
            //dump($filtro);
            
            $criterio = trim($filtro[0]);
            $valor = trim($filtro[1]);
            $valor = trim($valor,"'");        
            $operador = trim($filtro[2]);
            
            dump('-------->' . $criterio . $operador . $valor . '<------------');
        }
        
        
        
        foreach($filtros as $filtro)
        {
            //dump($filtro);
            
            $criterio = trim($filtro[0]);
            $valor = trim($filtro[1]);
            $valor = trim($valor,"'");        
            $operador = trim($filtro[2]);
            
            dump($criterio . $operador . $valor);
            switch ($criterio)
            {
                case 'sexo':
                    dump($pessoa->getSexo());
                    if ($operador == '=') 
                    {
                        if ( strtolower($pessoa->getSexo()) != strtolower($valor))
                        return false;
                    }
                    elseif ($operador == '!=') 
                    {
                        if ( strtolower($pessoa->getSexo()) == strtolower($valor))
                        return false;
                    }
                break;
                case 'idadeAtual':
                    $agora = new \DateTime();
                    $dataNascimento = $pessoa->getDataNascimento();
                    $idade = date_diff($agora, $dataNascimento)->y;
                    
                    if (!$this->verificaValor($idade, $valor, $operador))
                            return false;
                    
                break;
                case 'idadeAtendimento':
                    $dataAtendimento = $pessoa->getDataCadastro();
                    $dataNascimento = $pessoa->getDataNascimento();
                    $idade_atendimento = date_diff($dataAtendimento, $dataNascimento)->y;
                    
                    if (!$this->verificaValor($idade, $valor, $operador))
                            return false;
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
                case 'estadoCivil':
                    if ($operador == '=') 
                    {
                        if (strtolower($pessoa->getEstadoCivil()) != strtolower($valor))
                            return false;
                    }
                    elseif ($operador == '!=') 
                    {
                        if (strtolower($pessoa->getEstadoCivil()) == strtolower($valor))
                            return false;
                    }
                break;
                case 'moradia':
                    $questionario = $pessoa->getQuestionario();
                    if (is_null($questionario))
                        return false;
                    $moradia = $questionario->getMoradia();
                    if ($operador == '=') 
                    {
                        if (strtolower($moradia) != strtolower($valor))
                            return false;
                    }
                    elseif ($operador == '!=') 
                    {
                        if (strtolower($moradia) == strtolower($valor))
                            return false;
                    }
                break;
                case 'moraCom':
                    $questionario = $pessoa->getQuestionario();
                    $valores = explode(',', $valor);
                    if (is_null($questionario))
                        return false;
                    if ($operador == '=')
                    {
                        if (! $this->verificaMoraCom($questionario, $valor))
                                return false;
                    }
                    else if ($operador == '!=')
                    {
                        if ( $this->verificaMoraCom($questionario, $valor))
                                return false;
                    }
                break;
                case 'quantosMoram';
                    $questionario = $pessoa->getQuestionario();
                    if (is_null($questionario))
                        return false;
                    $numero = $questionario->getQuantasPessoasMoramNaCasa();
                    if (!$this->verificaValor($numero, $valor, $operador))
                            return false;
                break;
                case 'numeroDeFilhos':
                    $questionario = $pessoa->getQuestionario();
                    if (is_null($questionario))
                        return false;
                    $numero = $questionario->getNumeroDeFilhos();
                    if (!$this->verificaValor($numero, $valor, $operador))
                            return false;
                break;
                case 'rendaFamiliar':
                    $questionario = $pessoa->getQuestionario();
                    if (is_null($questionario))
                        return false;
                    
                    $rendaFamiliar = $questionario->getRendaFamiliar();
                    dump($rendaFamiliar);
                    dump($valor);
                    switch ($operador)
                    {
                        case '=':
                            if (! ($rendaFamiliar == $valor))
                                        return false;
                        break;
                    }
                break;
            }
        }
        
        return true;
    }
    
    /**
     * Verfica se valor está entre os dados de moradia do questionário
     * 
     * @param type $questionario
     * @param type $valor
     * @return boolean
     */
    private function verificaMoraCom($questionario, $valor)
    {
        switch ($valor)
                        {
                            case 'Sozinho':
                                if (! $questionario->getMoraSozinho())
                                    return false;
                            break;
                            case 'Filhos':
                                if (! $questionario->getMoraComFilhos() )
                                    return false;
                            break;
                            case 'Pai/Mae':
                                if (! $questionario->getMoraComPaiMae() )
                                    return false;
                            break;
                            case 'Irmãos':
                                if (! $questionario->getMoraComIrmaos() )
                                    return false;
                            break;
                            case 'Conjuge':
                                if (! $questionario->getMoraComConjuge() )
                                    return false;
                            break;
                            case 'Parentes/Amigos/Colegas':
                                if (! $questionario->getMoraComParentesAmigosColegas() )
                                    return false;
                            break;
                            case 'Outra situação':
                                if (! $questionario->getMoraComPaiMae() )
                                    return false;
                            break;
                        }
                        
        return true;
    }
    
    /**
     * Gera texto de exibição dos campos selecionados e critérios utilizados
     * 
     * @param type $campos
     * @param type $filtros
     * @return type
     */
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
        $texto = str_replace('cpf', 'CPF', $texto);
        $texto = str_replace('moradia', 'condição de moradia', $texto);
        $texto = str_replace('moraCom', 'mora com', $texto);
        $texto = str_replace('quantosMoram', 'quantos moram na casa', $texto);
        $texto = str_replace('numeroDeFilhos', 'numero de filhos', $texto);
        $texto = str_replace('tipoDeMoradia', 'tipo de moradia', $texto);
        $texto = str_replace('estudaAtualmente', 'estuda atualmente', $texto);
        $texto = str_replace('temInteresseEmVoltarAEstudar', 'tem interesse em voltar a estudar', $texto);
        $texto = str_replace('temFilhosEmIdadeEscolar', 'tem filhos em idade escolar', $texto);
        $texto = str_replace('temFilhosMatriculadosEmEscola', 'tem filhos matriculados em escola', $texto);
        $texto = str_replace('rendaFamiliar', 'renda familiar', $texto);
        $texto = str_replace('condicaoDeTrabalho', 'condição de trabalho', $texto);
        $texto = str_replace('despesasMesais', 'despesas mensais', $texto);

        
        
        
        //$texto = $this->get('app.stringutils')->LReplace(',', ' e', $texto);
        $texto = $this->str_lreplace(',', ' e', $texto);
        
        $texto .= ' de todos os clientes';
        
        if (count($filtros)>0)
        {
            $texto .= " com ";
            
            foreach ($filtros as $filtro)
            {
                $texto .= $filtro[0] . ' ' . $filtro[2] . ' ' . $filtro[1] . ' e ';
                
                
            }
            
            //$texto = $this->get('app.stringutils')->LReplace('e ', '.', $texto);
            $texto = $this->str_lreplace('e ', '.', $texto);
        }
        else
        {
            $texto .= '.';
        }
        
        $texto = str_replace('idadeAtual', 'idade atual', $texto);
        $texto = str_replace('!=', 'diferente de', $texto);
        $texto = str_replace('=', 'igual a', $texto);
        $texto = str_replace('>', 'maior que', $texto);
        $texto = str_replace('<', 'menor que', $texto);
        $texto = str_replace('>=', 'maior que ou igual a', $texto);
        $texto = str_replace('<=', 'menor que ou igual a', $texto);
        
        return $texto;
    }
    
    /**
     * Replaces Last Occurence of a String in a String
     * 
     * @param type $search
     * @param type $replace
     * @param type $subject
     * @return type
     */
    function str_lreplace($search, $replace, $subject)
    {
        return preg_replace('~(.*)' . preg_quote($search, '~') . '~', '$1' . $replace, $subject, 1);
    }

    /**
     * Compara número com valor baseado no operador
     * 
     * @param type $numero
     * @param type $valor
     * @param type $operador
     * @return boolean
     */
    public function verificaValor($numero, $valor, $operador)
    {
        switch ($operador)
        {
            case '=':
                if ( ! ($numero == $valor) )
                    return false;
            break;
            case '!=':
                if ( ! ($numero != $valor) )
                    return false;
            break;
            case '>=':
                if ( ! ($numero >= $valor) )
                    return false;
            break;
            case '<=':
                if ( ! ($numero <= $valor) )
                    return false;
            break;
            case '>':
                if ( ! ($numero > $valor) )
                    return false;
            break;
            case '<':
                if ( ! ($numero < $valor) )
                    return false;
            break;
        }
                    
        return true;
    }

}
