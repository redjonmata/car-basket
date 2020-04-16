@extends('layouts.app')
@section('title', 'Add Car')

@section('content')
<div class="container" id="home-container">
    <div class="row justify-content-center align-items-center pt-4">
        <div class="col-12 col-md-10 col-lg-8 ">
            <form method="post" action="/add-test" name="Form" enctype="multipart/form-data">
                {{ csrf_field() }}
                <h4 class="form-heading text-center">Add a new car in the basket</h4>

                @if(!Auth::check())
                    <div class="field field-create">
                        <label class="label-input" for="email"> <strong>Enter your email</strong> </label><br/>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                    </div>
                @endif

                <div class="field field-create">
                    <label class="label-input" for="model"> <strong>Enter make</strong> </label><br/>
                    <input type="text" class="form-control" id="make" name="make" placeholder="Make" required>
                </div>

                <div class="field field-create">
                    <label class="label-input" for="model"> <strong>Enter model</strong> </label><br/>
                    <input type="text" class="form-control" id="model" name="model" placeholder="Model" required></input>
                </div>

                <div class="field field-create">
                    <label class="label-input" for="year"> <strong>Enter year</strong> </label><br/>
                    <input type="text" class="form-control" id="year" name="year" placeholder="Year" required>
                </div>

                <div class="field field-create">
                    <label class="label-input" for="registration"> <strong>Enter registration</strong> </label><br/>
                    <input type="text" class="form-control" id="registration" name="registration" placeholder="Registration" required>
                </div>

                <div class="field field-create">
                    <label class="label-input" for="engine"> <strong>Enter engine</strong> </label><br/>
                    <input type="text" class="form-control" id="engine" name="engine" placeholder="Engine" required>
                </div>

                <div class="field field-create">
                    <label class="label-input" for="price"> <strong>Enter price</strong> </label><br/>
                    <input type="number" class="form-control" id="price" name="price" placeholder="Price" required>
                </div>

                <div class="field field-create">
                    <label class="label-input mb-0" for="tags"> <strong>Tags</strong> </label><br/>
                    <label style="font-size: 13px" class="label-input" for="tags"> Enter up to 5 tags to describe your car </label><br/>
                    <input type="text" class="form-control" id="tags" name="tags" value="">
                </div>

                <div class="col-xs-12">
                    <button type="submit" class="btn btn-primary" id="email-submit-btn">Add car</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    jQuery.noConflict();

    jQuery( document ).ready(function( $ ) {
        $.ajax({
            url: "/tags",
            type: "GET",
            success: function (data) {
                $('#tags').tokenfield({
                    autocomplete: {
                        source: data,
                        delay: 100
                    },
                    showAutocompleteOnFocus: true
                })
            },
            error: function (jqXHR, textStatus, errorThrown) {
                alert(jqXHR.responseText);
            }
        });
    });
</script>

@endsection
