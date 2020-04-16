@extends('layouts.app')
@section('title', 'Draft')

@section('content')
<div class="container" id="home-container">
    <div class="row justify-content-center align-items-center pt-4">
        <div class="col-12 col-md-10 col-lg-10 ">
            <h4 class="form-heading text-center">Update basket cars</h4>
            <div class="example table-responsive">
                <table class="table">
                    <thead class="thead-success">
                    <tr>
                        <th>Id</th>
                        <th>Make</th>
                        <th>Model</th>
                        <th>Year</th>
                        <th>Visible</th>
                        <th>Registration</th>
                        <th>Engine</th>
                        <th>Price</th>
                        <th colspan="2">&nbsp&nbspAction</th>
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($cars as $car)
                            <tr>
                                <td class="alignment">{{ $car->id }}</td>
                                <td class="alignment">{{ $car->make }}</td>
                                <td class="alignment">{{ $car->model }}</td>
                                <td class="alignment">{{ $car->year }}</td>

                                @if($car->visible == "0")
                                    <td class="alignment">
                                        <form method="post" action="/draft/car/{{$car->id}}">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <button class="btn btn-success" type="submit">Show</button>
                                        </form>
                                    </td>
                                @else
                                    <td class="alignment">
                                        <form method="post" action="/draft/car/{{$car->id}}">
                                            {{ csrf_field() }}
                                            {{ method_field('PUT') }}
                                            <button class="btn btn-danger" type="submit">Hide</button>
                                        </form>
                                    </td>
                                @endif
                                <td class="alignment">{{ $car->registration }}</td>
                                <td class="alignment">{{ $car->engine }}</td>
                                <td class="alignment">{{ $car->price }}</td>
                                <td class="alignment">
                                    <form method="post" action="/draft/car/{{$car->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger" type="submit" id="delete"> Delete </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
