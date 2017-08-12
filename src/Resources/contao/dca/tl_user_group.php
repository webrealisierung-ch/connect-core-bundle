<?php


/**
 * Extend default palette
 */
$GLOBALS['TL_DCA']['tl_user_group']['palettes']['default'] = str_replace('formp;', 'formp;{wr_project_legend},wr_projectss,wr_projectsp;', $GLOBALS['TL_DCA']['tl_user_group']['palettes']['default']);


/**
 * Add fields to tl_wr_project
 */
$GLOBALS['TL_DCA']['tl_user_group']['fields']['wr_projectss'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['wr_projectss'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'foreignKey'              => 'tl_wr_project.title',
	'eval'                    => array('multiple'=>true),
	'sql'                     => "blob NULL"
);

$GLOBALS['TL_DCA']['tl_user_group']['fields']['wr_projectsp'] = array
(
	'label'                   => &$GLOBALS['TL_LANG']['tl_user']['wr_projectsp'],
	'exclude'                 => true,
	'inputType'               => 'checkbox',
	'options'                 => array('create', 'delete'),
	'reference'               => &$GLOBALS['TL_LANG']['MSC'],
	'eval'                    => array('multiple'=>true),
	'sql'                     => "blob NULL"
);