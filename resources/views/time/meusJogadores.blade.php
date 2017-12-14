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
                <li class="breadcrumb-item"><a href="{{route('meus.jogadores')}}">Meus Jogadores</a></li>
            </ol>

            <div class="row">
                <div class="col-lg-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Elenco</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" width="100%" cellspacing="0">
                                    <thead>
                                    <tr align="center">
                                        <th>Posição</th>
                                        <th>Nome</th>
                                        <th>Idade</th>
                                        <th>ATK</th>
                                        <th>DEF</th>
                                        <th>Salário</th>
                                        <th>Passe</th>
                                        <th>Ações</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($goleiros as $key => $jogador)
                                        <tr align="center">
                                            <td>{{$jogador->posicao}}</td>
                                            <td>{{$jogador->nome}}</td>
                                            <td>{{$jogador->idade}}</td>
                                            <td>{{$jogador->atk_rate}}</td>
                                            <td>{{$jogador->def_rate}}</td>
                                            <td>{{$jogador->salario}}</td>
                                            <td>{{$jogador->passe}}</td>
                                            <td>
                                                <a onclick="return confirm('Dispensar o jogador dará metade do valor do seu passe de volta aos caixas, confirmar?')"
                                                   href="{{route('dispensar.jogador',['jogador' => $jogador->id])}}" class="btn btn-primary">
                                                    <i class="fa fa-money"></i> Dispensar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach($defensores as $key => $jogador)
                                        <tr align="center">
                                            <td>{{$jogador->posicao}}</td>
                                            <td>{{$jogador->nome}}</td>
                                            <td>{{$jogador->idade}}</td>
                                            <td>{{$jogador->atk_rate}}</td>
                                            <td>{{$jogador->def_rate}}</td>
                                            <td>{{$jogador->salario}}</td>
                                            <td>{{$jogador->passe}}</td>
                                            <td>
                                                <a onclick="return confirm('Dispensar o jogador dará metade do valor do seu passe de volta aos caixas, confirmar?')"
                                                   href="{{route('dispensar.jogador',['jogador' => $jogador->id])}}" class="btn btn-primary">
                                                    <i class="fa fa-money"></i> Dispensar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach($meias as $key => $jogador)
                                        <tr align="center">
                                            <td>{{$jogador->posicao}}</td>
                                            <td>{{$jogador->nome}}</td>
                                            <td>{{$jogador->idade}}</td>
                                            <td>{{$jogador->atk_rate}}</td>
                                            <td>{{$jogador->def_rate}}</td>
                                            <td>{{$jogador->salario}}</td>
                                            <td>{{$jogador->passe}}</td>
                                            <td>
                                                <a onclick="return confirm('Dispensar o jogador dará metade do valor do seu passe de volta aos caixas, confirmar?')"
                                                   href="{{route('dispensar.jogador',['jogador' => $jogador->id])}}" class="btn btn-primary">
                                                    <i class="fa fa-money"></i> Dispensar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    @foreach($atacantes as $key => $jogador)
                                        <tr align="center">
                                            <td>{{$jogador->posicao}}</td>
                                            <td>{{$jogador->nome}}</td>
                                            <td>{{$jogador->idade}}</td>
                                            <td>{{$jogador->atk_rate}}</td>
                                            <td>{{$jogador->def_rate}}</td>
                                            <td>{{$jogador->salario}}</td>
                                            <td>{{$jogador->passe}}</td>
                                            <td>
                                                <a onclick="return confirm('Dispensar o jogador dará metade do valor do seu passe de volta aos caixas, confirmar?')"
                                                   href="{{route('dispensar.jogador',['jogador' => $jogador->id])}}" class="btn btn-primary">
                                                    <i class="fa fa-money"></i> Dispensar
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection






