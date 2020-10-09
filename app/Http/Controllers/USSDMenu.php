<?php
namespace App\Http\Controllers;

trait USSDMenu{

    public function WelcomeMenu(){
        $start  = "Hello ! Welcome\n";
        $start .= "1. To check your data balance\n";
        $start .= "2. To check your phone number\n";
        $start .= "3. Exit\n";
        $this->ussd_proceed($start);
    }

    public function PhoneScreen($phone){
        $start  = "My Phone Number is $phone\n";
        // $start .= "1. Previous\n";
        $this->ussd_stop($start);
    }

    public function DataScreen(){
        $start  = "My Data balance is 455GB\n";
        // $start .= "1. Previous\n";
        $this->ussd_stop($start);
    }

    public function RewardProgram($ref_link, $phone){
        $start  = "Hello ! Welcome to reward program, an sms has been sent to $phone with the referral link www.link.com/ref=$ref_link , Kindly activate your account and get 10% .... \n";
        $this->ussd_stop($start);
    }

}
