<?php


namespace Wr\Connect\CoreBundle\Service\Todo;


use Contao\Database;
use Contao\DataContainer;
use Contao\StringUtil;

class TodoGenerateAlias
{

    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    public function generateAlias($varValue, DataContainer $dc){
        $autoAlias = false;

        // Generate an alias if there is none
        if ($varValue == '')
        {
            $autoAlias = true;
            $varValue = StringUtil::generateAlias($dc->activeRecord->title);
        }

        $objAlias = $this->database->prepare("SELECT id FROM tl_wr_status WHERE id=? OR alias=?")
            ->execute($dc->id, $varValue);

        // Check whether the page alias exists
        if ($objAlias->numRows > 1)
        {
            if (!$autoAlias)
            {
                throw new \Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
            }

            $varValue .= '-' . $dc->id;
        }

        return $varValue;
    }

}