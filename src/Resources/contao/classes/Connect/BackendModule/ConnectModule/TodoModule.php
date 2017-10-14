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
            if($check = $container->get('wr.connect.todo.assigned_to_user')->check($this->user,$todoId)){
                $container->get('wr.connect.todo_change_status')->execute($todoId,$statusId);
            }
        }

        $statusBoardsTemplate->class='todos';

        $statusBoardsTemplate->statusBoards=$statusBoards->generateStatusBoard($this->user);
        return $statusBoardsTemplate;
    }
}
