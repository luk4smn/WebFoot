@extends('templates.template')

@section('content')
   <br>
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
            <ol class="breadcrumb">
                <li class="breadcrumb-item">
                    <a href="/">Início</a>
                </li>
                <li class="breadcrumb-item active">Estatísticas</li>
            </ol>
            <!-- Icon Cards-->
            <div class="row">
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-primary o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-comments"></i>
                            </div>
                            <div class="mr-5">Mensagens</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="mensagens">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-warning o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-list"></i>
                            </div>
                            <div class="mr-5">Jogos do meu Time</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="{{route('minhas.proximas.partidas')}}">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-success o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-shopping-cart"></i>
                            </div>
                            <div class="mr-5">Comprar Jogadores</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="comprar-jogadores">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                        </a>
                    </div>
                </div>
                <div class="col-xl-3 col-sm-6 mb-3">
                    <div class="card text-white bg-danger o-hidden h-100">
                        <div class="card-body">
                            <div class="card-body-icon">
                                <i class="fa fa-fw fa-support"></i>
                            </div>
                            <div class="mr-5">Meu Estádio</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="estadio">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Area Chart Example-->


            <div class="row">
                <div class="col-lg-12">
                    <div class="card mb-3">
                        @if($proximo_jogo != '')
                        <div class="card-header">
                            <i class="fa fa-table"></i> Proxima Partida :
                        <div align="center" style="color: #005cbf; font-weight: bold;">Estádio: {{$mandante->estadio->nome ?? ''}}</div>
                        </div>
                        <div class="card-body" style="width:100%;padding:8px;background:url('img/campo.png')">
                            <div class="table-responsive">
                                <table class="table table-dark" width="100%" cellspacing="0">
                                    <thead>
                                    <tr align="center">
                                        <th>Casa</th>
                                        <th>Rating ATK {{$mandante->getRatingAtk() ?? ''}} - DEF {{$mandante->getRatingDef() ?? ''}}</th>
                                        <th></th>
                                        <th>Rating ATK {{$visitante->getRatingAtk() ?? ''}} - DEF {{$visitante->getRatingDef() ?? ''}}</th>
                                        <th>Fora</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr align="center">
                                        <td align="center">{{$mandante->nome ?? ''}}</td>
                                        <td><a class="navbar-brand" href="{{ URL::asset('/') }}"><img
                                                        src="{{ URL::asset($mandante->escudo ?? '') }}" alt=""></a></td>
                                        <td>X</td>
                                        <td><a class="navbar-brand" href="{{ URL::asset('/') }}"><img
                                                        src="{{ URL::asset($visitante->escudo ?? '') }}" alt=""></a></td>
                                        <td>{{$visitante->nome}}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right">
                                <a   href="{{route('jogar',['partida_id' => $proximo_jogo->id  ?? ''])}}"  class="btn btn-primary">Jogar <i
                                            class="fa fa-fw fa-soccer-ball-o position-right"></i></a>
                            </div>
                        </div>

                        @else
                            <div class="card-body" style="width:100%;padding:8px;background:url('img/campo.png')">
                                <div class="table-responsive">
                                    <table class="table table-dark" width="100%" cellspacing="0">
                                        <thead>
                                        <tr align="center">
                                            <th>Fim de Campeonato</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        <td align="center">
                                            Parabéns pelo seu desempenho, seu time obteve grandes resultados !
                                        </td>

                                        </tbody>

                                    </table>
                                </div>
                            </div>

                        @endif
                    </div>


                    <input type="hidden" id="vitorias" value="{{auth()->user()->time->classificacao->vitorias}}">
                    <input type="hidden" id="empates" value="{{auth()->user()->time->classificacao->empates}}">
                    <input type="hidden" id="derrotas" value="{{auth()->user()->time->classificacao->derrotas}}">
                    <!-- Example Bar Chart Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-bar-chart"></i> Desempenho</div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-sm-8 my-auto">
                                    <canvas id="myBarChart" width="100" height="50"></canvas>
                                </div>
                                <div class="col-sm-4 text-center my-auto">
                                    <div class="h4 mb-0 text-primary">R$ {{\App\Support\Convert::decimalToMoney(auth()->user()->time->caixa ?? '')}}</div>
                                    <div class="small text-muted">Dinheiro em Caixa</div>
                                    <hr>
                                    <div class="h4 mb-0 text-warning">R$ {{\App\Support\Convert::decimalToMoney(auth()->user()->time->getSalariosJogadores() ?? '')}}</div>
                                    <div class="small text-muted">Despesas com Salários</div>
                                    <hr>
                                    <div class="h4 mb-0 text-success">R$ {{\App\Support\Convert::decimalToMoney(auth()->user()->time->setBallance() ?? '')}}</div>
                                    <div class="small text-muted">Balanço Financeiro</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Atualizado em {{date('d/m/Y')}}</div>
                    </div>

                    <!-- Example DataTables Card-->

                </div>
            </div>
        </div>
    </div>
@endsection

