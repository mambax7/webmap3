<?php
// $Id: blocks.php,v 1.2 2012/04/09 11:52:19 ohwada Exp $

//=========================================================
// webmap3 module
// 2009-02-11 K.OHWADA
//=========================================================

$constpref = strtoupper( '_BL_' . $GLOBALS['MY_DIRNAME']. '_' ) ;

// === define begin ===
if( !defined($constpref."LANG_LOADED") ) 
{

define($constpref."LANG_LOADED" , 1 ) ;

//---------------------------------------------------------
// v1.10
//---------------------------------------------------------
define($constpref.'HEIGHT',  '表示の高さ');
define($constpref.'TIMEOUT', '表示の遅延時間');
define($constpref.'TIMEOUT_DSC', 'ミリ秒');

// === define end ===
}

?>