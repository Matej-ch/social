@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-md-6">
            <form action="{{ route('status.post') }}" method="post" role="form">
                <div class="form-group{{ $errors->has('status') ? ' has-error' : ''}}">
                    <textarea placeholder="What do you do {{ Auth::user()->getFirstNameOrUsername() }}" name="status" row="2" class="form-control"></textarea>
                @if($errors->has('status'))
                    <span class="help-block">{{ $errors->first('status') }}</span>
                    @endif
                </div>
                <button type="submit" class="btn btn-warning">Update status</button>
                <input name="_token" type="hidden" value="{{ Session::token() }}"/>
            </form>
            <hr/>
        </div>
    </div>

    <div class="row">
        <div class="col-md-6">
            @if (!$statuses->count() )
            <p>There is nothing</p>
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
                                    <li>
                                        <a href="{{route('status.like',['statusId' => $status->id])}}">Like</a>
                                    </li>
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
                            </div>
                        </div>
                @endforeach
        {!! $statuses->render() !!}
        @endif
        </div>
    </div>
@stop
