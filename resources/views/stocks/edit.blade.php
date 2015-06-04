@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::model($stock, ['route' => ['stocks.update', $stock->id], 'method' => 'patch']) !!}

        @include('stocks.fields')

    {!! Form::close() !!}
</div>
@endsection
