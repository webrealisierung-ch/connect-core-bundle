<?php
namespace Wr\Connect\CoreBundle\Contao\BackendModule\ConnectModule;

class TodoModule
{
    protected $statusTemplate = "be_wr_connect_status";
    protected $todoTemplate = "be_wr_connect_todos";
    protected $user;

    function __construct(\BackendUser $user)
    {
        $this->user=$user;
    }

    public function compile()
    {
        $entityManager = \Contao\System::getContainer()->get('doctrine.orm.default_entity_manager');

        $todoTemplate = new \BackendTemplate($this->todoTemplate);
        $statusBoardsTemplate = new \BackendTemplate($this->statusTemplate);

        $todoTemplate->User=$this->user;

        $statusBoards=array();

        $repoTodo=$entityManager->getRepository('Wr\Connect\CoreBundle\Entity\Todo');
        $repoStatus=$entityManager->getRepository('Wr\Connect\CoreBundle\Entity\Status');
        $allStatusEntries = $repoStatus->findAll();

        foreach($allStatusEntries as $status){
            //$todos=$repoTodo->findStatusByUserOrderedByDate($this->user,$status->getId());
            $todos=$repoTodo->findByStatusAndByUserAndByProjectIsNotClosed($this->user,$status->getId());
            $todoTemplate->class="status_board";
            $todoTemplate->title=$status->getTitle();
            $todoTemplate->color=$status->getColor();
            $todoTemplate->Todos=$todos;
            array_push($statusBoards,$todoTemplate->parse());
        }
        $statusBoardsTemplate->class='todos';
        $statusBoardsTemplate->statusBoards=$statusBoards;
        return $statusBoardsTemplate;
    }
}
