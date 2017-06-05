@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default">
                <div class="panel-heading">Register</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                        {{ csrf_field() }}

                        <div class="form-group{{ $errors->has('username') ? ' has-error' : '' }}">
                            <label for="username" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="name" type="text" class="form-control" name="username" placeholder="Username" value="{{ old('username') }}" required autofocus>

                                @if ($errors->has('name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('username') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">
                            <label for="email" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control" name="email" placeholder="Email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                            <label for="password" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control" name="password" placeholder="Password" required>

                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="password-confirm" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" placeholder="Confirm Password" name="password_confirmation" required>
                            </div>
                        </div>
                        
                        
                        <div class="form-group{{ $errors->has('firstname') ? ' has-error' : '' }}">
                            <label for="firstname" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="firstname" type="firstname" class="form-control" name="firstname" placeholder="Firstname" value="{{ old('firstname') }}" required>

                                @if ($errors->has('firstname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('firstname') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('lastname') ? ' has-error' : '' }}">
                            <label for="lastname" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="lastname" type="text" class="form-control" name="lastname" placeholder="Lastname" value="{{ old('lastname') }}" required>

                                @if ($errors->has('lastname'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('lastname') }}</strong>
                                    </span>
                                @endif
                            </div>
                            
                            
                        </div>
                        
<!--                        <div class="form-group{{$errors-> has('usertype')? 'has-error' : ''}}">
                            <label for="usertype" class="col-md-4 control-label"></label>
                            
                            <div class="col-md-6">
                                <b> Usertype </b> <br>
                                    <input type = 'radio' name = 'usertype' value = 'normal' /> Normal
                                    <input type = 'radio' name = 'usertype' value = 'administrator'/> Administrator 
                                
                                @if ($errors->has('usertype'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('usertype') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>-->
                        
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
                        
                        <div class="form-group {{$errors->has('role')? 'has-error':''}}">
                         <label for="role" class="col-md-4 control-label"></label>
                         
                         <div class="col-md-6">
                             <b>Role </b> <br>
                             <input type ='checkbox' name ='role' value='1' /> Creator
                             <input type ='checkbox' name ='role' value='2' /> Reviewer
                             <input type ='checkbox' name ='role' value='3' /> Approver
                              <input type ='checkbox' name ='role' value='4' /> Administrator
                        
                         </div>
                            
                        </div>

                        <div class="form-group">
                            <div class="col-md-6 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Register
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
