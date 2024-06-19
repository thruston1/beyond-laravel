<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Models\masterCampaign;
use App\Codes\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class UserAgentController extends _CrudController
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
            'user_name' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
            ],
            'full_name' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
             'campaign_id' => [
                'type' => 'select2',
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
            $request, 'general.user_agent', 'userAgent', 'UserAgent', 'userAgent',
            $passingData
        );

        $this->data['listSet'] = [
            'status' => get_list_active_inactive(),
            'campaign_id' => masterCampaign::pluck('name', 'id')->toArray(),
        ];

        // $this->listView['dataTable'] = env('ADMIN_TEMPLATE').'.page.admin.list_button';
        $this->listView['password'] = env('ADMIN_TEMPLATE').'.page.admin.password';

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
