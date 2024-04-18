// Check two given numbers and return true if one of the numbers is 50 or if their sum is 50.

function checkNumber(q,p)
{
    let sum = q+p;
    let output="";

    if((q==50)||(p==50)){
      
     output="either one of the variable is equal to 50"}

     else if(sum==50){
      
      output="their sum is equal to 50"
    } 
    else {
        output="both conditions are failed"

    }
    return output;
}
console.log(checkNumber(50,25));






  
// Check from the given integer, whether it is positive or negative.
function noNe(q=0){
    
    let int="";
    int=q;
    let output="";
    if(int > 0){
        output="the integer is positive";
    }
    else if(int < 0){
        output=" the integer is negative";
    }
    else{
        output="neutral";
    }

    return output
}
console.log(noNe(0))

// Check whether a given number is even or odd.
function evenOdd(x){
    let int=x;
    let output;
    if(x%2==0){
        output="the number is even"
    }
    else{
        output="the number is odd"
    }
    return output
}
console.log(evenOdd(5))

// Check whether a given positive number is a multiple of 3.
function positive(x){
    let int=x;
    let output;
    if(x%3==0){
        output="the number is multiple of three"
    }
    else{
        output="the number is not multiple if three"
    }
    return output
}
console.log(positive(5))

// Determine whether a given year is a leap year.
function leapYear(year) {
    
    let output;
    if ((0 == year % 4) && (0 != year % 100) || (0 == year % 400)) 
    {
        output="the year is a leap year";
    } 
    else {
        output="the year is not a leap year";
    }
    return output
}
console.log(leapYear(2005))