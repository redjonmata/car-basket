@extends('layouts.app')
@section('title', 'My Cars')

@section('content')
    <div class="container" id="home-container">
        <div class="row justify-content-center align-items-center pt-4">
            <div class="col-12 col-md-10 col-lg-10 ">
                <h4 class="form-heading text-center">Update users</h4>
                <input type="hidden" id="ids" value="{{$ids}}">
                <div class="example table-responsive">
                    <table class="table">
                        <tr>
                            <th>Id</th>
                            <th>First Name</th>
                            <th>Last Name</th>
                            <th>Username</th>
                            <th>Email</th>
                            <th colspan="2">&nbsp&nbspAction</th>
                        </tr>
                        @foreach($users as $user)
                            <tr>
                                <td class="alignment">{{ $user->id }}</td>
                                <td class="alignment">
                                    <input type="text" class="form-control" value="{{$user->first_name}}" id="first_name-{{$user->id}}" name="first_name">
                                </td>
                                <td class="alignment">
                                    <input type="text" class="form-control" value="{{$user->last_name}}" id="last_name-{{$user->id}}" name="last_name">
                                </td>
                                <td class="alignment">
                                    <input type="text" class="form-control" value="{{$user->username}}" id="username-{{$user->id}}" name="username">
                                </td>
                                <td class="alignment">
                                    <input type="text" class="form-control" value="{{$user->email}}" id="email-{{$user->id}}" name="email">
                                </td>
                                <td class="alignment">
                                    <form method="post" action="/users/{{$user->id}}">
                                        {{ csrf_field() }}
                                        {{ method_field('PUT') }}
                                        <input type="hidden" name="hidden_first_name-{{$user->id}}" id="hidden_first_name-{{$user->id}}" value="">
                                        <input type="hidden" name="hidden_last_name-{{$user->id}}" id="hidden_last_name-{{$user->id}}" value="">
                                        <input type="hidden" name="hidden_username-{{$user->id}}" id="hidden_username-{{$user->id}}" value="">
                                        <input type="hidden" name="hidden_email-{{$user->id}}" id="hidden_email-{{$user->id}}" value="">
                                        <button class="btn btn-primary" type="submit"> Edit </button>
                                    </form>
                                </td>
                                <td class="alignment">
                                    <form method="post" action="/users/{{$user->id}}">
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
            <div class="col-10 col-md-10 col-lg-10 mb-2">
                <a href="/add-user" class="btn btn-primary add-car-button mb-2">Add User</a>
            </div>
        </div>
    </div>

<script>
    $(document).ready(function () {
        var ids = $('#ids').val();
        var idArray = ids.split(',');

        idArray.forEach(function (id) {
            var hidden_first_name = $('#hidden_first_name-'+id)
            hidden_first_name.val($('#first_name-'+id).val())

            var hidden_last_name = $('#hidden_last_name-'+id)
            hidden_last_name.val($('#last_name-'+id).val())

            var hidden_username = $('#hidden_username-'+id)
            hidden_username.val($('#username-'+id).val())

            var hidden_email = $('#hidden_email-'+id)
            hidden_email.val($('#email-'+id).val())

            $('#first_name-'+id).keyup(function () {
                var hidden_first_name = $('#hidden_first_name-'+id)
                hidden_first_name.val($(this).val())
            })

            $('#last_name-'+id).keyup(function () {
                var hidden_last_name = $('#hidden_last_name-'+id)
                hidden_last_name.val($(this).val())
            })

            $('#username-'+id).keyup(function () {
                var hidden_username = $('#hidden_username-'+id)
                hidden_username.val($(this).val())
            })

            $('#email-'+id).keyup(function () {
                var hidden_email = $('#hidden_email-'+id)
                hidden_email.val($(this).val())
            })
        })
    })

</script>
@endsection
