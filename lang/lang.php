<?php

/**
 *
 * Choose language to display on mafioso
 * Available: no, en
 *
 */
$language = 'en';

// Norsk
$lang = file_get_contents('../../lang/' . $language . '.json');


$useLang = json_decode($lang);
