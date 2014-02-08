<?php
/**
* @version 
* @package MosModuleMod - COAddOns for Mambo & Jommla - Mambot - contribution from Andrés Felipe Vargas.
* @copyright (C) 2008 ongetc.com
* @info ongetc@ongetc.com http://ongetc.com
* @license GNU/GPL http:/ongetc.com/gpl.html.
*/ 

// no direct access
defined( '_VALID_MOS' ) or die( 'Restricted access' );

global $mosConfig_absolute_path;

$commandToExecute = $params->get( 'command', '');
$halign = $params->get( 'align', '');

if (!defined('_MOS_MODULE_LOADED')){
	// tiny class to deal with J15 compatibility issue
	class MosModuleModTinyIsJClass {
		function MosModuleTinyIsJClass() { } // empty constructor
		function isJ15() {
			( (defined('JVERSION')) and 
				($this->is1stNewer2nd(substr(JVERSION,0,3),'1.0') ) ) ? $ret=true : $ret=false;
			return $ret;
		}
		function is1stNewer2nd( $first,$second ) {
		   (version_compare($first,$second)=="1") ? $newer=true : $newer=false;
		   return $newer;
		}
		function getBotTable() { return "#__".$this->getBot(); }
		function getBot() {
			($this->isJ15()) ? $ret="plugins" : $ret="mambots";
			return $ret;
		}
	}
	$mmMe = new MosModuleModTinyIsJClass;
	$mosmodulefunc=$mmMe->getBot().'/content/mosmodule/mosmodule_func.php';
    if (file_exists($mosmodulefunc)) {
        include_once($mosmodulefunc); 
    }
    define('_MOS_MODULE_LOADED',1);
}

if (function_exists('mosmodule_bot')) { 
    echo "<div align=\"$halign\">".mosmodule_bot("{mosmodule $commandToExecute}")."</div>"; 
}

?>