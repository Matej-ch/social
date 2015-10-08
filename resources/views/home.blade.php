@extends('templates.default')

@section('content')
    <div class="row">
        <div class="col-lg-7 col-lg-offset-2" style="text-align: center">

            <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                <!-- Indicators -->
                <ol class="carousel-indicators">
                    <li data-target="#carousel-example-generic" data-slide-to="0" class="active"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="1"></li>
                    <li data-target="#carousel-example-generic" data-slide-to="2"></li>
                </ol>

                <!-- Wrapper for slides -->
                <div class="carousel-inner" role="listbox">
                    <div class="item active">
                        <img src="{{asset('images/front_page1.jpg')}}" alt="front image 1">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{asset('images/front_page2.jpg')}}" alt="front image 2">
                        <div class="carousel-caption">
                        </div>
                    </div>
                    <div class="item">
                        <img src="{{asset('images/front_page3.jpg')}}" alt="front image 3">
                        <div class="carousel-caption">
                        </div>
                    </div>
                </div>

                <!-- Controls -->
                <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                    <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                    <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>

            <h1 class="h1">Meet Your Friends @ Friendface!</h1>
            <h2 class="h2">Meet Your Friends @ Friendface!</h2>
            <h3 class="h3">Meet Your Friends @ Friendface!</h3>
            <h4 class="h4">Meet Your Friends @ Friendface!</h4>
            <h5 class="h5">Meet Your Friends @ Friendface!</h5>
            <h6 class="h6">Meet Your Friends @ Friendface!</h6>
            <p>What is <a href="https://www.youtube.com/watch?v=hio88ZmFUWQ">Friendface?</a></p>
        </div>
    </div>
@stop