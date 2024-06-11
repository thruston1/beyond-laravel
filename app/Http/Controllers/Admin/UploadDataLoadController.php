<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Models\TblDataInfoTask;
use Illuminate\Http\Request;
use App\Codes\Models\TblMasterCampaign;

class UploadDataLoadController extends _CrudController
{
    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
                'type' => 'text',
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        parent::__construct(
            $request, 'general.upload_data_load', 'uploadLoad', 'Category', 'category',
            $passingData
        );

        $this->listView['index'] = env('ADMIN_TEMPLATE') . '.page.dataLoad.list';
        // $this->listView['create'] = env('ADMIN_TEMPLATE') . '.page.product.forms';
        // $this->listView['edit'] = env('ADMIN_TEMPLATE') . '.page.product.forms';


    }

    public function index()
    {
        $this->callPermission();
        $tableMaster = new TblMasterCampaign();
        
        // validate user to get table campaign

        $data = $this->data;
        $data['mastercampaign'] = $tableMaster->getMasterCampaign();
        $data['listcampaign'] = $tableMaster->getMasterCampaign();
        $data['passing'] = collectPassingData($this->passingData);

        return view($this->listView['index'], $data);
    }


    public function ajaxData()
	{	    
        if($this->request->get('date')){
            $date = $this->request->get('date');
        }   
        else{
            $date = date('Y-m-d');	
        }
        $campaign= $this->request->get('campaign');
        $type= $this->request->get('type');

        $tblInfo = new TblDataInfoTask();

        $strukturtask = $tblInfo->getStructureTask($type);
        $get_data_info_all = $tblInfo->getDataInfoAll($strukturtask,$date,$campaign);

        dd($get_data_info_all);
        

    }

    public function upload()
    {

    }

    public function uploadProcess()
    {

    }

}
