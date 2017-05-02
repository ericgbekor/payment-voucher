
@extends('master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">@section('name') Payment Vouchers @stop</h1>
    </div>
</div><!--/.row-->


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-body">
                <table class="table table-bordered table-striped" id="data" data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="total amount" data-sort-order="asc">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th data-field="id" data-sortable="true">PV</th>
                            <th data-field="description"  data-sortable="true">Transaction Description</th>
                            <th data-field="amount" data-sortable="true"> Total Amount</th>
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
                             <td> {{$transaction->payee}}</td>
                            <td> {{$transaction->status}}</td>
                            <td> {{$transaction->created_at}} </td>
                            <td > {{$transaction->updated_at}} </td>

                            <td>
                                <button class="edit-modal btn btn-primary" id="btn_edit" data-id="{{$transaction->id}}" data-name="{{$transaction->description}}" data-amount="{{$transaction->amount}}" 
                                        data-cheque="{{$transaction->cheque}}" data-rate="{{$transaction->rate}}"  data-payee="{{$transaction->payee}}" 
                                        data-credit="{{$transaction->accountCredited}}" data-debit="{{$transaction->accountDebited}}" data-withholding="{{$transaction->withholding}}" data-vat="{{$transaction->vat}}" 
                                        data-currency="{{$transaction->currency}}" data-dept="{{$transaction->department}}" data-reviewer="{{$transaction->reviewer}}" data-approver="{{$transaction->approver}}">
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
            <div align="center">
                <button type="button" name="btn_delete" id="btn_delete" class="btn btn-danger">
                    <span class="glyphicon glyphicon-trash"></span> Delete
                </button>

                <button type="button" name="btn_submit" id="btn_submit" class="btn btn-success">
                    <span class="glyphicon glyphicon-check"></span> Submit
                </button>
                
                 <button type="button" name="btn_excel" id="btn_excel" class="btn btn-primary">
                    <span class="glyphicon glyphicon-check"></span> Export To Excel
                </button>
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
                                    <option value="{{ $sn->id }}">{{ $sn->supplier_name }}</option>
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
                                    <option value="{{ $an->id }}">{{ $an->account_name }}</option>
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
                                    <option value="{{ $sn->id }}">{{ $sn->departmentName }}</option>
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
                        
                        <div class="form-group">
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
                        
<!--                        <div class="form-group">
                            <label class="control-label col-sm-2" for="attachment">Attachment:</label>
                            <div class="col-sm-10">
                                <input id="documents" type="file" name="documents">

                            </div>
                        </div>-->


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
                        url: '/multidelete',
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
                $('#checkbox:checked').each(function () {
                    id.push(this.value);   
                });
                if (id.length === 0) {
                    alert("Please select at least one checkbox");
                } else {
                    $.ajax({
                        async: 'true',
                        type: 'get',
                        url: '/multireview',
                        data: {id: id
                               },
                        success: function (response) {
                            window.location = "/reviewmail?email="+response;

                        }

                    });
                }
            } else {
                return false;
            }

        });
    });


    $(document).ready(function () {
        $('#btn_excel').click(function () {
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
                        url: '/exportExcel',
                        data: {id: id},
                        success: function (url) {
                          
                            window.open(this.url);
                            location.reload();
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
        $('#payee').val($(this).data('payee'));
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
            url: '/updateTrans',
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
                location.href = '/transactions';
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
            url: '/deleteTrans',
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

