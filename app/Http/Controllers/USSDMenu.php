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

    public function RewardProgram($ref_link, $phone){
        $start  = "Hello ! Welcome to reward program, an sms has been sent to $phone with the referal link $ref_link \n";
        $start .= "3. Exit\n";
        $this->ussd_proceed($start);
    }

}
