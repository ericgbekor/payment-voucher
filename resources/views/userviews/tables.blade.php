 <?php $nav_user = 'active'; ?>
@extends('master')
@section('content')
<div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">@section('name') Manage Users @stop</h1>
    </div>
</div><!--/.row-->

<!--adding new data-->
<div class="form-group row add pull-right">
    <div class="col-md-2 ">
        <a class="btn btn-success" type="submit" href="newuser" id="add">
            <span class="glyphicon glyphicon-plus"></span> New User
        </a>
    </div>
</div>
<!--end of add-->


<div class="row">
    <div class="col-lg-12">
        <div class="panel panel-default">
            <div class="panel-heading">List of Users</div>
            <div class="panel-body">
                <table id="data" data-toggle="table"  data-show-refresh="true" data-show-toggle="true" data-show-columns="true" data-search="true" data-select-item-name="toolbar1" data-pagination="true" data-sort-name="username" data-sort-order="asc">
                    <thead>
                        <tr>
                            <th data-field="username"  data-sortable="true">Username</th>
                            <th data-field="email" data-sortable="true">Email</th>
                            <th data-field="full name" data-sortable="true"> Full name</th>
                            <th data-field="created_at" data-sortable="true"> Created At</th>
                            <th data-field="updated_at" data-sortable="true"> Updated At</th>
                            <th></th>
                            <th></th>
                            <th></th>
                            <th></th>

                        </tr>
                    </thead>
                    {{ csrf_field() }}
                    <tbody>
                        @foreach($users as $user)
                        <tr class="item{{$user->id}}"> 
                            <td> {{$user->username}}</td>
                            <td> {{$user->email}}</td>
                            <td> {{$user->lastname}},{{$user->firstname}} </td>
                            <td> {{$user->created_at}} </td>
                            <td > {{$user->updated_at}} </td>
                            <td>
                                <button class="show-modal btn btn-secondary" data-id="{{$user->id}}" data-username="{{$user->username}}" data-email="{{$user->email}}"
                                        data-firstname="{{$user->firstname}}" data-lastname="{{$user->lastname}}" data-usertype="{{$user->usertype}}" data-permission="{{$user->permission}}"
                                        data-status="{{$user->status}}">
                                    <span class="glyphicon glyphicon-eye-open"></span> Show
                                </button> </td>
                            <td>
                                <button class="edit-modal btn btn-primary" data-id="{{$user->id}}" data-username="{{$user->username}}" data-email="{{$user->email}}"
                                        data-firstname="{{$user->firstname}}" data-lastname="{{$user->lastname}}" data-usertype="{{$user->usertype}}" data-role="{{$user->role}}"
                                        data-status="{{$user->status}}">
                                    <span class="glyphicon glyphicon-edit"></span> Edit
                                </button> </td>
                                <td>
                                    <a class="btn btn-default" type="submit" href="userstatus?status={{$user->status}}&&id={{$user->id}}" data-id="{{$user->id}}" data-name="{{$user->username}}" data-class="{{$user->email}}"
                                        data-firstname="{{$user->firstname}}" data-lastname="{{$user->lastname}}" data-usertype="{{$user->usertype}}" data-role="{{$user->role}}"
                                        data-status="{{$user->status}}">
                                   @if ($user->status === 'enabled') Disable @else Enable @endif
                                </a>
                            </td>
                            <td>
                                <button class="delete-modal btn btn-danger" data-id="{{$user->id}}" data-name="{{$user->username}}" data-class="{{$user->email}}"
                                        data-firstname="{{$user->firstname}}" data-lastname="{{$user->lastname}}" data-usertype="{{$user->usertype}}" data-role="{{$user->role}}"
                                        data-status="{{$user->status}}">
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

<!--Modal for edit and delete-->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <div class="form-group">
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
                            <label class="control-label col-sm-2" for="username">Username:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="username" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="email">Email:</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" id="email" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="firstname">Firstname:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="firstname" value="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="lastname">Lastname:</label>
                            <div class="col-sm-10">
                                <input type="name" class="form-control" id="lastname" value="">
                            </div>
                        </div>

<!--                        <div class="form-group">
                            <label class="control-label col-sm-2" for="usertype">User Type:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="usertype" value="">
                            </div>
                        </div>-->
                        <div class="form-group {{$errors->has('role')? 'has-error':''}}">
                            <label for="role" class="col-md-2 control-label">Role</label>

                            <div class="col-sm-10">
                                <!--<b>Role </b> <br>-->
                                <input type ='checkbox' name ='role' value='1' /> Creator
                                <input type ='checkbox' name ='role' value='2' /> Reviewer
                                <input type ='checkbox' name ='role' value='3' /> Approver
                                <input type ='checkbox' name ='role' value='4' /> Administrator

                            </div>

                        </div>
                        <div class="form-group">
                            <label class="control-label col-sm-2" for="status">User Status:</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" id="status" value="">
                            </div>
                        </div>
                        <input type="hidden" id="_token" method='{{csrf_field()}}'>
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
    </div>
</div> <!--end modal-->




<div class="row">

    <script>
//        $(function () {
//            $('#hover, #striped, #condensed').click(function () {
//                var classes = 'table';
//                if ($('#hover').prop('checked')) {
//                    classes += ' table-hover';
//                }
//                if ($('#condensed').prop('checked')) {
//                    classes += ' table-condensed';
//                }
//                $('#table-style').bootstrapTable('destroy')
//                        .bootstrapTable({
//                            classes: classes,
//                            striped: $('#striped').prop('checked')
//                        });
//            });
//        });
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

<!--Modal script-->
<script type="text/javascript">
    // Edit Data (Modal and function edit data)
    $(document).on('click', '.edit-modal', function () {
        $('#footer_action_button').text(" Update").show();
        $('#footer_action_button').addClass('glyphicon-check').show();
        $('#footer_action_button').removeClass('glyphicon-trash').show();
        $('.actionBtn').addClass('btn-success').show();
        $('.actionBtn').removeClass('btn-danger').show();
        $('.actionBtn').addClass('edit').show();
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#id').val($(this).data('id')).prop("disabled", false);
        $('#username').val($(this).data('username')).prop("disabled", false);
        $('#email').val($(this).data('email')).prop("disabled", false);
        $('#usertype').val($(this).data('usertype')).prop("disabled", false);
        $('#firstname').val($(this).data('firstname')).prop("disabled", false);
        $('#lastname').val($(this).data('lastname')).prop("disabled", false);
        //$('#role').val($(this).data('role')).prop("disabled", false);
        $('input[name^="role"][value='+$(this).data('role')+']').prop("checked",true).prop("disabled", false);
        console.log($(this).data('role'));
        $('#status').val($(this).data('status')).prop("disabled", false);
        $('.modal-title').text("Edit " + $('#firstname').val() + "'s details");
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function () {
        $.ajax({
            type: 'put',
            url: 'user/' + $("#id").val(),
            datatype: 'json',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#id").val(),
                'name': $('#username').val(),
                'mail': $('#email').val(),
                'type': $('#usertype').val(),
                'fname': $('#firstname').val(),
                'lname': $('#lastname').val(),
                'permissions': $('#permission').val(),
                'status': $('#status').val()
            },
            success: function (data) {

                /*  $('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td>" + data.username +
                 "</td><td>" + data.email + "</td><td>" + data.created_at + "</td><td>" + data.updated_at + "</td><td>\n\
                 <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.username + "' data-class='" + data.email + "'><span class='glyphicon glyphicon-edit'></span> Edit</button></td><td> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.username + "' data-class='" + data.email + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");*/
                location.href = "{{url('user')}}";
            }
        });
    });

    // add function
    $("#add").click(function () {
        $.ajax({
            type: 'get',
            url: 'user/create',
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
                    /* $('#data').append("<tr class='item" + data.id + "'><td data-checkbox='true'></td><td>" + data.id + "</td><td>" + data.username +
                     "</td><td>" + data.email + "</td><td>" + data.created_at + "</td><td>" + data.updated_at + "</td><td>\n\
                     <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.username + "' data-class='" + data.email + "'><span class='glyphicon glyphicon-edit'>\n\
                     </span> Edit</button></td><td> <button class='delete-modal btn btn-danger' data-id='" + data.id +
                     "' data-name='" + data.username + "' data-class='" + data.email + "'>\n\
                     <span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");*/
                    location.href = "{{url('/user')}}";
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
            url: 'user/' + $('.id').val(),
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $('.id').val()
            },
            success: function () {
                $('.item' + $('.id').val()).remove();
            }
        });
    });

    //showing user's details

    $(document).on('click', '.show-modal', function () {
        $('#footer_action_button').text(" Update").hide();
        $('#footer_action_button').addClass('glyphicon-check').hide();
        $('#footer_action_button').removeClass('glyphicon-trash').hide();
        $('.actionBtn').addClass('btn-success').hide();
        $('.actionBtn').removeClass('btn-danger').hide();
        $('.actionBtn').addClass('edit').hide();
        $('.deleteContent').hide();
        $('.form-horizontal').show();
        $('#id').val($(this).data('id')).prop("disabled", true);
        $('#username').val($(this).data('username')).prop("disabled", true);
        $('#email').val($(this).data('email')).prop("disabled", true);
        $('#usertype').val($(this).data('usertype')).prop("disabled", true);
        $('#firstname').val($(this).data('firstname')).prop("disabled", true);
        $('#lastname').val($(this).data('lastname')).prop("disabled", true);
        $('#role').val($(this).data('role')).prop("disabled", true);
        $('#status').val($(this).data('status')).prop("disabled", true);
        $('.modal-title').text($('#firstname').val() + "'s details");
        $('#myModal').modal('show');
    });

</script>

@stop

