<?php

include("../include/dbConfig.php");

if(isset($_GET['id'])){
    // echo json_encode($_GET['id']);
    $temp_data["result"] = array();
    $count = 1;
    $get_user_query = $db->query("SELECT * FROM label_profiles WHERE label_id = ".$_GET['id']);
    if(mysqli_num_rows($get_user_query)!=0){
        
        if(mysqli_query($db, "DELETE FROM label_profiles WHERE label_id = ".$_GET['id'])){
            $temp_data["result"] = array(
                "removed_records" => mysqli_num_rows($get_user_query)
            );
        } else {
            $temp_data["result"] = array(
                "error" => "Error in query"
            );
        }
     
    } else {
        $temp_data["result"] = array(
            "error" => "Invalid User ID"
        );
    }
} else {
    $temp_data["error"] = array("type"=>"invalid parameters request");
    
}
echo json_encode($temp_data);
?>