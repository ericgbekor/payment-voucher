<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RouteTest extends TestCase
{
    /**
     * Testing successful redirects.
     *
     * @return void
     */
    public function testHome()
    {
           $response = $this ->get('/home');
           $response ->assertStatus(302);
    }

    public function testTrans()
    {
           $response = $this ->get('/transactions');
           $response ->assertStatus(302);
    }
    
    public function testAddTrans()
    {
           $response = $this ->get('/addtransactions');
           $response ->assertStatus(302);
    }
    
     public function testSaveTrans()
    {
           $response = $this ->post('/saveTrans');
           $response ->assertStatus(302);
    }
    
     public function testUpdateTrans()
    {
           $response = $this ->get('/updateTrans');
           $response ->assertStatus(302);
    }
    
     public function testDeleteTrans()
    {
           $response = $this ->get('/deleteTrans');
           $response ->assertStatus(302);
    }
    
     public function testApproveTrans()
    {
           $response = $this ->get('/approveTrans');
           $response ->assertStatus(302);
    }
    
     public function testReviewTrans()
    {
           $response = $this ->get('/reviewTrans');
           $response ->assertStatus(302);
    }
    
     public function testMakePayment()
    {
           $response = $this ->get('/makePayment');
           $response ->assertStatus(302);
    }
    
     public function testReject()
    {
           $response = $this ->get('/reject');
           $response ->assertStatus(302);
    }
    
     public function testMultiReject()
    {
           $response = $this ->get('/multireject');
           $response ->assertStatus(302);
    }
    
     public function testReview()
    {
           $response = $this ->get('/review');
           $response ->assertStatus(302);
    }
    
     public function testImportExcel()
    {
           $response = $this ->post('/importExcel');
           $response ->assertStatus(302);
    }
    public function testExportExcel()
    {
           $response = $this ->get('/exportExcel');
           $response ->assertStatus(302);
    }
    
    public function testPrintCheque()
    {
           $response = $this ->get('/printCheque');
           $response ->assertStatus(302);
    }
    
    public function testMultiDelete()
    {
           $response = $this ->get('/multidelete');
           $response ->assertStatus(302);
    }
    
    public function testMultiReview()
    {
           $response = $this ->get('/multireview');
           $response ->assertStatus(302);
    }
    
    public function testMultiApprove()
    {
           $response = $this ->get('/multiapprove');
           $response ->assertStatus(302);
    }
    
     public function testReviewMail()
    {
           $response = $this ->get('/reviewmail');
           $response ->assertStatus(302);
    }
    
     public function testApproveMail()
    {
           $response = $this ->get('/approvemail');
           $response ->assertStatus(302);
    }
    
     public function testRejectMail()
    {
           $response = $this ->get('/rejectmail');
           $response ->assertStatus(302);
    }
    
     public function testApprovalMail()
    {
           $response = $this ->get('/approvalmail');
           $response ->assertStatus(302);
    }
}





