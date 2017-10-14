<?php


namespace Wr\Connect\CoreBundle\Status;

use Contao\Database;
use Contao\DataContainer;
use Contao\Message;

class checkIsDefault
{
    private $database;

    public function __construct()
    {
        $this->database = Database::getInstance();
    }

    public function check($varValue, DataContainer $dc){

        if ($varValue != '')
        {
            $objAlias = $this->database->prepare("SELECT id FROM tl_wr_status WHERE isDefault=1")
                ->execute();
            if ($objAlias->numRows > 0)
            {
                $id  = $objAlias->id;
                $query = $this->database->prepare("UPDATE tl_wr_status SET isDefault = ? WHERE id=?")
                    ->execute('0',$id);
                Message::addError('isDefault Field from an other Status is reset to 0.');
                // throw new \Exception("Override status field is Default.");
            }
        }

        return $varValue;
    }
}
