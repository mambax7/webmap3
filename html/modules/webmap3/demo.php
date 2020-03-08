<?php
// $Id: demo.php,v 1.3 2012/04/10 00:45:47 ohwada Exp $

// 2012-04-02 K.OHWADA
// api_map.php -> api.php

//=========================================================
// webmap3 module
// 2012-03-01 K.OHWADA
//=========================================================

require '../../mainfile.php';

include XOOPS_ROOT_PATH . '/header.php';
echo "<h3 align='center'>Google Maps V3</h3>\n";
echo "<a href='index.php'>[Webmap3 Top]</a>\n";
echo "<h4>Demonstration of Function Call</h4>\n";

// === map start ===
$MY_DIRNAME = basename(__DIR__);
require XOOPS_ROOT_PATH . '/modules/' . $MY_DIRNAME . '/include/api.php';
$map_class = webmap3_api_map::getSingleton($MY_DIRNAME);
$map_class->init();
$map_class->set_map_size(640, 480);

// Yokohama Station
$map_class->set_map_center(35.4661880, 139.6227150, 11);

$map_class->add_marker(35.5334203, 139.7078576, 'Kawasaki Station');
$map_class->add_marker(35.4661880, 139.6227150, 'Yokohama Station');
$map_class->add_marker(35.4005823, 139.5339342, 'Totsuka Station');
echo $map_class->build_simple_map();
// === ,ap end ===

include(XOOPS_ROOT_PATH . '/footer.php');
