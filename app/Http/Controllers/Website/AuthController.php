<?php

namespace App\Http\Controllers\Website;

use App\Codes\Models\Settings;
use App\Codes\Models\UserAgent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class AuthController extends _BaseController
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

    public function Login()
    {
        $data = $this->data;
        
        return view('website.page.login', $data);
    }
    public function doLogin(){
        $this->validate($this->request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $userName = $this->request->get('username');
        $password = $this->request->get('password');
        $agent = UserAgent::where('user_name', '=', $userName)->first();
        
        if ($agent) {
            $validate = app('hash')->check($password, $agent->password);
            if(!$validate) {
                return redirect()->back()->withInput()->withErrors(
                    [
                        'error_login' => __('general.error_login')
                    ]
                );
            }
            
            session()->flush();
            session()->put('agent_id', $agent->id);
            session()->put('agent_name', $agent->full_name);
            try {
                session_start();    
            }
            catch (\Exception $e) {
            }

            return redirect()->route('callCenter.index');
        }
        else{
            return redirect()->back()->withInput()->withErrors(
                [
                    'error_login' => __('general.error_login')
                ]
            );
        }
    }

    public function logout()
    {
        session()->flush();

        return redirect()->route('web.login');
    }

}
