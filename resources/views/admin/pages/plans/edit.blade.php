@extends('adminlte::page')

@section('title', "Editar o Plano {$plan->name}")

@section('content_header')
    <h1>Editar o Plano {{ $plan->name }}</h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <form action="{{ route('plans.update', ['url' => $plan->url]) }}" class="form" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name">Nome:</label>
                    <input type="text" id="name" name="name" class="form-control" placeholder="Nome:" value="{{ $plan->name }}">
                </div>
                <div class="form-group">
                    <label for="price">Preço:</label>
                    <input type="text" id="price" name="price" class="form-control" placeholder="Preço:" value="{{ $plan->getOriginal('price') }}">
                </div>
                <div class="form-group">
                    <label for="description">Descrição:</label>
                    <input type="text" id="description" name="description" class="form-control" placeholder="Descrição:" value="{{ $plan->description }}">
                </div>
                <div class="form-group">
                    <button class="btn btn-dark" type="submit">Enviar</button>
                </div>
            </form>
        </div>
    </div>
@stop
