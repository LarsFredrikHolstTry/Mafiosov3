<?php

/**
 *
 * Choose language to display on mafioso
 * Available: no, en
 *
 */
$language = 'no';

$useLang = json_decode(file_get_contents('../../lang/' . $language . '/' . $language . '.json'));
$sidebarConfig = json_decode(file_get_contents('../../lang/' . $language . '/sidebar-config-' . $language . '.json'))->sidebarConfig;
$userMenu = json_decode(file_get_contents('../../lang/' . $language . '/user-menu-' . $language . '.json'))->userMenu;
