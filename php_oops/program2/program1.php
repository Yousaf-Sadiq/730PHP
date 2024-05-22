<?php
class AreaOfRectangle
{
    private $length;
    private $width;


    public function setWidth(float|int $w)
    {
        $this->width = $w;
    }


    public function setlength(float|int $l)
    {
        $this->length = $l;
    }

    public function calculate()
    {

        $area = $this->length * $this->width;

        return  $area;
    }



}


$abc = new AreaOfRectangle;

$abc->setlength(5);
$abc->setWidth(8);

echo  "AREA OF RECTANGLE IS: ".$abc->calculate();


?>