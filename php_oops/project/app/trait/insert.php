<?php 

trait Insert{


public function insert(string $table, array $data)
{
    $status = [
        "error" => 0,
        "message" => "",
    ];

    if ($this->CheckTable($table)) {
      

        $this->query = "INSERT INTO `{$table}` ";




       
        $col = array_keys($data); 

        $col_string = "`" . implode("` , `", $col) . "`"; 
          

        $this->query .= " ({$col_string})";

       
        $val = array_values($data);

        $val_string = " '" . implode("' , '", $val) . "'";
        
        $this->query .= "VALUES  ({$val_string})";



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
  
    else {


        $status["error"]++;
        $status["message"] = "{$table} table is not exist in DB";


    }

    return json_encode($status);
}


}

?>