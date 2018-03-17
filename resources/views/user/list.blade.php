@extends('welcome')
   
@section('content')

    {!! Form::model($users, ['action' => 'UsersController@create']) !!}

   
        <user-list :users="{{ json_encode($users) }}"></user-list>

    {!! Form::close() !!}
    
    <modal-box id="deleteUserModal" title="Delete User">
            <p>Here is the body.</p>
        </modal-box>


@endsection

@section('js-content')


@endsection
