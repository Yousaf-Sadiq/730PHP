<?php


declare(strict_types=1);
namespace abc;

// mysqli_connect();
// new mysqli();
/**
 * 4 pillars of oops
 * encapsulation (information hiding 50% )
 * abstraction (100% )
 * inheritance
 * polymorphism 
 * 
 * 
 * async 
 */
// function abc(int $a){
// Find the area of a rectangle where the length is 5 and the width is 8.
// 2. Find the area of a triangle where the base is 4 and the height is 3.
// 3. Find the area of a circle where the radius is 3.
// 4. Convert temperatures from Celsius to Fahrenheit and Fahrenheit to Celsius.
// }
//  $abc = fn($a,$b)=> $a + $b ;  
//  1- 100  multiple of 3 fizz  multiple 5 then buzz 
//  3 or 5  fizz buzz  


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

        return $area;
    }



}


$abc = new AreaOfRectangle;

$abc->setlength(5);
$abc->setWidth(8);

echo "AREA OF RECTANGLE IS: " . $abc->calculate();



abstract class person
{
    protected $abc;

    protected function display()
    {

    }

    abstract public function name();

}


interface persons
{

    public function name();
   
}

interface A{
    public function Address();
    public function Age();

}

class area_Of_Rectangle implements persons,A
{

    public function name()
    {

    }
    public function address()
    {

    }

    public function age()
    {

    }
}






?>