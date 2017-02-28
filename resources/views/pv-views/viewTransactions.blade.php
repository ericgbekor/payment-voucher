
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
                <table class="table-bordered" id="data" data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="total amount" data-sort-order="asc">
                    <thead>
                        <tr>
                            <th>Item</th>
                            <th data-field="id" data-sortable="true">PV</th>
                            <th data-field="description"  data-sortable="true">Transaction Description</th>
                            <th data-field="amount" data-sortable="true"> Total Amount</th>
                            <th data-field="status" data-sortable="true"> Status</th>
                            <th data-field="created_at" data-sortable="true"> Created At</th>
                            <th data-field="updated_at" data-sortable="true"> Updated At</th>
                            <th>Edit</th>
                            <th>Delete</th>

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
                            <td> {{$transaction->status}}</td>
                            <td> {{$transaction->created_at}} </td>
                            <td > {{$transaction->updated_at}} </td>



                            <td>
                                <button class="edit-modal btn btn-primary" id="btn_edit" data-id="{{$transaction->id}}" data-name="{{$transaction->description}}" data-amount="{{$transaction->amount}}" 
                                        data-cheque="{{$transaction->cheque}}" data-rate="{{$transaction->rate}}" file-attachment="{{$transaction->attachments}}" data-payee="{{$transaction->payee}}"
                                        data-debit="{{$transaction->accountDebited}}" data-wht="{{$transaction->WHT}}" data-nhil="{{$transaction->nhil}}" data-currency="{{$transaction->currency}}">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </button> </td>
                            <td>
                                <button class="delete-modal btn btn-danger" data-id="{{$transaction->id}}" data-descrition="{{$transaction->description}}" data-amount="{{$transaction->amount}}">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div align="right">
                <button type="button" name="btn_delete" id="btn_delete" class="btn btn-success">
                    <span class="glyphicon glyphicon-trash"></span> Delete
                </button>

                <button type="button" name="btn_submit" id="btn_submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-check"></span> Submit
                </button>
                
                 <button type="button" name="btn_excel" id="btn_excel" class="btn btn-secondary">
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
            <div class="modal-body">
                <form class="form-horizontal" role="form">
                    <div class="form-group">

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="id">ID :</label>
                            <div class="col-sm-5">
                                <input type="text" class="form-control" id="id" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="currency">Currency:</label>
                            <div class="col-sm-5">
                                <select class="form-control" name="currency" id="currency"  name="currency" required>
                                    <option value="-1">--Currency-- </option>

                                    <option value="cedis">GHS</option>
                                    <option value="dollars">$</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="name">Description:</label>
                            <div class="col-sm-8">
                                <input type="name" class="form-control" id="name" value="">
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
                                <select class="form-control" name="payee" id="payee"  name="payee" required>
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
                                <select class="form-control" name="debit" id="debit"  name="debit" required>
                                    <option value="-1">--Select Debit Account-- </option>
                                    @foreach ($accounts as $an) 
                                    {
                                    <option value="{{ $an->id }}">{{ $an->account_name }}</option>
                                    }
                                    @endforeach

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="attachment">Attachment:</label>
                            <div class="col-sm-10">
                                <input id="documents" type="file" name="documents">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="wht">Withholding Tax:</label>
                            <div class="col-sm-5">
                                <input type="radio" name="wht" class="wht" id="wht_yes" value="yes"> Yes
                                <input type="radio" name="wht" class="wht" id="wht_no" value="no"> No
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-sm-2" for="vat">VAT/NHIL:</label>
                            <div class="col-sm-5">
                                <input type="radio" name="vat" class="vat" id="vat_yes" value="yes"> Yes
                                <input type="radio" name="vat" class="vat" id="vat_no" value="no"> No
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
                        data: {id: id},
                        success: function () {
                            window.location = "/transactions";
//                         for(var i=0;i<id.length;i++){
//                             
//                           $('tr#'+id[i]+'').css('background-color','#cc');
//                           $('tr#'+id[i]+'').fadeOut('slow');

                            //}
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
                    $.ajax({
                        async: 'true',
                        type: 'get',
                        url: '/exportExcel',
                        data: {id: id},
                        success: function () {
                            
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
        if ($(this).data('wht') == 'yes') {
            $('#wht_yes').val($(this).data('wht')).prop('checked', true);
        } else {
            $('#wht_no').val($(this).data('wht')).prop('checked', true);
        }

        if ($(this).data('nhil') == 'yes') {
            $('#vat_yes').val($(this).data('nhil')).prop('checked', true);
        } else {
            $('#vat_no').val($(this).data('nhil')).prop('checked', true);
        }
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
                'name': $('#name').val(),
                'amount': $('#amount').val(),
                'currency': $('#currency').val(),
                'rate': $('#rate').val(),
                'cheque': $('#cheque').val(),
                'debit': $('#debit').val(),
                'payee': $('#debit').val(),
                'WHT': $('.wht').val(),
                'VAT': $('.vat').val()
            },
            success: function (data) {
                alert(data);

                /*$('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td data-checkbox='true'></td><td>" + data.id + "</td><td>" + data.description +
                 "</td><td>" + data.amount + "</td><td>" + data.created_at + "</td><td>" + data.updated_at + "</td><td>\n\
                 <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.description + "' data-category='" + data.amount + "'><span class='glyphicon glyphicon-edit'></span> Edit</button></td><td> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.description + "' data-category='" + data.amount + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");*/
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
        // $('.name').html($(this).data('description'));
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

