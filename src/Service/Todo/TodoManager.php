<?php

namespace Wr\Connect\CoreBundle\Service\Todo;

use Contao\Backend;
use Contao\User;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Twig\TwigEngine;
use Twig\TwigFunction;
use Wr\Connect\CoreBundle\Entity\Status;
use Wr\Connect\CoreBundle\Entity\Todo;

/**
 *
 * @author Daniel Steuri <mail@webrealisierung.ch>
 */
class TodoManager
{
    private $entityManager;
    private $twig;

    public function __construct(EntityManager $entityManager, \Twig_Environment $twig)
    {
        $this->entityManager = $entityManager;
        $this->twig = $twig;

        $function=new TwigFunction('addToBackendUrl',function($id){
            return \Backend::addToUrl("do=projects&table=tl_wr_todo&id=".$id."&act=edit");
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
