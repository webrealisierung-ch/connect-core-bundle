<?php

/**
 * Table tl_project
 */
$GLOBALS['TL_DCA']['tl_wr_todo'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'ptable'                      => 'tl_wr_project',
        'switchToEdit'                => true,
        'enableVersioning'            => true,
    ),
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 4,
            'fields'                  => array('tstamp'),
            'panelLayout'                    => 'sort,filter',
            'headerFields'            => array('title'),
            'child_record_callback'   => array('tl_wr_todo','listChild')
        ),
        'label' => array
        (
            'fields'                  => array('title', 'author'),
            'format'                  => '%s <span style="color:#b3b3b3;padding-left:3px">[%s]</span>',
            //'label_callback'          => array('tl_wr_todo', 'addIcon')
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_wr_todo']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'edit.gif',
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_wr_todo']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
        ),
        'global_operations' => array(
            'status' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_wr_status']['status'],
                'href'                => 'table=tl_wr_status',
                'class'               => 'header_status',
                'attributes'          => 'onclick="Backend.getScrollOffset()"',
            ),
        )
    ),
    'palettes' => array
    (
        '__selector__'                => array('protected', 'published'),
        'default'                     => '{title_legend},title,alias,author,pid;{description_legend:hide},description;{todo_files_legend},multiSRC;{parameters_legend},status,priority,deadline'
    ),
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'label'                   => array('ID'),
            'search'                  => true,
        ),
        'pid' => array
        (
            'inputType'               => 'select',
            'foreignKey'              => 'tl_wr_project.title',
            'eval'                    => array('doNotCopy'=>true, 'mandatory'=>true, 'multiple'=>false, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
            //'relation'                => array('type'=>'belongsTo', 'load'=>'eager')
        ),
        'title' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_todo']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'search'                  => true,
            'eval'                    => array('mandatory'=>true, 'decodeEntities'=>true, 'maxlength'=>255),
        ),
        'alias' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_todo']['alias'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'search'                  => true,
            'eval'                    => array('rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
            'save_callback' => array
            (
                array('tl_wr_todo', 'generateAlias')
            ),
        ),
        'author' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_todo']['author'],
            'default'                 => BackendUser::getInstance()->id,
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
            'foreignKey'              => 'tl_user.name',
            'eval'                    => array('doNotCopy'=>true, 'mandatory'=>true, 'multiple'=>false, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
        ),
        'description' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_todo']['description'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'search'                  => true,
            'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
        ),
        'deadline' => array
        (
            'exclude'                 => true,
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_todo']['deadline'],
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
        ),
        'status' => array
        (
            'default'                 => 0,
            'exclude'                 => true,
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_todo']['status'],
            'inputType'               => 'select',
            'foreignKey'              => 'tl_wr_status.title',
            'eval'                    => array('doNotCopy'=>true, 'chosen'=>true, 'mandatory'=>true, 'tl_class'=>'w50'),
        ),
        'priority' => array
        (
            'default'                 => 0,
            'exclude'                 => true,
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_todo']['priority'],
            'inputType'               => 'select',
            'options'                 => array(0,1,2),
            'reference'               => array('Normal','Prioritär','Dringend'),
            'eval'                    => array('doNotCopy'=>true, 'chosen'=>true, 'mandatory'=>true, 'tl_class'=>'w50'),
        )
    )
);
class tl_wr_todo extends Backend
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

        $objAlias = $this->Database->prepare("SELECT id FROM tl_wr_todo WHERE id=? OR alias=?")
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
        return $row['title'];
    }

}
