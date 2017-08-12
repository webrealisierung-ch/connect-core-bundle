<?php

/**
 * Table tl_project
 */
$GLOBALS['TL_DCA']['tl_wr_time'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'ptable'                      => 'tl_wr_project',
        'switchToEdit'                => true,
        'enableVersioning'            => false,
    ),
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 4,
            'fields'                  => array('author'),
            'panelLayout'             => 'sort,filter',
            'headerFields'            => array('title'),
            'child_record_callback'   => array('tl_wr_time','listChild')

        ),
        'label' => array
        (
            'fields'                  => array('title', 'author'),
            'format'                  => '%s <span style="color:#b3b3b3;padding-left:3px">[%s]</span>',
            //'label_callback'          => array('tl_wr_time', 'addIcon')
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_wr_time']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif',
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_wr_time']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
        )
    ),
    'palettes' => array
    (
        '__selector__'                => array('protected', 'published'),
        'default'                     => '{title_legend},todo,author;{description_legend:hide},description;{todo_files:hide},multiSRC;{todo_parameters:hide},start,stop'
    ),
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'label'                   => array('ID'),
            'search'                  => true,
            'sql'                     => "int(10) unsigned NOT NULL auto_increment"
        ),
        'pid' => array
        (
            'foreignKey'              => 'tl_wr_project.title',
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
        ),
        'sorting' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'tstamp' => array
        (
            'sql'                     => "int(10) unsigned NOT NULL default '0'"
        ),
        'author' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_time']['author'],
            'default'                 => BackendUser::getInstance()->id,
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
            'foreignKey'              => 'tl_user.name',
            'eval'                    => array('doNotCopy'=>true, 'mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
            'relation'                => array('type'=>'hasOne', 'load'=>'eager')
        ),
        'todo' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_time']['todo'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
            'options_callback'              => array('tl_wr_time','importTodos'),
            'eval'                    => array('doNotCopy'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
            'sql'                     => "int(10) unsigned NOT NULL default '0'",
        ),
        'description' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_time']['description'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'search'                  => true,
            'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
            'sql'                     => "text NULL"
        ),
        'start' => array
        (
            'exclude'                 => true,
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_time']['start'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true,'rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(10) NOT NULL default ''"
        ),
        'stop' => array
        (
            'exclude'                 => true,
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_time']['stop'],
            'inputType'               => 'text',
            'eval'                    => array('mandatory'=>true,'rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
            'sql'                     => "varchar(10) NOT NULL default ''"
        )
    )
);
class tl_wr_time extends Backend
{

    /**
     * Auto-generate an article alias if it has not been set yet
     *
     * @param mixed         $varValue
     * @param DataContainer $dc
     *
     * @return string
     *
     * @throws Exception
     */
    public function generateAlias($varValue, DataContainer $dc)
    {
        $autoAlias = false;

        // Generate an alias if there is none
        if ($varValue == '')
        {
            $autoAlias = true;
            $varValue = StringUtil::generateAlias($dc->activeRecord->title);
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_wr_time WHERE id=? OR alias=?")
            ->execute($dc->id, $varValue);

        // Check whether the page alias exists
        if ($objAlias->numRows > 1)
        {
            if (!$autoAlias)
            {
                throw new Exception(sprintf($GLOBALS['TL_LANG']['ERR']['aliasExists'], $varValue));
            }

            $varValue .= '-' . $dc->id;
        }

        return $varValue;
    }
    public function listChild($row){
        if($row['start']&&$row['stop']) {
            $days = array("So.", "Mo.", "Di.", "Mi.", "Do.", "Fr.", "Sa.");
            $startday = $days[$day = date("w", $row['start'])];
            $stopday = $days[$day = date("w", $row['stop'])];
            $timestart = date(' H:i d.m.Y', $row['start']);
            $timestop = date('H:i d.m.Y', $row['stop']);
            $timeauthor = Contao\UserModel::findById($row['author']);
            $timeduration = ($row['stop'] - $row['start']) / 60;
            if ($timeduration >= 60) {
                $counthours = floor($timeduration / 60);
                $minutes = $timeduration - ($counthours * 60);
                $timeduration = $counthours . " Std. " . $minutes . " Minuten";
            } else {
                $timeduration = "" . $timeduration . ' Minuten';
            }
        } else {
            $timeduration = "Keine Zeit erfasst!";
        }
        return $startday." ".$timestart . " - " . $stopday . " " . $timestop ." [". $timeduration .']';
    }
    public function importTodos(){
        $relobj=\Contao\WrTimeModel::findById($_REQUEST['id']);
        $listobj=\Contao\WrTodoModel::findByPid($relobj->pid);
        $array = array();
        if($listobj){
            foreach ($listobj as $item) {
                $array[$item->id] = $item->title;
            }
        }
        return $array;
    }
}
