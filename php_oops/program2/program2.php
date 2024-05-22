<?php
class AreaOfTriangle 
{
    private $base;
    private $height;


    public function setbase(float|int $b)
    {
        $this-> base= $b;
    }


    public function setheight(float|int $h)
    {
        $this->height = $h;
    }

    public function calculate()
    {

        $area = $this->base * $this->height / 2;

        return  $area;
    }



}


$t = new AreaOfTriangle;

$t->setbase(4);
$t->setheight(3);

echo  "AREA OF Triangle IS: ".$t->calculate();
?>