<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Logic\LogicSql;
use App\Codes\Logic\CallLogic;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class StrategyLoadController extends _CrudController
{
    protected $passingDataInfo;
    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'unique_id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'agreement_no' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'task_new_id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'agent_id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'status' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'action' => [
                'list' => 0,
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        $this->passingDataInfo = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'unique_id'=> [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'agreement_no'=> [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'data_info_id'=> [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'campaign'=> [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'status'=> [
                'type' => 'select',
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'created_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        $this->passingDataInfo = generatePassingData($this->passingDataInfo);

        parent::__construct(
            $request, 'general.strategy_load', 'strategyLoad', 'StrategyCallnew', 'strategyLoad',
            $passingData
        );

        $this->data['listSet'] = [
            
            // 'select' => get_list_active_inactive(),
        ];


        $this->listView['index'] = env('ADMIN_TEMPLATE') . '.page.strategyLoad.list';

    }

    public function index()
    {   
        $logicSql = new LogicSql();
        $this->callPermission();

        // if (isset($this->permission['export']) && $this->request->get('export')) {
        //     $this->exportData();
        // }

        $data = $this->data;

        $data['passing'] = collectPassingData($this->passingData);
        $data['passingDataInfo'] = collectPassingData($this->passingDataInfo);
        $data['mastercampaign'] = $logicSql->getMasterCampaign();

        return view($this->listView['index'], $data);
    }

    public function dataTable()
    {
        $this->callPermission();

        $dataTables = new DataTables();
        
        $builder = $this->model::query()->select('*');
       
        $campaign= $this->request->get('campaign');
        if($campaign){
            $builder = $builder->where('campaign', '=', $campaign);
        }

        return $this->processDataTable($dataTables, $builder);
    }

    public function submitBucket()
    {   
        $campaign= $this->request->get('campaign');
        $callLogic = new CallLogic();
        $getResult = $callLogic->bucketData($campaign);
        
        return $getResult;
    }


}
