@extends('templates.default')

@section('content')
<h3>Your search for "{{ Request::input('query') }}"</h3>
@if(!$users->count())
    <p>No Friends found! Sorry not sorry</p>
    @else
    <div class="row">
        <div class="col-md-12">
        @foreach($users as $user)
            @include('user/partials/userblock')
            @endforeach
    </div>
</div>
@endif
@stop