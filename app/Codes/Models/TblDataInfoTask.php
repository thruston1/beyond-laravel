<?php

namespace App\Codes\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Cache;
use App\Codes\Models\TblSetupMasterTask;

class TblDataInfoTask extends Model
{
    protected $table = 'tblDataInfoTask';
    protected $primaryKey = 'id';
    protected $fillable = [
        'id',
        'campaignName',
        'fieldName',
        'dataValue',
        'agreementNo',
    ];

    public function getCreatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['created_at'])
            ->format('Y-m-d H:i:s');
    }

    public function getUpdatedAtAttribute()
    {
        return \Carbon\Carbon::parse($this->attributes['updated_at'])
            ->format('Y-m-d H:i:s');
    }

    public function getStructureTask($type)
    {
		// Return Query
		return TblSetupMasterTask::where('typeName', '=', $type)->orderBy('fieldOrder')->get()->toArray();
		
	}

    public function getDataInfoAll($strukturtask,$date,$campaign){
		$no=1;
		$header="";
		$isi="";

		$header2="";
		$isi2="";

		// New Pecah 
		$chunkSize = ceil(count($strukturtask) / 2);
		$chunks = array_chunk($strukturtask, $chunkSize);

		// Check if the count is odd
		if (count($chunks) > 1 && count($chunks[0]) < count($chunks[1])) {
			// If odd, move the last element from the first chunk to the second
			$lastElement = array_pop($chunks[0]);
			$chunks[1][] = $lastElement;
		}

		$firstHalf = $chunks[0];
		$secondHalf = $chunks[1];
        $firstHalf = json_encode($firstHalf);
        $firstHalf = json_decode($firstHalf, false);

        $secondHalf = json_encode($secondHalf);
        $secondHalf = json_decode($secondHalf, false);
        
        // dd($firstHalf);
		foreach ($firstHalf as $st) {
            // dd($st);
			${'r'.$no}=$st->fieldName;
			$header=$header."r".$no.".dataValue AS '".$st->fieldName."',";
			$isi=$isi."LEFT JOIN tblDataInfoTask r".$no." ON r".$no.".campaignName =r0.campaignName AND r".$no.".agreementNo = r0.agreementNo AND r".$no.".fieldName = '".$st->fieldName."' AND r".$no.".createdDate=CURDATE()";
			$no=$no+1;
		}
		foreach ($secondHalf as $st) {
			${'r'.$no}=$st->fieldName;
			$header2=$header2."r".$no.".dataValue AS '".$st->fieldName."',";
			$isi2=$isi2."LEFT JOIN tblDataInfoTask r".$no." ON r".$no.".campaignName =r0.campaignName AND r".$no.".agreementNo = r0.agreementNo AND r".$no.".fieldName = '".$st->fieldName."' AND r".$no.".createdDate=CURDATE()";
			$no=$no+1;
		}

		$header=substr($header,0,-1);
		$header2=substr($header2,0,-1);

		$sql = "SELECT 
			".$header."
		FROM(
		SELECT campaignName,AGREEMENTNO,createdDate FROM tblDataInfoTask WHERE createdDate=CURDATE() AND campaignName='".$campaign."' GROUP BY campaignName,AGREEMENTNO,createdDate
         ORDER BY id )r0
		".$isi."
		WHERE r0.createdDate=CURDATE()
		ORDER BY
			r0.campaignName, r0.agreementNo";
		$sql2 = "SELECT 
			".$header2."
		FROM(
		SELECT campaignName,AGREEMENTNO,createdDate FROM tblDataInfoTask WHERE createdDate=CURDATE() AND campaignName='".$campaign."' GROUP BY campaignName,AGREEMENTNO,createdDate 
        ORDER BY id  )r0
		".$isi2."
		WHERE r0.createdDate=CURDATE()
		ORDER BY
			r0.campaignName, r0.agreementNo";
		// $query	= $this->db->query($sql)->result_array();
		// $query2	= $this->db->query($sql2)->result_array();
        $query = DB::select($sql);
        $query2 = DB::select($sql2);
		$data = array();
		foreach ($query as $key => $value) {
			$query[$key] = array_merge($query[$key], $query2[$key]);
			$data[] = array_values($query[$key]);
		}
		
		// Return Query
		return $data;
	}

    public static function boot()
    {
        parent::boot();

        self::updated(function($model){
            Cache::forget('role'.$model->id);
        });

        self::deleting(function($model){
            Cache::forget('role'.$model->id);
        });
    }

}
