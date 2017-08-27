<?php

if(TL_MODE=="BE"){
    $GLOBALS['TL_CSS'][]="bundles/connectcore/css/connect.css";
    $GLOBALS['TL_JAVASCRIPT'][]="bundles/connectcore/js/connect.js";
}
$GLOBALS['BE_MOD']= array_merge(
    array
    (
        'connect' => array
        (
            'cockpit' => array
            (
                'callback'          => 'Wr\Connect\CoreBundle\Contao\BackendModule\Cockpit',
                'tables' => array('tl_wr_todo','tl_wr_status'),
            ),
            'projects' => array
            (
                'tables' => array('tl_wr_project','tl_wr_todo','tl_wr_time','tl_wr_status'),
            )
        )
    ),
    $GLOBALS['BE_MOD']
);
