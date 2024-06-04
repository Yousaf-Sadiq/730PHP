<?php 

trait Insert{

 //  insert function-----------------------------------------------------
/* 

[
    "email"=>"value",
    "password=>"value" 
]

*/
public function insert(string $table, array $data)
{
    $status = [
        "error" => 0,
        "message" => "",
    ];

    if ($this->CheckTable($table)) {
        //    insert query 

        $this->query = "INSERT INTO `{$table}` ";




        // columns===================================================
        $col = array_keys($data); // array format 

        $col_string = "`" . implode("` , `", $col) . "`"; // array to string
        //============================╟=====================================    

        $this->query .= " ({$col_string})";

        //   values=========================
        $val = array_values($data);

        $val_string = " '" . implode("' , '", $val) . "'";
        //  ------------------------------------------------------- 
        $this->query .= "VALUES  ({$val_string})";


        //  ------------------------execution-------------------------------

        $this->exe = $this->conn->query($this->query);



        if ($this->exe) {

            if ($this->conn->affected_rows > 0) {

                $status["message"] = "Data has been inserted";

            } else {

                $status["message"] = "DATA HAS NOT BEEN INSERTED  {$this->query}";
                $status["error"]++;

            }

        } else {
            $status["error"]++;
            $status["message"] = "ERROR IN QUERY  {$this->query}";



        }




    }
    // if table is not exist 
    else {


        $status["error"]++;
        $status["message"] = "{$table} table is not exist in DB";


    }

    return json_encode($status);
}


}

?>