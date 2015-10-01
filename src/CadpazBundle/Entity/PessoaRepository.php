<?php

namespace CadpazBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * PessoaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PessoaRepository extends EntityRepository
{
    public function findAllAgesOrderedByTotal()
    {
        /*
            SELECT 
                c.nome,
                TIMESTAMPDIFF(YEAR, c.datanascimento, CURDATE()) as idade_atual,
                TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) as idade_no_cadastro
            FROM
                pessoa c
         * 
         * 
            SELECT  distinct

            case 
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=10  then "0-10"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=20 then "10-20"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=30 then "20-30"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=40 then "30-40"
            else ">40"
            end

            AS idade,

            COUNT(*) AS QTD

            FROM pessoa c

            GROUP BY TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro)
            ORDER BY TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) DESC
         * 
         * 
         * 
         SELECT  

            case 
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <18  then "0-18"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=30 then "18-30"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=40 then "31-40"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=50 then "41-50"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=60 then "51-60"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) >60  then "Mais de 60"
            else ">40"
            end

            AS idade,

            COUNT(*) AS QTD

            FROM pessoa c

            GROUP BY idade
            ORDER BY idade ASC
         
         * 
         * 
         */
        
        return $this->getEntityManager()
            ->createQuery(
                    'SELECT  

            case 
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <18  then "0-18"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=30 then "18-30"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=40 then "31-40"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=50 then "41-50"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) <=60 then "51-60"
            when TIMESTAMPDIFF(YEAR, c.datanascimento, c.dataCadastro) >60  then "Mais de 60"
            else ">40"
            end

            AS idade,

            COUNT(*) AS QTD

            FROM CadpazBundle:Pessoa c

            GROUP BY idade
            ORDER BY idade ASC'
            )
            ->getResult();
    }
}