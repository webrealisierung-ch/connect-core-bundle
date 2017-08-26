<?php

namespace Wr\Connect\CoreBundle\Repository;

use Contao\BackendUser;
use Doctrine\ORM\EntityRepository;

class TodoRepository extends EntityRepository
{

    /**
     * @return Todo[]
     */
   public function findOpenByUserOrderedByDate(BackendUser $User,$order="ASC"){
       return $this->createQueryBuilder('todo')
           ->where('todo.author= :user')
           ->setParameter(':user', $User->id)
           ->andWhere('todo.status= :isActive')
           ->setParameter('isActive', 0)
           ->orderBy('todo.tstamp',$order)
           ->getQuery()
           ->execute();
   }

    /**
     * @return Todo[]
     */
    public function findProgressByUserOrderedByDate($user,$order="ASC"){
        return $this->createQueryBuilder('todo')
            ->where('todo.author= :user')
            ->setParameter(':user', $user->id)
            ->andWhere('todo.status= :isActive')
            ->setParameter('isActive', 1)
            ->orderBy('todo.tstamp',$order)
            ->getQuery()
            ->execute();
    }

    /**
     * @return Todo[]
     */
    public function findClosedByUserOrderedByDate($user,$order="ASC"){
        return $this->createQueryBuilder('todo')
            ->where('todo.author= :user')
            ->setParameter(':user', $user->id)
            ->andWhere('todo.status= :isActive')
            ->setParameter('isActive', 2)
            ->orderBy('todo.tstamp',$order)
            ->getQuery()
            ->execute();
    }

    /**
     * @return Todo[]
     */
    public function findStatusByUserOrderedByDate($user,$statusId,$order="ASC"){
        return $this->createQueryBuilder('todo')
            ->where('todo.author= :user')
            ->setParameter(':user', $user->id)
            ->andWhere('todo.status= :isActive')
            ->setParameter('isActive', $statusId)
            ->orderBy('todo.tstamp',$order)
            ->getQuery()
            ->execute();
    }

    /**
     * @return Todo[]
     */
    public function findByStatusAndByUserAndByProjectIsNotClosed($user,$statusId,$order="DESC"){
        return $this->createQueryBuilder('todo')
            ->where('todo.author= :user')
            ->setParameter(':user', $user->id)
            ->andWhere('todo.status= :isActive')
            ->setParameter('isActive', $statusId)
            ->innerJoin('todo.project','project')
            ->andWhere("project.closed= :isClosed")
            ->setParameter('isClosed',0)
            ->orderBy('todo.id',$order)
            ->getQuery()
            ->execute();
    }
}
