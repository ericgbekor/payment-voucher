 <?php $nav_trans = 'active'; ?>
@extends('master')
@section('content')
<!-- <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">@section('name') Payment Vouchers @stop</h1>
    </div>
</div>--><!--/.row--> 

@section('icon')   
<li class="active"> <a href="{{url('/viewtransactions')}}"><span class="glyphicon glyphicon-file"></span> </a></li>@stop

@if (session('status'))
<div class="alert alert‐success">
{{ session('status') }}
</div>
@endif


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
            
                <table class="table table-bordered table-striped" id="data" data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="PV" data-sort-order="asc">
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
                                <button class="edit-modal btn btn-primary" id="btn_edit" data-id="{{$transaction->id}}" data-name="{{$transaction->description}}" data-amount="{{$transaction->amount}}" 
                                        data-cheque="{{$transaction->cheque}}" data-rate="{{$transaction->rate}}"  data-payee="{{$transaction->payee}}" 
                                        data-credit="{{$transaction->accountCredited}}" data-debit="{{$transaction->accountDebited}}" data-withholding="{{$transaction->withholding}}" data-vat="{{$transaction->vat}}" 
                                        data-currency="{{$transaction->currency}}" data-dept="{{$transaction->department}}" data-reviewer="{{$transaction->reviewer}}" data-approver="{{$transaction->approver}}"
                                        data-documents="{{$transaction->attachments}}">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </button> 
                            
                            </td>
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
            <!-- <div class="dropdown">
                <button type="button" class="btn btn-primary dropdown-toggle" id="dropdownMenu1"
                    data-toggle="dropdown">Excel Export-QuickBooks
                        <span class="caret"></span>
                    </button> -->
<!-- <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu1">
<li role="presentation">
<a role="menuitem" tabindex="-1" name="btn_bill" id="btn_bill">Bill Payment</a>
</li>
<li role="presentation">
<a role="menuitem" tabindex="-1" name="btn_cheque" id="btn_cheque">Cheque Payment</a>
</li>

</ul> -->
</div>
            <div align="center">
            
                <button type="button" name="btn_delete" id="btn_delete" class="btn btn-danger">
                    <span class="glyphicon glyphicon-trash"></span> Delete
                </button>

                <button type="button" name="btn_submit" id="btn_submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-check"></span> Submit
                </button>
                
                 <!-- <button type="button" name="btn_excel" id="btn_excel" class="btn btn-primary">
                    <span class="glyphicon glyphicon-check"></span> Export To Excel
                </button> -->

            </div>
        </div>
    </div>
</div><!--/.row-->

<!--Modal for CRUD-->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&minus;</button>
                <h4 class="modal-title"></h4>
            </div>
            <div class="modal-body ">
                
              <form class="form-horizontal" role="form">
                    <div class="form-group container-fluid">

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID :</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="id" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="currency">Currency:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="currency" id="currency"  required>
                                    <option value="-1">--Currency-- </option>

                                    <option value="cedis">GHS</option>
                                    <option value="dollars">USD</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Description:</label>
                            <div class="col-sm-8">
                                <textarea type="name" class="form-control" id="name" value=""></textarea>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="amount">Amount:</label>
                            <div class="col-sm-5">
                                <input type="amount" class="form-control" id="amount" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="cheque">Cheque:</label>
                            <div class="col-sm-5">
                                <input type="name" class="form-control" id="cheque" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="rate">Exchange Rate:</label>
                            <div class="col-sm-5">
                                <input type="name" class="form-control" id="rate" value="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="payee">Payee:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="payee" id="payee" required>
                                    <option value="-1">--Select Payee-- </option>
                                    @foreach ($suppliers as $sn) 
                                    {
                                    <option value="{{ $sn->id }}" name="{{ $sn->supplier_name }}">{{ $sn->supplier_name }}</option>
                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="debit">Account Debited:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="debit" id="debit" required>
                                    <option value="-1">--Select Debit Account-- </option>
                                    @foreach ($debit as $an) 
                                    {
                                    <option value="{{ $an->id }}">{{ $an->account_name }}</option>
                                    }
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="credit">Account Credited:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="credit" id="credit"  required>
                                    <option value="-1">--Select Credit Account-- </option>
                                    @foreach ($credit as $an) 
                                    {
                                    <option value="{{ $an->id }}" >{{ $an->account_name }}</option>
                                    }
                                    @endforeach

                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="department">Department:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="department" id="department">
                                    <option value="-1">--Select Department-- </option>
                                    @foreach ($depts as $sn) 
                                    {
                                    <option value="{{ $sn->id }}">{{ $sn->deptname }}</option>
                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="withholding">Withholding Tax:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="withholding" value="">
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="vat">VAT/NHIL:</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="vat" value="">
                            </div>
                        </div>
                        
                        <!-- <div class="form-group">
                            <label class="control-label col-sm-2" for="reviewer">Reviewer:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="reviewer" id="reviewer">
                                    <option value="-1">--Select Reviewer-- </option>
                                    @foreach ($reviewer as $sn) 
                                    {
                                    <option value="{{ $sn->id }}">{{ $sn->firstname}} {{ $sn->lastname}}</option>
                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="approver">Approver:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="approver" id="approver">
                                    <option value="-1">--Select Approver-- </option>
                                    @foreach ($approver as $sn) 
                                    {
                                    <option value="{{ $sn->id }}">{{ $sn->firstname}} {{ $sn->lastname}}</option>
                                    }
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        
 -->

                <div class="form-group{{ $errors->has('documents') ? ' has-error' : '' }}">
                        <label for="documents" class="control-label col-sm-2">Attachments: </label>

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

                </form>
                <div class="deleteContent">
                    Are you Sure you want to delete transaction?
                    <span class="hidden id"></span>
                </div>
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

    $(document).ready(function () {
        $('#btn_delete').click(function () {
            if (confirm("Delete?")) {
                var id = [];
                $('#checkbox:checked').each(function () {
                    id.push(this.value);
                });
                if (id.length === 0) {
                    alert("Please select at least one checkbox");
                } else {
                    $.ajax({
                        async: 'true',
                        type: 'get',
                        url: 'multidelete',
                        data: {id: id},
                        success: function () {
                            for (var i = 0; i < id.length; i++) {

                                $('tr#' + id[i] + '').css('background-color', '#cc');
                                $('tr#' + id[i] + '').fadeOut('slow');
                            }
                        }

                    });
                }
            } else {
                return false;
            }

        });
    });
    $(document).ready(function () {
        $('#btn_submit').click(function () {
            if (confirm("Submit for Review?")) {
                var id = [];
                var count=0
                $('#checkbox:checked').each(function () {
                    id.push(this.value);
                    count=count+1;   
                });
                if (id.length === 0) {
                    alert("Please select at least one checkbox");
                } else {
                    $.ajax({
                        async: 'true',
                        type: 'get',
                        url: 'multireview',
                        data: {id: id
                               },
                        success: function (response) {
                            alert('Vouchers submitted Successfully!!');
                            window.location = "reviewmail?count="+count;

                        }

                    });
                }
            } else {
                return false;
            }

        });
    });


    $(document).ready(function () {
        $('#btn_bill').click(function () {
            if (confirm("Export to Excel")) {
                var id = [];
                $('#checkbox:checked').each(function () {
                    id.push(this.value);
                });
                if (id.length === 0) {
                    alert("Please select at least one checkbox");
                } else {
                    //
                    $.ajax({
                        async: 'false',
                        type: 'get',
                        url: 'bill',
                        data: {id: id},
                        success: function (url) {
                          
                            window.location.assign(this.url);
                    }

                    });
                }
            } else {
                return false;
            }

        });
    });

    $(document).ready(function () {
        $('#btn_cheque').click(function () {
            if (confirm("Export to Excel")) {
                var id = [];
                $('#checkbox:checked').each(function () {
                    id.push(this.value);
                });
                if (id.length === 0) {
                    alert("Please select at least one checkbox");
                } else {
                    //
                    $.ajax({
                        async: 'false',
                        type: 'get',
                        url: 'cheque',
                        data: {id: id},
                        success: function (url) {
                          
                            window.location.assign(this.url);
                    }

                    });
                }
            } else {
                return false;
            }

        });
    });
</script>

<!--Modal script-->
<script type="text/javascript">
    // Edit Data (Modal and function edit data)
    $(document).on('click', '.edit-modal', function () {
        $('#footer_action_button').text(" Update");
        $('#footer_action_button').addClass('glyphicon-check');
        $('#footer_action_button').removeClass('glyphicon-trash');
        $('.actionBtn').addClass('btn-success');
        $('.actionBtn').removeClass('btn-danger');
        $('.actionBtn').addClass('edit');
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#id').val($(this).data('id'));
        $('#currency').val($(this).data('currency'));
        $('#name').val($(this).data('name'));
        $('#amount').val($(this).data('amount'));
        $('#cheque').val($(this).data('cheque'));
        $('#rate').val($(this).data('rate'));
        $('#debit').val($(this).data('debit'));
        $('select[name^="payee"] option[name="'+$(this).data('payee')+'"]').attr("selected",true);
        $('#credit').val($(this).data('credit'));
        $('#department').val($(this).data('dept'));
        $('#reviewer').val($(this).data('reviewer'));
        $('#approver').val($(this).data('approver'));
        $('#withholding').val($(this).data('withholding'));
        $('#vat').val($(this).data('vat'));
        $('.modal-title').text("Edit " + $('#name').val() + "'s details");
        $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.edit', function () {
        $.ajax({
            async: 'true',
            type: 'get',
            url: 'updateTrans',
            datatype: 'json',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('#id').val(),
                'description': $('#name').val(),
                'amount': $('#amount').val(),
                'currency': $('#currency').val(),
                'rate': $('#rate').val(),
                'cheque': $('#cheque').val(),
                'debit': $('#debit').val(),
                'credit': $('#credit').val(),
                'payee': $('#payee').val(),
                'department': $('#department').val(),
                'reviewer': $('#reviewer').val(),
                'approver': $('#approver').val(),
                'withholding': $('#withholding').val(),
                'vat': $('#vat').val()
            },
            success: function () {
                alert("Record Updated Successfully");
                location.href = 'viewtransactions';
            }
        });
    });

//delete function
    $(document).on('click', '.delete-modal', function () {
        $('#footer_action_button').text("Delete");
        $('#footer_action_button').removeClass('glyphicon-check');
        $('#footer_action_button').addClass('glyphicon-trash');
        $('.actionBtn').removeClass('btn-success');
        $('.actionBtn').addClass('btn-danger');
        $('.actionBtn').addClass('delete');
        $('.modal-title').text('Delete Record');
        $('.id').val($(this).data('id'));
        $('.deleteContent').show();
        $('.form-horizontal').hide();
        $('.name').html($(this).data('description'));
        $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.delete', function () {
        $.ajax({
            async: 'true',
            type: 'get',
            url: 'deleteTrans',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.id').val()
            },
            success: function () {
                $('.item' + $('.id').val()).remove();
            }
        });
    });

</script>


@stop

