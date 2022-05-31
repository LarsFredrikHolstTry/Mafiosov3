<?php

include_once '../../functions/env.php';
include_once '../../env.php';

/**
 *
 * Choose language to display on mafioso
 * Available: no, en
 *
 */

$useLang = json_decode(file_get_contents('../../lang/' . $language . '/' . $language . '.json'));
$sidebarConfig = json_decode(file_get_contents('../../lang/' . $language . '/sidebar-config-' . $language . '.json'))->sidebarConfig;
$userMenu = json_decode(file_get_contents('../../lang/' . $language . '/user-menu-' . $language . '.json'))->userMenu;
$userMenuOther = json_decode(file_get_contents('../../lang/' . $language . '/user-menu-' . $language . '.json'))->otherActions;
