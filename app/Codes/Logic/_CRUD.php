<?php

namespace App\Codes\Logic;

use Illuminate\Support\Facades\Storage;

class _CRUD
{
    protected $model;

    /**
     * @param $model
     */
    public function __construct($model)
    {
        $this->model = 'App\Codes\Models\\' . $model;
    }

    /**
     * @return mixed
     */
    public function all()
    {
        return $this->model::get();
    }

    /**
     * @param $data
     * @return mixed
     */
    public function store($data)
    {
        $saveData = new $this->model();
        foreach ($data as $key => $value) {
            $saveData->$key = $value;
        }
        $saveData->save();

        return $saveData;
    }

    /**
     * @param $id
     * @param string $key
     * @param array $condition
     * @return mixed
     */
    public function show($id, string $key = 'id', array $condition = [])
    {
        $model = $this->model::where($key, $id);
        if ($condition) {
            foreach ($condition as $keyCondition => $valCondition) {
                if (is_array($valCondition)) {
                    $model = $model->whereIn($keyCondition, $valCondition);
                }
                else {
                    $model = $model->where($keyCondition, '=', $valCondition);
                }
            }
        }
        return $model->first();
    }

    /**
     * @param $data
     * @param $id
     * @param string $key
     * @return mixed
     */
    public function update($data, $id, string $key = 'id')
    {
        $saveData = $this->model::where($key, $id)->first();
        foreach ($data as $key => $value) {
            $saveData->$key = $value;
        }
        $saveData->save();

        return $saveData;
    }

    /**
     * @param $id
     * @param string $key
     * @return void
     */
    public function destroy($id, string $key = 'id')
    {
        $getData = $this->model::where($key, $id)->first();
        $getData->delete();
    }

    /**
     * @param $listImage
     * @param $request
     * @param $destinationPath
     * @return array
     */
    public function saveImageFile($listImage, $request, $destinationPath): array
    {
        $data = [];

        foreach ($listImage as $imageKey => $list) {

            try {
                $image = $request->file($imageKey);
                if ($image && $image->getError() == 1) {
                    if ($list === true) {
                        if ($image->getSize() <= 0) {
                            $message = __('general.error_max_file_', ['bytes' => '25M', 'files' => 'Image']);
                        } else {
                            $message = __('general.error_upload_file_', ['files' => 'Image']);
                        }
                        return [
                            'success' => 0,
                            'message' => [
                                $imageKey => $message
                            ]
                        ];
                    }
                }
                if ($image) {
                    $getFileName = $image->getClientOriginalName();
                    $ext = explode('.', $getFileName);
                    $ext = end($ext);
                    $setFileName = md5($imageKey . strtotime('now') . rand(0, 100)) . '.' . $ext;

                    $destinationPath = str_ends_with($destinationPath, '/') ? substr($destinationPath, 0, strlen($destinationPath)-1) : $destinationPath;
                    $setFileName = Storage::putFile($destinationPath, $image);
//                    $image->move($destinationPath, $setFileName);
                    $data[$imageKey] = $setFileName;

                }
            }
            catch (\Exception $e) {
                return [
                    'success' => 0,
                    'message' => [
                        $imageKey => 'Error'
                    ]
                ];
            }

        }

        return [
            'success' => 1,
            'data' => $data
        ];

    }

    /**
     * @param $listImage
     * @param $request
     * @param $destinationPath
     * @return array
     */
    public function saveImageBase64($listImage, $request, $destinationPath): array
    {
        $data = [];

        foreach ($listImage as $imageKey => $list) {
            try {
                $image = base64_to_jpeg($request->get($imageKey));
                $setFileName = md5($imageKey.strtotime('now').rand(0, 100)).'.jpg';
                file_put_contents($destinationPath.$setFileName, $image);
                $data[$imageKey] = $setFileName;
            }
            catch (\Exception $e) {
                return [
                    'success' => 0,
                    'message' => [
                        $imageKey => 'Error'
                    ]
                ];
            }
        }

        return [
            'success' => 1,
            'data' => $data
        ];

    }

}
