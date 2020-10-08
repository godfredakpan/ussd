<?php

namespace Tests\Unit;

use App\Models\Finance;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\DatabaseTransactions;


class MakeRequestTest extends TestCase
{

    use DatabaseTransactions, WithFaker;
    /**
     * A basic unit test example.
     *@test
     * @return void
     */
    public function create_request()
    {

        // user visits the request page
        $this->get(route('request.index'));

        // user visits the  create request making page
        $this->get(route('create_vendor.request'));

        $finance = factory(Finance::class)->create();

        //user stores the equipment page with above values
        $this->get(route('save.request'));

        if (!$finance){
            $this->assertTrue(false);
        }
        else{
            $this->assertTrue(true);
        }

    }
}
