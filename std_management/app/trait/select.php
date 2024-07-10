<?php
use app\database\helper as help;

trait MySelect
{

    public function select(string $table, string $row = null, string $join=null ,string $where = null, string $orderBy = null, string $limit = null)
    {
        $help = new help();
        /**
         * SELECT * FROM table_name
         * SELECT name, email FROM table_name WHERE condition 
         * SELECT name FROM table_name  WHERE condition  orderby DESC/ASC
         * SELECT email FROM table_name  WHERE condition  LIMIT 10 offset 5 orderby id DESC/ASC
         */

        if ($this->CheckTable($table)) {


            if ($row == null) {
                $row = "*";
            }

            $this->query = "SELECT {$row} FROM `{$table}`";

            if ($join != null) {
                $this->query .= " {$join} ";
            }

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
            $help->showMessage("THIS {$table} table is not existed", "danger");
        }
    }
}


?>