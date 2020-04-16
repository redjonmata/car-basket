@extends('layouts.app')
@section('title', 'My Cars')

@section('content')
    <div class="container" id="home-container">
        <div class="row justify-content-center align-items-center pt-4">
            <div class="col-12 col-md-10 col-lg-10 ">
                <h4 class="form-heading text-center">Update your cars</h4>
                <input type="hidden" id="ids"value="{{$ids}}">
                <div class="example table-responsive">
                    <table class="table">
                        <tr>
                            <th>Id</th>
                            <th>Make</th>
                            <th>Model</th>
                            <th>Year</th>
                            <th>Registration</th>
                            <th>Engine</th>
                            <th>Price</th>
                            <th colspan="2">&nbsp&nbspAction</th>
                        </tr>
                        @foreach($cars as $car)
                            <tr>
                                <td class="alignment">{{ $car->id }}</td>
                                <td class="alignment">
                                    <input type="text" class="form-control" value="{{$car->make}}" id="make-{{$car->id}}" name="make">
                                </td>
                                <td class="alignment">
                                    <input type="text" class="form-control" value="{{$car->model}}" id="model-{{$car->id}}" name="model">
                                </td>
                                <td class="alignment">
                                    <input type="text" class="form-control" value="{{$car->year}}" id="year-{{$car->id}}" name="year">
                                </td>
                                <td class="alignment">
                                    <input type="text" class="form-control" value="{{$car->registration}}" id="registration-{{$car->id}}" name="registration">
                                </td>
                                <td class="alignment">
                                    <input type="text" class="form-control" value="{{$car->engine}}" id="engine-{{$car->id}}" name="engine">
                                </td>
                                <td class="alignment">
                                    <input type="text" class="form-control" value="{{$car->price}}" id="price-{{$car->id}}" name="price">
                                </td>
                                <td class="alignment">
                                    <form method="post" action="/cars/{{$car->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <input type="hidden" name="hidden_make-{{$car->id}}" id="hidden_make-{{$car->id}}" value="">
                                        <input type="hidden" name="hidden_model-{{$car->id}}" id="hidden_model-{{$car->id}}" value="">
                                        <input type="hidden" name="hidden_year-{{$car->id}}" id="hidden_year-{{$car->id}}" value="">
                                        <input type="hidden" name="hidden_registration-{{$car->id}}" id="hidden_registration-{{$car->id}}" value="">
                                        <input type="hidden" name="hidden_engine-{{$car->id}}" id="hidden_engine-{{$car->id}}" value="">
                                        <input type="hidden" name="hidden_price-{{$car->id}}" id="hidden_price-{{$car->id}}" value="">
                                        <button class="btn btn-primary" type="submit"> Edit </button>
                                    </form>
                                </td>
                                <td class="alignment">
                                    <form method="post" action="/cars/{{$car->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE') }}
                                        <button class="btn btn-danger" type="submit"> Delete </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function () {
        var ids = $('#ids').val();
        var idArray = ids.split(',');

        idArray.forEach(function (id) {
            var hidden_make = $('#hidden_make-'+id)
            hidden_make.val($('#make-'+id).val())

            var hidden_model = $('#hidden_model-'+id)
            hidden_model.val($('#model-'+id).val())

            var hidden_year = $('#hidden_year-'+id)
            hidden_year.val($('#year-'+id).val())

            var hidden_registration = $('#hidden_registration-'+id)
            hidden_registration.val($('#registration-'+id).val())

            var hidden_engine = $('#hidden_engine-'+id)
            hidden_engine.val($('#engine-'+id).val())

            var hidden_price = $('#hidden_price-'+id)
            hidden_price.val($('#price-'+id).val())

            $('#make-'+id).keyup(function () {
                var hidden_make = $('#hidden_make-'+id)
                hidden_make.val($(this).val())
            })

            $('#model-'+id).keyup(function () {
                var hidden_model = $('#hidden_model-'+id)
                hidden_model.val($(this).val())
            })

            $('#year-'+id).keyup(function () {
                var hidden_year = $('#hidden_year-'+id)
                hidden_year.val($(this).val())
            })

            $('#registration-'+id).keyup(function () {
                var hidden_registration = $('#hidden_registration-'+id)
                hidden_registration.val($(this).val())
            })

            $('#engine-'+id).keyup(function () {
                var hidden_engine = $('#hidden_engine-'+id)
                hidden_engine.val($(this).val())
            })

            $('#price-'+id).keyup(function () {
                var hidden_price = $('#hidden_price-'+id)
                hidden_price.val($(this).val())
            })
        })
    })

</script>
@endsection
