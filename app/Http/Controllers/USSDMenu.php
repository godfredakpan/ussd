<?php
namespace App\Http\Controllers;

trait USSDMenu{

    public function WelcomeMenu(){
        $start  = "Hello ! Welcome\n";
        $start .= "1. To check your data balance\n";
        $start .= "2. To check your phone number\n";
        $start .= "3. Previous";
        $start .= "3. Exit";
        $this->ussd_proceed($start);
    }

}
