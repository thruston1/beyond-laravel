<?php

namespace App\Codes\Logic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class _CrudParentController extends _GlobalFunctionController
{
    protected $request;
    protected $route;
    protected $model;
    protected $listView;
    protected $masterId;
    protected $crud;
    protected $rootRoute;
    protected $parentModel;
    protected $parentRoute;
    protected $parentId;
    protected $parentKeyId;

    /**
     * @param Request $request
     * @param $title
     * @param $route
     * @param $model
     * @param $module
     * @param $parent
     * @param $passing
     * @param string $masterId
     * @param string $envTemplate
     * @param string $rootRoute
     */
    public function __construct(Request $request, $title, $route, $model, $module, $parent, $passing,
                                string $masterId = 'id', string  $envTemplate = 'ADMIN_TEMPLATE',
                                string $rootRoute = 'admin')
    {
        $this->request = $request;
        $this->crud = new _CRUD($model);
        $this->parentModel = 'App\Codes\Models\\' . $parent['parentModel'];
        $this->parentKeyId = $parent['parentKeyId'];
        $this->parentId = $parent['parentId'];
        $this->parentRoute = $parent['parentRoute'];

        $this->passingData = generatePassingData($passing);

        $this->masterId = $masterId;
        $this->route = $route;
        $this->model = 'App\Codes\Models\\' . $model;
        $this->module = $module;
        $this->rootRoute = $rootRoute;

        $this->listView = [
            'index' => env($envTemplate).'._general_parent.list',
            'dataTable' => env($envTemplate).'._general_parent.list_button',
            'create' => env($envTemplate).'._general_parent.forms',
            'show' => env($envTemplate).'._general_parent.forms',
            'edit' => env($envTemplate).'._general_parent.forms'
        ];

        $this->data = [
            'thisLabel' => __($title),
            'thisRoute' => $this->route,
            'thisParentRoute' => $this->parentRoute,
            'masterId' => $this->masterId,
            'permission' => $this->permission,
            'listSet' => []
        ];
    }

    /**
     * @param $parentId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index($parentId)
    {
        $this->callPermission();

        $data = $this->data;

        $data['parent'] = $this->parentModel::where($this->parentKeyId, '=', $parentId)->first();
        $data['parentId'] = $parentId;
        $data['passing'] = collectPassingData($this->passingData);

        return view($this->listView['index'], $data);
    }

    /**
     * @param $parentId
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function dataTable($parentId): mixed
    {
        $this->callPermission();

        $dataTables = new DataTables();

        $builder = $this->model::query()->where($this->parentId, '=', $parentId);

        $dataTables = $dataTables->eloquent($builder)
            ->addColumn('action', function ($query) use ($parentId) {
                return view($this->listView['dataTable'], [
                    'query' => $query,
                    'thisRoute' => $this->route,
                    'permission' => $this->permission,
                    'masterId' => $this->masterId,
                    'parentId' => $parentId
                ]);
            });

        $listRaw = [];
        $listRaw[] = 'action';
        foreach (collectPassingData($this->passingData) as $fieldName => $list) {
            if (in_array($list['type'], ['select', 'select2'])) {
                $dataTables = $dataTables->editColumn($fieldName, function ($query) use ($fieldName) {
                    $getList = isset($this->data['listSet'][$fieldName]) ? $this->data['listSet'][$fieldName] : [];
                    return isset($getList[$query->$fieldName]) ? $getList[$query->$fieldName] : $query->$fieldName;
                });
            }
            else if (in_array($list['type'], ['image', 'image_preview'])) {
                $listRaw[] = $fieldName;
                $dataTables = $dataTables->editColumn($fieldName, function ($query) use ($fieldName, $list, $listRaw) {
                    if (isset($query->{$fieldName . '_full'})) {
                        $setImage = $query->{$fieldName . '_full'};
                    }
                    else if(strlen($query->$fieldName) > 0) {
                        if (str_starts_with($query->$fieldName, "http")) {
                            $setImage = $query->$fieldName;
                        }
                        else {
                            $setImage = asset($list['path'] . $query->$fieldName);
                        }
                    }
                    else {
                        $setImage = asset('assets/cms/image/no-img.png');
                    }
                    return '<img src="' . $setImage . '" class="img-responsive max-image-preview"/>';
                });
            }
            else if ($list['type'] == 'code') {
                $listRaw[] = $fieldName;
                $dataTables = $dataTables->editColumn($fieldName, function ($query) use ($fieldName, $list, $listRaw) {
                    return '<pre>' . json_encode(json_decode($query->$fieldName, true), JSON_PRETTY_PRINT) . '</pre>';
                });
            }
            else if ($list['type'] == 'texteditor') {
                $listRaw[] = $fieldName;
            }
        }

        return $dataTables
            ->rawColumns($listRaw)
            ->make(true);
    }

    /**
     * @param $parentId
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function create($parentId)
    {
        $this->callPermission();

        $data = $this->data;

        $data['parent'] = $this->parentModel::where($this->parentKeyId, '=', $parentId)->first();
        $data['parentId'] = $parentId;
        $data['viewType'] = 'create';
        $data['formsTitle'] = __('general.title_create', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($this->passingData, $data['viewType']);

        return view($this->listView[$data['viewType']], $data);
    }

    /**
     * @param $parentId
     * @param $id
     * @return \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function edit($parentId, $id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route('admin.' . $this->route . '.index', $parentId);
        }

        $data = $this->data;

        $data['parent'] = $this->parentModel::where($this->parentKeyId, '=', $parentId)->first();
        $data['parentId'] = $parentId;
        $data['viewType'] = 'edit';
        $data['formsTitle'] = __('general.title_edit', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($this->passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    /**
     * @param $parentId
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function show($parentId, $id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route('admin.' . $this->route . '.index', $parentId);
        }

        $data = $this->data;

        $data['parent'] = $this->parentModel::where($this->parentKeyId, '=', $parentId)->first();
        $data['parentId'] = $parentId;
        $data['viewType'] = 'show';
        $data['formsTitle'] = __('general.title_show', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($this->passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    /**
     * @param $parentId
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function destroy($parentId, $id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route('admin.' . $this->route . '.index', $parentId);
        }

        foreach ($this->passingData as $fieldName => $fieldValue) {
            if (in_array($fieldValue['type'], ['image', 'video', 'file'])) {
                $destinationPath = $fieldValue['path'];
                if (strlen($getData->$fieldName) > 0) {
                    try {
//                        unlink($destinationPath.$getData->$fieldName);
                        Storage::delete($getData->$fieldName);
                    }
                    catch (\Exception $e) { }
                }
            }
        }

        $this->crud->destroy($id);

        if($this->request->ajax()){
            return response()->json(['result' => 1]);
        }
        else {
            session()->flash('message', __('general.success_delete'));
            session()->flash('message_alert', 2);
            return redirect()->route('admin.' . $this->route . '.index', $parentId);
        }
    }

    /**
     * @param $parentId
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function store($parentId)
    {
        $this->callPermission();

        $viewType = 'create';

        $getListCollectData = collectPassingData($this->passingData, $viewType);
        $validate = $this->setValidateData($getListCollectData, $viewType);
        if (count($validate) > 0)
        {
            $data = $this->validate($this->request, $validate);
        }
        else {
            $data = [];
            foreach ($getListCollectData as $key => $val) {
                $data[$key] = $this->request->get($key);
            }
        }

        $data = $this->getCollectedData($getListCollectData, $viewType, $data);

        $data[$this->parentId] = $parentId;

        $getData = $this->crud->store($data);

        $id = $getData->id;

        if($this->request->ajax()){
            return response()->json(['result' => 1, 'message' => __('general.success_add')]);
        }
        else {
            session()->flash('message', __('general.success_add'));
            session()->flash('message_alert', 2);
            return redirect()->route('admin.' . $this->route . '.show', ['parent_id' => $parentId, 'id' => $id]);
        }
    }

    /**
     * @param $parentId
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function update($parentId, $id)
    {
        $this->callPermission();

        $viewType = 'edit';

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route('admin.' . $this->route . '.index', $parentId);
        }

        $getListCollectData = collectPassingData($this->passingData, $viewType);
        $validate = $this->setValidateData($getListCollectData, $viewType, $id);
        if (count($validate) > 0)
        {
            $data = $this->validate($this->request, $validate);
        }
        else {
            $data = [];
            foreach ($getListCollectData as $key => $val) {
                $data[$key] = $this->request->get($key);
            }
        }

        $data = $this->getCollectedData($getListCollectData, $viewType, $data, $getData);

        foreach ($getListCollectData as $key => $val) {
            if($val['type'] == 'image_many') {
                $getStorage = [];
                if ($this->request->get($key.'_storage')) {
                    $getStorage = explode(',', $this->request->get($key.'_storage')) ?? [];
                }
                $getOldData = json_decode($getData->$key, true);
                $tempData = [];
                if ($getOldData) {
                    foreach ($getOldData as $index => $value) {
                        if (in_array($index, $getStorage)) {
                            $tempData[] = $value;
                        }
                    }
                }

                if (isset($data[$key])) {
                    foreach (json_decode($data[$key], true) as $index => $value) {
                        $tempData[] = $value;
                    }
                }
                $data[$key] = json_encode($tempData);
            }
        }

        $getData = $this->crud->update($data, $id);

        $id = $getData->id;

        if($this->request->ajax()){
            return response()->json(['result' => 1, 'message' => __('general.success_edit')]);
        }
        else {
            session()->flash('message', __('general.success_edit'));
            session()->flash('message_alert', 2);
            return redirect()->route('admin.' . $this->route . '.show', ['parent_id' => $parentId, 'id' => $id]);
        }
    }

}
