<?php


/**
 * Table tl_project
 */
$GLOBALS['TL_DCA']['tl_wr_project'] = array
(

    // Config
    'config' => array
    (
        'dataContainer'               => 'Table',
        'ctable'                      => array('tl_wr_todo', 'tl_wr_time'),
        'switchToEdit'                => true,
        'enableVersioning'            => true,
    ),
    'list' => array
    (
        'sorting' => array
        (
            'mode'                    => 2,
            'fields'                  => array('title', 'author'),
        ),
        'label' => array
        (
            'fields'                  => array('title', 'owner'),
            'format'                  => '%s <span style="color:#b3b3b3;padding-left:3px">[%s]</span>',
            'showColumns'   => true,
            'label_callback'          => array('tl_wr_project', 'generateLabel'),
        ),
        'operations' => array
        (
            'edit' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_wr_project']['edit'],
                'href'                => 'act=edit',
                'icon'                => 'header.gif',
            ),
            'todo' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_wr_project']['todo'],
                'href'                => 'table=tl_wr_todo',
                'icon'                => 'bundles/connectcore/list.svg',
            ),
            'time' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_wr_project']['time'],
                'href'                => 'table=tl_wr_time',
                'icon'                => 'bundles/connectcore/clock.svg',
            ),
            'delete' => array
            (
                'label'               => &$GLOBALS['TL_LANG']['tl_wr_project']['delete'],
                'href'                => 'act=delete',
                'icon'                => 'delete.gif',
                'attributes'          => 'onclick="if(!confirm(\'' . $GLOBALS['TL_LANG']['MSC']['deleteConfirm'] . '\'))return false;Backend.getScrollOffset()"',
            ),
        )
    ),
    'palettes' => array
    (
        '__selector__'                => array('protected', 'published'),
        'default'                     => '{title_legend},title,author,alias,owner,workers;{description_legend},description;{files_legend},project_dir;{project_protected_legend},protected;{active_legend},published'
    ),
    // Subpalettes
    'subpalettes' => array
    (
        'protected'                   => 'groups',
        'published'                   => 'start,stop'
    ),
    // Fields
    'fields' => array
    (
        'id' => array
        (
            'label'                   => array('ID'),
            'search'                  => true,
        ),
        'title' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_project']['title'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'search'                  => true,
            'eval'                    => array('mandatory'=>true, 'decodeEntities'=>true, 'maxlength'=>255, 'tl_class'=>'w50'),
        ),
        'alias' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_project']['alias'],
            'exclude'                 => true,
            'inputType'               => 'text',
            'search'                  => true,
            'eval'                    => array('rgxp'=>'alias', 'doNotCopy'=>true, 'maxlength'=>128, 'tl_class'=>'w50'),
            'save_callback' => array
            (
                array('tl_wr_project', 'generateAlias')
            ),
        ),
        'author' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_project']['author'],
            'default'                 => BackendUser::getInstance()->id,
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
            'foreignKey'              => 'tl_user.name',
            'eval'                    => array('doNotCopy'=>true, 'mandatory'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
            'relation'                => array('type'=>'hasOne', 'load'=>'eager')
        ),
        'owner' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_project']['owner'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_wr_project', 'getWorkers'),
            'eval'                    => array('doNotCopy'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
        ),
        'workers' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_project']['worker'],
            'exclude'                 => true,
            'search'                  => true,
            'inputType'               => 'select',
            'options_callback'        => array('tl_wr_project', 'getWorkers'),
            'eval'                    => array('doNotCopy'=>true, 'multiple'=>true, 'chosen'=>true, 'includeBlankOption'=>true, 'tl_class'=>'w50'),
        ),
        'description' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_project']['description'],
            'exclude'                 => true,
            'inputType'               => 'textarea',
            'search'                  => true,
            'eval'                    => array('rte'=>'tinyMCE', 'tl_class'=>'clr'),
        ),
        'project_dir' => array
        (
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_project']['project_dir'],
            'exclude'                 => true,
            'inputType'               => 'fileTree',
            'eval'                    => array('fieldType'=>'radio', 'tl_class'=>'clr', 'mandatory'=>true),
        ),
        'active' => array
        (
            'exclude'                 => true,
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_project']['active'],
            'inputType'               => 'checkbox',
            'eval'                    => array('submitOnChange'=>true, 'doNotCopy'=>true),
        ),
        'start' => array
        (
            'exclude'                 => true,
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_project']['start'],
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
        ),
        'stop' => array
        (
            'exclude'                 => true,
            'label'                   => &$GLOBALS['TL_LANG']['tl_wr_project']['stop'],
            'inputType'               => 'text',
            'eval'                    => array('rgxp'=>'datim', 'datepicker'=>true, 'tl_class'=>'w50 wizard'),
        )
    )
);
class tl_wr_project extends Backend
{

    public function checkPermission()
    {


    }
    public function setMultiSrcFlags(){

    }

    public function generateAlias($varValue, DataContainer $dc)
    {
        $autoAlias = false;

        // Generate an alias if there is none
        if ($varValue == '')
        {
            $autoAlias = true;
            $varValue = StringUtil::generateAlias($dc->activeRecord->title);
        }

        $objAlias = $this->Database->prepare("SELECT id FROM tl_wr_project WHERE id=? OR alias=?")
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
    public function addIcon($row, $label)
    {

    }
    public function generateLabel($arrValues, $strValue, DataContainer $dc){
        $owners=\Contao\MemberModel::findById($arrValues['owner']);
        if($owners && $owners->company){
            return array($arrValues['title'],$owners->firstname." ".$owners->lastname." - ".$owners->company);
        }elseif($owners){
            return array($arrValues['title'],$owners->firstname." ".$owners->lastname);
        } else{
            return array($arrValues['title'], "-");
        }
    }
    public function getWorkers(){
        $workers=\Contao\MemberModel::findAll();
        if($workers) {
            foreach ($workers as $worker) {
                if($worker->company){
                    $arrWorker[$worker->id] = $worker->firstname." ".$worker->lastname." - ".$worker->company;
                }else{
                    $arrWorker[$worker->id] = $worker->firstname." ".$worker->lastname;
                }
            }
            return $arrWorker;
        }
    }
}
