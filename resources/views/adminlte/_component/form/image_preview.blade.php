<?php
$attribute = $addAttribute;
$attribute['id'] = $fieldName;
if ($fieldRequired == 1) {
    $attribute['required'] = 'true';
}
?>
<div class="form-group">
    <label for="{{$fieldName}}">{{ __($fieldLang) }} {!! $fieldRequired == 1 ? ' <span class="text-red">*</span>' : '' !!}</label>
    @if($fieldValue)
        <br/>
        <a href="{{ $fieldValue }}" target="_blank" title="{{$fieldName}}" rel="lightbox">
            <img src="{{ $fieldValue }}" class="img-responsive max-image-preview" alt="{{$fieldName}}"/>
        </a>
        <br/>
    @endif
    <br/>
    @if(isset($fieldMessage)) <span class="small">{{ $fieldMessage }}</span> @endif
</div>
