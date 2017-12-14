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

        <!-- Breadcrumbs-->
            <br>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/classificacao">Classificação do Campeonato</a></li>
            </ol>

            <div class="row">
                <div class="col-lg-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i>{{auth()->user()->time->campeonato->nome}}</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr><th>Posicão</th>
                                        <th>Time</th>
                                        <th>Nome</th>
                                        <th>Pontos</th>
                                        <th>Vitorias</th>
                                        <th>Empates</th>
                                        <th>Derrotas</th>
                                        <th>Gols Marcados</th>
                                        <th>Gols Sofridos</th>
                                        <th>Saldo de Gols</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($classificacao as $key => $time_classificacao)
                                        <tr>
                                            <td>{{$key + 1}}</td>
                                            <td><a class="navbar-brand"><img
                                                            src="{{ URL::asset($time_classificacao->time->escudo) }}" alt=""></a></td>
                                            <td>{{$time_classificacao->time->nome}}</td>
                                            <td>{{$time_classificacao->pontuacao}}</td>
                                            <td>{{$time_classificacao->vitorias}}</td>
                                            <td>{{$time_classificacao->empates}}</td>
                                            <td>{{$time_classificacao->derrotas}}</td>
                                            <td>{{$time_classificacao->time->getScoredGoals()}}</td>
                                            <td>{{$time_classificacao->time->getConceivedGoals()}}</td>
                                            <td>{{$time_classificacao->time->getScoredGoals() - $time_classificacao->time->getConceivedGoals()}}</td>
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
    {{ Form::close() }}
@endsection

