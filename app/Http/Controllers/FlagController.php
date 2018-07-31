<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;
use App\Flag;
use App\User;
use App\Soal;
use App\Game;
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
    | Penilaian score, last submit
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
    	$soal = Soal::select('soal_id','soal_poin')
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
        $dateSubmit = array();
        array_push($dateSubmit,'0000-00-00 00:00:00');
    	//Generate nilai Plus
    	foreach($poinPlus as $plus){
			$poin = Soal::select('soal_poin')
				->where('soal_id',$plus->soal_id)
    			->first();

            $curdate = strtotime($plus->flag_timestamp);
            array_push($dateSubmit,$curdate);
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
            $dateSubmit = array();
            array_push($dateSubmit,'0000-00-00 00:00:00');
	    	//Generate nilai Plus
	    	foreach($poinPlus as $plus){
				$poin = Soal::select('soal_poin')
					->where('soal_id',$plus->soal_id)
	    			->first();

                $curdate = $plus->flag_timestamp;
                array_push($dateSubmit,$curdate);
	    		$poinTotal = $poinTotal + $poin->soal_poin;;
	    	}
	    	//Generate nilai Minus
	    	foreach($poinMinus as $minus){
				$poin = Soal::select('soal_poin')
					->where('soal_id',$minus->soal_id)
	    			->first();

	    		$poinTotal = $poinTotal - $poin->soal_poin;;
	    	}

            $allPoin[$count] = ['teamid' => $teamid->team_id , 'username' => $teamid->team_username , 'poin' => $poinTotal, 'last_submit' => max($dateSubmit)];
	    	$count = $count+1;
		}

        // Pass the array, followed by the column names and sort flags
        $poin  = array_column($allPoin, 'poin');
        $lsubmit  = array_column($allPoin, 'last_submit');

        array_multisort($poin, SORT_DESC, $lsubmit, SORT_ASC, $allPoin);
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
    	
        //Check input teamnya sendiri
        $myid = Auth::user()->team_id;
        if($myid == $teamid){
            $msg = 'Tidak boleh input flag team sendiri!';
            return redirect()->route('error')->with(['msg' => $msg]);
        }

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

    public function viewScore()
    {
        return view('admin/scoreboard');
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

    public function gameStart(Request $request){
       $gameflag = Game::select('config_id','gvalue')
                    ->where([['gvalue','1'],['config_id','1']])
                    ->orWhere([['gvalue','0'],['config_id','1']])
                    ->first();
        if(!$gameflag){
            $gflag = new Game();
            $gflag->gvalue = '1';
            $status = $gflag->save();
        }
        else{
            $gameflag->gvalue = '1';
            $gameflag->save();

        }
                    
        return redirect()->route('admin.dashboard');
    }

    public function gameStop(Request $request){
       $gameflag = Game::select('config_id','gvalue')
                    ->where([['gvalue','1'],['config_id','1']])
                    ->orWhere([['gvalue','0'],['config_id','1']])
                    ->first();

        if(!$gameflag){
            $gflag = new Game();
            $gflag->gvalue = '0';
            $status = $gflag->save();
        }
        else{
            //return $gameflag;
            $gameflag->gvalue = '0';
            $gameflag->save();   
        }
                    
        return redirect()->route('admin.dashboard');
    }

}
