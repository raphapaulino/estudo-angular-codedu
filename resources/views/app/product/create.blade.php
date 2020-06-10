@extends('layouts.app')

@section('content')
    <h3>Novo produto</h3>
    @include('form._form_errors')
    <form action="{{ route('app.products.store') }}" method="post">
        @csrf
        @include('app.product._form')
        <button type="submit" class="btn btn-primary">Criar</button>
    </form>
@endsection