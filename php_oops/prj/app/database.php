<?php
declare(strict_types=1);
namespace app\database;


class Mysqli
{
    private $host = "localhost";
    private $userName = "root";
    private $password = "";
    private $db = "php_oops_crud";


    protected $conn;


    private $query;
    private $exe;
    private $result = [];
    public function __construct()
    {

        try {
            $this->conn = new \mysqli($this->host, $this->userName, $this->password, $this->db);

            if ($this->conn) {
                // echo "established";
            } else {
                throw new \Exception("DATABASE CONNECTION ERROR");
            }

        } catch (\Throwable $th) {
            throw $th;
        }

    }



    //  insert function-----------------------------------------------------
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

    // ajax javascript fetch function 
// Rest full API's
    private function CheckTable(string $table)
    {
        $this->query = "SELECT * 
        FROM information_schema.tables
        WHERE table_schema = '{$this->db}' 
            AND table_name = '{$table}'
        LIMIT 1
        ";

        $this->exe = $this->conn->query($this->query);

        if ($this->exe->num_rows > 0) {
            return true;
        } else {
            return false;
        }
    }

}


class helper extends Mysqli
{

    public function pre(array $a)
    {
        echo "<pre>";
        print_r($a);
        echo "</pre>";

    }

    public function filterData(string $data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        $data = $this->conn->real_escape_string($data);
       
        return $data;
    }
}
?>