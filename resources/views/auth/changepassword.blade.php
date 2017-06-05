@extends('layouts.app')
@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-8 col-md-offset-2">
            <div class="panel panel-default" >
                <div class="panel-heading">Login</div>
                <div class="panel-body">
                    <form class="form-horizontal" role="form" method="POST" action="{{ url('change') }}">
                        {{ csrf_field() }}

                        

                        <div class="form-group{{ $errors->has('oldpassword') ? ' has-error' : '' }}">
                            <label for="oldpassword" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="oldpassword" type="password" placeholder="Old Password" class="form-control" name="oldpassword" required>

                                @if ($errors->has('oldpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('oldpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group{{ $errors->has('newpassword') ? ' has-error' : '' }}">
                            <label for="newpassword" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="newpassword" type="password" placeholder="New Password" class="form-control" name="newpassword" required>

                                @if ($errors->has('newpassword'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('newpassword') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group{{ $errors->has('confirm') ? ' has-error' : '' }}">
                            <label for="confirm" class="col-md-4 control-label"></label>

                            <div class="col-md-6">
                                <input id="confirm" type="password" class="form-control" name="confirm" placeholder="Confirm Password" value="{{ old('confirm') }}" required autofocus>

                                @if ($errors->has('confirm'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('confirm') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>
                        
                        <div class="form-group">
                            <div class="col-md-8 col-md-offset-4">
                                <button type="submit" class="btn btn-primary">
                                    Change Password
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


