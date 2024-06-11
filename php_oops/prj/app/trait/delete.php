<?php

trait DELETES
{

    public function delete(string $table, string $where)
    {
        $status = [
            "error" => 0,
            "msg" => "",
        ];

        if ($this->CheckTable($table)) {


            $this->query = "DELETE FROM `{$table}` WHERE {$where}";

            $this->exe = $this->conn->query($this->query);

            if ($this->exe) {

                if ($this->conn->affected_rows > 0) {
                    $status["msg"] = "DATA HAS BEEN DELETED";

                } else {
                    $status["error"]++;
                    $status["msg"] = "DATA HAS NOT BEEN DELETED  {$this->query}";
                }
            } else {
                $status["error"]++;
                $status["msg"] = "ERROR IN QUERY  {$this->query}";
            }

        } else {
            $status["error"]++;
            $status["msg"] = "{$table} table is not exist in DB";

        }


        return json_encode($status);
    }

}


?>