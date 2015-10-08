@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form class="form-vertical" role="form" action="{{route('profile.edit')}}" method="post">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group{{$errors->has('first_name')? ' has-error' : '' }}">
                            <label class="control-label" for="first_name">First name</label>
                            <input class="form-control" name="first_name" type="text" id="first_name" value="{{ Request::old('first_name') ?: Auth::user()->first_name }}"/>
                        @if($errors->has('first_name'))
                            <span class="help-block">{{$errors->first('first_name')}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group{{$errors->has('last_name')? ' has-error' : '' }}">
                            <label class="control-label" for="last_name">Last name</label>
                            <input class="form-control" name="last_name" id="last_name" type="text" value="{{Request::old('last_name') ?: Auth::user()->last_name }}"/>
                            @if($errors->has('last_name'))
                                <span class="help-block">{{$errors->first('last_name')}}</span>
                            @endif
                        </div>
                    </div>
                </div>
                        <div class="form-group{{$errors->has('location')? ' has-error' : '' }}">
                            <label class="control-label" for="location">Location</label>
                            <input id="location" class="form-control" type="text" name="location" value="{{Request::old('location') ?: Auth::user()->location }}"/>
                            @if($errors->has('location'))
                                <span class="help-block">{{$errors->first('location') }}</span>
                            @endif
                        </div>
                <div class="form-group">
                    <button class="btn btn-success" type="submit">Update Profile</button>
                </div>
                <input type="hidden" name="_token" value="{{Session::token() }}"/>
            </form>
        </div>
    </div>
@stop