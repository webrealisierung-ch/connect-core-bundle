<?php


namespace Wr\Connect\CoreBundle\Todo;


use Contao\User;
use Doctrine\ORM\EntityManager;
use Wr\Connect\CoreBundle\Entity\Todo;

class ChangeStatus
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager=$entityManager;
    }

    public function execute($todoId,$statusId){
        $todoRepository = $this->entityManager->getRepository('Wr\Connect\CoreBundle\Entity\Todo');
        $todo = $todoRepository->findById($todoId);
        $this->save($todo[0], $statusId);
    }

    private function save(Todo $todo, $statusId)
    {
        $todo->setStatus($statusId);
        $this->entityManager->persist($todo);
        $this->entityManager->flush();
    }
}