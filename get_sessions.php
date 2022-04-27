<?php
require_once('functions.php');

if (isset($_POST['campusCode']) && is_numeric($_POST['campusClassID'])) {

    echo json_encode(['sessions' => get_sessions(trim($_POST['campusCode']), trim($_POST['campusClassID']))]);
}
