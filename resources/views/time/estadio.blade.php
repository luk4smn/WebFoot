@extends('templates.template')

@section('content')

    {{ Form::open(array('url' => '/estadio/update' , 'class'=>'form-horizontal' , 'method' => 'PUT')) }}

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
                <li class="breadcrumb-item"><a href="/estadio">Meu Estádio</a></li>
            </ol>

            <div class="panel panel-flat">
                <div class="panel-body">
                    <div class="form-group">
                        <label class="control-label col-lg-2">Nome</label>
                        <div class="col-lg-6">
                            {!! Form::input('text','nome', auth()->user()->time->estadio->nome ?? null, ['class'=>'form-control','placeholder'=>'Nome', 'required'] ) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Capacidade</label>
                        <div class="col-lg-6">
                            {!! Form::input('text','capacidade', auth()->user()->time->estadio->capacidade ?? null, ['class'=>'form-control','placeholder'=>'Capacidade','readonly']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <label class="control-label col-lg-2">Valor Ingresso</label>
                        <div class="col-lg-6">
                            {!! Form::input('text','valor_ingresso', auth()->user()->time->estadio->valor_ingresso ?? null, ['class'=>'form-control','placeholder'=>'Valor Ingresso','readonly']) !!}
                        </div>
                    </div>

                    <div class="form-group">
                        <img src="/img/estadio.png">
                    </div>
                    <div class="text-left">
                        <button type="submit" class="btn btn-primary">Alterar <i
                                    class="fa fa-arrow-circle-o-left"></i></button>
                    </div>

                </div>

            </div>

        </div>
    </div>
    {{ Form::close() }}
@endsection






