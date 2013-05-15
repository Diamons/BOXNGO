<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different urls to chosen controllers and their actions (functions).
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Config
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 */
/**
 * Here, we are connecting '/' (base path) to controller called 'Pages',
 * its action called 'display', and we pass a param to select the view file
 * to use (in this case, /app/View/Pages/home.ctp)...
 */

	Router::connect('/', array('controller' => 'pages', 'action' => 'display', 'home'));
/**
 * ...and connect the rest of 'Pages' controller's urls.
 */
	Router::connect('/dashboard', array('controller' => 'dashboards'));
	Router::connect('/dashboard/:action/*', array('controller' => 'dashboards'));
	Router::connect('/search', array('controller' => 'searches'));
	Router::connect('/search/:action/*', array('controller' => 'searches'));
	Router::connect('/api/:action/*', array('controller' => 'apis'));
	Router::connect('/admin', array('controller' => 'admins'));
	Router::connect('/admin/:action/*', array('controller' => 'admins'));
	Router::connect('/info/*', array('controller' => 'pages', 'action' => 'display'));
	Router::connect('/schools/*', array('controller' => 'schools', 'action' => 'index'));
	Router::connect('/browse/*', array('controller' => 'searches', 'action' => 'browse'));
/**
 * Load all plugin routes.  See the CakePlugin documentation on
 * how to customize the loading of plugin routes.
 */
	CakePlugin::routes();
	Router::parseExtensions('rss');
	Router::parseExtensions('pdf');

/**
 * Load the CakePHP default routes. Only remove this if you do not want to use
 * the built-in default routes.
 */
	require CAKE . 'Config' . DS . 'routes.php';
