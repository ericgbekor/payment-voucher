<html lang="en">
    <head>
        <link href="{{ URL::asset ('css/bootstrap.min.css')}}" rel="stylesheet">
    </head>
    <body>
        <div>
            VOUCHER NUMBER: {{$trans[0]->id}}
        </div>
        <div>
            PAYEE NAME: {{$payments[0]->supplier_name}} 
        </div>
        <div>
            CHEQUE NUMBER: {{$trans[0]->cheque}}
        </div>
        <div>
            TRANSACTION DESCRIPTION: {{$trans[0]->description}}
        </div>
<div class="row">
<table class="table-striped" border="1">
    <thead>
        <tr>
    <th>Transaction Type</th>
    <th>Account Code</th>
    <th>DR</th>
    <th>CR</th>
        </tr>
    </thead>
    
    <tbody>
        <tr>
            <td> Debited Account will be here</td>
            <td>{{$debit[0]->accountDebited}} - {{$debit[0]->account_name}}</td>
            
            <td>{{$trans[0]->amount}}</td>
            <td></td>
        </tr>
        <tr>
            <td> Credited Account will be here</td>
            <td>{{$trans[0]->accountDebited}}</td>
            
            <td>{{$credit[0]->accountCredited}} - {{$credit[0]->account_name}}</td>
            <td></td>
        </tr>
        <tr>
            <td> Debited Account will be here</td>
            <td>{{$trans[0]->accountDebited}}</td>
            
            <td>{{$trans[0]->amount}}</td>
            <td></td>
        </tr>
        <tr>
            <td> TOTAL</td>
            <td></td>
            <td>{{$trans[0]->amount}}</td>
            <td>{{$trans[0]->amount}}</td>
        </tr>
    </tbody>
</table>
</div>
        
        <div class="row">
            CREATED BY:  {{$creator[0]->firstname}} {{$creator[0]->lastname}}<br>
            REVIEWED BY: {{$reviewer[0]->firstname}} {{$reviewer[0]->lastname}}<br>
            APPROVED BY: {{$approver[0]->firstname}} {{$approver[0]->lastname}}
       
        </div>
    </body>
</html>
