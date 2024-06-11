<?php

namespace App\Http\Controllers\Website;

use App\Codes\Models\Settings;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class WebController extends _BaseController
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
        $data = $this->data;

        return view('website.page.landing', $data);
    }

}
