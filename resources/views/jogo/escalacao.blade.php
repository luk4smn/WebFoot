@extends('templates.template')

@section('content')

    {{ Form::open(array('url' => '/resultados' , 'class'=>'form-horizontal' , 'method' => 'GET')) }}

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

            <div class="card mb-3">
                <div class="card-header">

                    <input type="hidden" name="jogo_id" value="{{$jogo->id}}">

                    <i class="fa fa-table" ></i>Proxima Partida : <span style="color: #bf001d; font-weight: bold;"> {{$jogo->mandante->nome ." x ". $jogo->visitante->nome}} </span> {{"  (Estádio : ".$jogo->mandante->estadio->nome.")"}}
                </div>
                <div class="card-body" style="width:100%;padding:8px;background:url('img/campo_reto.jpg')">
                    <div class="panel panel-flat">
                        <div class="panel-body">
                            <div class="form-group">
                                <label class="control-label col-lg-2" style="color: #bf001d; font-weight: bold;">Formação</label>
                                <div class="col-lg-4">
                                    {{ Form::select('formacao', ["4-4-2", "4-3-3", "4-5-1", "3-5-2"], null, ['class' => 'form-control formacao','placeholder'=>'*** SELECIONE A FORMAÇÃO ***','required']) }}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2" style="color: #005cbf; font-weight: bold;">Goleiro </label>
                                <div class="col-lg-4">
                                    {!! Form::select('goleiro_id',array_pluck($meu_elenco['goleiros'], 'nome', 'id'),null,['class'=>'form-control','placeholder'=>'*** GOLEIROS ***','required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2" style="color: #005cbf; font-weight: bold;">Defensores </label>
                                <div class="col-lg-6">
                                    {!! Form::select('defensores_id[]',array_pluck($meu_elenco['defensores'], 'nome', 'id'),null,['multiple'=>true,'class'=>'form-control','required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2" style="color: #005cbf; font-weight: bold;">Meias </label>
                                <div class="col-lg-6">
                                        {!! Form::select('meias_id[]',array_pluck($meu_elenco['meias'], 'nome', 'id'),null,['multiple'=>true,'class'=>'form-control','required']) !!}
                                </div>
                            </div>

                            <div class="form-group">
                                <label class="control-label col-lg-2" style="color: #005cbf; font-weight: bold;">Atacantes </label>
                                <div class="col-lg-6">
                                    {!! Form::select('atacantes_id[]',array_pluck($meu_elenco['atacantes'], 'nome', 'id'),null,['multiple'=>true,'class'=>'form-control','required']) !!}
                                </div>
                            </div>


                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Submeter <i
                                            class="fa fa-arrow-circle-o-right"></i></button>
                            </div>

                        </div>

                    </div>

                </div>
        </div>
        </div>
    </div>

@endsection