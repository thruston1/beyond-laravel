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
if ($fieldRequired == 1) {
    $attribute['required'] = 'true';
}
?>
<div class="col-12 col-sm-4">
    <div class="form-group">
        <label for="{{$fieldName}}">{{ __($fieldLang) }} {!! $fieldRequired == 1 ? ' <span class="text-red">*</span>' : '' !!}</label>
        {{ Form::select($fieldName, $listFieldName, old($fieldName, $fieldValue), $attribute) }}
        @if(isset($fieldMessage)) <span class="small">{!! $fieldMessage !!}</span> @endif
        @if($errors->has($fieldName)) <div class="invalid-feedback">{{ $errors->first($fieldName) }}</div> @endif
    </div>
</div>

