<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use Illuminate\Http\Request;

class StrategyLoadController extends _CrudController
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
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];


        parent::__construct(
            $request, 'general.strategy_load', 'strategyLoad', 'Users', 'strategyLoad',
            $passingData
        );

        $this->data['listSet'] = [
            'select' => get_list_active_inactive(),
        ];

    }


}
