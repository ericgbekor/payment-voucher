<?php $nav_account = 'active'; ?>
@extends('master')
@section('content')
<!-- <div class="row">
    <div class="col-lg-12">
        <h1 class="page-header">@section('name') Chart of Accounts @stop</h1>
    </div>
</div> --><!--/.row-->

@section('icon')   
<li class="active"> <a href="{{url('/account')}}"><svg class="glyph stroked pencil"><use xlink:href="#stroked-pencil"></use></svg> </a></li>@stop


<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                	<a href="{{URL::previous()}}"> <span class="glyphicon glyphicon-arrow-left"> </span></a> 
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ url('/account/create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('id') ? ' has-error' : '' }}">
                            <label for="sname" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="id" type="text" class="form-control" name="id" placeholder="Account Number" value="{{ old('id') }}" required autofocus>

                                @if ($errors->has('id'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('id') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('aname') ? ' has-error' : '' }}">
                            <label for="sname" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="aname" type="text" class="form-control" name="aname" placeholder="Account Name" value="{{ old('aname') }}" required autofocus>

                                @if ($errors->has('aname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('aname') }}</strong>
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

                       	<div class="form-group{{ $errors->has('type') ? ' has-error' : '' }}">
                            <label for="sname" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="type" type="text" class="form-control" name="type" placeholder="Type" value="{{ old('type') }}"  autofocus>

                                @if ($errors->has('type'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('type') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('currency') ? ' has-error' : '' }}">
                            <label for="sname" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="currency" type="text" class="form-control" name="currency" placeholder="Currency" value="{{ old('id') }}"  autofocus>

                                @if ($errors->has('currency'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('currency') }}</strong>
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