@extends('layouts.app')

@section('content')
    <h3>Ver produto</h3>
    <a class="btn btn-primary" href="{{ route('app.products.edit',['product' => $product->id]) }}">Editar</a>
    <a class="btn btn-danger" href="{{ route('app.products.destroy',['product' => $product->id]) }}"
       onclick="event.preventDefault();if(confirm('Deseja excluir este item?')){document.getElementById('form-delete').submit();}">Excluir</a>
        <form id="form-delete" action="{{ route('app.products.destroy', ['product' => $product->id]) }}" method="post">
            @csrf
            @method('DELETE')
        </form>
    <br/><br/>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th scope="row">ID</th>
            <td>{{$product->id}}</td>
        </tr>
        <tr>
            <th scope="row">Nome</th>
            <td>{{$product->name}}</td>
        </tr>
        <tr>
            <th scope="row">Descrição</th>
            <td>{{$product->description}}</td>
        </tr>
        <tr>
            <th scope="row">Preço</th>
            <td>{{$product->price}}</td>
        </tr>
        </tbody>
    </table>
@endsection