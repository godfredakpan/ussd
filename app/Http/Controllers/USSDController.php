<?php

namespace App\Http\Controllers;

use DB;
use Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\SmsTrait;
use App\Http\Controllers\USSDMenu;
use App\Http\Controllers\Controller;
use AfricasTalking\SDK\AfricasTalking;
use App\Models\User;

class USSDController extends Controller
{

    use USSDMenu;
    use SmsTrait;

    public function InitiateUssd(Request $request)
    {
        try {

            $sessionId   = $request["sessionId"];
            $serviceCode = $request["serviceCode"];
            $phone       = $request["phoneNumber"];
            $text        = $request["text"];

            header('Content-type: text/plain');

            if($phone){
                // if(User::where('phone_number', $phone)->exists()){
                // Function to handle already registered users

                // $user_info = User::where('phone_number', $phone)->first();

                // $this->handleReturnUser($text, $phone);
                $data = $this->handleReturnUserInformation($text, $phone);

            }else {
                // Function to handle new users
                echo "User does not exsit";

                // $this->handleNewUser($text, $phone);
            }


        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function handleReturnUserInformation($ussd_string, $phone)
  {
        $ussd_string_exploded = explode ("*",$ussd_string);

        // Get menu level from ussd_string reply
        $level = count($ussd_string_exploded);

        if(empty($ussd_string) or $level == 0) {
            $this->WelcomeMenu(); // show the welcome menu
        }


        switch ($level) {
            case ($level == 1 && !empty($ussd_string)):
                if ($ussd_string_exploded[0] == "1") {
                    // If user selected 1 show them balance
                    $this->ussd_stop("My Data Balance is 350GB");

                } else if ($ussd_string_exploded[0] == "2") {
                    //If user selected 2, show them phone number

                    $this->ussd_stop("My Phone Number is $phone");

                } else if ($ussd_string_exploded[0] == "3") {
                    //If user selected 3, exit
                    $this->ussd_stop("Thank you !");
                }
            break;

        }
    }

    public function handleSms(Request $request)
    {
            $sessionId   = $request["sessionId"];
            $serviceCode = $request["serviceCode"];
            $phone       = $request["phoneNumber"];
            $text        = $request["text"];

            header('Content-type: text/plain');

            $ref_link = $this->quickRandom();

            $sms = $this->sendText("Hello, I invite you to join phoonePOS through this link ($ref_link) by using your mobile phone as POS for agency banking and start earning income.",$phone);

            $this->RewardProgram($ref_link, $phone);
            

      }


    public function ussd_proceed($ussd_text) {
        echo "CON $ussd_text";
      }
      public function ussd_stop($ussd_text) {
        echo "END $ussd_text";
      }


      public static function quickRandom($length = 8)
        {
            $string = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';

            return substr(str_shuffle(str_repeat($string, $length)), 0, $length);
        }

}
