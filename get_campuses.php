<?php
require_once('functions.php');

if (is_numeric($_POST['institute_id'])) {
if(isset($_POST['cityID'])) {
    echo $cityID = trim($_POST['cityID']);
}else{
    $cityID='';
}

    echo json_encode(['campuses' => get_campuses($cityID, trim($_POST['institute_id']))]);

}