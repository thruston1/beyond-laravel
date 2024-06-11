<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\AccessLogin;
use App\Codes\Models\Role;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AccessAdminController extends Controller
{
    protected $request;
    protected $accessLogin;
    protected $data = [];

    /**
     * @param Request $request
     * @param AccessLogin $accessLogin
     */
    public function __construct(Request $request, AccessLogin $accessLogin)
    {
        $this->request = $request;
        $this->accessLogin = $accessLogin;
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function getLogin()
    {
        $data = $this->data;

        return view(env('ADMIN_TEMPLATE').'.page.login', $data);
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function postLogin()
    {
        $this->validate($this->request, [
            'username' => 'required',
            'password' => 'required'
        ]);

        $user = $this->accessLogin->cekLogin($this->request->get('username'),
            $this->request->get('password'), 'Admin', 'username', 'password', ['status'=>80]);
        if ($user) {
            $getRole = Role::where('id', $user->role_id)->first();
            $getPermissionData = isset($getRole) ? json_decode($getRole->permission_data, TRUE) : null;

            session()->flush();
            session()->put('admin_id', $user->id);
            session()->put('admin_name', $user->name);
            session()->put('admin_role', $user->role_id);
            session()->put('admin_super_admin', isset($getPermissionData['super_admin']) ? 1 : 0);
            try {
                session_start();
                $_SESSION['set_login_ck_editor'] = 1;
            }
            catch (\Exception $e) {

            }

            return redirect()->route('admin');
        }
        else {
            return redirect()->back()->withInput()->withErrors(
                [
                    'error_login' => __('general.error_login')
                ]
            );
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function doLogout()
    {
        try {
            session_start();
            unset($_SESSION['set_login_ck_editor']);
            session_destroy();
        }
        catch (\Exception $e) {

        }
        session()->flush();

        return redirect()->route('admin.login');
    }

}
