<?php
//
// PHASE: BOOTSTRAP
//
define('MOLLY_INSTALL_PATH', dirname(__FILE__));
define('MOLLY_SITE_PATH', MOLLY_INSTALL_PATH . '/site');

require(MOLLY_INSTALL_PATH.'/src/CMolly/bootstrap.php');

$my = CMolly::Instance();

//
// PHASE: FRONTCONTROLLER ROUTE
//
$my->FrontControllerRoute();

//
// PHASE: THEME ENGINE RENDER
//
$my->ThemeEngineRender();
