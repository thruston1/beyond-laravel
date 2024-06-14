<?php

namespace App\Http\Controllers\Admin;

use App\Codes\Logic\_CrudController;
use App\Codes\Logic\LogicSql;
use App\Codes\Models\TblSetupMasterTask;
use App\Codes\Models\TblSetupTask;
use Illuminate\Http\Request;

class UploadDataLoadController extends _CrudController
{   
    protected $passingDataInfo;
    protected $headerMaster;
    public function __construct(Request $request)
    {
        $passingData = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'name' => [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
                'type' => 'text',
            ],
            'action' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        $this->passingDataInfo = [
            'id' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0
            ],
            'campaign'=> [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'client_code'=> [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'customer_name'=> [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'gender'=> [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'no_telp_1'=> [
                'type' => 'number',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'no_telp_2'=> [
                'type' => 'number',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'no_telp_3'=> [
                'type' => 'number',
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'agreement_no'=> [
                'validate' => [
                    'create' => 'required',
                    'edit' => 'required'
                ],
             ],
            'created_at' => [
                'create' => 0,
                'edit' => 0,
                'show' => 0,
            ]
        ];

        $this->headerMaster = [
                'client_code',
                'customer_name',
                'gender',
                'no_telp_1',
                'no_telp_2',
                'no_telp_3',
                'agreement_no',
        ];
                

        parent::__construct(
            $request, 'general.upload_data_load', 'uploadLoad', 'Category', 'category',
            $passingData
        );

        $this->listView['index'] = env('ADMIN_TEMPLATE') . '.page.dataLoad.list';
        $this->listView['data'] = env('ADMIN_TEMPLATE') . '.page.dataLoad.data';
        $this->listView['preview'] = env('ADMIN_TEMPLATE') . '.page.dataLoad.data_preview';
        // $this->listView['create'] = env('ADMIN_TEMPLATE') . '.page.product.forms';
        // $this->listView['edit'] = env('ADMIN_TEMPLATE') . '.page.product.forms';


    }

    public function index()
    {
        $this->callPermission();
        $logicSql = new LogicSql();
        
        // validate user to get table campaign

        $data = $this->data;
        $data['mastercampaign'] = $logicSql->getMasterCampaign();
        $data['listcampaign'] = $logicSql->getMasterCampaign();
        $data['passing'] = collectPassingData($this->passingData);

        return view($this->listView['index'], $data);
    }


    public function ajaxData()
	{	    
        $logicSql = new LogicSql();  

        $type= $this->request->get('type');
        $type_task = [];
        $campaign = $logicSql->getMasterCampaign($type);
       
        foreach($campaign as $cp){
            $type_task=$cp->typeTask;
        }
        $getDataInfoTask = $logicSql->getDataInfoTask($type);

        $this->passingDataInfo = generatePassingData($this->passingDataInfo);

        $data = $this->data;
        $data['campaign']= $campaign;
        $data['data'] = $getDataInfoTask;
        $data['passing'] = collectPassingData($this->passingDataInfo);
        
        return view($this->listView['data'], $data);
            
        // 

    }

    public function download_txt(){

		$type=$this->request->get('key');
		$campaign=$this->request->get('campaign');
        
        $header_master = $this->headerMaster;

		header("Content-type: application/txt");
		header("Content-Disposition: attachment; filename=\"".$campaign."_template.csv\"");
		header("Pragma: no-cache");
		header("Expires: 0");
        
		$handle = fopen('php://output', 'w');

		// $templateresult = $tblSetupTask->template_result_download_txt();
		
		
		// foreach($templateresult->result_array() as $result){
		// 	fputs($handle, $result['parameterTask'].'|');
		// } 
		$table="";
		foreach ($header_master as $hm) {
			$table=$table.$hm.'|';
		}
		$tes=substr($table,0,-1);
		print $tes;      
		fclose($handle);

		exit;
	}

    public function importcsv() {
        // $this->validate([
        //     'userfile' => 'mimes:csv,txt|max:1004800',
        // ]);
        $file = $this->request->file('userfile');
    	$campaign=$this->request->get('campaign');
    	$type= $this->request->get('type_task');
    	$file_name = $campaign."_Collection_Task-" . date('Ymd');
        // $csvFile->move(storage_path('app/uploads/data_load'), $csvFile->getClientOriginalName());
      
        // $filePath = $csvFile->move(storage_path('app/uploads/data_load'), $file->getClientOriginalName());
        $filePath = $file->storeAs('csv', $file_name);

        $header_master = $this->headerMaster;
        $header=array();
        $i=0;
        foreach ($header_master as $hm) {
            $header[$i]=$hm;
            $i=$i+1;
        }   
        $path2 = public_path('storage/'.$filePath);
        if (($handle = fopen($path2, "r")) !== FALSE) {
            $row = 1;
            while (($data = fgetcsv($handle, 10000, "|")) !== FALSE) {
                if($row==1){
                    $header_data=$data;
                }
                if($row==2){
                    $data_data=$data;	
                    break;
                }
                $row=$row+1;
            }
        }
        fclose($handle);

        $data = $this->data;
        $data['header']= $header;
        $data['header_data']= $header_data;
        $data['data_data']= $data_data;

        return view($this->listView['preview'], $data);
		// $this->m_data_application->upload_task('didi',$this->session->userdata('id'));
	}

    public function importToDB(){
        $logicSql = new LogicSql(); 
        $file = $this->request->file('userfile');
    	$campaign=$this->request->get('campaign');
    	$type= $this->request->get('type_task');
    	$file_name = $campaign."_Collection_Task-" . date('Ymd');

        // $filePath = $csvFile->move(storage_path('app/uploads/data_load'), $file->getClientOriginalName());
        $filePath = $file->storeAs('csv', $file_name);


        $header_master = $this->headerMaster;
        $header=array();
        $i=0;
        $agreementNo='';
        $overdue='';
        $overdue_index='';
        foreach ($header_master as $hm) {
            $header[$i]=$hm;
            $i=$i+1;
        }  
        $bulk_info_task=array();
        $bulk_task=array(); 
        $path2 = public_path('storage/'.$filePath);
        if (($handle = fopen($path2, "r")) !== FALSE) {
            $flag = true;
            $arrayNo = 0;
            $bulk_info_task [$arrayNo]['campaign'] = $campaign;

            while (($data = fgetcsv($handle, 10000, "|")) !== FALSE) {
                if($flag) {
                    $flag = false; continue; 
                }
                for($no=0;$no<count($header);$no++){
                    $fieldName=$header[$no];
                    $dataValue=$data[$no];
                    $agreementNo=$data[6];
                    $bulk_info_task [$arrayNo][$fieldName]= $dataValue;
                    
                }
                
                $uniqueId=$agreementNo.'-'.date('Y-m-d');
                array_push($bulk_task, array(
                    'unique_id' => $uniqueId,
                    'agreement_no' =>$agreementNo,
                    'campaign' => $campaign,

                ));
                $arrayNo = $arrayNo + 1;
                
            }
            $insertData = $logicSql->insertDataUploadBulk($bulk_info_task, $bulk_task);
            if($insertData['success'] == 0){
                return response()->json([
                    'success' => 0,
                    'message' => $insertData['message'],
                ]);
            }
            dd($insertData);
            
            // add data to customer ID + validate data if customer id already exist (under development)
        }
        fclose($handle);

        return response()->json([
            'success' => 1,
            'message' => 'success insert Data',
        ]);
    }

}
