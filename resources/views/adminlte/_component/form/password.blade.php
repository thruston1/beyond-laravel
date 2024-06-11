<?php
$attribute = $addAttribute;
foreach ($fieldExtra as $extraKey => $extraVal) {
    $attribute[$extraKey] = $extraVal;
}
$attribute['id'] = $fieldName;
$attribute['class'] = 'form-control';
if ($errors->has($fieldName)) {
    $attribute['class'] .= ' is-invalid';
}
$attribute['placeholder'] = __($fieldLang);
if ($fieldRequired == 1) {
    $attribute['required'] = 'true';
}
?>
<div class="form-group">
    <label for="{{$fieldName}}">{{ __($fieldLang) }} {!! $fieldRequired == 1 ? ' <span class="text-red">*</span>' : '' !!}</label>
    <div class="input-group {!! $errors->has($fieldName) ? ' is-invalid' : '' !!}">
        {{ Form::password($fieldName, $attribute) }}
        <div class="input-group-append">
            <div class="input-group-text">
                <span class="fas fa-lock togglePassword"></span>
            </div>
        </div>
    </div>
    @if(isset($fieldMessage)) <span class="small">{!! $fieldMessage !!}</span> @endif
    @if($errors->has($fieldName)) <div class="invalid-feedback">{{ $errors->first($fieldName) }}</div> @endif
</div>
