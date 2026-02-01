@extends('layouts.app')

@section('title', 'Редактирование бюджетной операции')

@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4">Редактирование бюджетной операции</h1>

        @include('budget.form', ['budget' => $budget])
    </div>
@endsection
