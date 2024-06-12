<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class MasterCampaignController extends _CrudController
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
            'campaignName' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'campaignDescription' => [
                'type' => 'textarea',
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'typeTask' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
             'queueName' => [
                'validate' => [
                    // 'create' => 'required',
                    // 'edit' => 'required'
                ],
             ],
             'campaignState' => [
                'type' => 'select',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
             'campaignState' => [
                'type' => 'select',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
        ];

        parent::__construct(
            $request, 'general.master_campaign', 'masterCampaign', 'masterCampaign', 'masterCampaign',
            $passingData
        );
        $this->data['listSet'] = [
            'campaignState' => get_list_boolean(),
            'campaignState' => get_list_boolean()
        ];

    }

}
