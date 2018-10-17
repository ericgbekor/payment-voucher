<?php $nav_trans = 'active'; ?>
@extends('master')
@section('content')

<!--<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">@section('name') Transactions @stop</h1>
    </div>
</div>/.row-->

@section('icon')   
<li class="active"> <a href="{{url('/addtransactions')}}"><span class="glyphicon glyphicon-file"></span> </a></li>@stop

<!-- <div class="row col-md-5">
    <div class="panel-default">
        <div class="panel-body">
    <form action="{{ URL::to('/importExcel') }}" class="form-horizontal" method="post" files="true" enctype="multipart/form-data">
        {{ csrf_field() }}
        <div class="form-group{{ $errors->has('documents') ? ' has-error' : '' }}">
                        <label for="import_file" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                            upload .csv files
                            <input id="documents" type="file" name="import_file"/>

                            @if ($errors->has('import_file'))
                            <span class="help-block">
                                <strong>{{ $errors->first('import_file') }}</strong>
                            </span>
                            @endif
                             
                        </div>
                        <!--<button class="btn btn-primary">Import File</button>-->
                    <!-- </div>
                    
                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Import
                            </button>


                        </div>
                    </div>
       
    </form>
            </div>
    </div>
</div> --> 
<div class="row">
    <div class="col-lg-11">
        <div class="panel panel-default">
            <div class="panel-heading"><a href="{{URL::previous()}}"> <span class="glyphicon glyphicon-arrow-left"> </span></a> Add Voucher</div>
            
            <div class="panel-body">

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/saveTrans') }}" files="true" enctype="multipart/form-data">
                    {{ csrf_field() }}

                    <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
                        <label for="currency" class="col-md-4 control-label"></label>

                        <div class="col-md-2">
                           
                            <select class="form-control" name="currency" id="currency" required>
                                <option value="-1">--Currency-- </option>
                               
                                <option value="cedis">GHS</option>
                                <option value="dollars">USD</option>
                                
                            </select>

                            @if ($errors->has('currency'))
                            <span class="help-block">
                                <strong>{{ $errors->first('currency') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('amount') ? ' has-error' : '' }}">
                        <label for="amount" class="col-md-4 control-label"></label>
                        
                        <div class="col-md-4">
                            <input id="amount" type="text" class="form-control" name="amount" placeholder="Gross Amount" value="{{ old('amount') }}" required autofocus>

                            @if ($errors->has('amount'))
                            <span class="help-block">
                                <strong>{{ $errors->first('amount') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('cheque') ? ' has-error' : '' }}">
                        <label for="cheque" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                            <input id="cheque" type="text" placeholder="Cheque No." class="form-control" name="cheque">

                            @if ($errors->has('cheque'))
                            <span class="help-block">
                                <strong>{{ $errors->first('cheque') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                        <label for="description" class="col-md-4 control-label"></label>

                        <div class="col-md-6">
                            <textarea id="description" type="text" placeholder="Transaction Description" class="form-control" name="description" required></textarea>

                            @if ($errors->has('description'))
                            <span class="help-block">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('rate') ? ' has-error' : '' }}">
                        <label for="rate" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                            <input id="cheque" type="text" placeholder="Exchange Rate" class="form-control" name="rate" required>

                            @if ($errors->has('rate'))
                            <span class="help-block">
                                <strong>{{ $errors->first('rate') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('payee') ? ' has-error' : '' }}">
                        <label for="payee" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                           
                            <select class="form-control selectpicker" data-live-search="true" name="payee" id="payee"  name="payee" title="Select a payee..." liveSearchStyle="contains" required>
                                <!-- <option value="-1">--Select Payee-- </option> -->
                                @foreach ($suppliers as $sn) 
                                {
                                <option value="{{ $sn->id }}">{{ $sn->supplier_name }} - {{$sn->description}}</option>
                                }
                                @endforeach
                            </select>

                            @if ($errors->has('payee'))
                            <span class="help-block">
                                <strong>{{ $errors->first('payee') }}</strong>
                            </span>
                            @endif
                        </div>

<!--                        <div class="col-md-2">
                            <button class="add-modal btn btn-secondary" type="" id="add">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                            </button>
                        </div>-->
                    </div>

                    <div class="form-group{{ $errors->has('debit') ? ' has-error' : '' }}">
                        <label for="debit" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                           <select class="form-control selectpicker" data-live-search="true" name="debit" id="debit"  name="debit" title="Select a debit account..." liveSearchStyle="contains" required>
                               <!-- <option value="-1">--Select Debit Account-- </option> -->
                                @foreach ($debit as $an) 
                                {
                                <option value="{{ $an->id }}">{{ $an->id}} - {{ $an->account_name }}</option>
                                }
                                @endforeach
                               
                            </select>

                            @if ($errors->has('debit'))
                            <span class="help-block">
                                <strong>{{ $errors->first('debit') }}</strong>
                            </span>
                            @endif
                        </div>

<!--                        <div class="col-md-1">
                            <button class="btn btn-secondary" type="" id="add">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                            </button>
                        </div>-->
                    </div> 

                    <div class="form-group{{ $errors->has('credit') ? ' has-error' : '' }}">
                        <label for="debit" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                           <select class="form-control selectpicker" name="credit" data-live-search="true" id="credit"  name="credit" title="Select a credit account..." liveSearchStyle="contains" required>
                               <!-- <option value="-1">--Select Credit Account-- </option> -->
                                @foreach ($credit as $an) 
                                {
                                <option value="{{ $an->id }}">{{ $an->id }} - {{ $an->account_name }}</option>
                                }
                                @endforeach
                               
                            </select>

                            @if ($errors->has('credit'))
                            <span class="help-block">
                                <strong>{{ $errors->first('credit') }}</strong>
                            </span>
                            @endif
                        </div>

<!--                        <div class="col-md-1">
                            <button class="btn btn-secondary" type="" id="add">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                            </button>
                        </div>-->
                    </div> 
                    
                     <div class="form-group{{ $errors->has('credit') ? ' has-error' : '' }}">
                        <label for="debit" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                           <select class="form-control selectpicker" data-live-search="true" liveSearchStyle="contains" name="department" id="department" title="Select a department..." required>
                               <!-- <option value="-1">--Select Department-- </option> -->
                                @foreach ($depts as $dept) 
                                {
                                <option value="{{ $dept->id }}">{{ $dept->deptname }}</option>
                                }
                                @endforeach
                               
                            </select>

                            @if ($errors->has('department'))
                            <span class="help-block">
                                <strong>{{ $errors->first('department') }}</strong>
                            </span>
                            @endif
                        </div>

<!--                        <div class="col-md-1">
                            <button class="btn btn-secondary" type="" id="add">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                            </button>
                        </div>-->
                    </div> 
                    
                    <div class="form-group{{ $errors->has('withholding') ? ' has-error' : '' }}">
                        <label for="withholding" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                            <!-- <input id="withholding" type="text" placeholder="Withholding Tax" class="form-control" name="withholding"> -->
                            <b>Withholding Tax</b><br>

                            <input type="radio" name="withholding" value='0'/> 0 <br>
                            <input type="radio" name="withholding" value='5'/> 5 <br>
                             <input type="radio" name="withholding" value='8'/> 8 <br>
                            <input type="radio" name="withholding" value='10'/> 10 <br>
                            <input type="radio" id="other" name="withholding" value="">Other

                            <div class="reveal-if-active">
                                 <input id="withholding" type="text" placeholder="Enter rate here..." class="form-control" name="withholding2">
                            </div>

                            @if ($errors->has('withholding'))
                            <span class="help-block">
                                <strong>{{ $errors->first('withholding') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="form-group{{ $errors->has('vat') ? ' has-error' : '' }}">
                        <label for="vat" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                            <!-- <input id="vat" type="text" placeholder="Enter VAT" class="form-control" name="vat"> -->

                            <b>VAT/NHIL</b><br>

                            <input type="radio" name="vat" value='0'/> 0 <br>
                            <input type="radio" name="vat" value='2.5'/> 2.5 <br>
                             <input type="radio" name="vat" value='17.5'/> 17.5 <br>
                            <input type="radio" id="other" name="vat" value=""/>Other
                            <div class="reveal-if-active">
                                 <input id="vat" type="text" placeholder="Enter rate here..." class="form-control" name="vat2">
                            </div>
                            @if ($errors->has('vat'))
                            <span class="help-block">
                                <strong>{{ $errors->first('vat') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    
                   <!--  <div class="form-group{{ $errors->has('reviewer') ? ' has-error' : '' }}">
                        <label for="reviewer" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                           
                            <select class="form-control" name="reviewer" id="reviewer"  required>
                                <option value="-1">Select Reviewer </option>
                                @foreach ($review as $sn) 
                                {
                                <option value="{{ $sn->id }}">{{ $sn->firstname }} {{ $sn->lastname }}</option>
                                }
                                @endforeach
                            </select>

                            @if ($errors->has('reviewer'))
                            <span class="help-block">
                                <strong>{{ $errors->first('reviewer') }}</strong>
                            </span>
                            @endif
                        </div>
 -->
<!--                        <div class="col-md-2">
                            <button class="add-modal btn btn-secondary" type="" id="add">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                            </button>
                        </div>-->
                    <!-- </div>

                    <div class="form-group{{ $errors->has('approver') ? ' has-error' : '' }}">
                        <label for="approver" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                           
                            <select class="form-control" name="approver" id="approver"  required>
                                <option value="-1">Select Approver </option>
                                @foreach ($approve as $sn) 
                                {
                                <option value="{{ $sn->id }}">{{ $sn->firstname }} {{ $sn->lastname }}</option>
                                }
                                @endforeach
                            </select>

                            @if ($errors->has('approver'))
                            <span class="help-block">
                                <strong>{{ $errors->first('approver') }}</strong>
                            </span>
                            @endif
                        </div> -->

<!--                        <div class="col-md-2">
                            <button class="add-modal btn btn-secondary" type="" id="add">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                            </button>
                        </div>-->
                    <!-- </div> -->

            
                    <div class="form-group{{ $errors->has('documents') ? ' has-error' : '' }}">
                        <label for="documents" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                            upload .pdf, .zip files
                            <input id="documents" type="file" name="documents[]" multiple="multiple">

                            @if ($errors->has('documents'))
                            <span class="help-block">
                                <strong>{{ $errors->first('documents') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>
                    
<!--                    <div class="form-group{{ $errors->has('WHT') ? ' has-error' : '' }}">
                        <label for="WHT" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                            <strong>Withholding Tax</strong><br>
                            <input type="radio" name="WHT" value="yes"> Yes
                            <input type="radio" name="WHT" value="no"> No
                            @if ($errors->has('withholding'))
                            <span class="help-block">
                                <strong>{{ $errors->first('WHT') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>-->
                    
                    
                    
<!--                    <div class="form-group{{ $errors->has('vat') ? ' has-error' : '' }}">
                        <label for="vat" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                            <strong>VAT/NHIL</strong><br>
                            <input type="radio" name="VAT" value="yes"> Yes
                            <input type="radio" name="VAT" value="no"> No
                            @if ($errors->has('vat'))
                            <span class="help-block">
                                <strong>{{ $errors->first('vat') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>-->
<!-- <div class="form-group{{ $errors->has('reviewer') ? ' has-error' : '' }}">
                        <label for="reviewer" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                           <select class="form-control" id="reviewer"  name="reviewer" required>
                               <option value="-1">--Select Reviewer-- </option>
                                @foreach ($review as $user) 
                                {
                                <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                }
                                @endforeach
                               
                            </select>

                            @if ($errors->has('reviewer'))
                            <span class="help-block">
                                <strong>{{ $errors->first('reviewer') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div> 

<div class="form-group{{ $errors->has('approver') ? ' has-error' : '' }}">
                        <label for="approver" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                           <select class="form-control" id="approver"  name="approver" required>
                               <option value="-1">--Select Approver-- </option>
                                @foreach ($approve as $user) 
                                {
                                <option value="{{ $user->id }}">{{ $user->firstname }} {{ $user->lastname }}</option>
                                }
                                @endforeach
                               
                            </select>

                            @if ($errors->has('approver'))
                            <span class="help-block">
                                <strong>{{ $errors->first('approver') }}</strong>
                            </span>
                            @endif
                        </div>

                    </div>  -->


                    <div class="form-group">
                        <div class="col-md-8 col-md-offset-4">
                            <button type="submit" class="btn btn-primary">
                                Create
                            </button>


                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>


<!--Modal for CRUD-->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&minus;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body">
                <form class="form-horizontal" role="form">

                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Supplier Name:</label>
                        <div class="col-md-6">
                            <input type="name" class="form-control" id="name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category">Supplier Category:</label>
                        <div class="col-md-6">
                            <input type="name" class="form-control" id="category" value="">
                        </div>
                    </div>
                </form>

                <div class="modal-footer">
                    <button type="button" class="btn actionBtn" data-dismiss="modal">
                        <span id="footer_action_button" class='glyphicon'> </span>
                    </button>
                    <button type="button" class="btn btn-warning" data-dismiss="modal">
                        <span class='glyphicon glyphicon-remove'></span> Close
                    </button>
                </div>
            </div>
        </div>
    </div>
</div> <!--end modal-->  

<script src="{{URL::asset('js/jquery-1.11.1.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap.min.js')}}"></script>
<script src="{{URL::asset('js/bootstrap-select.min.js')}}"></script>
<script src="{{URL::asset('js/i18n/defaults-*.js')}}"></script>


<script>
$(document).on('click', '.add-modal', function () {
    $('#footer_action_button').text("Add");
    $('#footer_action_button').addClass('glyphicon-plus');
    $('#footer_action_button').removeClass('glyphicon-trash');
    $('.actionBtn').addClass('btn-success');
    $('.actionBtn').removeClass('btn-danger');
    $('.actionBtn').addClass('add');
    $('.form-horizontal').show();
    $('#id').val($(this).data('id'));
    $('#name').val($(this).data('name'));
    $('#category').val($(this).data('category'));
    $('.modal-title').text("Add New Supplier");
    $('#myModal').modal('show');
});

$('.modal-footer').on('click', '.add', function () {
    $.ajax({
        type: 'get',
        url: 'supplier/create',
        datatype: 'json',
        data: {
            // '_token': $('input[name=_token]').val(),
            'sname': $('input[name=sname]').val(),
            'scategory': $('input[name=scategory]').val()
        },
        success: function (data) {
            if ((data.errors)) {
                $('.error').removeClass('hidden');
                $('.error').text(data.errors.name);
                $('.error').text(data.errors.category);
            } else {
                $('.error').remove();

                alert('supplier added');
            }

            $('#name').val('');
            $('#category').val('');
        }
    });
});

</script>
@stop