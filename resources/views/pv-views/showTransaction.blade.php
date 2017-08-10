<?php $nav_trans = 'active'; ?>
@extends('master')
@section('content')
<!-- <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">@section('name') Payment Vouchers @stop</h1>
    </div>
</div> --><!--/.row-->

@section('icon')   
<li class="active"> <a href="{{url('/showTrans')}}"><span class="glyphicon glyphicon-file"></span> </a></li>@stop

<div class="row">
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">

                <p> <b> Voucher ID:</b> {{$trans[0]->id}} </p>
                <p> <b> Currency:</b> {{$trans[0]->currency}} </p>
                <p> <b>Transaction Description:</b>  {{$trans[0]->description}}</p>
                <p> <b>Cheque Number:</b>  {{$trans[0]->cheque}}</p>
                <p><b> Total Amount:</b> {{$trans[0]->amount}} </p>
                <p><b> Withholding Tax:</b> {{$trans[0]->withholding}} </p>
                <p><b> VAT/NHIL:</b> {{$trans[0]->vat}} </p>
                <p> <b>Net Payable:</b> {{$trans[0]->netpayable}} </p>

            </div> 
        </div>
    </div>
    <div class="col-md-6">
        <div class="panel panel-default">
            <div class="panel-body">
                <p><b> Rate:</b>  {{$trans[0]->rate}}</p>
                <p> <b>Status:</b>  {{$trans[0]->status}}</p>
                <p> <b>Supplier/Payee: </b> {{$payments[0]->supplier_name}}</p>
                <p> <b>Department:</b>  {{$dept[0]->department}}</p>
                <p> <b>Account Debited:</b>  {{$debit[0]->account_name}}</p>
                <p> <b>Account Credited:</b>  {{$credit[0]->account_name}}</p>
                <p> <a class="btn btn-secondary" href="download?id={{$trans[0]->id}}" id="btn_show">
                                    <span class="glyphicon glyphicon-download"></span> Download {{substr($trans[0]->attachments,strpos($trans[0]->attachments,'/')+1)}}
                     </a>  </p>
            </div>
        </div>
    </div>
</div>
<!--/.row-->

@stop