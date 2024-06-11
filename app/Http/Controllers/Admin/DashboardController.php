<?php

namespace App\Http\Controllers\Admin;


use App\Codes\Models\FromContactUs;
use App\Codes\Models\ListSubscribe;
use App\Codes\Models\Product;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $data;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->data = [
            'thisLabel' => 'Dashboard',
            'thisRoute' => 'dashboard',
        ];
    }

    public function dashboard()
    {
        $data = $this->data;

        // $data['unreadContact'] = FromContactUs::where('status', '=', 1)->count();
        // $data['listSubscribe'] = ListSubscribe::count();
        // $data['totalProduct'] = Product::where('status', '=', 80)->count();

        return view(env('ADMIN_TEMPLATE').'.page.dashboard', $data);
    }

}
