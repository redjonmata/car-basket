@extends('layouts.app')
@section('title', 'Tag [' . $name . ']')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12 row  offset-md-2">
                <div class="col-12 col-md-12 col-lg-12 mb-2">
                    <h2 class="text-center main-title">Cars tagged [{{ $name }}]</h2>
                </div>
                @if(!empty($tag))
                    @foreach($tag->cars()->get() as $car)
                        @if($car->visible == 1)
                            <div class="card col-md-5 card-home mr-4 mb-4">
                                <div class="card-header text-left card_title">
                                    <span class="car_time">{{ date('d M H:s', strtotime($car->created_at))  }}</span>
                                    <h4 class="mb-0">{{ $car->make . " " . $car->model . " " . $car->year }}</h4>
                                </div>
                                <div class="card-body text-left">
                                    <h5>Registration: <strong>{{ $car->registration }}</strong></h5>
                                    <h5>Engine: <strong>{{ $car->engine }}</strong></h5>
                                    <h5>Price: <strong>{{ number_format($car->price,0,' ',' ') . " EUR" }}</strong></h5>
                                </div>
                            </div>
                        @endif
                    @endforeach
                @else
                    <div> There were no cars tagged [{{ $name }}] <a href="/" class="btn btn-primary">Go to home</a> </div>
                @endif
            </div>
        </div>
    </div>
@endsection

