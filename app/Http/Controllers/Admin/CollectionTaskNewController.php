<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class DataInfoTaskController extends _CrudController
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
