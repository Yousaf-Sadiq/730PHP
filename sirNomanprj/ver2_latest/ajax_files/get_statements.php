<?php 

include("../include/dbConfig.php");

if(isset($_GET['label'])){
    $output["result"] = array();
    // echo "SELECT * FROM statements WHERE user_id = ".$_GET['uid']." AND label_name ='".$_GET['label']."' ORDER BY year DESC"; die();
    $query = $db->query("SELECT * FROM statements WHERE user_id = ".$_GET['uid']." AND label_name ='".$_GET['label']."' ORDER BY year DESC");
    
    while($row = $query->fetch_assoc()) {
        array_push($output["result"], array(
                    "label_name" => $row['label_name'],
                    "earnings" => $row['earnings'],
                    "year" => $row['year'],
                    "month" => date('F', strtotime($row['month']))
                    
                    ));
          
    }
    // echo '<pre>';print_r($output);
    echo json_encode($output, true);
}



?>