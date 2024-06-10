<?php
use app\database\helper as help;

trait MySelect
{

    public function select(string $table, string $row = null, string $where = null, string $orderBy = null, string $limit = null)
    {
        $help = new help();
       

        if ($this->CheckTable($table)) {


            if ($row == null) {
                $row = "*";
            }

            $this->query = "SELECT {$row} FROM `{$table}`";


            if ($where != null) {
                $this->query .= " WHERE {$where}";
            }


            if ($orderBy != null) {
                $this->query .= "  ORDER BY {$orderBy}";
            }


            if ($limit != null) {
                $this->query .= "  LIMIT {$limit}";
            }

            $this->exe = $this->conn->query($this->query);

            if ($this->exe) {
                return true;
            } else {
                return false;
            }


        } else {
            $help->showmsg("THIS {$table} table is not existed", "danger");
        }
    }
}


?>