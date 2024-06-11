<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Storage;
use function PHPSTORM_META\type;

class PageController extends _CrudController
{
    protected $passingDataHome;
    protected $passingDataAboutUs;
    protected $passingDataContactUs;
    protected $passingDataMenu;
    protected $passingDataFranchise;
    protected $passingDataMeta;

    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
                'list' => 0,
            ],
            'header_image' => [
                'list' => 0,
                'type' => 'image',
                'path' => 'uploads/page',
            ],
            'name' => [
            ],
            'content' => [
                'list' => 0,
                'type' => 'texteditor'
            ],

            'metatag_title' => [
                'list' => 0,
                'lang' => __('Title'),
            ],
            'metatag_keywords' => [
                'list' => 0,
                'lang' => __('Keywords'),
            ],
            'metatag_description' => [
                'list' => 0,
                'lang' => __('Description'),
            ],

            'updated_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        $this->passingDataHome = generatePassingData([
            'big_icon_name1' => [
                'lang' => __('general.big_icon_name', ['field' => '1 (Special Promo)'])
            ],
            'big_icon_image1' => [
                'type' => 'image',
                'path' => 'uploads/page',
                'lang' => __('general.big_icon_image', ['field' => '1 (Special Promo)']),
                'message' => 'Image Size: 400x300 (px)'
            ],
            'big_icon_link1' => [
                'type' => 'textarea',
                'lang' => __('general.big_icon_link', ['field' => '1 (Special Promo)']),
            ],
            'big_icon_name2' => [
                'lang' => __('general.big_icon_name', ['field' => 2])
            ],
            'big_icon_image2' => [
                'type' => 'image',
                'path' => 'uploads/page',
                'lang' => __('general.big_icon_image', ['field' => '2 (News and Event)']),
                'message' => 'Image Size: 400x300 (px)'
            ],
            'big_icon_link2' => [
                'type' => 'textarea',
                'lang' => __('general.big_icon_link', ['field' => '2 (News and Event)']),
            ],
            'big_icon_name3' => [
                'lang' => __('general.big_icon_name', ['field' => 3])
            ],
            'big_icon_image3' => [
                'type' => 'image',
                'path' => 'uploads/page',
                'lang' => __('general.big_icon_image', ['field' => '3 (Find Our Outlet)']),
                'message' => 'Image Size: 400x300 (px)'
            ],
            'big_icon_link3' => [
                'type' => 'textarea',
                'lang' => __('general.big_icon_link', ['field' => '3 (Find Our Outlet)']),
            ],
            'big_icon_bg_image' => [
                'type' => 'image',
                'path' => 'uploads/page',
                'lang' => __('general.image'),
                'message' => 'Image Size: 1900x417 (px)'
            ],

            'section2_header' => [
                'type' => 'text',
                'lang' => __('general.big_order')
            ],
            'section2_sub_header' => [
                'type' => 'text',
                'lang' => __('general.sub_header_big_order')
            ],
            'section2_link' => [
                'type' => 'textarea',
                'lang' => __('general.link')
            ],
            'section2_image' => [
                'type' => 'image',
                'path' => 'uploads/page',
                'lang' => __('general.image'),
                'message' => 'Image Size: 960x300 (px)'
            ],

            'section3_header' => [
                'type' => 'text',
                'lang' => __('general.best_quality_ingredients')
            ],
            'section3_image' => [
                'type' => 'image',
                'path' => 'uploads/page',
                'lang' => __('general.image'),
                'message' => 'image Size: 960x1074 (px)'
            ],
            'section3_ingredients_title1' => [
                'type' => 'text',
                'lang' => __('general.ingredients_title', ['field' => '1'])
            ],
            'section3_ingredients_content1' => [
                'type' => 'textarea',
                'lang' => __('general.ingredients_content', ['field' => '1'])
            ],
            'section3_ingredients_title2' => [
                'type' => 'text',
                'lang' => __('general.ingredients_title', ['field' => '2'])
            ],
            'section3_ingredients_content2' => [
                'type' => 'textarea',
                'lang' => __('general.ingredients_content', ['field' => '2'])
            ],
            'section3_ingredients_title3' => [
                'type' => 'text',
                'lang' => __('general.ingredients_title', ['field' => '3'])
            ],
            'section3_ingredients_content3' => [
                'type' => 'textarea',
                'lang' => __('general.ingredients_content', ['field' => '3'])
            ],
            'section3_ingredients_title4' => [
                'type' => 'text',
                'lang' => __('general.ingredients_title', ['field' => '4'])
            ],
            'section3_ingredients_content4' => [
                'type' => 'textarea',
                'lang' => __('general.ingredients_content', ['field' => '4'])
            ],

            'section4_image' => [
                'type' => 'image',
                'path' => 'uploads/page',
                'lang' => __('general.image'),
                'message' => 'Image Size: 1890x1224 (px)'
            ],

            'metatag_title' => [
                'lang' => __('Title'),
            ],
            'metatag_keywords' => [
                'lang' => __('Keywords'),
            ],
            'metatag_description' => [
                'lang' => __('Description'),
            ],
        ]);

        $this->passingDataAboutUs = generatePassingData([
            'name' => [
            ],
            'header_image' => [
                'type' => 'image',
                'path' => 'uploads/page',
                'message' => 'Image Size: 2880x335 (px)'
            ],
            'section2_title' => [
                'edit' => 0,
                'type' => 'text',
                'lang' => __('general.section_title_', ['field' => 2])
            ],
            'section2_content' => [
                'edit' => 0,
                'type' => 'texteditor',
                'lang' => __('general.section_content_', ['field' => 2])
            ],
            'section2_image' => [
                'edit' => 0,
                'type' => 'image',
                'path' => 'uploads/page',
                'lang' => __('general.section_image_', ['field' => 2])
            ],
            'section3_title' => [
                'type' => 'text',
                'lang' => __('general.section_title_', ['field' => 3])
            ],
            'section3_content' => [
                'type' => 'texteditor',
                'lang' => __('general.section_content_', ['field' => 3])
            ],
            'section3_image' => [
                'type' => 'image',
                'path' => 'uploads/page',
                'message' => 'Image Size: 1110x335 (px)',
                'lang' => __('general.section_image_', ['field' => 3])
            ],

            'metatag_title' => [
                'lang' => __('Title'),
            ],
            'metatag_keywords' => [
                'lang' => __('Keywords'),
            ],
            'metatag_description' => [
                'lang' => __('Description'),
            ],
        ]);

        $this->passingDataContactUs = generatePassingData([
            'name' => [
                'type' => 'text'
            ],
            'address' => [
                'type' => 'textarea',
                'lang' => 'Address',
            ],
            'phone' => [
                'type' => 'phone',
            ],
            'email' => [
                'type' => 'email',
            ],

            'metatag_title' => [
                'lang' => __('Title'),
            ],
            'metatag_keywords' => [
                'lang' => __('Keywords'),
            ],
            'metatag_description' => [
                'lang' => __('Description'),
            ],
        ]);

        $this->passingDataMenu = generatePassingData([
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
                'list' => 0,
            ],
            'header_image' => [
                'list' => 0,
                'type' => 'image',
                'path' => 'uploads/page',
            ],
            'name' => [
            ],
            'image_all_product' => [
                'list' => 0,
                'type' => 'image',
                'path' => 'uploads/page',
            ],

            'metatag_title' => [
                'lang' => __('Title'),
            ],
            'metatag_keywords' => [
                'lang' => __('Keywords'),
            ],
            'metatag_description' => [
                'lang' => __('Description'),
            ],

            'updated_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ]);

        $this->passingDataFranchise = generatePassingData([
            'name' => [
            ],
            'section1_name' => [
                'type' => 'text',
                'lang' => __('general.section_name_', ['field' => 1])
            ],
            'section1_image' => [
                'type' => 'image',
                'path' => 'uploads/page',
                'lang' => __('general.section_image_', ['field' => 1]),
                'message' => 'Image Size: 555x480 (px)'
            ],
            'section2_name' => [
                'type' => 'text',
                'lang' => __('general.section_name_', ['field' => 2])
            ],
            'section2_title' => [
                'edit' => 0,
                'type' => 'text',
                'lang' => __('general.section_title_', ['field' => 2])
            ],
            'section2_content' => [
                'edit' => 0,
                'type' => 'texteditor',
                'lang' => __('general.section_content_', ['field' => 2])
            ],
            'section2_image' => [
                'edit' => 0,
                'type' => 'image',
                'path' => 'uploads/page',
                'lang' => __('general.section_image_', ['field' => 2]),
                'message' => 'Image Size: 100x100 (px)'
            ],
            'section3_name' => [
                'type' => 'text',
                'lang' => __('general.section_name_', ['field' => 3])
            ],
            'section3_title' => [
                'type' => 'text',
                'lang' => __('general.section_title_', ['field' => 3])
            ],
            'section3_content' => [
                'type' => 'texteditor',
                'lang' => __('general.section_content_', ['field' => 3])
            ],

            'metatag_title' => [
                'lang' => __('Title'),
            ],
            'metatag_keywords' => [
                'lang' => __('Keywords'),
            ],
            'metatag_description' => [
                'lang' => __('Description'),
            ],
        ]);

        $this->passingDataMeta = generatePassingData([
            'metatag_title' => [
                'lang' => __('Title'),
            ],
            'metatag_keywords' => [
                'lang' => __('Keywords'),
            ],
            'metatag_description' => [
                'lang' => __('Description'),
            ],
        ]);

        parent::__construct(
            $request, 'general.page', 'page', 'Page', 'page',
            $passingData
        );

    }

    public function edit($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $getAdditional = json_decode($getData->additional, true);

        switch ($getData->type) {
            case 'homepage' :
                $getData->big_icon_name1 = $getAdditional['big_icon_name1'] ?? '';
                $getData->big_icon_image1 = $getAdditional['big_icon_image1'] ?? '';
                $getData->big_icon_link1 = $getAdditional['big_icon_link1'] ?? '';
                $getData->big_icon_name2 = $getAdditional['big_icon_name2'] ?? '';
                $getData->big_icon_image2 = $getAdditional['big_icon_image2'] ?? '';
                $getData->big_icon_link2 = $getAdditional['big_icon_link2'] ?? '';
                $getData->big_icon_name3 = $getAdditional['big_icon_name3'] ?? '';
                $getData->big_icon_image3 = $getAdditional['big_icon_image3'] ?? '';
                $getData->big_icon_link3 = $getAdditional['big_icon_link3'] ?? '';
                $getData->big_icon_bg_image = $getAdditional['big_icon_bg_image'] ?? '';
                $getData->section2_header = $getAdditional['section2_header'] ?? '';
                $getData->section2_sub_header = $getAdditional['section2_sub_header'] ?? '';
                $getData->section2_link = $getAdditional['section2_link'] ?? '';
                $getData->section2_image = $getAdditional['section2_image'] ?? '';
                $getData->section3_header = $getAdditional['section3_header'] ?? '';
                $getData->section3_image = $getAdditional['section3_image'] ?? '';
                $getData->section3_ingredients_title1 = $getAdditional['section3_ingredients_title1'] ?? '';
                $getData->section3_ingredients_content1 = $getAdditional['section3_ingredients_content1'] ?? '';
                $getData->section3_ingredients_title2 = $getAdditional['section3_ingredients_title2'] ?? '';
                $getData->section3_ingredients_content2 = $getAdditional['section3_ingredients_content2'] ?? '';
                $getData->section3_ingredients_title3 = $getAdditional['section3_ingredients_title3'] ?? '';
                $getData->section3_ingredients_content3 = $getAdditional['section3_ingredients_content3'] ?? '';
                $getData->section3_ingredients_title4 = $getAdditional['section3_ingredients_title4'] ?? '';
                $getData->section3_ingredients_content4 = $getAdditional['section3_ingredients_content4'] ?? '';
                $getData->section4_image = $getAdditional['section4_image'] ?? '';

                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
            case 'about_us' :
                $getData->section2_title = $getAdditional['section2_title'] ?? [];
                $getData->section2_content = $getAdditional['section2_content'] ?? [];
                $getData->section2_image = $getAdditional['section2_image'] ?? [];
                $getData->section3_title = $getAdditional['section3_title'] ?? '';
                $getData->section3_content = $getAdditional['section3_content'] ?? '';
                $getData->section3_image = $getAdditional['section3_image'] ?? '';

                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
            case 'contact_us' :
                $getData->address = $getAdditional['address'] ?? '';
                $getData->phone = $getAdditional['phone'] ?? '';
                $getData->email = $getAdditional['email'] ?? '';

                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
            case 'franchise' :
                $getData->section1_name = $getAdditional['section1_name'] ?? '';
                $getData->section1_image = $getAdditional['section1_image'] ?? '';
                $getData->section2_name = $getAdditional['section2_name'] ?? '';
                // $getData->section2_title = $getAdditional['section2_title'] ?? [];
                // $getData->section2_content = $getAdditional['section2_content'] ?? [];
                // $getData->section2_image = $getAdditional['section2_image'] ?? [];
                $getData->section3_name = $getAdditional['section3_name'] ?? '';
                // $getData->section3_title = $getAdditional['section3_title'] ?? [];
                // $getData->section3_content = $getAdditional['section3_content'] ?? [];

                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
            case 'metatag' :
                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
            default :
                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
        }

        $data = $this->data;
        $data['viewType'] = 'edit';
        $data['formsTitle'] = __('general.title_edit', ['field' => $data['thisLabel']]);

        switch ($getData->type) {
            case 'homepage' :
                $data['passingData'] = collectPassingData($this->passingDataHome, $data['viewType']);
                break;
            case 'contact_us' :
                $data['passingData'] = collectPassingData($this->passingDataContactUs, $data['viewType']);
                break;
            case 'about_us' :
                $data['passingData'] = collectPassingData($this->passingDataAboutUs, $data['viewType']);
                break;
            case 'menu' :
                $data['passingData'] = collectPassingData($this->passingDataMenu, $data['viewType']);
                break;
            case 'franchise' :
                $data['passingData'] = collectPassingData($this->passingDataFranchise, $data['viewType']);
                break;
            case 'metatag' :
                $data['passingData'] = collectPassingData($this->passingDataMeta, $data['viewType']);
                break;
            default :
                $data['passingData'] = collectPassingData($this->passingData, $data['viewType']);
                break;
        }

        $data['data'] = $getData;

        $loadView = match ($getData->type) {
            'homepage' => env('ADMIN_TEMPLATE') . '.page.page.homepage',
            'about_us' => env('ADMIN_TEMPLATE') . '.page.page.about_us',
            'franchise' => env('ADMIN_TEMPLATE') . '.page.page.franchise',
            'metatag' => env('ADMIN_TEMPLATE') . '.page.page.metatag',
            default => env('ADMIN_TEMPLATE') . '.page.page.forms',
        };

        return view($loadView, $data);
    }

    public function show($id)
    {
        $this->callPermission();

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $getAdditional = json_decode($getData->additional, true);

        switch ($getData->type) {
            case 'homepage' :
                $getData->big_icon_name1 = $getAdditional['big_icon_name1'] ?? '';
                $getData->big_icon_image1 = $getAdditional['big_icon_image1'] ?? '';
                $getData->big_icon_link1 = $getAdditional['big_icon_link1'] ?? '';
                $getData->big_icon_name2 = $getAdditional['big_icon_name2'] ?? '';
                $getData->big_icon_image2 = $getAdditional['big_icon_image2'] ?? '';
                $getData->big_icon_link2 = $getAdditional['big_icon_link2'] ?? '';
                $getData->big_icon_name3 = $getAdditional['big_icon_name3'] ?? '';
                $getData->big_icon_image3 = $getAdditional['big_icon_image3'] ?? '';
                $getData->big_icon_link3 = $getAdditional['big_icon_link3'] ?? '';
                $getData->big_icon_bg_image = $getAdditional['big_icon_bg_image'] ?? '';
                $getData->section2_header = $getAdditional['section2_header'] ?? '';
                $getData->section2_sub_header = $getAdditional['section2_sub_header'] ?? '';
                $getData->section2_link = $getAdditional['section2_link'] ?? '';
                $getData->section2_image = $getAdditional['section2_image'] ?? '';
                $getData->section3_header = $getAdditional['section3_header'] ?? '';
                $getData->section3_image = $getAdditional['section3_image'] ?? '';
                $getData->section3_ingredients_title1 = $getAdditional['section3_ingredients_title1'] ?? '';
                $getData->section3_ingredients_content1 = $getAdditional['section3_ingredients_content1'] ?? '';
                $getData->section3_ingredients_title2 = $getAdditional['section3_ingredients_title2'] ?? '';
                $getData->section3_ingredients_content2 = $getAdditional['section3_ingredients_content2'] ?? '';
                $getData->section3_ingredients_title3 = $getAdditional['section3_ingredients_title3'] ?? '';
                $getData->section3_ingredients_content3 = $getAdditional['section3_ingredients_content3'] ?? '';
                $getData->section3_ingredients_title4 = $getAdditional['section3_ingredients_title4'] ?? '';
                $getData->section3_ingredients_content4 = $getAdditional['section3_ingredients_content4'] ?? '';
                $getData->section4_image = $getAdditional['section4_image'] ?? '';

                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
            case 'about_us' :
                $getData->section2_title = $getAdditional['section2_title'] ?? [];
                $getData->section2_content = $getAdditional['section2_content'] ?? [];
                $getData->section2_image = $getAdditional['section2_image'] ?? [];
                $getData->section3_title = $getAdditional['section3_title'] ?? '';
                $getData->section3_content = $getAdditional['section3_content'] ?? '';
                $getData->section3_image = $getAdditional['section3_image'] ?? '';

                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
            case 'contact_us' :
                $getData->title = $getAdditional['title'] ?? '';
                $getData->address = $getAdditional['address'] ?? '';
                $getData->phone = $getAdditional['phone'] ?? '';
                $getData->email = $getAdditional['email'] ?? '';

                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
            case 'menu' :
                $getData->image_all_product = $getAdditional['image_all_product'] ?? '';

                break;
            case 'franchise' :
                $getData->section1_name = $getAdditional['section1_name'] ?? '';
                $getData->section1_image = $getAdditional['section1_image'] ?? '';
                $getData->section2_name = $getAdditional['section2_name'] ?? '';
                // $getData->section2_title = $getAdditional['section2_title'] ?? [];
                // $getData->section2_content = $getAdditional['section2_content'] ?? [];
                // $getData->section2_image = $getAdditional['section2_image'] ?? [];
                $getData->section3_name = $getAdditional['section3_name'] ?? '';
                // $getData->section3_title = $getAdditional['section3_title'] ?? [];
                // $getData->section3_content = $getAdditional['section3_content'] ?? [];

                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
            case 'metatag' :
                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
            default :
                $getData->metatag_title = $getAdditional['metatag_title'] ?? '';
                $getData->metatag_keywords = $getAdditional['metatag_keywords'] ?? '';
                $getData->metatag_description = $getAdditional['metatag_description'] ?? '';
                break;
        }

        $data = $this->data;

        $data['viewType'] = 'show';
        $data['formsTitle'] = __('general.title_show', ['field' => $data['thisLabel']]);
        switch ($getData->type) {
            case 'homepage' :
                $data['passingData'] = collectPassingData($this->passingDataHome, $data['viewType']);
                break;
            case 'about_us' :
                $data['passingData'] = collectPassingData($this->passingDataAboutUs, $data['viewType']);
                break;
            case 'contact_us' :
                $data['passingData'] = collectPassingData($this->passingDataContactUs, $data['viewType']);
                break;
            case 'menu' :
                $data['passingData'] = collectPassingData($this->passingDataMenu, $data['viewType']);
                break;
            case 'franchise' :
                $data['passingData'] = collectPassingData($this->passingDataFranchise, $data['viewType']);
                break;
            case 'metatag' :
                $data['passingData'] = collectPassingData($this->passingDataMeta, $data['viewType']);
                break;
            default :
                $data['passingData'] = collectPassingData($this->passingData, $data['viewType']);
                break;
        }

        $data['data'] = $getData;

        $loadView = match ($getData->type) {
            'homepage' => env('ADMIN_TEMPLATE') . '.page.page.homepage',
            'about_us' => env('ADMIN_TEMPLATE') . '.page.page.about_us',
            'franchise' => env('ADMIN_TEMPLATE') . '.page.page.franchise',
            'metatag' => env('ADMIN_TEMPLATE') . '.page.page.metatag',
            default => env('ADMIN_TEMPLATE') . '.page.page.forms',
        };

        return view($loadView, $data);

    }

    public function update($id)
    {
        $this->callPermission();

        $viewType = 'edit';

        $getData = $this->crud->show($id);
        if (!$getData) {
            return redirect()->route($this->rootRoute.'.' . $this->route . '.index');
        }

        $getListCollectData = match ($getData->type) {
            'homepage' => collectPassingData($this->passingDataHome, $viewType),
            'about_us' => collectPassingData($this->passingDataAboutUs, $viewType),
            'contact_us' => collectPassingData($this->passingDataContactUs, $viewType),
            'menu' => collectPassingData($this->passingDataMenu, $viewType),
            'franchise' => collectPassingData($this->passingDataFranchise, $viewType),
            'metatag' => collectPassingData($this->passingDataMeta, $viewType),
            default => collectPassingData($this->passingData, $viewType),
        };

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
        $getParameter = json_decode($getData->additional, true);
        $saveParameter = [];

        switch ($getData->type) {
            case 'homepage' :
                $saveParameter = [
                    'big_icon_name1' => $getParameter['big_icon_name1'] ?? '',
                    'big_icon_image1' => $getParameter['big_icon_image1'] ?? '',
                    'big_icon_link1' => $getParameter['big_icon_link1'] ?? '',
                    'big_icon_name2' => $getParameter['big_icon_name2'] ?? '',
                    'big_icon_image2' => $getParameter['big_icon_image2'] ?? '',
                    'big_icon_link2' => $getParameter['big_icon_link2'] ?? '',
                    'big_icon_name3' => $getParameter['big_icon_name3'] ?? '',
                    'big_icon_image3' => $getParameter['big_icon_image3'] ?? '',
                    'big_icon_link3' => $getParameter['big_icon_link3'] ?? '',
                    'big_icon_bg_image' => $getParameter['big_icon_bg_image'] ?? '',
                    'section2_header' => $getParameter['section2_header'] ?? '',
                    'section2_sub_header' => $getParameter['section2_sub_header'] ?? '',
                    'section2_link' => $getParameter['section2_link'] ?? '',
                    'section2_image' => $getParameter['section2_image'] ?? '',
                    'section3_header' => $getParameter['section3_header'] ?? '',
                    'section3_image' => $getParameter['section3_image'] ?? '',
                    'section3_ingredients_title1' => $getParameter['section3_ingredients_title1'] ?? '',
                    'section3_ingredients_content1' => $getParameter['section3_ingredients_content1'] ?? '',
                    'section3_ingredients_title2' => $getParameter['section3_ingredients_title2'] ?? '',
                    'section3_ingredients_content2' => $getParameter['section3_ingredients_content2'] ?? '',
                    'section3_ingredients_title3' => $getParameter['section3_ingredients_title3'] ?? '',
                    'section3_ingredients_content3' => $getParameter['section3_ingredients_content3'] ?? '',
                    'section3_ingredients_title4' => $getParameter['section3_ingredients_title4'] ?? '',
                    'section3_ingredients_content4' => $getParameter['section3_ingredients_content4'] ?? '',
                    'section4_image' => $getParameter['section4_image'] ?? '',

                    'metatag_title' => $getParameter['metatag_title'] ?? '',
                    'metatag_keywords' => $getParameter['metatag_keywords'] ?? '',
                    'metatag_description' => $getParameter['metatag_description'] ?? '',

                ];

                foreach ($saveParameter as $key => $val) {
                    try {
                        if (isset($data[$key]) || is_null($data[$key])) {
                            $saveParameter[$key] = $data[$key] ?? '';
                        }
                    }
                    catch (\Exception $e) {}
                    try {
                        unset($data[$key]);
                    }
                    catch (\Exception $e) {}
                }
                break;
            case 'about_us' :
                $section2Title = $this->request->get('section2_title');
                $section2Content = $this->request->get('section2_content');
                $section2Image = $this->request->file('section2_image');

                $getOldImage = $getParameter['section2_image'] ?? [];
                if ($section2Image) {
                    foreach ($section2Image as $index => $image) {
                        if ($image) {
                            if ($image->getError() != 1) {

                                $getFileName = $image->getClientOriginalName();
                                $ext = explode('.', $getFileName);
                                $ext = end($ext);
                                $destinationPath = 'uploads/page';

                                if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'svg', 'gif'])) {
                                    if (isset($getOldImage[$index]) > 0) {
                                        try {
                                            unlink($destinationPath.$getOldImage[$index]);
                                            Storage::delete($getOldImage[$index]);
                                        }
                                        catch (\Exception $e) { }
                                    }

                                    $destinationPath = str_ends_with($destinationPath, '/') ? substr($destinationPath, 0, strlen($destinationPath)-1) : $destinationPath;
                                    $setFileName = Storage::putFile($destinationPath, $image);
                                    $getOldImage[$index] = $setFileName;
                                }
                            }
                        }
                    }
                }

                $data['section2_title'] = $section2Title;
                $data['section2_content'] = $section2Content;
                $data['section2_image'] = $getOldImage;

                $saveParameter = [
                    'section2_title' => $getParameter['section2_title'] ?? [],
                    'section2_content' => $getParameter['section2_content'] ?? [],
                    'section2_image' => $getParameter['section2_image'] ?? [],
                    'section3_title' => $getParameter['section3_title'] ?? '',
                    'section3_content' => $getParameter['section3_content'] ?? '',
                    'section3_image' => $getParameter['section3_image'] ?? '',

                    'metatag_title' => $getParameter['metatag_title'] ?? '',
                    'metatag_keywords' => $getParameter['metatag_keywords'] ?? '',
                    'metatag_description' => $getParameter['metatag_description'] ?? '',
                ];

                foreach ($saveParameter as $key => $val) {
                    try {
                        if (isset($data[$key]) || is_null($data[$key])) {
                            $saveParameter[$key] = $data[$key] ?? '';
                        }
                    }
                    catch (\Exception $e) {}
                    try {
                        unset($data[$key]);
                    }
                    catch (\Exception $e) {}
                }
                break;
            case 'contact_us' :
                $saveParameter = [
                    'address' => $getParameter['address'] ?? '',
                    'phone' => $getParameter['phone'] ?? '',
                    'email' => $getParameter['email'] ?? '',

                    'metatag_title' => $getParameter['metatag_title'] ?? '',
                    'metatag_keywords' => $getParameter['metatag_keywords'] ?? '',
                    'metatag_description' => $getParameter['metatag_description'] ?? '',
                ];

                foreach ($saveParameter as $key => $val) {
                    try {
                        if (isset($data[$key]) || is_null($data[$key])) {
                            $saveParameter[$key] = $data[$key] ?? '';
                        }
                    }
                    catch (\Exception $e) {}
                    try {
                        unset($data[$key]);
                    }
                    catch (\Exception $e) {}
                }
                break;
            case 'menu' :
                $saveParameter = [
                    'image_all_product' => $getParameter['image_all_product'] ?? '',

                    'metatag_title' => $getParameter['metatag_title'] ?? '',
                    'metatag_keywords' => $getParameter['metatag_keywords'] ?? '',
                    'metatag_description' => $getParameter['metatag_description'] ?? '',
                ];

                foreach ($saveParameter as $key => $val) {
                    if (isset($data[$key])) {
                        $saveParameter[$key] = $data[$key];
                    }
                    try {
                        unset($data[$key]);
                    }
                    catch (\Exception $e) {}
                }
                break;
            case 'franchise' :
                $section1Name = $this->request->get('section1_name');
                $section1Image = $this->request->file('section1_image');
                $section2Name = $this->request->get('section2_name');
                // $section2Title = $this->request->get('section2_title');
                // $section2Content = $this->request->get('section2_content');
                // $section2Image = $this->request->file('section2_image');
                $section3Name = $this->request->get('section3_name');
                // $section3Title = $this->request->get('section3_title');
                // $section3Content = $this->request->get('section3_content');

                $getOldImage = $getParameter['section1_image'] ?? '';
                if ($section1Image) {
                    if ($section1Image->getError() != 1) {

                        $getFileName = $section1Image->getClientOriginalName();
                        $ext = explode('.', $getFileName);
                        $ext = end($ext);
                        $destinationPath = 'uploads/page';

                        if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'svg', 'gif'])) {
                            if (isset($getOldImage) && strlen($getOldImage) > 0) {
                                try {
                                    unlink($destinationPath.$getOldImage);
                                    Storage::delete($getOldImage);
                                }
                                catch (\Exception $e) { }
                            }

                            $destinationPath = str_ends_with($destinationPath, '/') ? substr($destinationPath, 0, strlen($destinationPath)-1) : $destinationPath;
                            $setFileName = Storage::putFile($destinationPath, $section1Image);
                            $getOldImage = $setFileName;
                        }
                    }
                }

                $data['section1_name'] = $section1Name;
                $data['section1_image'] = $getOldImage;

                // $getOldImage = $getParameter['section2_image'] ?? [];
                // if ($section2Image) {
                //     foreach ($section2Image as $index => $image) {
                //         if ($image) {
                //             if ($image->getError() != 1) {

                //                 $getFileName = $image->getClientOriginalName();
                //                 $ext = explode('.', $getFileName);
                //                 $ext = end($ext);
                //                 $destinationPath = 'uploads/page';

                //                 if (in_array(strtolower($ext), ['jpg', 'jpeg', 'png', 'svg', 'gif'])) {
                //                     if (isset($getOldImage[$index]) > 0) {
                //                         try {
                //                             unlink($destinationPath.$getOldImage[$index]);
                //                             Storage::delete($getOldImage[$index]);
                //                         }
                //                         catch (\Exception $e) { }
                //                     }

                //                     $destinationPath = str_ends_with($destinationPath, '/') ? substr($destinationPath, 0, strlen($destinationPath)-1) : $destinationPath;
                //                     $setFileName = Storage::putFile($destinationPath, $image);
                //                     $getOldImage[$index] = $setFileName;
                //                 }
                //             }
                //         }
                //     }
                // }

                $data['section2_name'] = $section2Name;
                // $data['section2_title'] = $section2Title;
                // $data['section2_content'] = $section2Content;
                // $data['section2_image'] = $getOldImage;

                $data['section3_name'] = $section3Name;
                // $data['section3_title'] = $section3Title;
                // $data['section3_content'] = $section3Content;

                $saveParameter = [
                    'section1_name' => $getParameter['section1_name'] ?? '',
                    'section1_image' => $getParameter['section1_image'] ?? '',
                    'section2_name' => $getParameter['section2_name'] ?? '',
                    // 'section2_title' => $getParameter['section2_title'] ?? [],
                    // 'section2_content' => $getParameter['section2_content'] ?? [],
                    // 'section2_image' => $getParameter['section2_image'] ?? [],
                    'section3_name' => $getParameter['section3_name'] ?? '',
                    // 'section3_title' => $getParameter['section3_title'] ?? [],
                    // 'section3_content' => $getParameter['section3_content'] ?? [],

                    'metatag_title' => $getParameter['metatag_title'] ?? '',
                    'metatag_keywords' => $getParameter['metatag_keywords'] ?? '',
                    'metatag_description' => $getParameter['metatag_description'] ?? '',
                ];

                foreach ($saveParameter as $key => $val) {
                    try {
                        if (isset($data[$key]) || is_null($data[$key])) {
                            $saveParameter[$key] = $data[$key] ?? '';
                        }
                    }
                    catch (\Exception $e) {}
                    try {
                        unset($data[$key]);
                    }
                    catch (\Exception $e) {}
                }
                break;
            case 'metatag' :
                $saveParameter = [
                    'metatag_title' => $getParameter['metatag_title'] ?? '',
                    'metatag_keywords' => $getParameter['metatag_keywords'] ?? '',
                    'metatag_description' => $getParameter['metatag_description'] ?? '',
                ];


                foreach ($saveParameter as $key => $val) {
                    try {
                        if (isset($data[$key]) || is_null($data[$key])) {
                            $saveParameter[$key] = $data[$key] ?? '';
                        }
                    }
                    catch (\Exception $e) {}
                    try {
                        unset($data[$key]);
                    }
                    catch (\Exception $e) {}
                }

                break;
            default :
                $saveParameter = [
                    'metatag_title' => $getParameter['metatag_title'] ?? '',
                    'metatag_keywords' => $getParameter['metatag_keywords'] ?? '',
                    'metatag_description' => $getParameter['metatag_description'] ?? '',
                ];

                foreach ($saveParameter as $key => $val) {
                    try {
                        if (isset($data[$key]) || is_null($data[$key])) {
                            $saveParameter[$key] = $data[$key] ?? '';
                        }
                    }
                    catch (\Exception $e) {}
                    try {
                        unset($data[$key]);
                    }
                    catch (\Exception $e) {}
                }
                break;

        }

        $data['additional'] = json_encode($saveParameter);

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

}
