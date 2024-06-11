<?php

namespace App\Codes\Logic;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yajra\DataTables\DataTables;

class _CrudController extends _GlobalFunctionController
{
    protected $request;
    protected $route;
    protected $model;
    protected $listView;
    protected $masterId;
    protected $crud;
    protected $rootRoute;

    /**
     * _CrudController constructor.
     * @param Request $request
     * @param $title
     * @param $route
     * @param $model
     * @param $module
     * @param $passing
     * @param string $masterId
     * @param string $envTemplate
     * @param string $rootRoute
     */
    public function __construct(Request $request, $title, $route, $model, $module, $passing, string $masterId = 'id',
                                string  $envTemplate = 'ADMIN_TEMPLATE', string $rootRoute = 'admin')
    {
        $this->request = $request;
        $this->crud = new _CRUD($model);

        $this->passingData = generatePassingData($passing);

        $this->masterId = $masterId;
        $this->route = $route;
        $this->model = 'App\Codes\Models\\' . $model;
        $this->module = $module;
        $this->rootRoute = $rootRoute;

        $this->listView = [
            'index' => env($envTemplate).'._general.list',
            'dataTable' => env($envTemplate).'._general.list_button',
            'create' => env($envTemplate).'._general.forms',
            'show' => env($envTemplate).'._general.forms',
            'edit' => env($envTemplate).'._general.forms',
        ];

        $this->data = [
            'thisLabel' => __($title),
            'thisRoute' => $this->route,
            'masterId' => $this->masterId,
            'permission' => $this->permission,
            'listSet' => []
        ];
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Contracts\Foundation\Application
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function index()
    {
        $this->callPermission();

        // if (isset($this->permission['export']) && $this->request->get('export')) {
        //     $this->exportData();
        // }

        $data = $this->data;

        $data['passing'] = collectPassingData($this->passingData);

        return view($this->listView['index'], $data);
    }

    /**
     * @return mixed
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function dataTable()
    {
        $this->callPermission();

        $dataTables = new DataTables();

        $builder = $this->model::query()->select('*');

        return $this->processDataTable($dataTables, $builder);
    }

    /**
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function create()
    {
        $this->callPermission();

        $data = $this->data;

        $data['viewType'] = 'create';
        $data['formsTitle'] = __('general.title_create', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($this->passingData, $data['viewType']);

        return view($this->listView[$data['viewType']], $data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function edit($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data = $this->data;

        $data['viewType'] = 'edit';
        $data['formsTitle'] = __('general.title_edit', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($this->passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function show($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $data = $this->data;

        $data['viewType'] = 'show';
        $data['formsTitle'] = __('general.title_show', ['field' => $data['thisLabel']]);
        $data['passing'] = collectPassingData($this->passingData, $data['viewType']);
        $data['data'] = $getData;

        return view($this->listView[$data['viewType']], $data);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function destroy($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
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
            return response()->json(['result' => 1, 'message' => __('general.success_delete_', ['field' => $this->data['thisLabel']])]);
        }
        else {
            session()->flash('message', __('general.success_delete_', ['field' => $this->data['thisLabel']]));
            session()->flash('message_alert', 2);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function store()
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
        $getData = $this->crud->store($data);

        $id = $getData->id;

        if($this->request->ajax()){
            return response()->json(['result' => 1, 'message' => __('general.success_add_', ['field' => $this->data['thisLabel']])]);
        }
        else {
            session()->flash('message', __('general.success_add_', ['field' => $this->data['thisLabel']]));
            session()->flash('message_alert', 2);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.show', $id);
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse|\Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     */
    public function update($id)
    {
        $this->callPermission();

        $viewType = 'edit';

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
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

        $getData = $this->crud->update($data, $id);

        $id = $getData->id;

        if($this->request->ajax()){
            return response()->json(['result' => 1, 'message' => __('general.success_edit_', ['field' => $this->data['thisLabel']])]);
        }
        else {
            session()->flash('message', __('general.success_edit_', ['field' => $this->data['thisLabel']]));
            session()->flash('message_alert', 2);
            return redirect()->route($this->rootRoute.'.' . $this->route . '.show', $id);
        }
    }

    protected function processDataTable($dataTables, $builder)
    {
        $dataTables = $dataTables->eloquent($builder)
            ->addColumn('action', function ($query) {
                return view($this->listView['dataTable'], [
                    'query' => $query,
                    'thisRoute' => $this->route,
                    'permission' => $this->permission,
                    'masterId' => $this->masterId
                ]);
            });

        $listRaw = [];
        $listRaw[] = 'action';
        foreach (collectPassingData($this->passingData) as $fieldName => $list) {
            if (in_array($list['type'], ['select', 'select2', 'select_category'])) {
                $dataTables = $dataTables->editColumn($fieldName, function ($query) use ($fieldName) {
                    $getList = $this->data['listSet'][$fieldName] ?? [];
                    return $getList[$query->$fieldName] ?? $query->$fieldName;
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
                            $setImage = asset('uploads/'.$query->$fieldName);
                        }
                    }
                    else {
                        $setImage = asset('assets/cms/image/no-img.png');
                    }
                    return '<a href="'.$setImage.'" target="_blank" title="'.$query->$fieldName.'"  rel="lightbox">
                            <img src="' . $setImage . '" class="img-responsive max-image-preview"/>
                            </a>';
                });
            }
            else if ($list['type'] == 'checkbox') {
                $listRaw[] = $fieldName;
                $dataTables = $dataTables->editColumn($fieldName, function ($query) use ($fieldName, $list, $listRaw) {
                    return $query->$fieldName == 1 ? __('general.checked') : __('general.unchecked');
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

    // protected function exportData()
    // {
    //     $builder = $this->model::query();

    //     $builder = $builder->get();

    //     $fileName = create_slugs($this->data['thisLabel'].'_'.strtotime('now'));
    //     $spreadsheet = new Spreadsheet();
    //     $spreadsheet->getProperties()->setCreator('SYSTEM')->setLastModifiedBy('SYSTEM');

    //     $sheet = $spreadsheet->getActiveSheet();
    //     $row = 1;
    //     $column = 1;

    //     $headers = collectPassingData($this->passingData, 'export');

    //     foreach ($headers as $key => $value) {
    //         $sheet->setCellValueByColumnAndRow($column++, $row, __($value['lang']));
    //     }

    //     foreach ($builder as $list) {
    //         $row += 1;
    //         $column = 1;

    //         foreach ($headers as $key => $value) {
    //             switch ($value['type']) {
    //                 case 'select':
    //                 case 'select2':
    //                     $getList = $this->data['listSet'][$key] ?? [];
    //                     $getValue = $getList[$list->$key] ?? $list->$key;
    //                     break;
    //                 default:
    //                     $getValue = $list->$value;
    //                     break;
    //             }

    //             $sheet->setCellValueByColumnAndRow($column++, $row, $getValue);

    //         }
    //     }

    //     header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    //     header('Content-Disposition: attachment;filename="'.$fileName.'.xlsx"');
    //     header('Cache-Control: max-age=0');
    //     header('Cache-Control: max-age=1');

    //     header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
    //     header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
    //     header('Cache-Control: cache, must-revalidate');
    //     header('Pragma: public');

    //     $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
    //     $writer->save('php://output');
    //     exit;
    // }

}
