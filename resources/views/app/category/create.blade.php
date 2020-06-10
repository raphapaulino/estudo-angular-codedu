@extends('layouts.app')

@section('content')
    <h3>Nova categoria</h3>
    @include('form._form_errors')
    <form action="{{ route('app.categories.store') }}" method="post">
        @csrf
        @include('app.category._form')
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
@endsection