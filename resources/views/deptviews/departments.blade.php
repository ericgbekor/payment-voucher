<?php $nav_department = 'active'; ?>
@extends('master')
@section('content')
<!-- <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">@section('name')  Departments @stop</h1>
    </div>
</div> --><!--/.row-->

@section('icon')   
<li class="active"> <a href="{{url('/department')}}"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> </a></li>@stop



<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading"></div>
            <div class="panel-body">
                <table id="data" data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="id" data-sort-order="asc">
                    <thead>
                        <tr>
                            <th data-field="state" data-checkbox="true" >Item</th>
                            <th data-field="id" data-sortable="true">ID</th>
                            <th data-field="deptname"  data-sortable="true">Department Name</th>
                            <th data-field="description"  data-sortable="true">Description</th>
                            <th data-field="status" data-sortable="true"> Status</th>
                            <th>Edit</th>
                            <th>Delete</th>

                        </tr>
                    </thead>
                    {{ csrf_field() }}
                    <tbody>
                        @foreach($depts as $dept)
                        <tr class="item{{$dept->id}}"> 
                            <td data-checkbox="true"></td>
                            <td> {{$dept->id}} </td>
                            <td> {{$dept->deptname}}</td>
                            <td> {{$dept->description}} </td>
                             <td>
                                    <a class="btn btn-default" type="submit" href="deptstatus?status={{$dept->status}}&&id={{$dept->id}}" data-id="{{$dept->id}}" data-name="{{$dept->deptname}}" data-description="{{$dept->description}}"
                                        data-status="{{$dept->status}}">
                                   @if ($dept->status === 'enabled') Disable @else Enable @endif
                                </a>
                            </td>
                            <td>
                                <button class="edit-modal btn btn-primary" data-id="{{$dept->id}}" data-name="{{$dept->deptname}}" data-description="{{$dept->description}}">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </button> </td>
                            <td>
                                <button class="delete-modal btn btn-danger" data-id="{{$dept->id}}" data-name="{{$dept->departmentName}}">
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
                            <input type="text" class="form-control" id="id" value="" readonly="true">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Department Name:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="class">Description:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="description" value="">
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
        $('#description').val($(this).data('description'));
        $('.modal-title').text("Edit " + $('#name').val() + "'s details");
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function () {
        $.ajax({
            type: 'put',
            url: 'department.update',
            datatype: 'json',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#id").val(),
                'name': $('#name').val(),
                'description': $('#description').val()
            },
            success: function (data) {

                /* $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td data-checkbox='true'></td><td>" + data.id + "</td><td>" + data.account_name +
                 "</td><td>" + data.account_class + "</td><td>" + data.created_at + "</td><td>" + data.updated_at + "</td><td>\n\
                 <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.account_name + "' data-class='" + data.account_class + "'><span class='glyphicon glyphicon-edit'></span> Edit</button></td><td> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.account_name + "' data-class='" + data.account_class + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");*/
                location.href = "{{url('/department')}}";
            }
        });
    });

    // add function
    $("#add").click(function () {
        $.ajax({
            type: 'get',
            url: 'department/create',
            datatype: 'json',
            data: {
                 '_token': $('input[name=_token]').val(),
//                'id': $('input[name=did]').val(),
                'name': $('input[name=dname]').val()
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
                    location.href = "{{url('/department')}}";
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
            url: '/department/' + $('.id').val(),
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



