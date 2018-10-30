@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Shortener Link</div>
                <div class="card-body">
                @if(Session::has('global'))
                <p>{!! Session::get('global') !!}</p>
                @endif

                {!! Form::open(['action' => 'LinkController@make', 'method' => 'POT']) !!}

                <div class="form-group">
                    {{ Form::label('url' , 'Shortener link:')}}
                    {{ Form::text('url', '', ['class' => 'form-control', 'placeholder' => 'Shortener link'])}}
                </div>

                {{ Form::submit('Submit', ['class' => 'btn btn-primary'])}}
                {!! Form::close() !!}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection