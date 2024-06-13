<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
class SettingsController extends _CrudController
{
    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'subscribe-text' => [
                'type' => 'text',
                'lang' => 'Subscribe Text',
            ],
            'subscribe-background' => [
                'type' => 'image',
                'path' => 'uploads/banner-promo',
                'lang' => 'Subscribe Background'
            ],
            'subscribe-image' => [
                'validate' => [
                    'create' => 'required',
                ],
                'type' => 'image',
                'path' => 'uploads/banner-promo',
                'lang' => 'Subscribe Image'
            ],
            'header-logo' => [
                'type' => 'image',
                'path' => 'uploads/banner-promo',
                'lang' => 'Header Logo'
            ],
            'footer-logo' => [
                'type' => 'image',
                'path' => 'uploads/banner-promo',
                'lang' => 'Footer Logo'
            ],
            'privacy-policy-link' => [
                'type' => 'text',
                'lang' => 'Privacy Policy Link'
             ],
            'contact-us-link' => [
                'type' => 'text',
                'lang' => 'Contact Us Link'
            ],
            'copyright' => [
                'type' => 'text',
                'lang' => 'Copyright'
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

        parent::__construct(
            $request, 'general.settings', 'settings', 'Settings', 'settings',
            $passingData
        );
        $this->listView['show'] = env('ADMIN_TEMPLATE').'.page.settings.forms';
        $this->listView['edit'] = env('ADMIN_TEMPLATE').'.page.settings.forms';
    }

    public function index()
    {
        $this->callPermission();

        $data = $this->data;

        $getData = (object)Settings::pluck('value', 'key')->toArray();

        $data['viewType'] = 'show';
        $data['formsTitle'] = __('general.title_show', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($this->passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    public function edit($id)
    {
        $this->callPermission();

        $data = $this->data;

        $getData = (object)Settings::pluck('value', 'key')->toArray();

        $data['viewType'] = 'edit';
        $data['formsTitle'] = __('general.title_edit', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($this->passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    public function update($id)
    {
        $this->callPermission();

        $viewType = 'edit';

        $getListCollectData = collectPassingData($this->passingData, $viewType);
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

        $data = $this->getCollectedData($getListCollectData, $viewType, $data);

        DB::beginTransaction();

        foreach ($data as $key => $val) {
            $getData = Settings::firstOrCreate([
                'key' => $key
            ], [
                'name' => $key
            ]);

            $getData->value = $val;
            $getData->save();
        }

        DB::commit();

        if($this->request->ajax()){
            return response()->json(['result' => 1, 'message' => __('general.success_edit_', ['field' => $this->data['thisLabel']])]);
        }
        else {
            session()->flash('message', __('general.success_edit_', ['field' => $this->data['thisLabel']]));
            session()->flash('message_alert', 2);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }
    }

}
