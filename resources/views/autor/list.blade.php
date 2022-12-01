@extends('layout')

@section('title', 'Llistat d\'autors')

@section('stylesheets')
    @parent
@endsection

@section('content')
    <h1>Llistat d'autors</h1>
    @if (Auth::check())
    <a href="{{ route('autor_new') }}">+ Nou autor</a>
    @endif
    @if (session('status'))
        <div>
            <strong>Success!</strong> {{ session('status') }}  
        </div>
    @endif

    <table style="margin-top: 20px;margin-bottom: 10px;">
        <thead>
            <tr>
                <th>Nom Autor</th><th>Cognoms</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($autors as $autor)
                <tr>
                    <td>{{ $autor->nom }}</td><td>{{ $autor->cognoms }}</td>
                    @if (Auth::check())
                    <td>
                        <a href="{{ route('autor_delete', ['id' => $autor->id]) }}">Eliminar</a>
                    </td>
                    <td>
                        <a href="{{ route('autor_edit', ['id' => $autor->id]) }}">Editar</a>
                    </td>
                    @endif
                </tr>
            @endforeach
        </tbody>
    </table>

    <br>
@endsection