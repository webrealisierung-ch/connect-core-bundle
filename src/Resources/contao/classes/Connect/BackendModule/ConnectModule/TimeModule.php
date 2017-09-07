<?php
namespace Wr\Connect\CoreBundle\Contao\BackendModule\ConnectModule;

class TimeModule
{
    protected $strTemplate="be_wr_connect_time";
    public function compile()
    {
       $time = new \BackendTemplate($this->strTemplate);


       return $time;
    }
}
