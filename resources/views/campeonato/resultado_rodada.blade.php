@extends('templates.template')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
            @if (Session::has('mensagem'))
                <div class="alert alert-danger">{{ Session::get('mensagem') }}</div>
            @endif

            @if($errors->count() > 0)
                <div class="alert alert-danger">
                    {{ HTML::ul($errors->all()) }}
                </div>
            @endif
            <br>
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Resultado da rodada</a></li>
            </ol>
            <div class="row">
                <div class="col-lg-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Tabela de Jogos dessa rodada</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr align="center">
                                        <th>#</th>
                                        <th>Casa</th>
                                        <th></th>
                                        <th>Placar</th>
                                        <th></th>
                                        <th>Fora</th>
                                        <th>Estadio</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr align="center">
                                        <td>{{$meu_resultado->id}}</td>
                                        <td align="center">{{$meu_resultado->mandante->nome}}</td>
                                        <td><a class="navbar-brand" href="{{ URL::asset('/') }}"><img
                                                        src="{{ URL::asset($meu_resultado->mandante->escudo) }}" alt=""></a></td>
                                        <td>{{$meu_resultado->placar_mandante}} x {{$meu_resultado->placar_visitante}}</td>
                                        <td><a class="navbar-brand" href="{{ URL::asset('/') }}"><img
                                                        src="{{ URL::asset($meu_resultado->visitante->escudo) }}" alt=""></a></td>
                                        <td>{{$meu_resultado->visitante->nome}}</td>
                                        <td>{{$meu_resultado->mandante->estadio->nome}}</td>
                                    </tr>
                                    @foreach($resultados as $key => $partida)
                                        <tr align="center">
                                            <td>{{$partida->id}}</td>
                                            <td align="center">{{$partida->mandante->nome}}</td>
                                            <td><a class="navbar-brand" href="{{ URL::asset('/') }}"><img
                                                            src="{{ URL::asset($partida->mandante->escudo) }}" alt=""></a></td>
                                            <td>{{$partida->placar_mandante}} x {{$partida->placar_visitante}}</td>
                                            <td><a class="navbar-brand" href="{{ URL::asset('/') }}"><img
                                                            src="{{ URL::asset($partida->visitante->escudo) }}" alt=""></a></td>
                                            <td>{{$partida->visitante->nome}}</td>
                                            <td>{{$partida->mandante->estadio->nome}}</td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Atualizado em {{date('d/m/Y')}}</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
