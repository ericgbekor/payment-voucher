<?php $nav_supplier = 'active'; ?>
@extends('master')
@section('content')
<!-- <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">@section('name') Suppliers @stop</h1>
    </div>
</div> --><!--/.row-->

@section('icon')   
<li class="active"> <a href="{{url('/supplier')}}"><svg class="glyph stroked table"><use xlink:href="#stroked-table"></use></svg> </a></li>@stop


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<a href="{{URL::previous()}}"> <span class="glyphicon glyphicon-arrow-left"> </span></a> 
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ url('/supplier/create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('sname') ? ' has-error' : '' }}">
                            <label for="sname" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="sname" type="text" class="form-control" name="sname" placeholder="Supplier Name" value="{{ old('sname') }}" required autofocus>

                                @if ($errors->has('sname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('sname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('description') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="description" type="text" class="form-control" name="description" placeholder="Description/Comments" value="{{ old('description') }}">

                                @if ($errors->has('description'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('description') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                       
                        
                         <div class="form-group{{$errors-> has('status')? 'has-error' : ''}}">
                            <label for="status" class="col-md-4 control-label"></label>
                            
                            <div class="col-md-6">
                                <b> Status </b> <br>
                                    <input type = 'radio' name = 'status' value = 'enabled' /> Enable
                                    <input type = 'radio' name = 'status' value = 'disabled'/> Disable
                                
                                
                                @if ($errors->has('status'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('status') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Add
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>




@stop