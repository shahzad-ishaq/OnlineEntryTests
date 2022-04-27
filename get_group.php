<?php
require_once('functions.php');

if (is_numeric($_POST['ClassID'])) {

    echo json_encode(['groups' => get_groups(trim($_POST['ClassID']))]);
}
