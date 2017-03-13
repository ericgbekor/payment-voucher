

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

                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div align="right">
                <button type="button" name="btn_reject" id="btn_reject" class="btn btn-success">
                    <span class="glyphicon glyphicon-trash"></span> Reject
                </button>
                
                <button type="button" name="btn_review" id="btn_review" class="btn btn-primary">
                    <span class="glyphicon glyphicon-check"></span> Approve
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
                        <label class="control-label col-sm-2" for="id">ID :</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="id" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="name">Supplier Name:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="name" value="">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-sm-2" for="category">Supplier Category:</label>
                        <div class="col-sm-10">
                            <input type="name" class="form-control" id="category" value="">
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
                  $('#checkbox:checked').each(function(){
                  id.push(this.value);
                  });
                  
             if(id.length === 0){
                 alert("Please select at least one checkbox");
             }
             else{
                 $.ajax({
                     async: 'true',
                     type: 'get',
                     url: '/multireject',
                     data:{id:id},
                     success:function(){
                          window.location="/approveTrans";
//                         for(var i=0;i<id.length;i++){
//                             
//                           $('tr#'+id[i]+'').css('background-color','#cc');
//                           $('tr#'+id[i]+'').fadeOut('slow');
//                           
//                         }
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
              if(confirm("Approve?")){
                  var id =[];
                  $('#checkbox:checked').each(function(){
                  id.push(this.value);
                  });
                  
             if(id.length === 0){
                 alert("Please select at least one checkbox");
             }
             else{
                 $.ajax({
                     async: 'true',
                     type: 'get',
                     url: '/multiapprove',
                     data:{id:id},
                     success:function(){
                         window.location="/approveTrans";
//                         for(var i=0;i<id.length;i++){
//                             
//                           $('tr#'+id[i]+'').css('background-color','#cc');
//                           $('tr#'+id[i]+'').fadeOut('slow');
                           
                         //}
                     }
                     
                 });
                 
             } 
             }
                  else{
                  return false;}
             
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
        $('#name').val($(this).data('name'));
        $('#category').val($(this).data('category'));
        $('.modal-title').text("Edit " + $('#name').val() + "'s details");
        $('#myModal').modal('show');
    });

    $('.modal-footer').on('click', '.edit', function () {
        $.ajax({
            type: 'put',
            url: '/supplier/' + $("#id").val(),
            datatype: 'json',
            data: {
                '_token': $('input[name=_token]').val(),
                'id': $("#id").val(),
                'name': $('#name').val(),
                'category': $('#category').val()
            },
            success: function (data) {

                /*$('.item' + data.id).replaceWith("<tr class='item" + data.id + "'><td data-checkbox='true'></td><td>" + data.id + "</td><td>" + data.description +
                 "</td><td>" + data.amount + "</td><td>" + data.created_at + "</td><td>" + data.updated_at + "</td><td>\n\
                 <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.description + "' data-category='" + data.amount + "'><span class='glyphicon glyphicon-edit'></span> Edit</button></td><td> <button class='delete-modal btn btn-danger' data-id='" + data.id + "' data-name='" + data.description + "' data-category='" + data.amount + "'><span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");*/
                location.href = 'supplier';
            }
        });
    });

    // add function
    $("#add").click(function () {
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
                    $('#data').append("<tr class='item" + data.id + "'><td data-checkbox='true'></td><td>" + data.id + "</td><td>" + data.description +
                            "</td><td>" + data.amount + "</td><td>" + data.created_at + "</td><td>" + data.updated_at + "</td><td>\n\
                        <button class='edit-modal btn btn-info' data-id='" + data.id + "' data-name='" + data.description + "' data-category='" + data.amount + "'><span class='glyphicon glyphicon-edit'>\n\
                           </span> Edit</button></td><td> <button class='delete-modal btn btn-danger' data-id='" + data.id +
                            "' data-name='" + data.description + "' data-category='" + data.amount + "'>\n\
                        <span class='glyphicon glyphicon-trash'></span> Delete</button></td></tr>");
                    location.href = 'supplier';
                }

                $('#name').val('');
                $('#category').val('');
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




