@extends('welcome')


@section('content')
    <!--  create users -->
 

    {!! Form::model($data, ['action' => 'UsersController@store']) !!}

        <create-user :username="{{ json_encode("") }}" :message="{{ json_encode($data['message']) }}" :messagetype="{{ json_encode($data['messagetype']) }}" :groups="{{ json_encode($data['groups']) }}"></create-user>

    {!! Form::close() !!}

@endsection
