 <?php $nav_trans = 'active'; ?>

@extends('master')
@section('content')
<!-- <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">@section('name') Payment Vouchers @stop</h1>
    </div>
</div> --><!--/.row-->

@section('icon')   
<li class="active"> <a href="{{url('/reviewTrans')}}"><span class="glyphicon glyphicon-file"></span> </a></li>@stop

<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table-bordered" id="data" data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="total amount" data-sort-order="asc">
                    <thead>
                        <tr>
                        <th>Item</th>
                            <th data-field="id" data-sortable="true">PV</th>
                            <th data-field="description"  data-sortable="true">Transaction Description</th>
                            <th data-field="amount" data-sortable="true"> Total Amount</th>
                            <th data-field="netpayable" data-sortable="true"> Net Payable</th>
                            <th data-field="payee" data-sortable="true"> Payee</th>
                            <th data-field="status" data-sortable="true"> Status</th>
                            <th data-field="created_at" data-sortable="true"> Created At</th>
                            <th data-field="updated_at" data-sortable="true"> Updated At</th>
                            <th></th>
                            <!-- <th>Delete</th> -->

                        </tr>
                    </thead>
                    {{ csrf_field() }}
                    <tbody>
                        @foreach($transactions as $transaction)
                        <tr class="item{{$transaction->id}}" id="{{$transaction->id}}"> 
                            <td><input type="checkbox" id="checkbox" name="pid[]" value="{{$transaction->id}}"></input></td>
                             <td> {{$transaction->id}} </td>
                            <td> {{$transaction->description}}</td>
                            <td> {{$transaction->amount}}</td>
                            <td> {{$transaction->netpayable}}</td>
                             <td> {{$transaction->payee}}</td>
                            <td> {{$transaction->status}}</td>
                            <td> {{$transaction->created_at}} </td>
                            <td > {{$transaction->updated_at}} </td>
                            <td>
                                <a class="btn btn-secondary" href="showTrans?id={{$transaction->id}}" id="btn_show">
                                    <span class="glyphicon glyphicon-eye-open"></span> Details
                                </a> 
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div align="center">
                <button type="button" name="btn_reject" id="btn_reject" class="btn btn-success">
                    <span class="glyphicon glyphicon-remove-sign"></span> Reject
                </button>
                
                <button type="button" name="btn_review" id="btn_review" class="btn btn-primary">
                    <span class="glyphicon glyphicon-check"></span> Reviewed
                </button>
            </div>
        </div>
    </div>
</div><!--/.row-->



<div class="row">

    <script>
        function rowStyle(row, index) {
            var classes = ['active', 'success', 'info', 'warning', 'danger'];
            if (index % 2 === 0 && index / 2 < classes.length) {
                return {
                    classes: classes[index / 2]
                };
            }
            return {};
        }
    </script>
</div><!--/.row-->	


</div><!--/.main-->

<script src="{{URL::asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<!--<script src="{{URL::asset('js/chart.min.js')}}"></script>
<script src="{{URL::asset('js/chart-data.js')}}"></script>-->
<script src="{{URL::asset('js/bootstrap-datepicker.js')}}"></script>
<script src="{{URL::asset('js/bootstrap-table.js')}}"></script>
<script>
         !function ($) {
             $(document).on("click", "ul.nav li.parent > a > span.icon", function () {
                 $(this).find('em:first').toggleClass("glyphicon-minus");
             });
             $(".sidebar span.icon").find('em:first').addClass("glyphicon-plus");
         }(window.jQuery);
         $(window).on('resize', function () {
             if ($(window).width() > 768)
                 $('#sidebar-collapse').collapse('show');
         });
         $(window).on('resize', function () {
             if ($(window).width() <= 767)
                 $('#sidebar-collapse').collapse('hide');
         });</script>


    <script>
        $(document).ready(function(){
           $('#btn_reject').click(function(){
              if(confirm("Reject?")){
                  var id =[];
                  var count=0;
                  $('#checkbox:checked').each(function(){
                  id.push(this.value);
                  count=count+1;
                  });
                  
             if(id.length === 0){
                 alert("Please select at least one checkbox");
             }
             else{
                 $.ajax({
                     async: 'true',
                     type: 'get',
                     url: 'multireject',
                     data:{id:id},
                     success:function(response){
                          window.location="rejectmail?count="+count;

                     }  
                 });    
             } 
             }
                  else{
                  return false;}
             
           }); 
        });
        
        
         $(document).ready(function(){
           $('#btn_review').click(function(){
              if(confirm("Submit for Approval?")){
                  var id =[];
                  var count=0
                  $('#checkbox:checked').each(function(){
                  id.push(this.value);
                  count=count+1;
                  });
                  
             if(id.length === 0){
                 alert("Please select at least one checkbox");
             }
             else{
                 $.ajax({
                     async: 'true',
                     type: 'get',
                     url: 'review',
                     data:{id:id},
                     success:function(response){
                         window.location = "approvemail?count="+count;
                        
                     }
                     
                 });
                 
             } 
             }
                  else{
                  return false;}
             
           }); 
        });
    </script>



@stop


