<?php

namespace CadpazBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use CadpazBundle\Entity\Questionario;
use CadpazBundle\Entity\Pessoa;
use CadpazBundle\Form\QuestionarioType;

use Symfony\Component\HttpFoundation\Session\Session;

class QuestionarioController extends Controller
{
    public function viewAction($id)
    {
        $questionario = $this->getDoctrine()
            ->getRepository('CadpazBundle:Questionario')
            ->find($id);
        
        //dump($questionario);
        
        return $this->render('CadpazBundle:Questionario:view.html.twig',  array('questionario'=>$questionario));
    }
    
    public function newAction(Request $request, $pessoa_id)
    {
        //$pis = new PIS();
        $pessoa = $this->getDoctrine()
            ->getRepository('CadpazBundle:Pessoa')
            ->find($pessoa_id);
        
        $questinario = new Questionario();

        
        $questinario->setPessoa($pessoa);
        $form = $this->createForm(new QuestionarioType(), $questinario);
        
        $form->handleRequest($request);
        if ($form->isValid()) {
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($questinario);
            $em->flush();

            $pessoa->setQuestionario($questinario);
            //return $this->render('CadpazBundle:Pessoa:view.html.twig',  array('pessoa'=>$pessoa));
            return $this->render('CadpazBundle:Questionario:view.html.twig',  array('questionario'=>$questinario));
        }
        
        
        return $this->render('CadpazBundle:Questionario:new.html.twig',  ['form' => $form->createView(), 'id'=>$pessoa_id]);
    }
    
    public function saveToSessionAction(Request $request)
    {   
        $session = new Session();
        //$session->start();
        $questionario = $session->get('questionario');
        
        if (is_null($questionario)) {
            
            $pessoa_id = $request->get('pessoa_id');
            
            $questionario = new Questionario();
            $pessoa = $this->getDoctrine()
                ->getRepository('CadpazBundle:Pessoa')
                ->find($pessoa_id);
            $questionario->setPessoa($pessoa);
        }
        
        //dump($request);
        
        
        if (intval($request->get('page')) === 1 ) {
            $questionario->setMoradia ($request->get('moradia'));
            $questionario->setMoraSozinho ($request->get('moraSozinho'));
            $questionario->setMoraComFilhos ($request->get('moraComFilhos'));
            $questionario->setMoraComPaiMae ($request->get('moraComPaiMae'));
            $questionario->setMoraComIrmaos ($request->get('moraComIrmaos'));
            $questionario->setMoraComConjuge ($request->get('moraComConjuge'));
            $questionario->setMoraComParentesAmigosColegas ($request->get('moraComParentesAmigosColegas'));
            $questionario->setMoraComOutraSituacao ($request->get('moraComOutraSituacao'));
        }
        
        if (!is_null($m=$request->get('quantasPessoasMoramNaCasa')))
            $questionario->setQuantasPessoasMoramNaCasa ($m);
        if (!is_null($m=$request->get('numeroDeFilhos')))
            $questionario->setNumeroDeFilhos ($m);
        if (!is_null($m=$request->get('moradiaTemColetaDeLixo')))
            $questionario->setMoradiaTemColetaDeLixo ($m);
        if (!is_null($m=$request->get('moradiaTemRedeDeEsgoto')))
            $questionario->setMoradiaTemRedeDeEsgoto ($m);
        if (!is_null($m=$request->get('moradiaTemRuaPavimentada')))
            $questionario->setMoradiaTemRuaPavimentada ($m);
        if (!is_null($m=$request->get('moradiaSituadaEmZonaRural')))
            $questionario->setMoradiaSituadaEmZonaRural ($m);
        if (!is_null($m=$request->get('moradiaTemAguaEncanada')))
            $questionario->setMoradiaTemAguaEncanada ($m);
        if (!is_null($m=$request->get('moradiaSituadaEmComunidadeQuilombolaOuIndigena')))
            $questionario->setMoradiaSituadaEmComunidadeQuilombolaOuIndigena ($m);
        if (!is_null($m=$request->get('moradiaTemEletricidade')))
            $questionario->setMoradiaTemEletricidade ($m);
        if (!is_null($m=$request->get('tipoDeMoradia')))
            $questionario->setTipoDeMoradia ($m);
        if (!is_null($m=$request->get('escolaridade')))
            $questionario->setEscolaridade ($m);
        if (!is_null($m=$request->get('estudaAtualmente')))
            $questionario->setEstudaAtualmente ($m);
        if (!is_null($m=$request->get('temInteresseEmVoltarAEstudar')))
            $questionario->setTemInteresseEmVoltarAEstudar ($m);
        if (!is_null($m=$request->get('temFilhosEmIdadeEscolar')))
            $questionario->setTemFilhosEmIdadeEscolar ($m);
        if (!is_null($m=$request->get('temFilhosMatriculadosEmEscola')))
            $questionario->setTemFilhosMatriculadosEmEscola ($m);
        if (!is_null($m=$request->get('deficienciaFisica')))
            $questionario->setDeficienciaFisica ($m);
        if (!is_null($m=$request->get('deficienciaAuditiva')))
            $questionario->setDeficienciaAuditiva ($m);
        if (!is_null($m=$request->get('deficienciaMental')))
            $questionario->setDeficienciaMental ($m);
        if (!is_null($m=$request->get('deficienciaVisual')))
            $questionario->setDeficienciaVisual ($m);
        if (!is_null($m=$request->get('fezOuFazAcompanhamentoNeurologico')))
            $questionario->setFezOuFazAcompanhamentoNeurologico ($m);
        if (!is_null($m=$request->get('fezOuFazAcompanhamentoPsicologico')))
            $questionario->setFezOuFazAcompanhamentoPisicologico ($m);
        if (!is_null($m=$request->get('fezOuFazOutrosAcompanhamentos')))
            $questionario->setFezOuFazOutrosAcompanhamentos ($m);
        if (!is_null($m=$request->get('fezOuFazOutrosAcompnhamentosQuais')))
            $questionario->setFezOuFazOutrosAcompanhamentosQuais ($m);
        if (!is_null($m=$request->get('fazUsoDeMedicacaoConstante')))
            $questionario->setFazUsoDeMedicacaoConstante ($m);
        if (!is_null($m=$request->get('redebeMedicacaoDaFarmaciaDistrital')))
            $questionario->setRecebeMedicacaoDaFarmaciaDistrital ($m);
        if (!is_null($m=$request->get('domicilioCobertoPorUBSOuPSF')))
            $questionario->setDomicilioCobertoPorUBSOuPSF ($m);
        if (!is_null($m=$request->get('pessoaIdosaOuGestanteNaFamilia')))
            $questionario->setPessoaIdosaOuGestanteNaFamilia ($m);
        if (!is_null($m=$request->get('participaOuRecebePETIBolsaCriancaCidada')))
            $questionario->setParticipaOuRecebePETIBolsaCriancaCidada ($m);
        if (!is_null($m=$request->get('participaOuRecebeAgenteJovem')))
            $questionario->setParticipaOuRecebeAgenteJovem ($m);
        if (!is_null($m=$request->get('participaOuRecebeBolsaFamilia')))
            $questionario->setParticipaOuRecebeBolsaFamilia ($m);
        if (!is_null($m=$request->get('participaOuRecebeBCP')))
            $questionario->setParticipaOuRecebeBCP ($m);
        if (!is_null($m=$request->get('participaOuRecebeNaoRespondeu')))
            $questionario->setParticipaOuRecebeNaoRespondeu ($m);
        if (!is_null($m=$request->get('participaOuRecebeNaoSabe')))
            $questionario->setParticipaOuRecebeNaoSabe ($m);
        if (!is_null($m=$request->get('condicaoDeTrabalho')))
            $questionario->setCondicaoDeTrabalho ($m);
        if (!is_null($m=$request->get('despesasMensaisAluguel')))
            $questionario->setDespesasMensaisAluguel ($m);
        if (!is_null($m=$request->get('despesasMensaisPrestacaoHabitacao')))
            $questionario->setDespesasMensaisPrestacaoHabitacao ($m);
        if (!is_null($m=$request->get('despesasMensaisAgua')))
            $questionario->setDespesasMensaisAgua ($m);
        if (!is_null($m=$request->get('despesasMensaisLuz')))
            $questionario->setDespesasMensaisLuz ($m);
        if (!is_null($m=$request->get('despesasMensaisTelefone')))
            $questionario->setDespesasMensaisTelefone ($m);
        if (!is_null($m=$request->get('despesasMensaisMedicamentos')))
            $questionario->setMoradia ($m);
        if (!is_null($m=$request->get('despesasMensaisOutras')))
            $questionario->setDespesasMensaisOutras ($m);
        if (!is_null($m=$request->get('encaminhamentoAoProjeto')))
            $questionario->setEncaminhamentoAoProjeto ($m);
        if (!is_null($m=$request->get('comoFicouSabendoDoProjeto')))
            $questionario->setComoFicouSabendoDoProjeto ($m);
        if (!is_null($m=$request->get('pessoa')))
            $questionario->setPessoa ($m);
        if (!is_null($m=$request->get('observacoes')))
            $questionario->setObservacoes ($m);
        
        
        //$questionario = null;
        $session->set("questionario", $questionario);
        
        return new Response('ok');
    }
    
    public function restoreFromSessionAction()
    {
        $session = new Session();
        //$session->start();
        
        $questionario = $session->get('questionario');
        
        //dump($questionario);
        
        
        
        // Converte o resultado da consulta para json e retorna
        $serializer = \JMS\Serializer\SerializerBuilder::create()->build();
        $json = $serializer->serialize($questionario, 'json');
        //dump($json);
        
        if ($json === 'null') {
            $json = '{
                "status": "error",
                "message": "Error xyz has occurred"
            }';
        }
        
        return new \Symfony\Component\HttpFoundation\JsonResponse($json);
    }
}