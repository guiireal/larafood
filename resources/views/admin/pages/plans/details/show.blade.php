@extends('adminlte::page')

@section('title', "Detalhes do detalhe {$planDetail->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', [$plan->url]) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.details.index', [$plan->url]) }}">Detalhes</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.details.edit', [$plan->url, $planDetail->id]) }}">{{ $planDetail->name }}</a></li>
    </ol>

    <h1>Detalhes do detalhe {{ $planDetail->name }} </h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <ul>
                <li><strong>Nome: </strong>{{ $planDetail->name }}</li>
            </ul>
        </div>
        <div class="card-footer">
            <form action="{{ route('plans.details.destroy', [$plan->url, $planDetail->id]) }}" method="POST">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger"><i class="fas fa-trash"></i> Deletar o detalhe {{ $planDetail->name }} do plano {{ $plan->name }}</button>
            </form>
        </div>
    </div>
@stop
