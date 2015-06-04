<!--- Product Id Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('product_id', 'Product:') !!}
    {!! Form::select('product_id', \App\Product::lists('name', 'id')) !!}
</div>

<!--- Quantity Field --->
<div class="form-group col-sm-6 col-lg-4">
    {!! Form::label('quantity', 'Quantity:') !!}
    {!! Form::text('quantity', null, ['class' => 'form-control']) !!}
</div>


<!--- Submit Field --->
<div class="form-group col-sm-12">
    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
</div>
