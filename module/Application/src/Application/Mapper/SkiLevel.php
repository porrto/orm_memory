<?php
/**
 * Created by PhpStorm.
 * User: isen
 * Date: 05/02/2016
 * Time: 14:06
 */

namespace Application\Mapper;


use Doctrine\ORM\EntityRepository;

class SkiLevel extends EntityRepository
{

    public function findUserSkiLevel(){

        $qb = $this->_em->createQueryBuilder();
        $qb->select('sl')
            ->from('Application\Entity\SkiLevel', 'sl');

        $qb->leftJoin('sl.user', 'slu');
        $qb->addSelect('slu');

        return $qb->getQuery()->getResult();
    }
}