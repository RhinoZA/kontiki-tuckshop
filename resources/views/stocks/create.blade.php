@extends('app')

@section('content')
<div class="container">

    @include('common.errors')

    {!! Form::open(['route' => 'stocks.store']) !!}

        @include('stocks.fields')

    {!! Form::close() !!}
</div>
@endsection
