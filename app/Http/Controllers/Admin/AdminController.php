<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminController extends _CrudController
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
            'role_id' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
                'type' => 'select',
                'lang' => 'general.role'
            ],
            'image' => [
                'validate' => [
                    'create' => 'required',
                ],
                'type' => 'image',
                'path' => 'uploads/admin',
            ],
            'name' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
            ],
            'username' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'password' => [
                'validate' => [
                    'create' => 'required',
                ],
                'list' => 0,
                'show' => 0,
                'type' => 'password'
            ],
            'status' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
                'type' => 'select'
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
            $request, 'general.admin', 'admin', 'Admin', 'admin',
            $passingData
        );

        $this->data['listSet'] = [
            'role_id' => Role::pluck('name', 'id')->toArray(),
            'status' => get_list_active_inactive()
        ];

        $this->listView['dataTable'] = env('ADMIN_TEMPLATE').'.page.admin.list_button';
        $this->listView['password'] = env('ADMIN_TEMPLATE').'.page.admin.password';

    }

    public function destroy($id)
    {
        $this->callPermission();

        if (session()->get('admin_id') == $id) {
            session()->flash('message', __('general.error_cannot_own_account'));
            session()->flash('message_alert', 1);
            return redirect()->route('admin.' . $this->route . '.index');
        }
        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route('admin.' . $this->route . '.index');
        }

        foreach ($this->passingData as $fieldName => $fieldValue) {
            if (in_array($fieldValue['type'], ['image', 'video', 'file'])) {
                $destinationPath = $fieldValue['path'];
                if (strlen($getData->$fieldName) > 0 && is_file($destinationPath.$getData->$fieldName)) {
//                    unlink($destinationPath.$getData->$fieldName);
                    Storage::delete($destinationPath.$getData->$imageKey);
                }
            }
        }

        $this->crud->destroy($id);

        if($this->request->ajax()){
            return response()->json(['result' => 1, 'message' => __('general.success_delete_', ['field' => $this->data['thisLabel']])]);
        }
        else {
            session()->flash('message', __('general.success_delete_', ['field' => $this->data['thisLabel']]));
            session()->flash('message_alert', 2);
            return redirect()->route('admin.' . $this->route . '.index');
        }
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
