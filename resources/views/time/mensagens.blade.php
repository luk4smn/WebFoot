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
                <li class="breadcrumb-item"><a href="/mensagens">Mensagens</a></li>
            </ol>

            <div class="row">
                <div class="col-lg-12">

                    <!-- Example DataTables Card-->
                    <div class="card mb-3">
                        <div class="card-header">
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-dark" width="100%" cellspacing="0">
                                    <thead>
                                    <tr align="center">
                                        <th>Data</th>
                                        <th>Mensagem</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($mensagens as $key => $mensagem)
                                        <tr align="center">
                                            <td>{{\App\Support\Convert::DBDateTimeToStringFormat($mensagem->created_at ?? null)}}</td>
                                            <td>{{$mensagem->mensagem ?? null}}</td>
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






