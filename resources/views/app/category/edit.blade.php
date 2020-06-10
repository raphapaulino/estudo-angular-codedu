@extends('layouts.app')

@section('content')
    <h3>Editar categoria</h3>
    @include('form._form_errors')
    <form action="{{ route('app.categories.update', ['category' => $category->id]) }}" method="post">
        @csrf
        @method('PUT')
        @include('app.category._form')
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection