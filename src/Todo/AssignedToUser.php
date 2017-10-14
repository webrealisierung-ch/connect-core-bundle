<?php


namespace Wr\Connect\CoreBundle\Todo;

use Doctrine\ORM\EntityManager;
use Contao\User;

class AssignedToUser
{
    public $entityManager;
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function check(User $user, $id){
        $todoRepository = $this->entityManager->getRepository('Wr\Connect\CoreBundle\Entity\Todo');
        $todo = $todoRepository->findById($id);
        if($todo[0]->getAuthor() == $user->id){
            return true;
        }
        return false;

    }

}