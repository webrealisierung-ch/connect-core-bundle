<?php

namespace Wr\Connect\CoreBundle\Todo;

use Contao\Backend;
use Contao\User;
use Doctrine\ORM\EntityManager;
use Twig\Environment;
use Twig\TwigFunction;
use Wr\Connect\CoreBundle\Entity\Status;

/**
 *
 * @author Daniel Steuri <mail@webrealisierung.ch>
 */
class TodoManager
{
    private $entityManager;
    private $twig;

    public function __construct(EntityManager $entityManager, Environment $twig)
    {
        $this->entityManager = $entityManager;
        $this->twig = $twig;

        $function=new TwigFunction('addToBackendUrl',function($id){
            return Backend::addToUrl("do=projects&table=tl_wr_todo&id=".$id."&act=edit");
        });

        $this->twig->addFunction($function);
    }

    public function generateTodo(Status $status, User $user)
    {
        $repoTodo = $this->entityManager->getRepository('Wr\Connect\CoreBundle\Entity\Todo');

        $todos = $repoTodo->findByStatusAndByUserAndByProjectIsNotClosed($user, $status->getId());
        return $this->twig->render(
            '@ConnectCore/connect_todo.html.twig',
            [
                'class' => 'todo',
                'status' => $status,
                'todos' => $todos
            ]);
    }
}
