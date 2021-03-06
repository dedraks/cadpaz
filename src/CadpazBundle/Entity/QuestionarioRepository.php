<?php

namespace CadpazBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * QuestionarioRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class QuestionarioRepository extends EntityRepository
{
    public function findAllOriginsDistinctOrderedByTotal()
    {
        return $this->getEntityManager()
            ->createQuery(
                //'SELECT c FROM CadpazBundle:Caso c GROUP BY c.nome ORDER BY c.nome'
                    'SELECT q.encaminhamentoAoProjeto as origem, (SELECT COUNT(qe.encaminhamentoAoProjeto) FROM CadpazBundle:Questionario qe WHERE q.encaminhamentoAoProjeto=qe.encaminhamentoAoProjeto) as total FROM CadpazBundle:Questionario q GROUP BY q.encaminhamentoAoProjeto ORDER BY total DESC'
            )
            ->getResult();
    }
    
    public function findAllRendasDistinctOrderedByTotal()
    {
        return $this->getEntityManager()
            ->createQuery(
                    'SELECT q.rendaFamiliar as renda, count(q.id) as total from CadpazBundle:Questionario q group by renda'
            )
            ->getResult();
    }
}
