<?php
require_once('functions.php');

if (is_numeric($_POST['instituteID'])) {

  echo json_encode(['classes' => get_classes(trim($_POST['instituteID']), trim($_POST['campusCode']), trim($_POST['class_field']))]);
}
