<?php

$link = mysqli_connect('localhost', 'root', '', 'databasename');
if (!$link) {
    die('Connect Error (' . mysqli_connect_errno() . ') '
            . mysqli_connect_error());
}

mysqli_get_host_info($link);

?>
