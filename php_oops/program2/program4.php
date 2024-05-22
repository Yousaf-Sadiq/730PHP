<?php
class celsiustofahrenheit
{
    private $celsius;



    public function setcelsius(float|int $c)
    {
        $this->celsius = $c;
    }




    public function temperature()
    {

        $temp = (($this->celsius * (9 / 5)) + 32);

        return $temp;
    }



}


$t = new celsiustofahrenheit;

$t->setcelsius(32);


echo "Celsius to Fahrenheight : " . $t->temperature();







?>