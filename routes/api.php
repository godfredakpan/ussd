<?php
use Illuminate\Http\Request;



Route::post('/ussd', 'USSDController@InitiateUssd');
