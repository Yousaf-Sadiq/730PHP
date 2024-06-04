<?php 

trait Mysql{
    public function Mysql(string $sql, $checkRow = false)
    {
        $this->query = $sql;
        $this->exe = $this->conn->query($this->query);

        if ($this->exe) {

            if ($checkRow) {

                if ($this->exe->num_rows > 0) {
                    return true;
                } else {
                    return false;
                }
            }

            return true;

        }

    }
}

?>