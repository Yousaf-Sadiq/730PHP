<?php

/**
 * 4 pillars of oops
 * encapsulation (information hiding 50% )
 * abstraction (100% )
 * inheritance
 * polymorphism 
 * 
 * async 
 */


 abstract class person{
// condition  i want atleast one function of abstract 

    public function display(){
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

    public function name(){
        echo "function name called";
    }

    public function setName($n)
    {
        $this->name = $n;
    }


    public function  getName(){
        return $this->name ;
    }

}

// a=b 
// b=c 

// a = c

class B extends A{

    public function SetTest(){
        $this->test="This is test from Class B";
    }
}

// $abc = new person;

$qwer = new B; // object of class B/A

$qwer->setName("abc");
echo $qwer->getName();
$qwer->display();


$qwer2 = new A; // object of class A 

$qwer2->setName("abc2");
echo $qwer2->getName();
$qwer2->name();
// echo $qwer->abc;


?>