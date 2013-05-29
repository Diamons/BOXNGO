<?php if (!defined('IN_PHPBB')) exit; ?><!--

    Configuration file
    phpBB3 style name: Modestus
    @version 1.3.1: modestus_config.html 2010-07 $
    @copyright RocketTheme, LLC (C) Copyright. All rights reserved.  
    @license http://opensource.org/licenses/gpl-license.php GNU Public License
    
-->

<!-- Default color variation (pick from style1 to style5) --><?php $this->_tpldata['DEFINE']['.']['DEFAULT_MODESTUS_SCHEME'] = 'style3'; ?><!-- Full width or Fixed width (true or false) --><?php $this->_tpldata['DEFINE']['.']['MODESTUS_FULL_WIDTH'] = FALSE; ?><!-- Template width (in pixels) --><?php $this->_tpldata['DEFINE']['.']['MODESTUS_WIDTH'] = '960'; ?><!-- Logo link (url) --><?php $this->_tpldata['DEFINE']['.']['MODESTUS_LOGO_LINK'] = ''; ?><!-- Enable logo (true or false) --><?php $this->_tpldata['DEFINE']['.']['ENABLE_MODESTUS_LOGO'] = TRUE; ?><!-- Enable bottom modules (true or false) --><?php $this->_tpldata['DEFINE']['.']['ENABLE_MODESTUS_BOTTOM_MODULES'] = TRUE; ?><!-- Show pathway (true or false) --><?php $this->_tpldata['DEFINE']['.']['SHOW_MODESTUS_PATHWAY'] = TRUE; ?><!-- Enable Date (true or false) --><?php $this->_tpldata['DEFINE']['.']['SHOW_MODESTUS_DATE'] = TRUE; ?><!-- Enable ColorSwitcher (true or false) --><?php $this->_tpldata['DEFINE']['.']['ALLOW_MODESTUS_COLORSWITCHER'] = TRUE; ?><!-- Enable RokBox (true or false) --><?php $this->_tpldata['DEFINE']['.']['ROKBOX'] = TRUE; ?><!-- RokBox Theme --><?php $this->_tpldata['DEFINE']['.']['ROKBOX_THEME'] = 'light'; ?>




<!--

    RokBB3 Configuration Module Support
    
-->
<?php $this->_tpl_include('modestus.php'); if ($this->_rootref['ENABLE_ROKBB3']) {  $this->_tpldata['DEFINE']['.']['DEFAULT_MODESTUS_SCHEME'] = '' . (isset($this->_rootref['DEFAULT_MODESTUS_SCHEME'])) ? $this->_rootref['DEFAULT_MODESTUS_SCHEME'] : '' . ''; $this->_tpldata['DEFINE']['.']['MODESTUS_FULL_WIDTH'] = '' . (isset($this->_rootref['MODESTUS_FULL_WIDTH'])) ? $this->_rootref['MODESTUS_FULL_WIDTH'] : '' . ''; $this->_tpldata['DEFINE']['.']['MODESTUS_WIDTH'] = '' . (isset($this->_rootref['MODESTUS_WIDTH'])) ? $this->_rootref['MODESTUS_WIDTH'] : '' . ''; $this->_tpldata['DEFINE']['.']['MODESTUS_LOGO_LINK'] = '' . (isset($this->_rootref['MODESTUS_LOGO_LINK'])) ? $this->_rootref['MODESTUS_LOGO_LINK'] : '' . ''; $this->_tpldata['DEFINE']['.']['ENABLE_MODESTUS_LOGO'] = '' . (isset($this->_rootref['ENABLE_MODESTUS_LOGO'])) ? $this->_rootref['ENABLE_MODESTUS_LOGO'] : '' . ''; $this->_tpldata['DEFINE']['.']['ENABLE_MODESTUS_BOTTOM_MODULES'] = '' . (isset($this->_rootref['ENABLE_MODESTUS_BOTTOM_MODULES'])) ? $this->_rootref['ENABLE_MODESTUS_BOTTOM_MODULES'] : '' . ''; $this->_tpldata['DEFINE']['.']['SHOW_MODESTUS_PATHWAY'] = '' . (isset($this->_rootref['SHOW_MODESTUS_PATHWAY'])) ? $this->_rootref['SHOW_MODESTUS_PATHWAY'] : '' . ''; $this->_tpldata['DEFINE']['.']['SHOW_MODESTUS_DATE'] = '' . (isset($this->_rootref['SHOW_MODESTUS_DATE'])) ? $this->_rootref['SHOW_MODESTUS_DATE'] : '' . ''; $this->_tpldata['DEFINE']['.']['ALLOW_MODESTUS_COLORSWITCHER'] = '' . (isset($this->_rootref['ALLOW_MODESTUS_COLORSWITCHER'])) ? $this->_rootref['ALLOW_MODESTUS_COLORSWITCHER'] : '' . ''; $this->_tpldata['DEFINE']['.']['ROKBOX'] = '' . (isset($this->_rootref['ROKBOX'])) ? $this->_rootref['ROKBOX'] : '' . ''; $this->_tpldata['DEFINE']['.']['ROKBOX_THEME'] = '' . (isset($this->_rootref['ROKBOX_THEME'])) ? $this->_rootref['ROKBOX_THEME'] : '' . ''; } ?>