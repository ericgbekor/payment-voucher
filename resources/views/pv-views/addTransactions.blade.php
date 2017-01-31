@extends('master')
@section('content')

<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">@section('name') Transactions @stop</h1>
    </div>
</div><!--/.row-->

<div class="row">
    <div class="col-lg-11">
        <div class="panel panel-default">
            <div class="panel-heading"> Payment Vouchers</div>
            <div class="panel-body">

                <form class="form-horizontal" role="form" method="POST" action="{{ url('/saveTrans') }}" file="true">
                    {{ csrf_field() }}

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
                            <input id="cheque" type="text" placeholder="Cheque No." class="form-control" name="cheque" required>

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
                            <input id="description" type="text" placeholder="Transaction Description" class="form-control" name="description" required>

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
                           

                            <select class="form-control" name="payee" id="payee"  name="payee" required>
                                <option value="-1">--Select Payee-- </option>
                                @foreach ($suppliers as $sn) 
                                {
                                <option value="{{ $sn->id }}">{{ $sn->supplier_name }}</option>
                                }
                                @endforeach
                            </select>

                            @if ($errors->has('payee'))
                            <span class="help-block">
                                <strong>{{ $errors->first('payee') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="col-md-2">
                            <button class="add-modal btn btn-secondary" type="" id="add">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                            </button>
                        </div>
                    </div>

                    <div class="form-group{{ $errors->has('debit') ? ' has-error' : '' }}">
                        <label for="debit" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                           <select class="form-control" name="debit" id="debit"  name="debit" required>
                               <option value="-1">--Select Account-- </option>
                                @foreach ($accounts as $an) 
                                {
                                <option value="{{ $an->id }}">{{ $an->account_name }}</option>
                                }
                                @endforeach
                               
                            </select>

                            @if ($errors->has('debit'))
                            <span class="help-block">
                                <strong>{{ $errors->first('debit') }}</strong>
                            </span>
                            @endif
                        </div>

                        <div class="col-md-1">
                            <button class="btn btn-secondary" type="" id="add">
                                <span class="glyphicon glyphicon-plus-sign"></span>
                            </button>
                        </div>
                    </div> 
                    <div class="form-group{{ $errors->has('documents') ? ' has-error' : '' }}">
                        <label for="documents" class="col-md-4 control-label"></label>

                        <div class="col-md-4">
                            <strong>Attachments</strong>
                            <input id="documents" type="file" name="documents">

                            @if ($errors->has('documents'))
                            <span class="help-block">
                                <strong>{{ $errors->first('documents') }}</strong>
                            </span>
                            @endif
                        </div>
                    </div>



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