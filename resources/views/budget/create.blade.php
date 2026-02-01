@extends('layouts.app')

@section('title', 'Новая бюджетная операция')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Новая бюджетная операция</h1>

        @include('budget.form')
    </div>
@endsection
