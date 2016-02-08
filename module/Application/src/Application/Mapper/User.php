<?php
namespace Application\Mapper;

use Doctrine\ORM\EntityRepository;

class User extends EntityRepository
{

    /**
     *
     * @return array
     */
    public function findForAge()
    {
        $dql = 'SELECT u FROM Application\Entity\User u  WHERE u.age < 30';
        $query = $this->getEntityManager()->createQuery($dql);
        return $query->getResult();
    }
}