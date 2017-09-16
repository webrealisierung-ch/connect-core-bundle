<?php


namespace Wr\Connect\CoreBundle\Service\Todo;


use Doctrine\ORM\EntityManager;
use Wr\Connect\CoreBundle\Entity\Todo;

class TodoChangeStatus
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager=$entityManager;
    }

    public function changeStatus($todoId,$statusId){
        $todoRepository = $this->entityManager->getRepository('Wr\Connect\CoreBundle\Entity\Todo');
        $todo = $todoRepository->findById($todoId);
        $this->saveTodoChangeStatus($todo[0], $statusId);
    }

    private function saveTodoChangeStatus(Todo $todo, $statusId)
    {
        $todo->setStatus($statusId);
        $this->entityManager->persist($todo);
        $this->entityManager->flush();
    }
}