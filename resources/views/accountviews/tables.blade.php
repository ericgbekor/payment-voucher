
@extends('master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">@section('name') Chart of Accounts @stop</h1>
    </div>
</div><!--/.row-->

<!--adding new data-->
<div class="form-group row add">
    <!--   <div class="panel-heading">Add New Account</div>-->
    <div class="col-md-3">
        <input type="text" class="form-control" id="aid" name="aid" placeholder="Account ID" required>
        <p class="error text-center alert alert-danger hidden"></p>
    </div>
    <div class="col-md-4">
        <input type="text" class="form-control" id="aname" name="aname" placeholder="Account Name" required>
        <p class="error text-center alert alert-danger hidden"></p>
    </div>

    <div class="col-md-3">
        <input type="text" class="form-control" id="aclass" name="aclass" placeholder="Account Class " required>
        <p class="error text-center alert alert-danger hidden"></p>

       <!-- <input type="hidden" id="_token" method='{{csrf_field()}}'>-->
    </div>
    <div class="col-md-2">
        <button class="btn btn-warning" type="submit" id="add">
            <span class="glyphicon glyphicon-plus"></span> Add Account
        </button>
    </div>
</div>

<!--end of add-->


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">List of Accounts</div>
            <div class="panel-body">
                <table id="data" data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="id" data-sort-order="asc">
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true" >Item</th>
                            <th data-field="id" data-sortable="true">Account ID</th>
                            <th data-field="account_name"  data-sortable="true">Account Name</th>
                            <th data-field="account_class" data-sortable="true">Account Class</th>
                            <th data-field="created_at" data-sortable="true"> Created At</th>
                            <th data-field="updated_at" data-sortable="true"> Updated At</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                    </thead>
                    {{ csrf_field() }}
                    <tbody>
                        @foreach($accounts as $account)
                        <tr class="item{{$account->id}}"> 
                            <td data-checkbox="true"></td>
                            <td> {{$account->id}} </td>
                            <td> {{$account->account_name}}</td>
                            <td> {{$account->account_class}}</td>
                            <td> {{$account->created_at}} </td>
                            <td > {{$account->updated_at}} </td>
                            <td>
                                <button class="edit-modal btn btn-primary" data-id="{{$account->id}}" data-name="{{$account->account_name}}" data-class="{{$account->account_class}}">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </button> </td>
                            <td>
                                <button class="delete-modal btn btn-danger" data-id="{{$account->id}}" data-name="{{$account->account_name}}" data-class="{{$account->account_class}}">
                                    <span class="glyphicon glyphicon-trash"></span> Delete
                                </button>
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                </table>
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
                        <label class="control-label col-sm-2" for="id">ID :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Account Name:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="class">Account Class:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="class" value="">
                        </div>
                    </div>
                </form>
                <div class="deleteContent">
                    Are you Sure you want to delete <span class="name"></span> ?
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
        $(function () {
            $('#hover, #striped, #condensed').click(function () {
                var classes = 'table';
                if ($('#hover').prop('checked')) {
                    classes += ' table-hover';
                }
                if ($('#condensed').prop('checked')) {
                    classes += ' table-condensed';
                }
                $('#table-style').bootstrapTable('destroy')
                        .bootstrapTable({
                            classes: classes,
                            striped: $('#striped').prop('checked')
                        });
            });
        });
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
        $('#name').val($(this).data('name'));
        $('#class').val($(this).data('class'));
        $('.modal-title').text("Edit " + $('#name').val() + "'s details");
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function () {
        $.ajax({
            type: 'put',
            url: '/account/' + $("#id").val(),
            datatype: 'json',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#id").val(),
                'name': $('#name').val(),
                'class': $('#class').val()
            },
            success: function (data) {

                /* $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td data-checkbox='true'></td><td>" + data.id + "</td><td>" + data.account_name +
                 "</td><td>" + data.account_class + "</td><td>" + data.created_at + "</td><td>" + data.updated_at + "</td><td>\n\
                 <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.account_name + "' data-class='" + data.account_class + "'><span class='glyphicon glyphicon-edit'></span> Edit</button></td><td> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.account_name + "' data-class='" + data.account_class + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");*/
                location.href = 'account';
            }
        });
    });

    // add function
    $("#add").click(function () {
        $.ajax({
            type: 'get',
            url: 'account/create',
            datatype: 'json',
            data: {
                // '_token': $('input[name=_token]').val(),
                'aid': $('input[name=aid]').val(),
                'aname': $('input[name=aname]').val(),
                'aclass': $('input[name=aclass]').val()
            },
            success: function (data) {
                if ((data.errors)) {
                    $('.error').removeClass('hidden');
                    $('.error').text(data.errors.name);
                    $('.error').text(data.errors.class);
                } else {
                    $('.error').remove();
                    /* $('#data').append("<tr class='item" + data.id + "'><td data-checkbox='true'></td><td>" + data.id + "</td><td>" + data.account_name +
                     "</td><td>" + data.account_class + "</td><td>" + data.created_at + "</td><td>" + data.updated_at + "</td><td>\n\
                     <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.account_name + "' data-class='" + data.account_class + "'><span class='glyphicon glyphicon-edit'>\n\
                     </span> Edit</button></td><td> <button class='delete-modal btn btn-danger' data-id='" + data.id +
                     "' data-name='" + data.account_name + "' data-class='" + data.account_class + "'>\n\
                     <span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");*/
                    location.href = 'account';
                }

                $('#name').val('');
                $('#class').val('');
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
        $('.name').html($(this).data('name'));
        $('#myModal').modal('show');
    });
    $('.modal-footer').on('click', '.delete', function () {
        $.ajax({
            async: 'true',
            type: 'delete',
            url: '/account/' + $('.id').val(),
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

