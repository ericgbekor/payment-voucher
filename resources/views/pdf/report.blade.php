<html lang="en">
    <head>

        <style>
            th,td{
                text-align: center;
            }
        </style>
    </head>
    <body>
    <table><tr>
     <td style="text-align:left;"> <h3>TRANSACTION DETAILS</h3></td>
        <td style="text-align:right;">
            VOUCHER NUMBER: {{$trans[0]->id}}</td></tr></table>
      
        <p>PAYEE NAME: {{$payments[0]->supplier_name}} </p>
        <p>CHEQUE NUMBER: {{$trans[0]->cheque}}</p>
        <p>TRANSACTION DESCRIPTION: {{$trans[0]->description}}</p>
        <p>AMOUNT IN WORDS: {{ucwords($numWords." ".$trans[0]->currency)}}</p>
        <p>CLASS/DEPT: {{$dept[0]->department}}</p>
        <p>EX RATE: {{$trans[0]->rate}}</p>
        <p>AMOUNT: {{$trans[0]->amount}}</p>

        <div class="row">
            <table class="table-striped" border="1" style="width:85%;" >
                <thead>
                    <tr>
                        <th style="width:65%;">Transaction Type</th>
                        <th style="width:15%;">Account Code</th>
                        <th style="width:15%;">DR</th>
                        <th style="width:15%;">CR</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td style="width:65%;">{{$debit[0]->account_name}}</td>
                        <td style="width:15%;">{{$debit[0]->accountDebited}}</td>

                        <td style="width:15%;">{{$trans[0]->amount}}</td>
                        <td style="width:15%;"></td>
                    </tr>

                    <tr>
                        <td style="width:65%;"> VAT/NHIL</td>
                        <td style="width:15%;"></td>

                        <td style="width:15%;"></td>
                        <td style="width:15%;">{{$trans[0]->vat}}</td>
                    </tr>

                    <tr>
                        <td style="width:65%;"> WTH Tax </td>
                        <td style="width:15%;"></td>

                        <td style="width:15%;"></td>
                        <td style="width:15%;">{{$trans[0]->withholding}}</td>
                    </tr>
                    <tr>
                        <td style="width:65%;"> {{$credit[0]->account_name}}</td>
                        <td style="width:15%;">{{$credit[0]->accountCredited}}</td>

                        <td style="width:15%;"> </td>
                        <td style="width:15%;">{{$trans[0]->netpayable}} </td>
                    </tr>
                    <tr>
                        <td style="width:65%;"> TOTAL</td>
                        <td style="width:15%;"></td>
                        <td style="width:15%;">{{$trans[0]->amount}}</td>
                        <td style="width:15%;">{{$trans[0]->amount}}</td>
                    </tr>
                </tbody>
            </table>

        <!--<div>-->
        <!--</div>-->
            <p><b> DETAILED TRANSACTION NARRATION </b></p>
            <table>
                <tr> <td style="width:20%">Gross Amount:</td> <td  style="width:15%"> {{$trans[0]->amount}} </td> </tr>
                <tr> <td  style="width:20%">WHT: </td> <td  style="width:15%"> {{$trans[0]->withholding}} </td> </tr>
                <tr><td  style="width:20%">VAT/NHIL:</td> <td  style="width:15%">{{$trans[0]->vat}}</td></tr>       
                <tr><td  style="width:20%">Net Payable:</td> <td  style="width:15%">{{$trans[0]->netpayable}}</td></tr>
            </table> 

            <p>DATE: {{$current}}</p>

                <table>
                    <thead> <tr>
                            <th style="text-align:left;"> CREATED BY</th>
                            <th style="text-align:center;"> REVIEWED BY</th>
                            <th style="text-align:right;">  APPROVED BY</th>
                        </tr> </thead>

                    <tbody>
                        <tr>
                            <td style="text-align:left;"> {{$creator[0]->firstname}} {{$creator[0]->lastname}}</td>
                            <td style="text-align:center;">{{$reviewer[0]->firstname}} {{$reviewer[0]->lastname}}</td>
                            <td style="text-align:right;">{{$approver[0]->firstname}} {{$approver[0]->lastname}}</td>
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


    </body>
</html>
