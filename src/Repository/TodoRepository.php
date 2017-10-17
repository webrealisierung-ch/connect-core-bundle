<?php

namespace Wr\Connect\CoreBundle\Repository;

use Contao\BackendUser;
use Doctrine\ORM\EntityRepository;

class TodoRepository extends EntityRepository
{


    /**
     * @return Todo[]
     */
    public function findByStatusByUserOrderedByDate($user,$statusId,$order="ASC"){
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

    /**
     * @return Todo[]
     */
    public function findByStatusAndByUserAndByShowAfterDays($user,$statusId,$time,$order="DESC"){
        return $this->createQueryBuilder('todo')
            ->where('todo.author= :user')
            ->setParameter(':user', $user->id)
            ->andWhere('todo.status= :statusId')
            ->setParameter('statusId', $statusId)
            ->andWhere('todo.tstamp > :time')
            ->setParameter('time',$time)
            ->orderBy('todo.id',$order)
            ->getQuery()
            ->execute();
    }
}
