<?php $nav_department = 'active'; ?>
@extends('master')
@section('content')

@section('icon')   
<li class="active"> <a href="{{url('/department')}}"><svg class="glyph stroked app-window"><use xlink:href="#stroked-app-window"></use></svg> </a></li>@stop

<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">
                <a href="{{URL::previous()}}"> <span class="glyphicon glyphicon-arrow-left"> </span></a> 
                </div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="GET" action="{{ url('/department/create') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('deptname') ? ' has-error' : '' }}">
                            <label for="sname" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="deptname" type="text" class="form-control" name="deptname" placeholder="Department Name" value="{{ old('deptname') }}" required autofocus>

                                @if ($errors->has('deptname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('deptname') }}</strong>
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