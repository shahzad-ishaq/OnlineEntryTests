<?php
if (isset($_POST['sessionsID'])) {
    require_once('./dbconnection.php');
    $sessionsID = $_POST['sessionsID'];
    $query = "SELECT sos.sos_name FROM  sos_type sos 
       INNER JOIN sessions se ON se.sos_type_id = sos.id
       WHERE se.id = '$sessionsID'";

    $sos_detail = mysqli_query($link, $query);
    $html = '';

    if (mysqli_num_rows($sos_detail)) {
        $row = mysqli_fetch_object($sos_detail);
        $html .= $row->sos_name;
    } else {
        $html = '<div class="col-md-4">Not Found</div>';
    }
    $link->close();
    echo json_encode(['detail'=>$html]);
}
?>
