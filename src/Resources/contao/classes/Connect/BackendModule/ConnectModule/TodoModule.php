<?php
namespace Wr\Connect\CoreBundle\Contao\BackendModule\ConnectModule;

use Contao\Input;
use Contao\System;

class TodoModule
{
    protected $statusTemplate = "be_mod_connect_todos";
    protected $user;

    function __construct(\BackendUser $user)
    {
        $this->user=$user;
    }

    public function compile()
    {
        $statusBoardsTemplate = new \BackendTemplate($this->statusTemplate);
        $container=System::getContainer();
        $statusBoards=$container->get('wr.connect.status_manager');


        /*
         *Preparation for Ajax Stuff
         *
         */
        $statusId = Input::get('status_id');
        $todoId = Input::get('todo_id');


        if(!empty($todoId)&&!empty($statusId))
        {
            $container->get('wr.connect.todo_change_status')->changeStatus($todoId,$statusId);
        }

        $statusBoardsTemplate->class='todos';

        $statusBoardsTemplate->statusBoards=$statusBoards->generateStatusBoard($this->user);
        return $statusBoardsTemplate;
    }
}
