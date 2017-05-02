<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $this->assertTrue(true);
    }
    
    public function testreviewStatus(){
        $trans = new TransactionController();
        $request = new Request;
        $request->id = 6;
        $request-
        $request->status = 'created';
        $trans->reviewStatus($request );
        $this->assertTrue(true);
    }
}
