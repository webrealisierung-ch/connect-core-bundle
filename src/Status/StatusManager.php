<?php

/**
 * @copyright 2017 Webrealisierung GmbH
 *
 * @license LGPL-3.0+
 */

namespace Wr\Connect\CoreBundle\Status;
use Contao\Backend;
use Contao\BackendUser;
use Doctrine\ORM\EntityManager;
use Twig\Environment;
use Twig\TwigFunction;
use Wr\Connect\CoreBundle\Entity\Status;
use Wr\Connect\CoreBundle\Todo\TodoManager;


/**
 *
 * @author Daniel Steuri <mail@webrealisierung.ch>
 */
class StatusManager
{
    private $entityManager;
    private $todoManager;
    private $twig;

    public function __construct(EntityManager $entityManager, TodoManager $todoManager, Environment $twig)
    {
        $this->entityManager = $entityManager;
        $this->todoManager = $todoManager;
        $this->twig = $twig;
        $function=new TwigFunction('addToBackendUrl',function($str){
            return Backend::addToUrl($str);
        });

        $this->twig->addFunction($function);

    }

    public function generateStatusBoard($user){

        $boards='';

        $repoStatus=$this->entityManager->getRepository('Wr\Connect\CoreBundle\Entity\Status');
        $statusBoards = $repoStatus->findAll();

        foreach($statusBoards as $statusBoard){
            $boards.=$this->twig->render('@ConnectCore/connect_status_board.html.twig',[
                'class'=>'status_board',
                'statusBoard'=> $statusBoard,
                'todos'=> $this->todoManager->generateTodo($statusBoard,$user)
                ]
            );
        }

        $r = $this->twig->render(
                '@ConnectCore/connect_status_boards.html.twig',
                [
                    'boards' => $boards
                ]
            );
        return $r;
    }
}
