@extends('layouts.app')

@section('header_styles')
<style type="text/css">
    .no-padding-left{
        padding-left: 0px !important;
    }
    .no-padding-right{
        padding-right: 0px !important;
    }
</style>
@stop

@section('content')
<div class="container">
    <h1>
        New Generator
    </h1>
    @include('flash::message')
    @include('common.errors')
    <div class="widget-container fluid-height clearfix">
        <div class="heading">
            <i class="fa fa-th-list"></i>New Generator
        </div>
        <div class="clearfix">
		    {!! Form::open(['route' => 'admin.generators.store', 'class'=>'form-horizontal', 'role'=>'form']) !!}

		        @include('generators.fields')

		    {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection

{{-- Body Bottom confirm modal --}}
@section('footer_scripts')

    <script type="text/javascript">

        var inits = function(){

            $('.field_type').on('change', function(){
                if($(this).val() == 'select' || $(this).val() == 'checkbox' || $(this).val() == 'radio'){
                    $($(this).parent().parent().children()[1]).removeClass('hide');
                }
                else{
                    $($(this).parent().parent().children()[1]).addClass('hide');
                }
                if($(this).val() == 'pointer')
                    $($(this).parent().parent().children()[2]).removeClass('hide');
                else{
                    $($(this).parent().parent().children()[2]).addClass('hide');
                }
            });
            $('.pointer').on('change', function(index){
                var selectedIndex = $(this).find(":selected").index();
                var objects = {!! json_encode($object_fields) !!};
                var objectFields = $.map(objects[selectedIndex], function(value, index) {
                    return [value];
                });

                $($($(this).parent().parent().children()[1]).children()[1]).html('');
                for (var i = 0; i < objectFields.length; i++) {
                    $($($(this).parent().parent().children()[1]).children()[1]).append('<option value="'+objectFields[i]+'">'+objectFields[i]+'</option>');
                }

            });

        }
        inits();
        $('#next-field').on('click', function(){
            var template = $('#template-field').html();
            $('#template-container').append(template);
            inits();
        });
    </script>

@stop

