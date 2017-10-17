<?php


namespace Wr\Connect\CoreBundle\Todo;


use Doctrine\ORM\EntityManager;

class DefaultStatus
{
    private $entityManager;

    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager=$entityManager;
    }
    public function get(){
        $repoStatus = $this->entityManager->getRepository('Wr\Connect\CoreBundle\Entity\Status');
        $status = $repoStatus->findAll();
        foreach($status as $s){
            if($s->getIsDefault()){
                return $s->getIsDefault();
            }
        }
        return "";
    }
}