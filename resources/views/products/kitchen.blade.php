<div class="form-group">
    <label class="col-md-4 control-label">Kitchen</label>
    <div class="col-md-6">
    	{!! Form::select('kitchen_id', \App\Kitchen::lists('name', 'id')) !!}
    </div>
</div>