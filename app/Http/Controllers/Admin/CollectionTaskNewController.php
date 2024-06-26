<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Models\DataInfoTask;
use App\Codes\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class CollectionTaskNewController extends _CrudController
{

    public function __construct(Request $request)
    {
        $passingData = [
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

        parent::__construct(
            $request, 'general.collection_task_new', 'collectionTask', 'CollectionTaskNew', 'collectionTask',
            $passingData
        );

        $this->data['listSet'] = [
            // 'data_info_id' => DataInfoTask::pluck('agreement_no', 'id')->toArray(),
            'status' => get_list_collection()
        ];



    }

    public function dataTable()
    {
        $this->callPermission();

        $dataTables = new DataTables();

        $builder = $this->model::query()->select('*');
        $status= $this->request->get('status');
        if($status){
            $builder = $builder->where('status', '=', $status);
        }

        return $this->processDataTable($dataTables, $builder);
    }



}
