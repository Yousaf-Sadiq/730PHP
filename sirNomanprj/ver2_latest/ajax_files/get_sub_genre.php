<?php
session_start();
include ("../include/dbConfig.php");
$query = $db->query("SELECT * FROM releases WHERE user_id = " . $_SESSION['login_userid'] . " AND status ='draft' LIMIT 1");
// var_dump(mysqli_num_rows($query));
// die();
$draft_data = "";


if (isset($_GET['main_genre'])) {
    $index = $_GET["count"];
    // $output["result"] = array();
    if (mysqli_num_rows($query) > 0) {
        $row = $query->fetch_assoc();
        $draft_data = json_decode($row['release_meta'], true);

    } else {
        $draft_data = null;

    }

    // echo "SELECT * FROM main_genre WHERE title = '".$_GET['main_genre']."' LIMIT 1";
    // die();
    $query = $db->query("SELECT * FROM main_genre WHERE title = '" . $_GET['main_genre'] . "' LIMIT 1");
    $main_id = 0;
    while ($row = $query->fetch_assoc()) {
        $main_id = $row['genre_id'];
    }
    // echo "SELECT * FROM statements WHERE user_id = ".$_GET['uid']." AND label_name ='".$_GET['label']."' ORDER BY year DESC"; die();
    $query = $db->query("SELECT * FROM sub_genre WHERE main_id = '" . $main_id . "' ORDER BY title DESC");
    // echo "SELECT * FROM sub_genre WHERE main_id = '".$main_id."' ORDER BY title DESC"; die();
    $output = '';
    while ($row = $query->fetch_assoc()) {
        // array_push($output["result"], array(
        //             "label_name" => $row['label_name'],
        //             "earnings" => $row['earnings'],
        //             "year" => $row['year'],
        //             "month" => date('F', strtotime($row['month']))
        if ($draft_data != null) {

            if ($index == "genre") {
                if ($draft_data["genre"] == $row['title']) {
                    # code...
                    $output .= '<option selected value="' . $row['title'] . '">' . $row['title'] . '</option>';
                } else {
                    $output .= '<option value="' . $row['title'] . '">' . $row['title'] . '</option>';

                }
            } else {


                if ($draft_data["track_genre[]"][$index] == $row['title']) {
                    # code...
                    $output .= '<option selected value="' . $row['title'] . '">' . $row['title'] . '</option>';
                } else {
                    $output .= '<option value="' . $row['title'] . '">' . $row['title'] . '</option>';

                }

            }

        } else {

            $output .= '<option value="' . $row['title'] . '">' . $row['title'] . '</option>';
        }
        //             ));
    }
    echo $output;
    // echo '<pre>';print_r($output);
    // echo json_encode($output, true);
}



?>