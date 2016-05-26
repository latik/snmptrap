@extends('layouts.app')

@section('content')
    <div class="container">
        {!! Form::open(['route' => 'netdevice.import', 'files'=>true, 'class' => 'form-horizontal']) !!}

            <div class="form-group">
                <h3 class="help-block">Импорт коммутаров из базы Кубика</h3>
                <p class="help-block">Отчет Развернутый отчет по топологии(Вывод в CSV), файл вида KTV-7018_xxxxx.csv</p>
                <p class="help-block label label-danger">В процессе импорта будет очищенна текущая база</p><br/>

                <label class="btn btn-default btn-file">
                    CSV file <input type="file" name="file" style="display: none;">
                </label>

            </div>

            <div class="form-group">
                <div class="col-sm-offset-3 col-sm-3">
                    {!! Form::submit('Импорт', ['class' => 'btn btn-primary form-control']) !!}
                </div>
            </div>

        {!! Form::close() !!}

        @if ($errors->any())
            <ul class="alert alert-danger">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        @endif
    </div>
@endsection