    <div class="row">
        @foreach($passing as $fieldName => $fieldData)
            <?php
        $fieldValue = isset($data->$fieldName) ? $data->$fieldName : null;
        if ($fieldData['type'] == 'image') {
            if (isset($data->{$fieldName.'_full'})) {
                $fieldValue = $data->{$fieldName.'_full'};
            }
            else if (strlen($fieldValue) > 0) {
                $fieldValue = asset('uploads/'.$fieldValue);
            }
            else {
                $fieldValue = null;
            }
        }

        $listPassing = [
            'fieldName' => $fieldName,
            'fieldLang' => __($fieldData['lang']),
            'fieldRequired' => isset($fieldData['validate'][$viewType]) && in_array('required', explode('|', $fieldData['validate'][$viewType])) ? 1 : 0,
            'fieldValue' => $fieldValue,
            'fieldMessage'=>$fieldData['message'],
            'path'=>$fieldData['path'],
            'addAttribute'=>$addAttribute,
            'fieldExtra' => isset($fieldData['extra'][$viewType]) ? $fieldData['extra'][$viewType] : [],
            'viewType' => $viewType
        ];

        $arrayPassing = [];
        if (in_array($fieldData['type'], ['select', 'select2', 'tagging', 'multiselect2'])) {
            $arrayPassing = isset($listSet[$fieldName]) ? $listSet[$fieldName] : [];
        }
        else if(in_array($fieldData['type'], ['file', 'file_many', 'image', 'image_many'])) {
            if(in_array($viewType, ['edit', 'create'])) {
                $listPassing['fieldMessage'] = $listPassing['fieldMessage'].' Max Upload file adalah 2Mb';
            }
        }
        $listPassing['listFieldName'] = $arrayPassing;
    ?>
    <div class="col-12">
        @component(env('ADMIN_TEMPLATE').'._component.form.'.$fieldData['type'], $listPassing)
        @endcomponent
    </div>
@endforeach

</div>
