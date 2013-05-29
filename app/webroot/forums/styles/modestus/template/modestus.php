<?php
/**
* RokBB3 File
* phpBB3 style name: Modestus
* @version 1.3.1: modestus.php 2010-07 $
* @copyright (c) 2010 
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
*
*/

// Don't allow direct access
die( 'Restricted access' );
?>
<!-- PHP -->
global $config, $template;
$template->assign_vars(array(
// RokBB3 variables
                'ENABLE_ROKBB3'	        =>  "{$config['enable_modestus_rokbb3']}",
                'DEFAULT_MODESTUS_SCHEME'	        =>  "{$config['default_modestus_scheme']}",
                'MODESTUS_LOGO_LINK'	                =>  "{$config['modestus_logo_link']}",
                'MODESTUS_WIDTH'	                =>  "{$config['modestus_width']}",
                'MODESTUS_FULL_WIDTH'                   =>  ($config['modestus_full_width']) ? true : false,
                'ENABLE_MODESTUS_LOGO'                  =>  ($config['enable_modestus_logo']) ? true : false,
		'ALLOW_MODESTUS_COLORSWITCHER'          =>  ($config['show_modestus_colorswitcher']) ? true : false,
                'SHOW_MODESTUS_DATE'		        =>  ($config['show_modestus_date']) ? true : false,
                'SHOW_MODESTUS_PATHWAY'		        =>  ($config['show_modestus_pathway']) ? true : false,   
                'ENABLE_MODESTUS_BOTTOM_MODULES'        =>  ($config['enable_modestus_bottom_modules']) ? true : false,
                'ROKBOX'                  => ($config['rokbox']) ? true : false,
                'ROKBOX_THEME'            => "{$config['rokbox_theme']}"
 
));
<!-- ENDPHP -->





       