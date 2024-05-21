<?php
declare(strict_types=1);
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

        return  $area;
    }



}


$abc = new AreaOfRectangle;

$abc->setlength(5);
$abc->setWidth(8);

echo  "AREA OF RECTANGLE IS: ".$abc->calculate();

abstract class person
{
    // condition  i want atleast one function of abstract 

    public function display()
    {
        echo "i am a human being";
    }

    abstract public function name(); // method overriding 

}




class A extends person
{

    // with in class we call function  called methods
    //  and we call variable called properties
    // access modifier  are public , private, protected

    // public $abc;
    // ==============Encapsulation=========================

    private $name;
    private $contact;

    protected $test;

    // setter or getter

    public function name()
    {
        echo "function name called";
    }

    public function setName($n)
    {
        $this->name = $n;
    }


    public function getName()
    {
        return $this->name;
    }

}

// a=b 
// b=c 

// a = c

class B extends A
{

    public function SetTest()
    {
        $this->test = "This is test from Class B";
    }
}

// $abc = new person;

// $qwer = new B; // object of class B/A

// $qwer->setName("abc");
// echo $qwer->getName();
// $qwer->display();


// $qwer2 = new A; // object of class A 

// $qwer2->setName("abc2");
// echo $qwer2->getName();
// $qwer2->name();
// echo $qwer->abc;


?>