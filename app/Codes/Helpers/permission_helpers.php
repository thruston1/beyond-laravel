<?php
if ( ! function_exists('generateMenu')) {
    /**
     * @return string
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function generateMenu(): string
    {
        $html = '';
        $adminRole = session()->get('admin_role');
        if ($adminRole) {
            $role = \Illuminate\Support\Facades\Cache::remember('role'.$adminRole, env('SESSION_LIFETIME'), function () use ($adminRole) {
                return \App\Codes\Models\Role::where('id', '=', $adminRole)->first();
            });
            if ($role) {
                $permissionRoute = json_decode($role->permission_route, TRUE);
                $getRoute = \Illuminate\Support\Facades\Route::current()->action['as'];
                foreach (listGetPermission(listAllMenu(), $permissionRoute) as $key => $value) {
                    $active = '';
                    $class = '';
                    foreach ($value['active'] as $getActive) {
                        if (strpos($getRoute, $getActive) === 0) {
                            $active = ' active';
                        }
                    }
                    if (isset($value['inactive'])) {
                        foreach ($value['inactive'] as $getInActive) {
                            if (strpos($getRoute, $getInActive) === 0) {
                                $active = '';
                            }
                        }
                    }

                    if ($value['type'] == 2) {
                        $class .= strlen($active) > 0 ? ' nav-item has-treeview menu-open' : ' nav-item has-treeview';
                        $extraLi = '<i class="right fas fa-angle-left"></i>';
                    }
                    else {
                        $class .= 'nav-item';
                        $extraLi = '';
                    }

                    if(isset($value['route'])) {
                        $route = route($value['route']);
                    }
                    else {
                        $route = '#';
                    }

                    $getIcon = $value['icon'] ?? '';
                    $getAdditional = $value['additional'] ?? '';
                    $html .= '<li class="'.$class.'">
                    <a href="'.$route.'" title="'.$value['name'].'" class="nav-link'.$active.'">
                    '.$getIcon.'
                    <p>'.
                        $value['title'].$extraLi.$getAdditional.'</p></a>';

                    if ($value['type'] == 2) {
                        $html .= '<ul class="nav nav-treeview">';
                        $html .= getMenuChild($value['data'], $getRoute);
                        $html .= '</ul>';
                    }

                    $html .= '</a></li>';
                }
            }
        }
        return $html;
    }
}

if ( ! function_exists('getMenuChild')) {
    /**
     * @param $data
     * @param $getRoute
     * @return string
     */
    function getMenuChild($data, $getRoute): string
    {
        $html = '';

        foreach ($data as $value) {
            $active = '';
            foreach ($value['active'] as $getActive) {
                if (strpos($getRoute, $getActive) === 0) {
                    $active = 'active';
                }
            }
            if (isset($value['inactive'])) {
                foreach ($value['inactive'] as $getInActive) {
                    if (strpos($getRoute, $getInActive) === 0) {
                        $active = '';
                    }
                }
            }

            if(isset($value['route'])) {
                $route = route($value['route']);
            }
            else {
                $route = '#';
            }

            $html .= '<li class="nav-item">
                    <a href="'.$route.'" class=" nav-link '.$active.'" title="'.$value['name'].'">
                    <i class="far fa-dot-circle nav-icon"></i><p>'.
                    $value['title'];
            $html .= '</p></a></li>';
        }

        return $html;
    }
}

if ( ! function_exists('getDetailPermission')) {
    /**
     * @param $module
     * @param false[] $permission
     * @return false[]|mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    function getDetailPermission($module, array $permission = ['create' => false,'edit' => false,'show' => false,'destroy' => false])
    {
        $adminRole = session()->get('admin_role');
        if ($adminRole) {
            $role = \Illuminate\Support\Facades\Cache::remember('role'.$adminRole, env('SESSION_LIFETIME'), function () use ($adminRole) {
                return \App\Codes\Models\Role::where('id', '=', $adminRole)->first();
            });
            if ($role) {
                $permissionData = json_decode($role->permission_data, TRUE);
                if( isset($permissionData[$module])) {
                    foreach ($permissionData[$module] as $key => $value) {
                        $permission[$key] = true;
                    }
                }
            }
        }
        return $permission;
    }
}

if ( ! function_exists('getValidatePermissionMenu')) {
    /**
     * @param $permission
     * @return array
     */
    function getValidatePermissionMenu($permission): array
    {
        $listMenu = [];
        if ($permission) {
            foreach ($permission as $key => $route) {
                if ($key == 'super_admin') {
                    $listMenu['super_admin'] = 1;
                }
                else {
                    if (is_array($route)) {
                        foreach ($route as $key2 => $route2) {
                            $listMenu[$key][$key2] = 1;
                        }
                    }
                }
            }
        }


        return $listMenu;
    }
}

if ( ! function_exists('generateListPermission')) {
    /**
     * @param null $data
     * @return string
     */
    function generateListPermission($data = null): string
    {
        $value = isset($data['super_admin']) ? 'checked' : '';
        $html = '<label for="super_admin">
                    <input '.$value.' style="margin-right: 5px;" type="checkbox" class="checkThis super_admin"
                    data-name="super_admin" name="permission[super_admin]" value="1" id="super_admin"/>
                    Super Admin
                </label><br/><br/>';
        $html .= createTreePermission(listAllMenu(), 0, 'checkThis super_admin', $data);
        return $html;
    }
}

if ( ! function_exists('createTreePermission')) {
    /**
     * @param $data
     * @param int $left
     * @param string $class
     * @param array | null $getData
     * @return string
     */
    function createTreePermission($data, int $left = 0, string $class = '', ?array $getData = array()): string
    {
        $html = '';
        foreach ($data as $index => $list) {
            if ($list['type'] == 2) {
                $html .= '<label>'.$list['name'].'</label><br/>';
                $html .= createTreePermission($list['data'], $left + 1, $class, $getData);
            }
            else {

                $value = isset($getData[$list['key']]) ? 'checked' : '';
                $html .= '<label for="checkbox-'.$index.'-'.$list['key'].'">
                            <input '.$value.' style="margin-left: '.($left*30).'px; margin-right: 5px;" type="checkbox"
                            class="'.$class.' '.$list['key'].'" data-name="'.$list['key'].'" name="permission['.$list['key'].']"
                            value="1" id="checkbox-'.$index.'-'.$list['key'].'"/>
                            '.$list['name'].
                    '</label><br/>';
                $html .= getAttributePermission($list['key'], $index, $left + 1, $class.' '.$list['key'], $getData);
                $html .= '<br/>';
            }
        }
        return $html;
    }
}

if ( ! function_exists('getAttributePermission')) {
    /**
     * @param $module
     * @param $index
     * @param $left
     * @param string $class
     * @param array|null $getData
     * @return string
     */
    function getAttributePermission($module, $index, $left, string $class = '', ?array $getData = array()): string
    {
        $html = '';
        $list = listAvailablePermission();
        if (isset($list[$module])) {
            foreach ($list[$module] as $key => $value) {
                $value = isset($getData[$module][$key]) ? 'checked' : '';
                $html .= '<label for="checkbox-'.$index.'-'.$module.'-'.$key.'">
                            <input '.$value.' style="margin-left: '.($left*30).'px; margin-right: 5px;" type="checkbox"
                            class="'.$class.'" name="permission['.$module.']['.$key.']" value="1"
                            id="checkbox-'.$index.'-'.$module.'-'.$key.'"/>
                            '.$key.
                        '</label><br/>';
            }
        }
        return $html;
    }
}

if ( ! function_exists('getPermissionRouteList')) {
    /**
     * @param $listMenu
     * @return array
     */
    function getPermissionRouteList($listMenu): array
    {
        $listAllowed = [];
        $listPermission = listAvailablePermission();
        foreach ($listPermission as $key => $list) {
            if ($key == 'super_admin')
                continue;
            foreach ($list as $key2 => $listRoute) {
                if (isset($listMenu[$key][$key2])) {
                    foreach ($listRoute as $value) {
                        $listAllowed[] = $value;
                    }
                }
            }
        }
        return $listAllowed;
    }
}

if ( ! function_exists('listGetPermission')) {
    /**
     * @param $listMenu
     * @param $permissionRoute
     * @return array
     */
    function listGetPermission($listMenu, $permissionRoute): array
    {
        $result = [];
        if ($permissionRoute) {
            foreach ($listMenu as $list) {
                if ($list['type'] == 1) {
                    if (in_array($list['route'], $permissionRoute)) {
                        $result[] = $list;
                    }
                }
                else {
                    $getResult = listGetPermission($list['data'], $permissionRoute);
                    if (count($getResult) > 0) {
                        $list['data'] = $getResult;
                        $result[] = $list;
                    }
                }
            }
        }

        return $result;
    }
}

if ( ! function_exists('listAllMenu')) {
    /**
     * @return array[]
     */
    function listAllMenu(): array
    {
        return [
            // [
            //     'name' => __('general.user'),
            //     'icon' => '<i class="nav-icon fas fa-user"></i>',
            //     'title' => __('general.user'),
            //     'active' => ['admin.user.'],
            //     'route' => 'admin.user.index',
            //     'key' => 'user',
            //     'type' => 1
            // ],
            [
                'name' => __('general.config'),
                'icon' => '<i class="nav-icon fas fa-gear"></i>',
                'title' => __('general.config'),
                'active' => [
                    'admin.strategy.',
                ],
                'type' => 2,
                'data' => [
                    [
                        'name' => __('general.setup_strategy_call'),
                        'title' => __('general.setup_strategy_call'),
                        'active' => ['admin.strategy.'],
                        'route' => 'admin.strategy.index',
                        'key' => 'strategy',
                        'type' => 1
                    ],
                ],
            ],
            [
                'name' => __('general.upload_file'),
                'icon' => '<i class="nav-icon fas fa-upload"></i>',
                'title' => __('general.upload_file'),
                'active' => [
                    'admin.uploadLoad.',
                ],
                'type' => 2,
                'data' => [
                    [
                        'name' => __('general.upload_data_load'),
                        'title' => __('general.upload_data_load'),
                        'active' => ['admin.uploadLoad.'],
                        'route' => 'admin.uploadLoad.index',
                        'key' => 'uploadLoad',
                        'type' => 1
                    ],
                ],
            ],
            [
                'name' => __('general.setting'),
                'icon' => '<i class="nav-icon fas fa-gear"></i>',
                'title' => __('general.setting'),
                'active' => [
                    'admin.settings.',
                    'admin.custom-menu.',
                    'admin.admin.',
                    'admin.role.'
                ],
                'type' => 2,
                'data' => [
                    [
                        'name' => __('general.category'),
                        'title' => __('general.category'),
                        'active' => ['admin.category.'],
                        'route' => 'admin.category.index',
                        'key' => 'category',
                        'type' => 1
                    ],
                    [
                        'name' => __('general.admin'),
                        'title' => __('general.admin'),
                        'active' => ['admin.admin.'],
                        'route' => 'admin.admin.index',
                        'key' => 'admin',
                        'type' => 1
                    ],
                    [
                        'name' => __('general.role'),
                        'title' => __('general.role'),
                        'active' => ['admin.role.'],
                        'route' => 'admin.role.index',
                        'key' => 'role',
                        'type' => 1
                    ],
                ],
            ],
        ];
    }
}

if ( ! function_exists('listAvailablePermission'))
{
    /**
     * @return array
     */
    function listAvailablePermission(): array
    {

        $listPermission = [];

        foreach ([
                     'settings', 'page',
                 ] as $keyPermission) {
            $listPermission[$keyPermission] = [
                'list' => [
                    'admin.'.$keyPermission.'.index',
                    'admin.'.$keyPermission.'.dataTable'
                ],
                'edit' => [
                    'admin.'.$keyPermission.'.edit',
                    'admin.'.$keyPermission.'.update'
                ],
                'show' => [
                    'admin.'.$keyPermission.'.show'
                ],
//                'export' => [
//                    'admin.'.$keyPermission.'.export',
//                ]
            ];
        }


        foreach ([
                     'admin', 'role', 'category', 'uploadLoad', 'strategy'
                 ] as $keyPermission) {
            $listPermission[$keyPermission] = [
                'list' => [
                    'admin.'.$keyPermission.'.index',
                    'admin.'.$keyPermission.'.dataTable'
                ],
                'create' => [
                    'admin.'.$keyPermission.'.create',
                    'admin.'.$keyPermission.'.store'
                ],
                'edit' => [
                    'admin.'.$keyPermission.'.edit',
                    'admin.'.$keyPermission.'.update'
                ],
                'show' => [
                    'admin.'.$keyPermission.'.show'
                ],
                'destroy' => [
                    'admin.'.$keyPermission.'.destroy'
                ],
                // 'export' => [
                //     'admin.'.$keyPermission.'.export',
                // ],
            ];
        }

        $listPermission['user']['edit'][] = 'admin.user.password';
        $listPermission['user']['edit'][] = 'admin.user.updatePassword';
        $listPermission['admin']['edit'][] = 'admin.admin.password';
        $listPermission['admin']['edit'][] = 'admin.admin.updatePassword';

        
        $listPermission['uploadLoad']['list'][] = 'admin.uploadLoad.ajaxData';

        return $listPermission;

    }
}
