<?php
$attribute = $addAttribute;
foreach ($fieldExtra as $extraKey => $extraVal) {
    $attribute[$extraKey] = $extraVal;
}
$attribute['id'] = $fieldName;
$attribute['class'] = 'form-control pull-right daterange';
if ($errors->has($fieldName)) {
    $attribute['class'] .= ' is-invalid';
}
$attribute['autocomplete'] = 'off';
if ($fieldRequired == 1) {
    $attribute['required'] = 'true';
}
?>
<div class="form-group">
    <label for="{{$fieldName}}">{{ __($fieldLang) }} {!! $fieldRequired == 1 ? ' <span class="text-red">*</span>' : '' !!}</label>
    <div class="input-group">
        <div class="input-group-prepend datepicker-trigger">
            <div class="input-group-text">
                <i class="fas fa-calendar"></i>
            </div>
        </div>
        {{ Form::text($fieldName, old($fieldName, $fieldValue), $attribute) }}
    </div>
    @if(isset($fieldMessage)) <span class="small">{{ $fieldMessage }}</span> @endif
    @if($errors->has($fieldName)) <div class="invalid-feedback">{{ $errors->first($fieldName) }}</div> @endif
</div>
