<?php
namespace Wr\Connect\CoreBundle\Contao\BackendModule\ConnectModule;

class AboModule
{
    protected $strTemplate="be_wr_connect_abo";
    public function compile()
    {
        $objTemplate =new \BackendTemplate($this->strTemplate);
        return $objTemplate;
    }
}
