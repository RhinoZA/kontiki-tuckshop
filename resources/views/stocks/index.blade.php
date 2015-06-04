@extends('app')

@section('content')

<div class="container">

    @include('flash::message')

    <div class="row">
        <h1 class="pull-left">Stocks</h1>
        <a class="btn btn-primary pull-right" style="margin-top: 25px" href="{!! route('stocks.create') !!}">Add New</a>
    </div>

    <div class="row">

        <table class="table">
            <thead>
                <th>Product</th>
                <th>Purchased</th>
                <th>Sold</th>
                <th>Remaining</th>
                <th width="50px">Action</th>
            </thead>
            <tbody>
                @foreach($stocks as $stock)
                <tr>
                    <td>{!! $stock->name !!}</td>
                    <td>{!! $stock->total_purchased !!}</td>
                    <td>{!! $stock->total_consumed !!}</td>
                    <td>{!! $stock->remaining !!}</td>
                    <td>
                        <a href="{!! route('stocks.edit', [$stock->id]) !!}"><i class="glyphicon glyphicon-edit"></i></a>
                        <a href="{!! route('stocks.delete', [$stock->id]) !!}" onclick="return confirm('Are you sure wants to delete this Stock?')"><i class="glyphicon glyphicon-remove"></i></a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection