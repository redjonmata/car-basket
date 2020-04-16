@extends('layouts.app')
@section('title', 'Home')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 row  offset-md-2">
            @if(session()->has('add-success'))
                <div class="col-10 text-center ml-3 alert alert-success" id="alert">
                    {{ session('add-success') }}
                </div>
            @endif
            <div class="col-12 col-md-12 col-lg-12 mb-2">
                <h2 class="text-center main-title">Browse Cars</h2>
            </div>
            <div class="col-10 col-md-10 col-lg-10 mb-2">
                <a href="/add-test" class="btn btn-primary add-car-button mb-2">Add Car</a>
                <span class="text-right results">{{$cars->count()}} Results</span>
            </div>
            <div class="col-10 col-md-10 col-lg-10 mb-2">
                <form action="{{ url('search') }}" method="get">
                    <div class="form-group">
                        <input
                            type="text"
                            name="q"
                            class="form-control"
                            placeholder="Search..."
                            value="{{ request('q') }}"
                        />
                    </div>
                </form>
            </div>
            @foreach($carTags as $carTag)
                <div class="card col-md-5 card-home mr-4 mb-4">
                    <div class="card-header text-left card_title">
                        <span class="car_time">{{ date('d M H:s', strtotime($carTag['car']->created_at))  }}</span>
                        <h4 class="mb-0">{{ $carTag['car']->make . " " . $carTag['car']->model . " " . $carTag['car']->year }}</h4>
                    </div>
                    <div class="card-body text-left">
                        <h5>Registration: <strong>{{ $carTag['car']->registration }}</strong></h5>
                        <h5>Engine: <strong>{{ $carTag['car']->engine }}</strong></h5>
                        <h5>Price: <strong>{{ number_format($carTag['car']->price,0,' ',' ') . " EUR" }}</strong></h5>
                        <div style="display: inline-block" class="mt-3">
                            @foreach($carTag['tags'] as $tag)
                                <a href="/cars/tag/{{$tag->slug}}" class="tags">{{ $tag->slug }}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
<script>
    $(document).ready(function () {
        setTimeout(function(){
            if ($('#alert').length > 0) {
                $('#alert').remove().fadeOut('slow');
            }
        }, 2500)
    });
</script>
@endsection
