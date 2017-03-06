<html lang="en">
    <head>
        
        <style>
            th,td{
                text-align: center;
            }
        </style>
    </head>
    <body>
        <div style="text-align:right;">
            VOUCHER NUMBER: {{$trans[0]->id}}
        </div>
        <h1> TRANSACTION DETAILS </h1>
        <div>
            PAYEE NAME: {{$payments[0]->supplier_name}} 
        </div>
        <div>
            CHEQUE NUMBER: {{$trans[0]->cheque}}
        </div>
        <div>
            TRANSACTION DESCRIPTION: {{$trans[0]->description}}
        </div>
        <div>
            AMOUNT IN WORDS: {{ucfirst($numWords)}}
        </div>
        <div style="text-align:right;">
            AMOUNT: {{$trans[0]->amount}}
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
        <div>
            EX RATE: {{$trans[0]->rate}}
        </div>
        <div>
            <h1> DETAILED TRANSACTION NARRATION </h1>
            <div>
            Gross Amount  <br>
            WHT <br>
            VAT/NHIL   <br>       
            Net Payable  
            </div>
        </div>

       
        DATE: <br>
       



        <section>
            <div class="row" style="border:1px solid; bottom:5px">
                CREATED BY:  {{$creator[0]->firstname}} {{$creator[0]->lastname}}<br>
                REVIEWED BY: {{$reviewer[0]->firstname}} {{$reviewer[0]->lastname}}<br>
                APPROVED BY: {{$approver[0]->firstname}} {{$approver[0]->lastname}}
            </div>
        </section>

    </body>
</html>
