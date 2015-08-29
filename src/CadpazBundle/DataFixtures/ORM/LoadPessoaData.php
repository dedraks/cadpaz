<?php
namespace CadpazBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use CadpazBundle\Entity\Pessoa;
use CadpazBundle\Entity\RG;
use CadpazBundle\Entity\Titulo;
use CadpazBundle\Entity\CTPS;
use CadpazBundle\Entity\PIS;
use CadpazBundle\Entity\Telefone;
use CadpazBundle\Entity\Endereco;

class LoadPessoaData implements FixtureInterface
{
    /**
     * {@inheritDoc}
     */
    public function load(ObjectManager $manager)
    {
        $pessoa = new Pessoa();
        $pessoa->setNome('João Carlos da Silva');
        $pessoa->setCpf('11111111111');
        $pessoa->setDataNascimento( new \DateTime('1980-10-01'));
        $pessoa->setSexo('M');
        $pessoa->setCertidaoNascimento(true);
        $pessoa->setCertidaoCasamento(false);
        $pessoa->setCartaoVacina(true);
        $pessoa->setEstadoCivil('SOLTEIRO');
        $pessoa->setNomeMae('Maria da Silva');
        $pessoa->setCorInformada('NEGRO');
        $pessoa->setEmail('nao1@tenho.com');
        
        $pis = new PIS();
        $pis->setNumero('1234567890');
        $pis->setDataEmissao(new \DateTime('1998-10-01'));
        $pis->setPessoa($pessoa);
        $pessoa->setPis($pis);
        
        $rg = new RG();
        $rg->setNumero('M-1.111.111');
        $rg->setDataExpedicao(new \DateTime('2000-10-01'));
        $rg->setOrgaoExpedidor('SSP-MG');
        $rg->setPessoa($pessoa);
        $pessoa->setRg($rg);
        
        $titulo = new Titulo();
        $titulo->setNumero('1234567890');
        $titulo->setZona('123');
        $titulo->setSecao('1234');
        $titulo->setMunicipio('Belo Horizonte');
        $titulo->setUf('MG');
        $titulo->setDataEmissao(new \DateTime('2001-03-31'));
        $titulo->setPessoa($pessoa);
        $pessoa->setTitulo($titulo);
        
        $ctps = new CTPS();
        $ctps->setNumero('12345');
        $ctps->setSerie('1234');
        $ctps->setUf('MG');
        $ctps->setPessoa($pessoa);
        $pessoa->setCtps($ctps);
        
        $manager->persist($rg);
        $manager->persist($titulo);
        $manager->persist($pis);
        $manager->persist($ctps);
        $manager->persist($pessoa);
        
        $pessoa = new Pessoa();
        $pessoa->setNome('Carlos Alberto da Silva e Souza');
        $pessoa->setCpf('22222222222');
        $pessoa->setDataNascimento( new \DateTime('1970-03-25'));
        $pessoa->setSexo('M');
        $pessoa->setCertidaoNascimento(false);
        $pessoa->setCertidaoCasamento(true);
        $pessoa->setCartaoVacina(true);
        $pessoa->setEstadoCivil('CASADO');
        $pessoa->setNomeMae('Joana de Souza e Silva');
        $pessoa->setCorInformada('PARDO');
        $pessoa->setEmail('nao2@tenho.com');
        $rg = new RG();
        $rg->setNumero('M-2.222.222');
        $rg->setDataExpedicao(new \DateTime('1990-03-25'));
        $rg->setOrgaoExpedidor('SSP-MG');
        $rg->setPessoa($pessoa);
        $pessoa->setRg($rg);        
        $manager->persist($rg);
        $manager->persist($pessoa);
 
        $pessoa = new Pessoa();
        $pessoa->setNome('Maria da Silva e Souza');
        $pessoa->setCpf('33333333333');
        $pessoa->setDataNascimento( new \DateTime('1975-08-12'));
        $pessoa->setSexo('F');
        $pessoa->setCertidaoNascimento(false);
        $pessoa->setCertidaoCasamento(true);
        $pessoa->setCartaoVacina(true);
        $pessoa->setEstadoCivil('CASADO');
        $pessoa->setNomeMae('Mariana de Souza');
        $pessoa->setCorInformada('BRANCO');
        $pessoa->setEmail('nao3@tenho.com');
        $rg = new RG();
        $rg->setNumero('M-3.333.333');
        $rg->setDataExpedicao(new \DateTime('1985-08-12'));
        $rg->setOrgaoExpedidor('SSP-MG');
        $rg->setPessoa($pessoa);
        $pessoa->setRg($rg);        
        $manager->persist($rg);
        $manager->persist($pessoa);
        
        $manager->flush();
    }
}
