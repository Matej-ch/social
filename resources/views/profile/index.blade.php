@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-md-5">
            @include('user.partials.userblock')
            <hr/>

            @if (!$statuses->count() )
                <p>There is nothing left for you</p>
                <p>You will die alone :-(</p>
            @else
                @foreach($statuses as $status)
                    <div class="media">
                        <a class="pull-left" href="{{route('profile.index',['username'=> $status->user->username ])}}">
                            <img class="media-object" src="{{$status->user->getAvatarUrl() }}" alt="{{$status->user->getNameOrUsername() }}"/>
                        </a>

                        <div class="media-body">
                            <h4 class="media-heading"><a href="{{route('profile.index',['username'=> $status->user->username ])}}">{{ $status->user->getNameOrUserName() }}</a></h4>
                            <p>{{ $status->body }}</p>
                            <ul class="list-inline">
                                <li>{{$status->created_at->diffForHumans() }}</li>
                                @if($status->user->id !== Auth::user()->id)
                                    <li><a href="{{route('status.like',['statusId' => $status->id])}}">Like</a></li>
                                    @endif
                                <li>{{$status->likes->count()}} {{str_plural('like',$status->likes->count())}}</li>
                            </ul>

                            @foreach($status->replies as $reply)
                                <div class="media">
                                    <a class="pull-left" href="{{route('profile.index',['username'=>$reply->user->username])}}">
                                        <img class="media-object" src="{{$reply->user->getAvatarUrl()}}"  alt="{{$reply->user->getNameOrUsername()}}"/>
                                    </a>
                                    <div class="media-body">
                                        <h5><a href="{{route('profile.index',['username'=>$reply->user->username])}}">{{$reply->user->getNameOrUsername()}}</a></h5>
                                        <p>{{$reply->body}}</p>
                                        <ul class="list-inline">
                                            <li>1{{$reply->created_at->diffForHumans() }}</li>
                                            @if($reply->user->id !== Auth::user()->id)
                                                <li><a href="{{route('status.like',['statusId' => $reply->id])}}">Like</a></li>
                                            @endif
                                            <li>{{$reply->likes->count()}} {{str_plural('like',$reply->likes->count())}}</li>
                                        </ul>
                                    </div>
                                </div>
                            @endforeach

                            @if($authUserIsFriend || Auth::user()->id === $status->user->id)
                                <form action="{{route('status.reply',['statusId' => $status->id ])}}" role="form" method="post">
                                    <div class="form-group{{ $errors->has("reply-{$status->id}") ? ' has-error': '' }}">
                                        <textarea name="reply-{{$status->id}}" class="form-control" placeholder="Reply to this status" rows="2"></textarea>
                                        @if($errors->has("reply-{$status->id}"))
                                            <span class="help-block">{{$errors->first("reply-{$status->id}") }}</span>
                                        @endif
                                    </div>
                                    <input class="btn btn-default btn-sm" type="submit" value="Reply"/>
                                    <input name="_token" type="hidden" value="{{Session::token() }}"/>
                                </form>
                            @endif

                        </div>
                    </div>
                @endforeach
            @endif

        </div>
        <div class="col-md-4 col-md-offset-3">
            @if(Auth::user()->hasFriendRequestPending($user))
                <p>Waiting for {{$user->getNameOrUsername() }} to accept your request.</p>
                @elseif(Auth::user()->hasFriendRequestReceived($user))
                <a class="btn btn-primary" href="#">Accept</a>
                @elseif(Auth::user()->isFriendsWith($user))
                <p>You are friendzone'd by {{$user->getNameOrUsername()}}</p>
                @else
                <a href="{{route('friends.add',['username' => $user->username])}}" class="btn btn-primary">Friendzone this person</a>
            @endif
            <h4>{{$user->getFirstNameOrUsername() }}'s friends.</h4>
            @if(!$user->friends()->count())
                <p>{{$user->getFirstNameOrUsername() }} has no friends</p>
                <h4>LOOSER</h4>
            @else
                @foreach($user->friends() as $user)
                    @include('user/partials/userblock')
                @endforeach
            @endif
        </div>
    </div>
@stop