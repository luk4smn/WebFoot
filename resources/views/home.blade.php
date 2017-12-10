@extends('templates.template')

@section('content')
    <div class="content-wrapper">
        <div class="container-fluid">
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
                        <a class="card-footer text-white clearfix small z-1" href="#">
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
                            <div class="mr-5">Próximos Jogos</div>
                        </div>
                        <a class="card-footer text-white clearfix small z-1" href="#">
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
                        <a class="card-footer text-white clearfix small z-1" href="#">
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
                        <a class="card-footer text-white clearfix small z-1" href="#">
                            <span class="float-left">View Details</span>
                            <span class="float-right">
                <i class="fa fa-angle-right"></i>
              </span>
                        </a>
                    </div>
                </div>
            </div>
            <!-- Area Chart Example-->
            <input type="hidden" id="vitorias" value="{{auth()->user()->time->classificacao->vitorias}}">
            <input type="hidden" id="empates" value="{{auth()->user()->time->classificacao->empates}}">
            <input type="hidden" id="derrotas" value="{{auth()->user()->time->classificacao->derrotas}}">
            <div class="row">
                <div class="col-lg-12">
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
                                    <div class="h4 mb-0 text-primary">R$ {{\App\Support\Convert::decimalToMoney(auth()->user()->time->caixa)}}</div>
                                    <div class="small text-muted">Dinheiro em Caixa</div>
                                    <hr>
                                    <div class="h4 mb-0 text-warning">$18,474</div>
                                    <div class="small text-muted">Despesas com Salários</div>
                                    <hr>
                                    <div class="h4 mb-0 text-success">$16,219</div>
                                    <div class="small text-muted">Balanço Financeiro</div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer small text-muted">Atualizado em {{date('d/m/Y')}}</div>
                    </div>

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Data Table Example</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th>Position</th>
                                        <th>Office</th>
                                        <th>Age</th>
                                        <th>Start date</th>
                                        <th>Salary</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    {{--@foreach($times as $key => $time)--}}
                                        {{--<tr>--}}
                                            {{--<td><a class="navbar-brand" href="{{ URL::asset('/') }}"><img--}}
                                                            {{--src="{{ URL::asset($time->escudo) }}" alt=""></a></td>--}}
                                            {{--<td>{{$time->nome}}</td>--}}
                                            {{--<td>{{$time->estadio->nome}}</td>--}}
                                            {{--<td>{{$time->numero_torcedores}}k</td>--}}
                                            {{--<td>{{$time->campeonato->nome}}</td>--}}
                                            {{--<td>R$ {{$time->caixa}}</td>--}}
                                            {{--<td><input type="radio" name="radio[time_id]" value="{{$time->id}}"></td>--}}
                                        {{--</tr>--}}
                                    {{--@endforeach--}}
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

