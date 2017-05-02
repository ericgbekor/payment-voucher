<?php

namespace Tests\Browser;

use Tests\DuskTestCase;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class FormTests extends DuskTestCase
{
    /**
     * A Dusk test example.
     *
     * @return void
     */
    public function testFormInputs()
    {
//        $user = factory(User::class)->create([
//            'email' => 'eri@laravel.com',
//        ]);

        $this->browse(function ($first) {
            $first->loginAs(User::find(5))
                    ->visit('/addtransactions')
                    ->select('currency','cedis')
                    ->type('amount','25000')
                    ->type('cheque','ECB2456')
                    ->type('description','Payment for water treatment')
                    ->type('rate','4.3')
                    ->select('payee','9')
                    ->select('debit','2001')
                    ->select('credit','5001')
                    ->type('withholding','100')
                    ->type('vat','50')
                    ->select('department','1')
                    ->select('reviewer','6')
                    ->select('approver','9')
                    ->press('Create')
                    ->assertSee('Payment Vouchers');
        
        
//            $second ->visit('/login')
//                    ->type('email', $user->email)
//                    ->type('password', 'secret')
//                    ->press('Login')
//                    ->assertPathIs('/home');
            
           
        });
    }
}
