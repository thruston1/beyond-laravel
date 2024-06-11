<?php
$attribute = $addAttribute;
$attribute['accept'] = 'image/*';
if ($fieldRequired == 1) {
    $attribute['required'] = 'true';
}
?>
<div class="form-group">
    <label for="{{$fieldName}}">{{ __($fieldLang) }} {!! $fieldRequired == 1 ? ' <span class="text-red">*</span>' : '' !!}</label>
    @if($fieldValue)
        <?php
        $getListValue = json_decode($fieldValue, TRUE);
        $listIndexValue = [];
        foreach($getListValue as $index => $listValue) {
            $listIndexValue[] = $index;
        }
        if (count($listIndexValue) > 0) {
            $listIndexValue = implode(',', $listIndexValue);
        }
        else {
            $listIndexValue = '';
        }
        ?>
        <input type="hidden" value="{!! $listIndexValue !!}" name="{!! $fieldName.'_storage' !!}" id="{!! $fieldName.'_storage' !!}">
        @foreach($getListValue as $index => $listValue)
            <div class="showing-image" data-id="{!! $index !!}">
                <a href="{{ asset($path.$listValue) }}" class="link_image" target="_blank" title="{{$listValue}}" rel="lightbox">
                    <img src="{{ asset($path.$listValue) }}" class="img-responsive max-image-preview" alt="{{$listValue}}"/>
                </a>
                @if($viewType == 'edit')
                    <a href="#" onclick="return remove_image(this)" data-storage="{!! $fieldName.'_storage' !!}" data-id="{!! $index !!}" class="btn btn-sm btn-danger"><i class="fas fa-close"></i></a>
                @endif
            </div>
        @endforeach
    @endif
    @if(!($viewType == 'show'))
        <div class="upload-image">
            {{ Form::file($fieldName.'[]', $attribute) }}
        </div>
        <a href="#" onclick="return add_image(this)" class="btn btn-sm btn-success"><i class="fas fa-plus"></i> @lang('general.add')</a>
    @endif
    @if(isset($fieldMessage)) <br/><span class="small">{{ $fieldMessage }}</span> @endif
    @if($errors->has($fieldName)) <div class="form-control is-invalid" style="display: none;"></div><div class="invalid-feedback">{{ $errors->first($fieldName) }}</div> @endif
</div>
