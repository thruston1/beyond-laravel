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

        parent::__construct(
            $request, 'general.data_info_task', 'dataInfoTask', 'DataInfoTask', 'dataInfoTask',
            $passingData
        );



    }

    // public function dataTable()
    // {
    //     $this->callPermission();

    //     $dataTables = new DataTables();

    //     $builder = $this->model::query()->select('*');
    //     $status= $this->request->get('status');
    //     if($status){
    //         $builder = $builder->where('status', '=', $status);
    //     }

    //     return $this->processDataTable($dataTables, $builder);
    // }



}
