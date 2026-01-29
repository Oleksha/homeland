@extends('layouts.app')

@section('title', 'Добавить статью расхода')

@section('content')
    <div class="container">
        <h1>Добавить статью расхода</h1>

        <form method="POST"
              action="{{ route('expense-items.update', $item) }}">
            @include('dictionaries.expense_items.partial.form')
        </form>
    </div>
@endsection
