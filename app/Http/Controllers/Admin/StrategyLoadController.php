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
            'campaign'=> [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'client_code'=> [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'customer_name'=> [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'gender'=> [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'no_telp_1'=> [
                'type' => 'number',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'no_telp_2'=> [
                'type' => 'number',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'no_telp_3'=> [
                'type' => 'number',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'agreement_no'=> [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
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
            'select' => get_list_active_inactive(),
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
