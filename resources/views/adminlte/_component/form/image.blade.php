<?php
$attribute = $addAttribute;
$attribute['id'] = $fieldName;
$attribute['accept'] = 'image/*';
$attribute['class'] = 'dropify';
$attribute['data-max-file-size'] = '2M';
if ($fieldRequired == 1) {
    $attribute['required'] = 'true';
}
?>
<div class="col-12">
    <div class="form-group">
        <label for="{{$fieldName}}">{{ __($fieldLang) }} {!! $fieldRequired == 1 ? ' <span class="text-red">*</span>' : '' !!}</label>
        @if($fieldValue)
            <br/>
            <a href="{{ $fieldValue }}" target="_blank" title="{{$fieldName}}" rel="lightbox">
                <img src="{{ $fieldValue }}" class="img-responsive max-image-preview" alt="{{$fieldName}}"/>
            </a>
            <br/>
        @endif
        @if(!($viewType == 'show'))
            @if (isset($fieldExtra['disabled']) && $fieldExtra['disabled'] == true)
            @else
            <br />
            {{ Form::file($fieldName, $attribute) }}
            @endif
        @endif
        @if(isset($fieldMessage)) <br/><span class="small">{{ $fieldMessage }}</span> @endif
        @if($errors->has($fieldName)) <div class="form-control is-invalid" style="display: none;"></div><div class="invalid-feedback">{{ $errors->first($fieldName) }}</div> @endif
    </div>
</div>

