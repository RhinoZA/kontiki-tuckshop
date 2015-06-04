@extends('app') @section('content')
<div class="container">
    <div class="row">
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">
                <div class="panel-heading">Home</div>

                {!! Form::model($product, array('route' => array('products.update', $product->id), 'method' => 'PUT')) !!}

                <div class="form-group">
                    {!! Form::label('name', 'Name') !!} {!! Form::text('name', null, array('class' => 'form-control')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('cost_price', 'Cost Price') !!} {!! Form::input('number', 'cost_price', null, array('class' => 'form-control')) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('selling_price', 'Selling Price') !!} {!! Form::input('number', 'selling_price', null, array('class' => 'form-control')) !!}
                </div>

                <div class="form-group">
                    {!! Form::label('product_type_id', 'Product Type') !!} {!! Form::select('product_type_id', \App\ProductType::lists('name', 'id')) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('combo_type_id', 'Combo Type') !!} {!! Form::select('combo_type_id', \App\ComboType::lists('name', 'id')) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('product_group_id', 'Product Group') !!} {!! Form::select('product_group_id', \App\ProductGroup::lists('name', 'id')) !!}
                </div>
                
                <div class="form-group">
                    {!! Form::label('kitchen_id', 'Kitchen') !!} {!! Form::select('kitchen_id', \App\Kitchen::lists('name', 'id')) !!}
                </div>

                {!! Form::submit('Edit', array('class' => 'btn btn-primary')) !!} {!! Form::close() !!}
                
                <a href="{!! route('combos', [ 'product_id' => $product->id ]) !!}">Combo Rules</a> 
            </div>
        </div>
    </div>
</div>
@endsection
