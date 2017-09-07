<?php

namespace Wr\Connect\CoreBundle\Contao\BackendModule;


use Contao\WrTodoModel;


class Cockpit extends \BackendModule
{
    protected $strTemplate = 'be_wr_connect_cockpit';

    protected function compile(){


        $connectModules=array();
        $user = \BackendUser::getInstance();

        $this->Template->User = $user;

        $container = \Contao\System::getContainer();
        $availableConnectModules=$container->getParameter('connect')['connect']['modules'];
        foreach($availableConnectModules as $connectModule){
            $module= new $connectModule['class']($user);
            array_push($connectModules,$module->compile()->parse());
        }
        $this->Template->class='connect cockpit';
        $this->Template->connectModules=$connectModules;
    }
}
