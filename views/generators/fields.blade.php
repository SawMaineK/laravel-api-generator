<div class="row">
	<!-- pointer Name Field -->
	<div class="col-sm-1 col-lg-1 control-label">pointer:</div>
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('model_name') ? ' has-error' : '' }}">
			{!! Form::text('model_name', null, ['class' => 'form-control']) !!}
	        @if ($errors->has('model_name'))
	            <span class="help-block">
	                <strong>{{ $errors->first('model_name') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>
</div>
<div class="row">
	<!-- Field Name Field -->
	<div class="col-sm-1 col-lg-1 control-label">Field 1:</div>
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('field_name') ? ' has-error' : '' }}">
	    	{!! Form::label('field_name', 'Field Name:',['class' => 'control-label']) !!}
	        
			{!! Form::text('field_name[]', null, ['class' => 'form-control']) !!}
	        @if ($errors->has('field_name'))
	            <span class="help-block">
	                <strong>{{ $errors->first('field_name') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<!-- Field Type Field -->
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('field_type') ? ' has-error' : '' }}">
	    {!! Form::label('field_type', 'Field Type:',['class' => 'control-label']) !!}
	        
			{!! Form::select('field_type[]', [ 'text' => 'text', 'textarea' => 'textarea', 'email' => 'email', 'date' => 'date', 'password' => 'password', 'checkbox' => 'checkbox', 'radio' => 'radio', 'select' => 'select', 'file' => 'file', 'pointer' => 'pointer' ], null, ['class' => 'form-control field_type']) !!}
	        @if ($errors->has('field_type'))
	            <span class="help-block">
	                <strong>{{ $errors->first('field_type') }}</strong>
	            </span>
	        @endif
	    </div>
	    <div class="form-group hide" id="select-value">
	    	{!! Form::text('value[]', null, ['class' => 'form-control','placeholder'=>'Apple, Orange, Friute',]) !!}
		</div>
		<div class="form-group hide" id="pointer-value">
			<div class="col-sm-6 col-lg-6 no-padding-left">
				{!! Form::label('pointer', 'Choose Model:',['class' => 'control-label']) !!}
				{!! Form::select('pointer[]', $objects, null, ['class' => 'form-control pointer']) !!}
			</div>
			<div class="col-sm-6 col-lg-6 no-padding-right">
				{!! Form::label('pointer_column', 'Choose Column:',['class' => 'control-label']) !!}
				{!! Form::select('pointer_column[]', count($object_fields) > 0 ? $object_fields[0] : [] , null, ['class' => 'form-control']) !!}
			</div>
		</div>
	</div>

	<!-- Data Type Field -->
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('data_type') ? ' has-error' : '' }}">
	    {!! Form::label('data_type', 'Data Type:',['class' => 'control-label']) !!}
	        
			{!! Form::select('data_type[]', [ 'string' => 'String', 'text' => 'Text', 'integer' => 'Integer', 'double' => 'Double', 'boolean' => 'Boolean' ], null, ['class' => 'form-control']) !!}
	        @if ($errors->has('data_type'))
	            <span class="help-block">
	                <strong>{{ $errors->first('data_type') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>


	<!-- Is Required Field -->
	<div class="col-sm-2 col-lg-2"> 
		<div class="form-group{{ $errors->has('is_required') ? ' has-error' : '' }}">
	    {!! Form::label('is_required', 'Is Required:',['class' => 'control-label']) !!}
	        <div class="checkbox">
				<label>{!! Form::checkbox('is_required[]', 1, true) !!}<span></span></label>
			</div>
	        @if ($errors->has('is_required'))
	            <span class="help-block">
	                <strong>{{ $errors->first('is_required') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

</div>
<div class="row">
	<!-- Field Name Field -->
	<div class="col-sm-1 col-lg-1 control-label">Field 2:</div>
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('field_name') ? ' has-error' : '' }}">
	    	{!! Form::label('field_name', 'Field Name:',['class' => 'control-label']) !!}
	        
			{!! Form::text('field_name[]', null, ['class' => 'form-control']) !!}
	        @if ($errors->has('field_name'))
	            <span class="help-block">
	                <strong>{{ $errors->first('field_name') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<!-- Field Type Field -->
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('field_type') ? ' has-error' : '' }}">
	    {!! Form::label('field_type', 'Field Type:',['class' => 'control-label']) !!}
	        
			{!! Form::select('field_type[]', [ 'text' => 'text', 'textarea' => 'textarea', 'email' => 'email', 'date' => 'date', 'password' => 'password', 'checkbox' => 'checkbox', 'radio' => 'radio', 'select' => 'select', 'file' => 'file', 'pointer' => 'pointer' ], null, ['class' => 'form-control field_type']) !!}
	        @if ($errors->has('field_type'))
	            <span class="help-block">
	                <strong>{{ $errors->first('field_type') }}</strong>
	            </span>
	        @endif
	    </div>
	    <div class="form-group hide" id="select-value">
	    	{!! Form::text('value[]', null, ['class' => 'form-control','placeholder'=>'Apple, Orange, Friute',]) !!}
		</div>
		<div class="form-group hide" id="pointer-value">
			<div class="col-sm-6 col-lg-6 no-padding-left">
				{!! Form::label('pointer', 'Choose Model:',['class' => 'control-label']) !!}
				{!! Form::select('pointer[]', $objects, null, ['class' => 'form-control pointer']) !!}
			</div>
			<div class="col-sm-6 col-lg-6 no-padding-right">
				{!! Form::label('pointer_column', 'Choose Column:',['class' => 'control-label']) !!}
				{!! Form::select('pointer_column[]', count($object_fields) > 0 ? $object_fields[0] : [], null, ['class' => 'form-control']) !!}
			</div>
		</div>
	</div>

	<!-- Data Type Field -->
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('data_type') ? ' has-error' : '' }}">
	    {!! Form::label('data_type', 'Data Type:',['class' => 'control-label']) !!}
	        
			{!! Form::select('data_type[]', [ 'string' => 'String', 'text' => 'Text', 'integer' => 'Integer', 'double' => 'Double', 'boolean' => 'Boolean' ], null, ['class' => 'form-control']) !!}
	        @if ($errors->has('data_type'))
	            <span class="help-block">
	                <strong>{{ $errors->first('data_type') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>


	<!-- Is Required Field -->
	<div class="col-sm-2 col-lg-2"> 
		<div class="form-group{{ $errors->has('is_required') ? ' has-error' : '' }}">
	    {!! Form::label('is_required', 'Is Required:',['class' => 'control-label']) !!}
	        <div class="checkbox">
				<label>{!! Form::checkbox('is_required[]', 1, true) !!}<span></span></label>
			</div>
	        @if ($errors->has('is_required'))
	            <span class="help-block">
	                <strong>{{ $errors->first('is_required') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

</div>
<div class="row">
	<!-- Field Name Field -->
	<div class="col-sm-1 col-lg-1 control-label">Field 3:</div>
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('field_name') ? ' has-error' : '' }}">
	    	{!! Form::label('field_name', 'Field Name:',['class' => 'control-label']) !!}
	        
			{!! Form::text('field_name[]', null, ['class' => 'form-control']) !!}
	        @if ($errors->has('field_name'))
	            <span class="help-block">
	                <strong>{{ $errors->first('field_name') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<!-- Field Type Field -->
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('field_type') ? ' has-error' : '' }}">
	    {!! Form::label('field_type', 'Field Type:',['class' => 'control-label']) !!}
	        
			{!! Form::select('field_type[]', [ 'text' => 'text', 'textarea' => 'textarea', 'email' => 'email', 'date' => 'date', 'password' => 'password', 'checkbox' => 'checkbox', 'radio' => 'radio', 'select' => 'select', 'file' => 'file', 'pointer' => 'pointer' ], null, ['class' => 'form-control field_type']) !!}
	        @if ($errors->has('field_type'))
	            <span class="help-block">
	                <strong>{{ $errors->first('field_type') }}</strong>
	            </span>
	        @endif
	    </div>
	    <div class="form-group hide" id="select-value">
	    	{!! Form::text('value[]', null, ['class' => 'form-control','placeholder'=>'Apple, Orange, Friute',]) !!}
		</div>
		<div class="form-group hide" id="pointer-value">
			<div class="col-sm-6 col-lg-6 no-padding-left">
				{!! Form::label('pointer', 'Choose Model:',['class' => 'control-label']) !!}
				{!! Form::select('pointer[]', $objects, null, ['class' => 'form-control pointer']) !!}
			</div>
			<div class="col-sm-6 col-lg-6 no-padding-right">
				{!! Form::label('pointer_column', 'Choose Column:',['class' => 'control-label']) !!}
				{!! Form::select('pointer_column[]', count($object_fields) > 0 ? $object_fields[0] : [], null, ['class' => 'form-control']) !!}
			</div>
		</div>
	</div>

	<!-- Data Type Field -->
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('data_type') ? ' has-error' : '' }}">
	    {!! Form::label('data_type', 'Data Type:',['class' => 'control-label']) !!}
	        
			{!! Form::select('data_type[]', [ 'string' => 'String', 'text' => 'Text', 'integer' => 'Integer', 'double' => 'Double', 'boolean' => 'Boolean' ], null, ['class' => 'form-control']) !!}
	        @if ($errors->has('data_type'))
	            <span class="help-block">
	                <strong>{{ $errors->first('data_type') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>


	<!-- Is Required Field -->
	<div class="col-sm-2 col-lg-2"> 
		<div class="form-group{{ $errors->has('is_required') ? ' has-error' : '' }}">
	    {!! Form::label('is_required', 'Is Required:',['class' => 'control-label']) !!}
	        <div class="checkbox">
				<label>{!! Form::checkbox('is_required[]', 1, true) !!}<span></span></label>
			</div>
	        @if ($errors->has('is_required'))
	            <span class="help-block">
	                <strong>{{ $errors->first('is_required') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

</div>

<template id="template-field">
<div class="row">
	<!-- Field Name Field -->
	<div class="col-sm-1 col-lg-1 control-label">Extra Field:</div>
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('field_name') ? ' has-error' : '' }}">
	    	{!! Form::label('field_name', 'Field Name:',['class' => 'control-label']) !!}
	        
			{!! Form::text('field_name[]', null, ['class' => 'form-control']) !!}
	        @if ($errors->has('field_name'))
	            <span class="help-block">
	                <strong>{{ $errors->first('field_name') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<!-- Field Type Field -->
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('field_type') ? ' has-error' : '' }}">
	    {!! Form::label('field_type', 'Field Type:',['class' => 'control-label']) !!}
	        
			{!! Form::select('field_type[]', [ 'text' => 'text', 'textarea' => 'textarea', 'email' => 'email', 'date' => 'date', 'password' => 'password', 'checkbox' => 'checkbox', 'radio' => 'radio', 'select' => 'select', 'file' => 'file', 'pointer' => 'pointer' ], null, ['class' => 'form-control field_type']) !!}
	        @if ($errors->has('field_type'))
	            <span class="help-block">
	                <strong>{{ $errors->first('field_type') }}</strong>
	            </span>
	        @endif
	    </div>
	    <div class="form-group hide" id="select-value">
	    	{!! Form::text('value[]', null, ['class' => 'form-control','placeholder'=>'Apple, Orange, Friute',]) !!}
		</div>
		<div class="form-group hide" id="pointer-value">
			<div class="col-sm-6 col-lg-6 no-padding-left">
				{!! Form::label('pointer', 'Choose Model:',['class' => 'control-label']) !!}
				{!! Form::select('pointer[]', $objects, null, ['class' => 'form-control pointer']) !!}
			</div>
			<div class="col-sm-6 col-lg-6 no-padding-right">
				{!! Form::label('pointer_column', 'Choose Column:',['class' => 'control-label']) !!}
				{!! Form::select('pointer_column[]', count($object_fields) > 0 ? $object_fields[0] : [], null, ['class' => 'form-control']) !!}
			</div>
		</div>
	</div>

	<!-- Data Type Field -->
	<div class="col-sm-3 col-lg-3"> 
		<div class="form-group{{ $errors->has('data_type') ? ' has-error' : '' }}">
	    {!! Form::label('data_type', 'Data Type:',['class' => 'control-label']) !!}
	        
			{!! Form::select('data_type[]', [ 'string' => 'String', 'text' => 'Text', 'integer' => 'Integer', 'double' => 'Double', 'boolean' => 'Boolean' ], null, ['class' => 'form-control']) !!}
	        @if ($errors->has('data_type'))
	            <span class="help-block">
	                <strong>{{ $errors->first('data_type') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>


	<!-- Is Required Field -->
	<div class="col-sm-2 col-lg-2"> 
		<div class="form-group{{ $errors->has('is_required') ? ' has-error' : '' }}">
	    {!! Form::label('is_required', 'Is Required:',['class' => 'control-label']) !!}
	        <div class="checkbox">
				<label>{!! Form::checkbox('is_required[]', 1, true) !!}<span></span></label>
			</div>
	        @if ($errors->has('is_required'))
	            <span class="help-block">
	                <strong>{{ $errors->first('is_required') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>
</div>
</template>
<div id="template-container"></div>
<!-- Add More Field -->
<div class="row">
	<div class="col-sm-3 col-lg-2 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
		<div class="form-group">
		    {!! Form::button('Next Field', ['class' => 'btn btn-default-outline', 'id' => 'next-field']) !!}
	    </div>
	</div>
	<!-- Has Access Token Field -->
    <div class="col-xs-6 col-sm-3 col-lg-2"> 
		<div class="form-group{{ $errors->has('has_access_token') ? ' has-error' : '' }}">
	        <div class="checkbox">
				<label>{!! Form::checkbox('has_access_token', 1, false) !!}<span>Has Access Token</span></label>
			</div>
	        @if ($errors->has('has_access_token'))
	            <span class="help-block">
	                <strong>{{ $errors->first('has_access_token') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<!-- Set Paginater Field -->
	<div class="col-xs-6 col-sm-3 col-lg-2"> 
		<div class="form-group{{ $errors->has('set_paginater') ? ' has-error' : '' }}">
	        <div class="checkbox">
				<label>{!! Form::checkbox('set_paginater', 1, true) !!}<span>Set Paginater</span></label>
			</div>
	        @if ($errors->has('set_paginater'))
	            <span class="help-block">
	                <strong>{{ $errors->first('set_paginater') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<!-- Add Soft Delete Field -->
	<div class="col-xs-6 col-sm-3 col-lg-2"> 
		<div class="form-group{{ $errors->has('add_soft_delete') ? ' has-error' : '' }}">
	        <div class="checkbox">
				<label>{!! Form::checkbox('add_soft_delete', 1, true) !!}<span>Add Soft Delete</span></label>
			</div>
	        @if ($errors->has('add_soft_delete'))
	            <span class="help-block">
	                <strong>{{ $errors->first('add_soft_delete') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<!-- Has Api Field -->
	<div class="col-xs-6 col-sm-2 col-lg-2"> 
		<div class="form-group{{ $errors->has('has_api') ? ' has-error' : '' }}">
	        <div class="checkbox">
				<label>{!! Form::checkbox('has_api', 1, true) !!}<span>Has Api</span></label>
			</div>
	        @if ($errors->has('has_api'))
	            <span class="help-block">
	                <strong>{{ $errors->first('has_api') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

	<!-- Skip Migration Field -->
	<div class="col-xs-6 col-sm-2 col-lg-2"> 
		<div class="form-group{{ $errors->has('skip_migration') ? ' has-error' : '' }}">
	        <div class="checkbox">
				<label>{!! Form::checkbox('skip_migration', 1, false) !!}<span>Skip Migration</span></label>
			</div>
	        @if ($errors->has('skip_migration'))
	            <span class="help-block">
	                <strong>{{ $errors->first('skip_migration') }}</strong>
	            </span>
	        @endif
	    </div>
	</div>

</div>


<!-- Submit Field -->
<div class="row">
	<div class="form-group">
		<div class="col-sm-6 col-sm-offset-1 col-md-offset-1 col-lg-offset-1">
		    {!! Form::submit('Save', ['class' => 'btn btn-primary']) !!}
		    <a class="btn btn-default-outline" href="{!! URL::previous() !!}">Cancel</a>
	    </div>
	</div>
</div>
