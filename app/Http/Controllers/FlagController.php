<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Flag;
use App\User;
use App\Soal;
use Illuminate\Support\Facades\DB;

class FlagController extends Controller
{
	/*
    |--------------------------------------------------------------------------
    | DANGEROUS AREA !!!
    |--------------------------------------------------------------------------
    |
    | HATI-HATI!
    | Bagian paling penting dari aplikasi ini ada di sini.
    | Jangan merubah sembarangan tanpa seijin Penerus!!!
    |
    */
    public function viewFormSubmit()
    {
    	$teamid = Auth::user()->team_id;

    	//get Data Peserta
    	$peserta = User::select('team_id','team_username')
    		->where([['team_type','=' ,'peserta'],['team_id','<>',$teamid]])
    		->orderBy('team_username','asc')
    		->get();

    	//get Data Soal
    	$soal = Soal::select('soal_id')
    		->orderBy('soal_id','asc')
    		->get();

    	return view('peserta/formsubmit', ['peserta' => $peserta , 'soal' => $soal]);
    }

    public function getPoin()
    {
    	$teamid = Auth::user()->team_id;

    	//Kumpulin Data
    	$poinPlus = Flag::where('flag_submitter', $teamid)->get();
    	$poinMinus= Flag::where([['team_id',$teamid],['flag_isActive','0']])->get();

    	$poinTotal = 0;
    	//Generate nilai Plus
    	foreach($poinPlus as $plus){
			$poin = Soal::select('soal_poin')
				->where('soal_id',$plus->soal_id)
    			->first();

    		$poinTotal = $poinTotal + $poin->soal_poin;
    	}
    	//Generate nilai Minus
    	foreach($poinMinus as $minus){
			$poin = Soal::select('soal_poin')
				->where('soal_id',$minus->soal_id)
    			->first();

    		$poinTotal = $poinTotal - $poin->soal_poin;
    	}

    	return $poinTotal;
    }

    public function getAllPoin()
    {
    	//Kumpulin List Team
    	$getTeam = User::select('team_id','team_username')
    		->where('team_type', 'peserta')
    		->orderBy('team_username','asc')
    		->get();

    	$allPoin = array();
    	$count = 0;
    	//Generate Nilai
    	foreach($getTeam as $teamid){
	    	//Kumpulin Data
	    	$poinPlus = Flag::where('flag_submitter', $teamid->team_id)->get();
	    	$poinMinus= Flag::where([['team_id',$teamid->team_id],['flag_isActive','0']])->get();

	    	$poinTotal = 0;
	    	//Generate nilai Plus
	    	foreach($poinPlus as $plus){
				$poin = Soal::select('soal_poin')
					->where('soal_id',$plus->soal_id)
	    			->first();

	    		$poinTotal = $poinTotal + $poin->soal_poin;;
	    	}
	    	//Generate nilai Minus
	    	foreach($poinMinus as $minus){
				$poin = Soal::select('soal_poin')
					->where('soal_id',$minus->soal_id)
	    			->first();

	    		$poinTotal = $poinTotal - $poin->soal_poin;;
	    	}

	    	$allPoin[$count] = $poinTotal;
	    	$count = $count+1;
		}
		return $allPoin;
    }

    public function viewCreateFlag()
    {
        return view('admin/addflag');
    }

    public function submitCreateFlag(Request $request)
    {
        $flag = new Flag();
        $flag->soal_id = $request->input('soal_id');
        $flag->team_id = $request->input('team_id');
        $flag->flag_text = $request->input('flag_text');
        $flag->flag_isActive = '1';
        $flag->flag_submitter = null;
        $flag->flag_timestamp = null;

        $status = $flag->save();

        return redirect()->route('flag.create');
    }

    public function submitYourFlag(Request $request)
    {
    	$teamid = $request->input('team');
    	$soalid = $request->input('soal');
    	$inputflag = $request->input('input_flag');
    	
    	$flag = Flag::where([['team_id',$teamid],['soal_id',$soalid],['flag_text',$inputflag]])->first();
    	
    	if(!$flag){
    		$msg = 'Flag Anda Salah!';
    		return redirect()->route('error')->with(['msg' => $msg]);
    	}

    	if($flag->flag_isActive == 0){
    		$msg = 'Soal Sudah Diselesaikan';
    		return redirect()->route('error')->with(['msg' => $msg]);
    	}
    	if($flag->flag_isActive == 1)
    		//Build variable
     		$submitter = Auth::user()->team_id;
     	 	date_default_timezone_set("Asia/Jakarta");
     		$currentdate = date('Y-m-d H:i:s');

    		$flag->flag_isActive = '0';
    		$flag->flag_submitter = $submitter;
    		$flag->flag_timestamp = $currentdate;

    		$flag->save();

    		return redirect()->route('flag.game');
    }


    /*
    |--------------------------------------------------------------------------
    | Soal Section
    |--------------------------------------------------------------------------
    |
    | Mainin CRUD Soal di sini cuy!
    |
    */
    public function viewSoalForm(){
        return view('admin/soalform');
    }

    public function submitSoal(Request $request){
        $soal = new Soal();
        $soal->soal_desc = $request->input('soal_desc');
        $soal->soal_poin = $request->input('soal_poin');

        $status = $soal->save();

        return redirect()->route('soal.form');
    }

}
