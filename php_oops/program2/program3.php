<?php


class AreaOfCircle
{
    private $radius;



    public function setradius(float|int $r)
    {
        $this->radius = $r;
    }




    public function calculate()
    {

        $area =  (pow($this->radius,2) * (22/7));

        return $area;

    }


}


$c = new AreaOfCircle;

$c->setradius(3);


echo "AREA OF Circle IS: " . $c->calculate();


?>