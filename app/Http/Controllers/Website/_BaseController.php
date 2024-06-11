<?php

namespace App\Http\Controllers\Website;

use App\Http\Controllers\Controller;

class _BaseController extends Controller
{
    protected $user;

    public function responseData($request, $params)
    {
        if ($request->ajax()) {
            return response()->json([
                'success' => $params['success'],
                'message' => $params['message']
            ], $params['code'] ?? 200);
        }
        else {
            if ($params['success'] == 1) {
                session()->flash('message_alert', 2);
            }
            else {
                session()->flash('message_alert', 1);
            }
            if (is_array($params['message'])) {
                session()->flash('message', $params['message'][0]);
            }
            else {
                session()->flash('message', $params['message']);
            }
            if (isset($params['redirect'])) {
                return redirect()->route($params['redirect'], $params['redirect_slugs'] ?? []);
            }
            else if (redirect()->back()->getTargetUrl() == url()->current()) {
                return redirect()->route('web.home');
            }
            else {
                return redirect()->back();
            }
        }
    }
}
