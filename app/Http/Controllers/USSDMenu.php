<?php
namespace App\Http\Controllers;

trait USSDMenu{

    public function WelcomeMenu(){
        $start  = "CON Hello ! Welcome\n";
        $start .= "1. To check your data balance\n";
        $start .= "2. To check your phone number\n";
        $start .= "3. Exit\n";
        $this->ussd_proceed($start);
    }

    public function PhoneScreen($phone){
        $start  = "CON My Phone Number is $phone\n";
        $start .= "1. Previous\n";
        $this->ussd_proceed($start);
    }

    public function DataScreen(){
        $start  = "CON My Data balance is 455GB\n";
        $start .= "1. Previous\n";
        $this->ussd_stop($start);
    }

    public function RewardProgram($ref_link, $phone){
        $start  = "CON Hello ! Welcome to reward program, an sms has been sent to $phone with the referral link www.link.com/ref=$ref_link \n";
        // $start .= "3. Exit\n";
        $this->ussd_stop($start);
    }

}
