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
            AMOUNT IN WORDS: {{ucfirst($numWords)." ".$trans[0]->currency}}
        </div>
        <div style="text-align:right;">
            AMOUNT: {{$trans[0]->amount}}
        </div>
        <div>
            CLASS/DEPT: {{$dept[0]->department}}
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
                        <td>{{$debit[0]->account_name}}</td>
                        <td>{{$debit[0]->accountDebited}}</td>

                        <td>{{$trans[0]->amount}}</td>
                        <td></td>
                    </tr>

                    <tr>
                        <td> VAT/NHIL</td>
                        <td></td>

                        <td></td>
                        <td>{{$trans[0]->vat}}</td>
                    </tr>

                    <tr>
                        <td> WTH Tax </td>
                        <td></td>

                        <td></td>
                        <td>{{$trans[0]->withholding}}</td>
                    </tr>
                    <tr>
                        <td> {{$credit[0]->account_name}}</td>
                        <td>{{$credit[0]->accountCredited}}</td>

                        <td> </td>
                        <td>{{$trans[0]->netpayable}} </td>
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
        <!--<div>-->
        EX RATE: {{$trans[0]->rate}} <br>
        <!--</div>-->
        <div>
            <h1> DETAILED TRANSACTION NARRATION </h1>
            <div>
                Gross Amount: {{$trans[0]->amount}}  <br>
                WHT: {{$trans[0]->withholding}} <br>
                VAT/NHIL: {{$trans[0]->vat}}  <br>       
                Net Payable: {{$trans[0]->netpayable}}  
            </div>
        </div>

        <div>
            DATE: {{$current}}
        </div>



        <section>
            <div class="row" style="border:1px solid; bottom:5px">
                <table>
                    <thead> <tr>
                            <th> CREATED BY</th>
                            <th> REVIEWED BY</th>
                            <th>  APPROVED BY</th>
                        </tr> </thead>

                    <tbody>
                        <tr>
                            <td> {{$creator[0]->firstname}} {{$creator[0]->lastname}}</td>
                            <td>{{$reviewer[0]->firstname}} {{$reviewer[0]->lastname}}</td>
                            <td>{{$approver[0]->firstname}} {{$approver[0]->lastname}}</td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </section>


    </body>
</html>
