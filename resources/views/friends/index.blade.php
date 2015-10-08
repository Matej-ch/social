@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-md-5">
            <h3>Your friends</h3>
            @if(!$friends->count())
                <p> You have no friends</p>
                <h4>LOOSER</h4>
            @else
                @foreach($friends as $user)
                    @include('user/partials/userblock')
                @endforeach
            @endif
        </div>
        <div class="col-md-6">

            <h4>Friend Request</h4>
            @if(!$requests->count())
                <p> You have no friends request</p>
            @else
                @foreach($requests as $user)
                    @include('user.partials.userblock')
                @endforeach
            @endif
        </div>
    </div>
@stop