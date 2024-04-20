<?php 

include("../include/dbConfig.php");

// print_r( $_POST);
if(isset($_POST['catalog'])){
    // $output["result"] = array();
    // echo "SELECT * FROM statements WHERE user_id = ".$_GET['uid']." AND label_name ='".$_GET['label']."' ORDER BY year DESC"; die();
    $query = $db->query("SELECT * FROM releases WHERE user_id = ".$_POST['user_id']." AND status ='draft' LIMIT 1");
    
    
    if(mysqli_num_rows($query) > 0 ){
        echo 'in if';
        while($row = $query->fetch_assoc()) {
            print_r($row);
            $release_meta_enc = json_decode($row['release_meta'], true);
            // Modify the 'catalog' key in the decoded JSON data
            $release_meta_enc['catalog'] = mysqli_real_escape_string($db, $_POST['catalog']);
            // Encode the modified data back to JSON format
            $release_meta_enc = json_encode($release_meta_enc);
        
            // Update the 'release_meta' field in the 'releases' table
            // $query1 = "UPDATE releases SET release_meta = '$release_meta_enc' WHERE rid = ".$row['rid']; 
        
            // Execute the update query
            // if(mysqli_query($db, $query1)) {
            //     echo 'save';
            // } else {
            //     // Handle query execution errors
            //     echo "Error updating record: " . mysqli_error($db);
            // }
        }

    }else{

        echo 'else';
        
        $release_uid = uniqid('r_', true);
        $data['catalog'] = $_POST['catalog'];
        $data = json_encode($data,true);

        if(mysqli_query($db, "INSERT INTO releases (rid,user_id, release_meta, created_at,status) VALUES ('$release_uid',".$_POST['user_id'].", '$data', '".date('Y-m-d h:i:s')."','draft' ) ")){
    
    }

    }




    // echo '<pre>';print_r($output);
    // echo json_encode($output, true);
}



?>