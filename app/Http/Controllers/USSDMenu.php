<?php
namespace App\Http\Controllers;

trait USSDMenu{

    public function WelcomeMenu(){
        $start  = "Hello ! Welcome\n";
        $start .= "1. To check your data balance\n";
        $start .= "2. To check your phone number\n";
        $start .= "3. Previous\n";
        $start .= "4. Next\n";
        $this->ussd_proceed($start);
    }

    public function RewardProgram($ref_link, $phone){
        $start  = "Hello ! Welcome to reward program, an sms has been sent to $phone with the referral link www.link.com/ref=$ref_link \n";
        // $start .= "3. Exit\n";
        $this->ussd_proceed($start);
    }

}
