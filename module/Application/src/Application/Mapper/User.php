<?php
namespace Application\Mapper;

use Doctrine\ORM\EntityRepository;

class User extends EntityRepository
{

    /**
     * @param Integer $ageMax
     * @return array
     */
    public function QueryBuilderFindForAge($ageMax)
    {
        $qb = $this->_em->createQueryBuilder();
        $qb->select('u')
            ->from('Application\Entity\User', 'u');

        $qb->Where('u.age <= :ageMax');
        $qb->setParameter('ageMax',$ageMax);

        return $qb->getQuery()->getResult();
    }

    /**
     * @param Integer $ageMax
     * @return array
     */
    public function dqlFindForAgeMax($ageMax)
    {
        $dql = 'SELECT u FROM Application\Entity\User u  WHERE u.age <= :ageMax';
        $query = $this->getEntityManager()->createQuery($dql);
        $query->setParameter('ageMax', $ageMax);

        return $query->getResult();
    }
}