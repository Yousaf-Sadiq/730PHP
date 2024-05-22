<?php
class fahrenheitToCelsius
{
    private $fahrenheit;



    public function setfahrenheit(float|int $f)
    {
        $this->fahrenheit = $f;
    }




    public function temperature()
    {

        $temp = (($this->fahrenheit - 32) * (5 / 9));

        return $temp;
    }



}


$t = new fahrenheitToCelsius;

$t->setfahrenheit(43);


echo " Fahrenheight to celsius : " . $t->temperature();







?>