@extends('layouts.app')

@section('content')
    <h3>Ver categoria</h3>
    <a class="btn btn-primary" href="{{ route('app.categories.edit',['category' => $category->id]) }}">Editar</a>
    <a class="btn btn-danger" href="{{ route('app.categories.destroy',['category' => $category->id]) }}"
       onclick="event.preventDefault();if(confirm('Deseja excluir este item?')){document.getElementById('form-delete').submit();}">Excluir</a>
       <form id="form-delete" action="{{ route('app.categories.destroy', ['category' => $category->id]) }}" method="post">
            @csrf
            @method('DELETE')
       </form>
    <br/><br/>
    <table class="table table-bordered">
        <tbody>
        <tr>
            <th scope="row">ID</th>
            <td>{{$category->id}}</td>
        </tr>
        <tr>
            <th scope="row">Nome</th>
            <td>{{$category->name}}</td>
        </tr>
        </tbody>
    </table>
@endsection