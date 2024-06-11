<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Models\Category;
use App\Codes\Models\Product;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use Yajra\DataTables\DataTables;

class ProductController extends _CrudController
{
    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'category_id' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
                'type' => 'select_category',
                'lang' => 'Category'
            ],
            'name' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
                'type' => 'text_name',
            ],
            'price' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
                'extra' => [
                    'create' => [
                        'onkeyup' => 'changePrice(this)',
                    ],
                    'edit' => [
                        'onkeyup' => 'changePrice(this)',
                    ]
                ],
                'type' => 'number_3',
            ],
            'price_sale' => [
                'validate' => [
                    // 'create' => 'required',
                    // 'edit' => 'required'
                ],
                'extra' => [
                    'create' => [
                        'readonly' => true,
                        // 'id' => 'price-sale',
                    ],
                    'create' => [
                        'readonly' => true,
                        // 'id' => 'price-sale',
                    ],
                ],
                'type' => 'number_3',
                'lang' => 'Price Sale',
            ],
            'qty' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
                'type' => 'number_3',
                'lang' => 'QTY',
            ],
            'image' => [
                'validate' => [
                    'create' => 'required',
                ],
                'type' => 'image',
                'path' => 'uploads/banner',
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        parent::__construct(
            $request, 'general.product', 'product', 'Product', 'product',
            $passingData
        );

        $this->listView['index'] = env('ADMIN_TEMPLATE') . '.page.product.list';
        $this->listView['create'] = env('ADMIN_TEMPLATE') . '.page.product.forms';
        $this->listView['edit'] = env('ADMIN_TEMPLATE') . '.page.product.forms';
        $this->listView['show'] = env('ADMIN_TEMPLATE') . '.page.product.forms';

        $this->data['listSet']['category_id'] = Category::pluck('name', 'id')->toArray();

    }

    public function index()
    {
        $this->callPermission();

        if ($this->request->get('export') == 1) {
            $this->export();
        }


        $data = $this->data;
        $data['listSet']['category_id'] = [0 => 'All'] + Category::pluck('name', 'id')->toArray();
        $data['passing'] = collectPassingData($this->passingData);

        return view($this->listView['index'], $data);
    }

    public function dataTable()
    {
        $this->callPermission();

        $dataTables = new DataTables();

        $builder = $this->model::query()->select('*');
        if ($this->request->get('category_id')) {
            $builder = $builder->where('category_id', '=', $this->request->get('category_id'));
        }
        return $this->processDataTable($dataTables, $builder);
    }

    protected function export()
    {
        ini_set('memory_limit', -1);
        ini_set('max_execution_time', -1);
        if($this->request->get('category_id') > 0){
            $getData = Product::where('category_id', '=', $this->request->get('category_id'))->get();
        }
        else{
            $getData = Product::get();
        }


        $catalogIds = [];
        foreach ($getData as $list) {
            $catalogIds[] = $list->catalog_id;
        }


        $fileName = create_slugs($this->data['thisLabel']).'_'.strtotime("now");

        $spreadsheet = new Spreadsheet();
        $sheet = $spreadsheet->getActiveSheet();

        $row = 1;
        $headers = [
            'id' => __('general.id'),
            'category_id' => __('general.category'),
            'name' => __('general.name'),
            'price' => __('general.price'),
            'price_sale' => 'Price Sale',
            'qty' => 'QTY',
        ];

        $column = 1;
        foreach ($headers as $key => $val) {
            $sheet->setCellValue(valExcel($row, $column++), $val);
        }
        foreach ($getData as $list) {
            $row++;
            $column = 1;
            foreach ($headers as $key => $val) {
                switch ($key) {
                    case 'category_id':
                        $getCategory = Category::where('id', '=', $list->$key)->first();
                        $getVal = $getCategory->name;
                        break;
                    default:
                        $getVal = $list->$key ?? '';
                        break;
                }
                $sheet->setCellValue(valExcel($row, $column++), $getVal);
                // if (in_array($key, ['fee_delivery', 'fee_laundry', 'price_one_time', 'price_insurance', 'price_preloved',
                //     'price_retail', 'price_buy'])) {
                //     $sheet->getStyleByColumnAndRow($column-1, $row)->getNumberFormat()->setFormatCode('#,##0');
                // }
            }
        }

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="' . urlencode($fileName) . '.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: max-age=1');

        header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT');
        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }

}
