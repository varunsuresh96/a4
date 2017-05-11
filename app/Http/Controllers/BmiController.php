<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BmiController extends Controller
{
    private $bmi;
    private $bmr;
    private $calories;

    // This method calculates the user's BMI
    public function bmiCal($weight, $height)
    {
        if($weight!=0 and $height!=0)
        {
            $this->bmi=($weight*0.45)/($height*$height*0.000625);
        }

        return round($this->bmi,2);
    }

    // This method calculates the user's Basal Metabolic Rate(BMR).
    private function bmr($weight,$height,$gender,$age)
    {
        if ($gender=='female')
        {
            $this->bmr=655+(4.35*$weight)+(4.7*$height)-(4.7*$age);
        }
        else
        {
            $this->bmr=66+(6.23*$weight)+(12.7*$height)-(6.8*$age);
        }

        return round($this->bmr,2);
    }

    // This method calculates the calories to be consumed by the user.
    public function caloriesCal($weight, $height,$gender,$age,$activity,$goal)
    {
        if($activity=='sedentary')
        {
            $this->calories=$this->bmr($weight,$height,$gender,$age)*1.45;
        }
        if($activity=='moderate')
        {
            $this->calories=$this->bmr($weight,$height,$gender,$age)*1.75;
        }
        if($activity=='active')
        {
            $this->calories=$this->bmr($weight,$height,$gender,$age)*2.20;
        }

        if($goal=='lose')
        {
            $this->calories=$this->calories-500;
        }

        if($goal=='gain')
        {
            $this->calories=$this->calories+500;
        }

        return round($this->calories,2);
    }
}
