@extends('layouts.app')

@section('content')
    <h3>Editar produto</h3>
    @include('form._form_errors')
    <form action="{{ route('app.products.update', ['product' => $product->id]) }}" method="post">
        @csrf
        @method('PUT')
        @include('app.product._form')
        <button type="submit" class="btn btn-primary">Salvar</button>
    </form>
@endsection