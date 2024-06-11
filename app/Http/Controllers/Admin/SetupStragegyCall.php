<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use Illuminate\Http\Request;

class SetupStrategyCall extends _CrudController
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
            $request, 'general.setup_strategy_call', 'category', 'Category', 'category',
            $passingData
        );

        $this->listView['index'] = env('ADMIN_TEMPLATE') . '.page.setupStrategy.list';
        // $this->listView['create'] = env('ADMIN_TEMPLATE') . '.page.product.forms';
        // $this->listView['edit'] = env('ADMIN_TEMPLATE') . '.page.product.forms';


    }


}
