@extends('layouts.app')


@section('content')
@include('components.form.addUser',
        [
            'formAction' => 'register',
            'title' => 'Register User',
            'submitButtonName' => 'Register User',
        ])
@endsection
