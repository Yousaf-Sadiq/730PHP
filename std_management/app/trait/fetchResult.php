<?php
use app\database\helper as help;

trait FetchResult
{
    public function Getresult()
    {
        $help = new help();

        $this->result=[];
        while ($row = $this->exe->fetch_assoc()) {

            array_push($this->result, $row);
        }

        return $this->result;
    }
}

?>