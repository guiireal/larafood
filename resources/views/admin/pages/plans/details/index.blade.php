@extends('adminlte::page')

@section('title', "Detalhes do plano {$plan->name}")

@section('content_header')
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{ route('admin.index') }}">Dashboard</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.index') }}">Planos</a></li>
        <li class="breadcrumb-item"><a href="{{ route('plans.show', ['url' => $plan->url]) }}">{{ $plan->name }}</a></li>
        <li class="breadcrumb-item active"><a href="{{ route('plans.details.index', ['planUrl' => $plan->url]) }}">Detalhes</a></li>
    </ol>

    <h1>Detalhes do plano {{ $plan->name }} <a href="{{ route('plans.details.create', ['planUrl' => $plan->url]) }}" class="btn btn-dark"> <i class="fas fa-plus-square"></i> ADD</a></h1>
@stop

@section('content')
    <div class="card">
        <div class="card-body">
            <table class="table table-condensed">
                <thead>
                    <tr>
                        <th>Nome</th>
                        <th width="200">Ações</th>
                    </tr>
                </thead>
                @foreach($planDetails as $detail)
                <tr>
                    <td>{{ $detail->name }}</td>
                    <td style="width: 10px;">
                        <a href="{{ route('plans.edit', ['url' => $plan->url]) }}" class="btn btn-info">Editar</a>
                        <a href="{{ route('plans.show', ['url' => $plan->url]) }}" class="btn btn-warning">Ver</a>
                    </td>
                </tr>
                @endforeach
            </table>
        </div>
        <div class="card-footer">
            @if(isset($filters))
                {!! $planDetails->appends($filters)->links() !!}
            @else
                {!! $planDetails->links() !!}
            @endif
        </div>
    </div>
@stop