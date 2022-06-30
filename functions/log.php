<?php

include '../db/PDODB.php';

function action_to_log($acc_id, $city, $page, $action, $date)
{
    $myObj = new stdClass();
    $myObj->id = $acc_id;
    $myObj->city = $city;
    $myObj->page = $page;
    $myObj->action = $action;
    $myObj->date = $date;

    $myJSON = json_encode($myObj);
}
