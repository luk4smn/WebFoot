@extends('templates.template')

@section('content')

    {{ Form::open(array('url' => '/team/selected' , 'class'=>'form-horizontal')) }}

    @if (Session::has('mensagem'))
        <div class="alert alert-danger">{{ Session::get('mensagem') }}</div>
    @endif

    @if($errors->count() > 0)
        <div class="alert alert-danger">
            {{ HTML::ul($errors->all()) }}
        </div>
    @endif

    <div class="content-wrapper">
        <div class="container-fluid">
            <!-- Breadcrumbs-->
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="/">Seleção de time</a></li>
            </ol>

            <div class="row">
                <div class="col-lg-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                            <i class="fa fa-table"></i> Selecione um time para prosseguir</div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                    <tr>
                                        <th></th>
                                        <th>Nome</th>
                                        <th>Estádio</th>
                                        <th>Torcedores</th>
                                        <th>Campeonato</th>
                                        <th>Caixa (R$)</th>
                                        <th></th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($times as $key => $time)
                                    <tr>
                                        <td><a class="navbar-brand" href="{{ URL::asset('/') }}"><img
                                                        src="{{ URL::asset($time->escudo) }}" alt=""></a></td>
                                        <td>{{$time->nome}}</td>
                                        <td>{{$time->estadio->nome}}</td>
                                        <td>{{$time->numero_torcedores}}k</td>
                                        <td>{{$time->campeonato->nome}}</td>
                                        <td>R$ {{$time->caixa}}</td>
                                        <td><input type="radio" name="radio[]" value="<?php echo $time->id; ?>"></td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Selecionar <i
                                            class="icon-arrow-right14 position-right"></i></button>
                            </div>

                        </div>
                        <div class="card-footer small text-muted">Updated yesterday at 11:59 PM</div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::close() }}
@endsection

