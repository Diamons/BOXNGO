<?php /* Smarty version 2.6.25, created on 2013-05-28 19:55:03
         compiled from C:%5Cwamp%5Cwww%5Crr%5Capp%5Cwebroot%5Cforums/themes/defaultsmarty/views/default.master.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'asset', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 4, false),array('function', 'link', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 12, false),array('function', 'logo', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 12, false),array('function', 'dashboard_link', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 14, false),array('function', 'discussions_link', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 15, false),array('function', 'activity_link', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 16, false),array('function', 'inbox_link', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 17, false),array('function', 'profile_link', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 18, false),array('function', 'custom_menu', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 19, false),array('function', 'signinout_link', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 20, false),array('function', 'searchbox', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 22, false),array('function', 'vanillaurl', 'C:\\wamp\\www\\rr\\app\\webroot\\forums/themes/defaultsmarty/views/default.master.tpl', 33, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en-ca">
<head>
  <?php echo smarty_function_asset(array('name' => 'Head'), $this);?>

</head>

<body id="<?php echo $this->_tpl_vars['BodyID']; ?>
" class="<?php echo $this->_tpl_vars['BodyClass']; ?>
">

<div id="Frame">
 <div id="Head">
   <div class="Banner Menu">
      <h1><a class="Title" href="<?php echo smarty_function_link(array('path' => "/"), $this);?>
"><span><?php echo smarty_function_logo(array(), $this);?>
</span></a></h1>
      <ul id="Menu">
         <?php echo smarty_function_dashboard_link(array(), $this);?>

         <?php echo smarty_function_discussions_link(array(), $this);?>

         <?php echo smarty_function_activity_link(array(), $this);?>

         <?php echo smarty_function_inbox_link(array(), $this);?>

         <?php echo smarty_function_profile_link(array(), $this);?>

         <?php echo smarty_function_custom_menu(array(), $this);?>

         <?php echo smarty_function_signinout_link(array(), $this);?>

      </ul>
      <div id="Search"><?php echo smarty_function_searchbox(array(), $this);?>
</div>
    </div>
  </div>

  <div id="Body">
    <div id="Content">
      <?php echo smarty_function_asset(array('name' => 'Content'), $this);?>

    </div>
    <div id="Panel"><?php echo smarty_function_asset(array('name' => 'Panel'), $this);?>
</div>
  </div>
  <div id="Foot">
    <div><a href="<?php echo smarty_function_vanillaurl(array(), $this);?>
"><span>Powered by Vanilla</span></a></div>
    <?php echo smarty_function_asset(array('name' => 'Foot'), $this);?>

 </div>
</div>

</body>
</html>