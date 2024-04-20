<?php
session_start();
// unset($_SESSION["draft_id"]);  
include ("../include/dbConfig.php");
// echo '<pre>';
// print_r($_POST['data']);
// die();
// error_reporting(E_ALL);
// ini_set("display_errors", 1);
function create_draft_release($db)
{

    //    mysqli_query($db, "DELETE FROM releases WHERE status = 'draft' AND user_id = '".$_SESSION['login_userid']."' AND created_at = '".date("Y-m-d")."' ");



    $release_id_verify_unique == false;
    $release_uid = uniqid('r_', true);
    // echo $release_uid;
    while ($release_id_verify_unique == false) {
        $query = $db->query("SELECT * FROM releases WHERE rid = '$release_uid'");
        if (mysqli_num_rows($query) != 0) {
            $release_uid = uniqid('r_', true);
        } else {
            $release_id_verify_unique = true;
        }

    }

    mysqli_query($db, "INSERT INTO releases (rid, status, user_id) VALUES ('" . $release_uid . "', 'draft', " . $_SESSION['login_userid'] . ")");
    // echo "INSERT INTO releases (rid, status, user_id) VALUES ('".$release_uid."', 'draft', ".$_SESSION['login_userid'].")";
    $_SESSION['draft_rid'] = $release_uid;
    return $release_uid;
}

// echo '<pre>';
// print_r($_POST);
// print_r($_GET);
// print_r($_REQUEST);
// print_r($_FILES);


function getUserFormData($postVal)
{
    $formParamsArr = explode("&", $postVal);
    $submittedData = array_map(function ($item) {
        $itemdata = explode("=", $item);
        return array (
            $itemdata[0] => $itemdata[1]
        );
    }, $formParamsArr);

    // print_r($submittedData);
    $formdata = [];

    foreach ($submittedData as $form => $dataArr) {

        foreach ($dataArr as $index => $value) {
            $index = urldecode($index);
            if (array_key_exists($index, $formdata)) {
                if (gettype($formdata[$index]) == 'string') {
                    $value_array = [];
                    array_push($value_array, $formdata[$index], $value);
                    // $formdata[$index] = json_encode($value_array);
                    $formdata[$index] = $value_array;
                    // print_r($formdata[$index]);
                    // array_push($value_array,$formdata[$index],$value);
                } else {
                    array_push($formdata[$index], $value);
                }
            } else {
                $formdata[$index] = gettype($value) == 'string' ? stripcslashes(urldecode($value)) : stripslashes($value);
            }
        }
    }
    return $formdata;
}

// function update_url_decoded_keys($array)
// {
//     $updated_array = [];
//     foreach ($array as $key => $value) {

//         $updated_array = array_merge($updated_array, [urldecode($key) => urldecode($value)]);
//     }
//     return $updated_array;
// }

function update_url_decoded_keys($array)
{
    $updated_array = [];
    foreach ($array as $key => $value) {
        // If the value is an array, recursively update its keys
        if (is_array($value)) {
            $value = update_url_decoded_keys($value);
        }
        // Decode both key and value and add to the updated array
        $updated_array[urldecode($key)] = is_array($value) ? $value : stripslashes(urldecode($value));
    }
    return $updated_array;
}

if (!isset($_POST['cover_upload'])) {


    //  print_r($data);
    $rid = '';
    // echo $_SESSION['draft_rid'];
    $new_entry = False;
    // echo 'test';
    // if(!isset($_SESSION['draft_rid'])){
    //     $rid = create_draft_release($db);
    // } else {
    //     $rid = $_SESSION['draft_rid'];  
    // }
    if (!isset($_SESSION['draft_rid']) || $_SESSION['draft_rid'] == '') {
        $query = $db->query("SELECT * FROM releases WHERE user_id = " . $_SESSION['login_userid'] . " AND status ='draft' LIMIT 1");
        if (mysqli_num_rows($query) > 0) {
            while ($row = $query->fetch_assoc()) {
                $rid = $row['rid'];
            }
        } else {
            $rid = uniqid('r_', true);
            $new_entry = True;
        }
        $_SESSION['draft_rid'] = $rid;

        // $rid = create_draft_release($db);
    } else {
        $rid = $_SESSION['draft_rid'];

    }

    // echo $_SESSION['draft_rid'];
    $release_uid = $rid;
    $post_data = $_POST['data'];
    // echo $rid;

    $formdata = getUserFormData($post_data);
    
    print_r($formdata);
    // echo $new_entry;
    $formdata = update_url_decoded_keys($formdata);

    $data = json_encode($formdata, true);
    print_r($data);
    echo 'new entry';
    // echo $release_uid;

    // echo $new_entry;
    if ($new_entry) {
        echo 'if';
        mysqli_query($db, "INSERT INTO releases (rid,user_id, release_meta, created_at,status) VALUES ('$release_uid'," . $_SESSION['login_userid'] . ", '$data', '" . date('Y-m-d h:i:s') . "','draft' ) ");
        echo $new_entry;
    } else {
        echo 'else';

        $query = mysqli_query($db, "UPDATE releases SET release_meta = '" . $data . "', status='draft'  WHERE rid = '" . $release_uid . "' ");
    }

    // if(mysqli_query($db, "INSERT INTO releases (rid,user_id, release_meta, created_at) VALUES ('$release_uid',".$_SESSION['login_userid'].", '$data', '".date('Y-m-d h:i:s')."' ) ")){
    //     // echo 'done';
    // }
    if (isset($_POST['track_name'])) {
        for ($i = 0; $i <= count($_POST['track_name']); $i++) {
            mkdir($dir . $release_uid . "/", 0777, true);
            chmod($dir . $release_uid . "/", 0777);
            // $fileExt = explode('.',$_FILES['track_audio_file']['name'][$i]);
            $fileActualExt = strtolower(end($fileExt));
            $audio_path = $dir . $release_uid . "/" . $_POST['catalog'] . "_" . ($i + 1) . "." . $fileActualExt;

            // if(move_uploaded_file($_FILES['track_audio_file']['tmp_name'][$i], $audio_path)){
            $song_name = isset($_POST['track_name'][$i]) ? $_POST['track_name'][$i] : "";
            $mix_version = isset($_POST['track_mix_version'][$i]) ? $_POST['track_mix_version'][$i] : "";
            $primary_artist = isset($_POST['track_primary_artist'][$i]) ? implode(",", $_POST['track_primary_artist'][$i]) : "";
            $featuring = isset($_POST['track_featuring'][$i]) ? implode(",", $_POST['track_featuring'][$i]) : "";
            $remixer = isset($_POST['track_remixer'][$i]) ? implode(",", $_POST['track_remixer'][$i]) : "";
            $composer = isset($_POST['track_composer'][$i]) ? $_POST['track_composer'][$i] : "";
            $primary_genre = isset($_POST['track_main_genre'][$i]) ? $_POST['track_main_genre'][$i] : "";
            $secondary_genre = isset($_POST['track_genre'][$i]) ? $_POST['track_genre'][$i] : "";
            $recording_year = isset($_POST['track_recording_year'][$i]) ? $_POST['track_recording_year'][$i] : "";
            $country_recording = isset($_POST['track_country_recording'][$i]) ? $_POST['track_country_recording'][$i] : "";
            $isrc_code = isset($_POST['track_i_s_r_c_code'][$i]) ? $_POST['track_i_s_r_c_code'][$i] : "";
            $price_tier = isset($_POST['track_price_tier'][$i]) ? $_POST['track_price_tier'][$i] : "";
            $album_only = isset($_POST['track_album_only'][$i]) ? $_POST['track_album_only'][$i] : "";
            $vocals = isset($_POST['track_vocals'][$i]) ? $_POST['track_vocals'][$i] : "";
            $explicit_status = isset($_POST['track_explicit_status'][$i]) ? $_POST['track_explicit_status'][$i] : "";
            $vocal_lang = isset($_POST['track_vocal_language'][$i]) ? $_POST['track_vocal_language'][$i] : "";



            $query = $db->query("SELECT * FROM tracks WHERE rid = '" . $release_uid . "' AND file_id = '" . ($i + 1) . "' ");

            if (mysqli_num_rows($query) != 0) {

                $query = "UPDATE tracks SET
                            
                             `track_song_name` = '$song_name',
                              `track_mix_version`=   '$mix_version',
                               `track_primary_artist` = '$primary_artist', 
                                `track_featuring` =  '$featuring',
                                `track_remixer` = '$remixer',
                                `track_contributor` = '$composer',
                                `track_primary_genre` =  '$primary_genre',
                                `track_secondary_genre` = '$secondary_genre',
                                `track_recording_year` =  '$recording_year',
                                `track_country_recording`= '$recording_year',
                                `track_isrc_code` = '$isrc_code',
                                `track_price_tier`= '$price_tier',
                                `track_album_only`=  '$album_only',
                                `track_vocals`= '$vocals',
                                `track_explicit_status`= '$explicit_status',
                                `track_vocal_lang`=  '$vocal_lang'
                                
                                WHERE rid = '" . $release_uid . "' 
                             
                            ";

            } else {

                $query = "INSERT INTO `tracks`
                                            (
                                                `rid`,
                                                `track_audio_file`,
                                                `track_song_name`,
                                                `track_mix_version`,
                                                `track_primary_artist`,
                                                `track_featuring`,
                                                `track_remixer`,
                                                `track_contributor`,
                                                `track_primary_genre`,
                                                `track_secondary_genre`,
                                                `track_recording_year`,
                                                `track_country_recording`,
                                                `track_isrc_code`,
                                                `track_price_tier`,
                                                `track_album_only`,
                                                `track_vocals`,
                                                `track_explicit_status`,
                                                `track_vocal_lang`,
                                                `created_at`
                                            )
                                            VALUES(
                                                '$release_uid', 
                                                '$audio_path', 
                                                '$song_name',
                                                '$mix_version', 
                                                '$primary_artist', 
                                                '$featuring',
                                                '$remixer',
                                                '$composer',
                                                '$primary_genre',
                                                '$secondary_genre',
                                                '$recording_year',
                                                '$country_recording',
                                                '$isrc_code',
                                                '$price_tier',
                                                '$album_only',
                                                '$vocals',
                                                '$explicit_status',
                                                '$vocal_lang',
                                                '" . date('Y-m-d h:i:s') . "'
                                            )";
            }

            // echo $query;
            if (mysqli_query($db, $query)) {
                $success = true;
                echo 'done';
            }

            // echo 'Done: '.$_FILES['track_audio_file']['name'][$i];
            // }


        }
    }


}


if (isset($_POST['cover_upload'])) {

    $rid = '';
    // echo 'test';
    if (!isset($_SESSION['draft_rid'])) {
        $rid = create_draft_release($db);
    } else {
        $rid = $_SESSION['draft_rid'];
    }


    $release_uid = $rid;
    $dir = "../releases/";
    $post_data = array();
    mkdir($dir . $release_uid, 0777, true);
    chmod($dir . $release_uid, 0777);
    $file = $_FILES['cover_art'];
    //Getting the file name of the uploaded file
    $fileName = $_FILES['cover_art']['name'];
    //Getting the Temporary file name of the uploaded file
    $fileTempName = $_FILES['cover_art']['tmp_name'];
    //Getting the file size of the uploaded file
    $fileSize = $_FILES['cover_art']['size'];
    //getting the no. of error in uploading the file
    $fileError = $_FILES['cover_art']['error'];
    //Getting the file type of the uploaded file
    $fileType = $_FILES['cover_art']['type'];

    //Getting the file ext
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    //Array of Allowed file type
    $allowedExt = array("jpg", "jpeg", "png", "pdf");
    if ($_FILES['cover_art']['name'] != "") {
        //Checking, Is file extentation is in allowed extentation array
        if (in_array($fileActualExt, $allowedExt)) {
            //Checking, Is there any file error
            if ($fileError == 0) {
                //Checking,The file size is bellow than the allowed file size
                if ($fileSize < 10000000) {
                    //Creating a unique name for file
                    if ($_FILES["cover_art"]["name"] != "") {
                        $fileNemeNew = $_POST['catalog'] . "." . $fileActualExt;
                        mkdir($dir . $release_uid . '/', 0777, true);
                        chmod($dir . $release_uid . '/', 0777);
                        $path = $dir . $release_uid . '/';
                        //File destination
                        $fileDestination = $path . $fileNemeNew;
                        //function to move temp location to permanent location
                        if (move_uploaded_file($fileTempName, $fileDestination)) {

                            $post_data['cover_art'] = $fileNemeNew;
                            // echo "File Uploaded successfully";
                        } else {
                            echo json_encode(array("error" => "File Uploaded Error"));
                            exit;
                        }
                    } else {
                        $post_data['cover_art'] = null;
                    }
                    //Message after success

                } else {
                    //Message,If file size greater than allowed size
                    echo json_encode(array("error" => "File too large"));
                    exit;
                }
            } else {
                //Message, If there is some error
                echo json_encode(array("error" => "Something Went Wrong Please try again!"));
                exit;
            }
        } else {
            //Message,If this is not a valid file type
            $errormsg = "You can't upload this extention of file";
            $error = true;
        }
    }
    // unset($post_data['create']);
    // unset($post_data['track_song_name']);
    // unset($post_data['track_mix_version']);

    // echo '<pre>';
    $_SESSION['cover_art'] = $fileNemeNew;
    //  echo '<pre>';
    //  print_r($_SESSION);
    echo json_encode(array("rid" => $rid, "cover_art" => $fileNemeNew));
    exit;
}


if (isset($_FILES['track_file'])) {

    $rid = '';
    // echo 'test';
    if (!isset($_SESSION['draft_rid'])) {
        $rid = create_draft_release($db);
    } else {
        $rid = $_SESSION['draft_rid'];
    }
    echo $rid;

    $release_uid = $rid;
    $dir = "../releases/";
    $post_data = array();
    mkdir($dir . $release_uid, 0777, true);
    chmod($dir . $release_uid, 0777);

    $file_id = $_POST['file_id'];
    $file = $_FILES['track_file'];
    //Getting the file name of the uploaded file
    $fileName = $_FILES['track_file']['name'];
    //Getting the Temporary file name of the uploaded file
    $fileTempName = $_FILES['track_file']['tmp_name'];
    //Getting the file size of the uploaded file
    $fileSize = $_FILES['track_file']['size'];
    //getting the no. of error in uploading the file
    $fileError = $_FILES['track_file']['error'];
    //Getting the file type of the uploaded file
    $fileType = $_FILES['track_file']['type'];

    //Getting the file ext
    $fileExt = explode('.', $fileName);
    $fileActualExt = strtolower(end($fileExt));

    //Array of Allowed file type
    $allowedExt = array("jpg", "jpeg", "png", "pdf");
    if ($_FILES['track_file']['name'] != "") {
        //Checking, Is file extentation is in allowed extentation array
        // if(in_array($fileActualExt, $allowedExt)){
        //Checking, Is there any file error
        if ($fileError == 0) {
            //Checking,The file size is bellow than the allowed file size
            // if($fileSize < 10000000){
            //Creating a unique name for file
            if ($_FILES["track_file"]["name"] != "") {
                $fileNemeNew = $_POST['catalog'] . "." . $fileActualExt;
                mkdir($dir . $release_uid . '/', 0777, true);
                chmod($dir . $release_uid . '/', 0777);
                $path = $dir . $release_uid . '/';
                //File destination
                $fileDestination = $path . $fileNemeNew;
                $audio_path = $dir . $release_uid . "/" . $_POST['catalog'] . "_" . $file_id . "." . $fileActualExt;
                //function to move temp location to permanent location
                if (move_uploaded_file($_FILES['track_file']['tmp_name'], $audio_path)) {


                    $query = $db->query("SELECT * FROM tracks WHERE rid = '" . $release_uid . "' AND file_id = '" . $file_id . "' ");

                    if (mysqli_num_rows($query) == 0) {

                        $query = "INSERT INTO `tracks` (  `rid`, `track_audio_file`, `file_id`,`created_at` )VALUES('$release_uid', '$audio_path', '$file_id','" . date('Y-m-d h:i:s') . "' )";
                    } else {
                        $query = "UPDATE tracks SET track_audio_file = '$audio_path' WHERE file_id = '$file_id' AND rid = '$release_uid'";
                    }
                    echo $query;
                    if (mysqli_query($db, $query)) {
                        echo json_encode(array("rid" => $rid, "track_file" => $fileNemeNew));
                        exit;
                    }

                    // echo "File Uploaded successfully";
                } else {
                    echo json_encode(array("error" => "File Uploaded Error"));
                    exit;
                }
            } else {
                $post_data['track_file'] = null;
            }
            //Message after success

            // }else{
            //     //Message,If file size greater than allowed size
            //     echo json_encode(array("error"=> "File too large"));
            //     exit;
            // }
        } else {
            //Message, If there is some error
            echo json_encode(array("error" => "Something Went Wrong Please try again!"));
            exit;
        }
        // }else{
        //     //Message,If this is not a valid file type
        //     $errormsg = "You can't upload this extention of file";
        //     $error = true;
        // }
    }
    // unset($post_data['create']);
    // unset($post_data['track_song_name']);
    // unset($post_data['track_mix_version']);

    // echo '<pre>';


}



?>