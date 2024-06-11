<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use Illuminate\Http\Request;

class UsersController extends _CrudController
{
    protected $passingPassword;

    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'text' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
                'type' => 'text'
            ],
            'checkbox' => [
                'type' => 'checkbox'
            ],
            'code' => [
                'type' => 'code'
            ],
            'colorpicker' => [
                'type' => 'colorpicker'
            ],
            'datemonthyear' => [
                'type' => 'datemonthyear'
            ],
            'datepicker' => [
                'type' => 'datepicker'
            ],
            'daterange' => [
                'type' => 'daterange'
            ],
            'daterangetime' => [
                'type' => 'daterangetime'
            ],
            'datetime' => [
                'type' => 'datetime'
            ],
            'email' => [
                'type' => 'email'
            ],
            'file' => [
                'type' => 'file'
            ],
            'file_many' => [
                'type' => 'file_many'
            ],
            'image' => [
                'type' => 'image'
            ],
            'image_many' => [
                'type' => 'image_many'
            ],
            'image_preview' => [
                'type' => 'image_preview'
            ],
            'money' => [
                'type' => 'money'
            ],
            'multiselect2' => [
                'type' => 'multiselect2'
            ],
            'number' => [
                'type' => 'number'
            ],
            'password' => [
                'type' => 'password'
            ],
            'phone' => [
                'type' => 'phone'
            ],
            'select' => [
                'type' => 'select'
            ],
            'select2' => [
                'type' => 'select2'
            ],
            'sound' => [
                'type' => 'sound'
            ],
            'tagging' => [
                'type' => 'tagging'
            ],
            'textarea' => [
                'type' => 'textarea'
            ],
            'texteditor' => [
                'type' => 'texteditor'
            ],
            'time' => [
                'type' => 'time'
            ],
            'video' => [
                'type' => 'video'
            ],
            'created_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        $this->passingPassword = generatePassingData([
            'password' => [
                'type' => 'password',
                'validate' => [
                    'edit' => 'required|confirmed'
                ]
            ],
            'password_confirmation' => [
                'type' => 'password',
                'validate' => [
                    'edit' => 'required'
                ]
            ]
        ]);

        parent::__construct(
            $request, 'general.users', 'user', 'Users', 'user',
            $passingData
        );

        $this->data['listSet'] = [
            'select' => get_list_active_inactive(),
            'select2' => get_list_active_inactive(),
            'tagging' => get_list_active_inactive(),
        ];

    }

    public function password($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data = $this->data;

        $data['viewType'] = 'edit';
        $data['thisLabel'] = __('general.password');
        $data['formsTitle'] = __('general.title_edit', ['field' => $data['thisLabel'].' '.$getData->name]);
        $data['passing'] = collectPassingData($this->passingPassword, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView['password'], $data);
    }

    public function updatePassword($id)
    {
        $this->callPermission();

        $viewType = 'edit';

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $getListCollectData = collectPassingData($this->passingPassword, $viewType);
        $validate = $this->setValidateData($getListCollectData, $viewType, $id);
        if (count($validate) > 0)
        {
            $data = $this->validate($this->request, $validate);
        }
        else {
            $data = [];
            foreach ($getListCollectData as $key => $val) {
                $data[$key] = $this->request->get($key);
            }
        }

        $data = $this->getCollectedData($getListCollectData, $viewType, $data, $getData);

        unset($data['password_confirmation']);

        $getData = $this->crud->update($data, $id);

        $id = $getData->id;

        if($this->request->ajax()){
            return response()->json(['result' => 1, 'message' => __('general.success_edit_', ['field' => $this->data['thisLabel']])]);
        }
        else {
            session()->flash('message', __('general.success_edit_', ['field' => $this->data['thisLabel']]));
            session()->flash('message_alert', 2);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.show', $id);
        }
    }

}
