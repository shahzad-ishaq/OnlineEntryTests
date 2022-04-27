<?php
function get_classes($instituteID, $campusCode,$class_field) {
    require_once('./dbconnection.php');

    $html = '';
    $query = "SELECT DISTINCT `campus_classes`.`id` as `campus_class_id`, `classes`.`id` as `class_id`, `classes`.`class_name`
        FROM `campus_classes`, `classes`,`sessions`
        WHERE `campus_classes`.`institute_id` = '$instituteID'
        AND `campus_classes`.`campus_code` = '$campusCode'
        AND `campus_classes`.`class_id` = classes.id
        AND sessions.class_id = campus_classes.id
        AND `campus_classes`.`status` = 'Active' 
        AND	sessions.online_status = '1' AND classes.class_field='$class_field' AND sessions.session_end_date > CURDATE() 
        AND DATE(NOW()) <= DATE(sessions.online_expiry_date) group by campus_classes.class_id ORDER BY class_id ASC ";


    $classes = mysqli_query($link, $query);

    if (mysqli_num_rows($classes)) {
       $i=0;
        while ($class = mysqli_fetch_object($classes)) {
            /*$html .= '<option value="' . $class->class_id  . '" campus_class_id="' . $class->campus_class_id . '">' . $class->class_name . '</option>';*/
            $html .= '<a class="link"><div class="courses" id="courses'.$i.'" onclick="get_sessions(this)"><label><input type="radio" name="classes" campus_class_id="' . $class->campus_class_id . '" value="' . $class->class_id  . '"><h5 >' . $class->class_name . '</h5></label></div></a>';
            $i++;
        }
    } else {
        $html = '<a class="link"><div class="courses selectedClass"><label><h5 >No Class Found</h5></label></div></a>';
    }
    $link->close();

    return $html;
}


function get_sessions($campusCode, $campusClassID) {
    require_once('./dbconnection.php');
    $query = "SELECT
	sessions_title AS title, 
	COUNT(admissions_ec.session_id) as session_count,
	sessions.*
	FROM	sessions
	INNER JOIN	campus_classes ON sessions.class_id = campus_classes.id
	INNER JOIN classes	ON campus_classes.class_id = classes.id
	LEFT JOIN admissions_ec ON	sessions.id = admissions_ec.session_id
    WHERE
	sessions.campus_code = '$campusCode' AND campus_classes.id = $campusClassID AND
	sessions.`status` = 'Active' AND campus_classes.`status` = 'Active' AND
	sessions.online_status = '1' AND sessions.session_end_date > CURDATE() AND DATE(NOW()) <= DATE(sessions.online_expiry_date)
	GROUP BY sessions.id
	having session_count < sessions.max_enroll_limit";
    $sessions = mysqli_query($link, $query);
    $html = '';

    if (mysqli_num_rows($sessions)) {
        $html = '<option value="">Select Session</option>';
        while ($session = mysqli_fetch_object($sessions)) {
            $sessionID = $session->id;
            $result = $link->query("SELECT id FROM admissions_ec WHERE session_id = '$sessionID'");
            if($result->num_rows < $session->max_enroll_limit) {
                $html .= '<option value="' . $session->id . '">' . $session->title . '</option>';
            }else{

            }
        }
    } else {
        $html = '<option value="">No Sessions found</option>';
    }

    $link->close();
    return $html;

}
function get_groups($ClassID) {
    require_once('./dbconnection.php');

    $query = "SELECT `id`, `class_group_title` AS title
        FROM `class_groups` 
        WHERE `class_id` = $ClassID
        AND `status`='Active' 
        ORDER BY `id` DESC
        ";

    $sessions = mysqli_query($link, $query);
    $html = '';

    if (mysqli_num_rows($sessions)) {
        $i=0;

        while ($groups = mysqli_fetch_object($sessions)) {
            /*$html .= '<option value="' . $groups->id . '">' . $groups->title . '</option>';*/
            $html .= '<a class="link"><div class="groups" id="groups'.$i.'" onclick="check_group(this)"><label><input type="radio" name="groups" value="' . $groups->id . '"><h5 >' . $groups->title . '</h5></label></div></a>';
            $i++;
        }
    } else {
        $html = '<a class="link"><div class="groups selectedClass"><label><h5 >No Class Found</h5></label></div></a>';
    }

    $link->close();
    return $html;
}
function get_campuses($cityID = '', $instituteId = '') {

    require_once('./dbconnection.php');
    $campus_html = '';
    $query = "SELECT cam.*
               FROM  campuses cam 	
               where cam.status = 'Active' AND  type_id =2 AND";
    if ($cityID != '' && $instituteId != '') {
        $query .= " cam.city_id = $cityID AND cam.institute_id = $instituteId ";
    } else if (!empty($cityID)) {
        $query .= " cam.city_id = $cityID";
    } else if ($instituteId != '') {
        $query .= " cam.institute_id = $instituteId ";
    }
    $query .= "  GROUP BY cam.campus_code ORDER BY cam.campus_calling_name ASC";
    ///echo $query;
    $campuses = mysqli_query($link, $query);

    if (mysqli_num_rows($campuses)) {
        while ($campus = mysqli_fetch_object($campuses)) {
            $campus_html .= '<option value="' . $campus->campus_code .
                '" campus_id="' . $campus->id .
                '" campus_name="' . $campus->campus_calling_name . '">' . $campus->campus_calling_name . '</option>';
        }
    } else {
        $campus_html .= '<option value="">No matching record(s) found!</option>';
    }

    $link->close();
    return $campus_html;
}