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



    public function insert(string $table, array $data)
    {

        if ($this->CheckTable($table)) {
        //    insert query 
        $this->query = "INSERT INTO `{$table}`";


        }


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

?>