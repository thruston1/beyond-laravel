<?php

namespace App\Http\Controllers\Website;

use App\Codes\Logic\WebCallLogic;
use App\Codes\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class CallCenterController extends _BaseController
{
    protected $request;
    protected $data;

    public function __construct(Request $request)
    {
        $this->request = $request;

        $settings = Cache::remember('settings', env('SESSION_LIFETIME'), function () {
            return Settings::pluck('value', 'key')->toArray();
        });

        $this->data = [
            'settings' => $settings
        ];
    }

    public function index()
    {   

        $this->request->attributes->get('_account');
        $data = $this->data;
        $data = [
            'content' => 'doAction',
            // 'perform' => $perform,
            // 'totalPerform' => $totalPerform,
        ];

        return view('website.page.callCenter.index', $data);
    }

    public function callCenter()
    {   
        $agent =  $this->request->attributes->get('_agent');
        $agentid = $agent->id;

        $webLogic = new WebCallLogic($agentid, $agent);
        // get data bucket
        $getDataBucket = $webLogic->getDataCall();

        $data = $this->data;

        if($getDataBucket['success'] == 1){
            $data['data'] = true;
            $data['telp'] = $getDataBucket['telp'];
            $data['dataValidation'] = $getDataBucket['data'];
            $data['customer'] = $getDataBucket['customer'];
        }
        else{
            $data['data'] = false;
        }
        
 
        return view('website.page.callCenter.callScreen', $data);
    }

}
