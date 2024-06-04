<?php
declare(strict_types=1);
namespace app\database;



require_once dirname(__FILE__) . "/trait/insert.php";
require_once dirname(__FILE__) . "/trait/mysql.php";
require_once dirname(__FILE__) . "/trait/checkTable.php";

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



    use \Insert, \Mysql, \CheckTable;



    public function __destruct()
    {
        $this->conn->close();
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