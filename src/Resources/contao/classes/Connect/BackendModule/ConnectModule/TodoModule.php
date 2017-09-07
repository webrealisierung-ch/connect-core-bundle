<?php
namespace Wr\Connect\CoreBundle\Contao\BackendModule\ConnectModule;

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

        $statusBoards=\Contao\System::getContainer()->get('wr.connect.status_manager');

        $statusBoardsTemplate->class='todos';

        $statusBoardsTemplate->statusBoards=$statusBoards->generateStatusBoard($this->user);
        return $statusBoardsTemplate;
    }
}
