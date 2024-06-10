<?php

trait Update
{

    // UPDATE `users` SET
    //  `user_name`='[value-2]',`email`='[value-3]'
    //  WHERE 1
    public function update(string $table, array $data, string $where)
    {
        $status = [
            "error" => 0,
            "msg" => []
        ];

        if ($this->CheckTable($table)) {

            $updates = "";
            foreach ($data as $key => $value) {
                $updates .= "`{$key}`= '{$value}' , ";
            }

            $updates = rtrim($updates, " , ");


            $this->query = "UPDATE `{$table}` SET {$updates}   WHERE {$where}";
            $this->exe = $this->conn->query($this->query);

            if ($this->exe) {
                if ($this->conn->affected_rows > 0) {
                    array_push($status["msg"], "DATA HAS BEEN UPDATED");
                } else {
                    $status["error"]++;
                    array_push($status["msg"], "DATA REMAIN SAME");
                }
            }
            else{
                $status["error"]++;
                array_push($status["msg"], "ERROR IN QUERY  {$this->query}");
            }
        } else {
            $status["error"]++;
            array_push($status["msg"], "THIS {$table} TABLE IS NOT EXISTED");
        }

        return json_encode($status);
    }


}
?>