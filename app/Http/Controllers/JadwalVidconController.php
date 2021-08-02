<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\JadwalVidcon;
use Carbon\Carbon;
use Validator;
use DB;

class JadwalVidconController extends Controller
{
    public function store(Request $request){
        $storeData = $request->all();
    
        $validate = Validator::make($storeData, [
            'kondisi' => 'required|max:60',
            'hari' => 'max:60',
            'tanggal' => 'required|date-format:Y-m-d',
            'jenis_bantuan' => 'required|max:60',
            'lokasi' => 'required|max:60',
            'waktu' => 'required|date_format:H:i',
            'acara' => 'required|max:60',
            'penyelenggara' => 'required|max:60',
            'petugas' => 'max:60',
            'no_surat' => 'required|max:60',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $jadwalVidcon = JadwalVidcon::create($storeData);

        $temp = Carbon::parse($jadwalVidcon->tanggal)->format('l');
        if($temp == 'Monday'){
            $jadwalVidcon->hari = 'Senin';
            $jadwalVidcon->save();
        }
        if($temp == 'Tuesday'){
            $jadwalVidcon->hari = 'Selasa';
            $jadwalVidcon->save();
        }
        if($temp == 'Wednesday'){
            $jadwalVidcon->hari = 'Rabu';
            $jadwalVidcon->save();
        }
        if($temp == 'Thursday'){
            $jadwalVidcon->hari = 'Kamis';
            $jadwalVidcon->save();
        }
        if($temp == 'Friday'){
            $jadwalVidcon->hari = 'Jumat';
            $jadwalVidcon->save();
        }
        if($temp == 'Saturday'){
            $jadwalVidcon->hari = 'Sabtu';
            $jadwalVidcon->save();
        }
        if($temp == 'Sunday'){
            $jadwalVidcon->hari = 'Minggu';
            $jadwalVidcon->save();
        }
        // $today = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        // $temp = Carbon::now('Asia/Jakarta')->format('l');
        // $jadwalVidcon->hari = $temp;
        // $jadwalVidcon->save();

        return response([
            'message' => 'Add JadwalVidcon Success',
            'data' => $jadwalVidcon,
        ],200);
    }

    public function index(){
        // $jadwalVidcon = JadwalVidcon::all();
        $jadwalVidcon=DB::table('jadwalvidcon')
        -> orderby('tanggal')
        -> get();   

        if(count($jadwalVidcon) > 0){
            return response([
                'message' => 'Retrieve All Success',
                'data' => $jadwalVidcon
            ],200);
        }
        
        return response([
            'message' => 'Empty',
            'data' => null
        ],404);
    }

    public function show($id){
        $jadwalVidcon = JadwalVidcon::find($id);

        if(!is_null($jadwalVidcon)){
            return response([
                'message' => 'Retrieve JadwalVidcon Success',
                'data' => $jadwalVidcon
            ],200);
        }

        return response([
            'message' => 'JadwalVidcon Not Found',
            'data' => null
        ],404);   
    }

    public function showJadwalToday(){
        // $jadwalVidcon = JadwalVidcon::find($id);
        $jadwalToday = Carbon::now('Asia/Jakarta')->format('Y-m-d');

        $jadwalVidcon=DB::table('jadwalvidcon')
        -> where('tanggal','=',$jadwalToday)
        -> orderby('tanggal')
        -> get();    

        if(!is_null($jadwalVidcon)){
            return response([
                'message' => 'Retrieve JadwalVidcon Success',
                'data' => $jadwalVidcon
            ],200);
        }

        return response([
            'message' => 'JadwalVidcon Not Found',
            'data' => null
        ],404);   
    }

    public function destroy($id){
        $jadwalVidcon = JadwalVidcon::find($id);

        if(is_null($jadwalVidcon)){
            return response([
                'message' => 'JadwalVidcon Not Found',
                'data' => null
            ],404);
        }

        if($jadwalVidcon->delete()){
            return response([
                'message' => 'Delete JadwalVidcon Success',
                'data' => $jadwalVidcon,
            ],200);
        }

        return response([
            'message' => 'Delete JadwalVidcon Failed',
            'data' => null,
        ],400);
    }

    public function update(Request $request, $id){
        $jadwalVidcon = JadwalVidcon::find($id);
        if(is_null($jadwalVidcon)){
            return response([
                'message' => 'JadwalVidcon Not Found',
                'data' => null
            ],404);
        }

        $updateData = $request->all();
        $validate = Validator::make($updateData, [
            'kondisi' => 'max:60',
            'hari' => 'max:60',
            'tanggal' => 'date-format:Y-m-d',
            'jenis_bantuan' => 'max:60',
            'lokasi' => 'max:60',
            'waktu' => 'max:60',
            'acara' => 'max:60',
            'penyelenggara' => 'max:60',
            'petugas' => 'max:60',
            'no_surat' => 'max:60',
        ]);

        if($validate->fails())
            return response(['message' => $validate->errors()],400);

        $jadwalVidcon->kondisi = $updateData['kondisi'];
        // $jadwalVidcon->hari = $updateData['hari'];
        $jadwalVidcon->tanggal = $updateData['tanggal'];
        $jadwalVidcon->jenis_bantuan = $updateData['jenis_bantuan'];
        $jadwalVidcon->lokasi = $updateData['lokasi'];
        $jadwalVidcon->waktu = $updateData['waktu'];
        $jadwalVidcon->acara = $updateData['acara'];
        $jadwalVidcon->penyelenggara = $updateData['penyelenggara'];
        $jadwalVidcon->petugas = $updateData['petugas'];
        $jadwalVidcon->no_surat = $updateData['no_surat'];

        // $today = Carbon::now('Asia/Jakarta')->format('Y-m-d');
        // $temp = $jadwalVidcon->tanggal;
        // $temp = Carbon::now('Asia/Jakarta')->format('l');
        $temp = Carbon::parse($jadwalVidcon->tanggal)->format('l');
        if($temp == 'Monday'){
            $jadwalVidcon->hari = 'Senin';
            $jadwalVidcon->save();
        }
        if($temp == 'Tuesday'){
            $jadwalVidcon->hari = 'Selasa';
            $jadwalVidcon->save();
        }
        if($temp == 'Wednesday'){
            $jadwalVidcon->hari = 'Rabu';
            $jadwalVidcon->save();
        }
        if($temp == 'Thursday'){
            $jadwalVidcon->hari = 'Kamis';
            $jadwalVidcon->save();
        }
        if($temp == 'Friday'){
            $jadwalVidcon->hari = 'Jumat';
            $jadwalVidcon->save();
        }
        if($temp == 'Saturday'){
            $jadwalVidcon->hari = 'Sabtu';
            $jadwalVidcon->save();
        }
        if($temp == 'Sunday'){
            $jadwalVidcon->hari = 'Minggu';
            $jadwalVidcon->save();
        }
        // $jadwalVidcon->hari = $temp;
        // $jadwalVidcon->save();

        if($jadwalVidcon->save()){
            return response([
                'message' => 'Update JadwalVidcon Success',
                'data' => $jadwalVidcon,
            ],200);
        }
        return response([
            'message' => 'Update JadwalVidcon Failed',
            'data' => null,
        ],400);
    }
    
}
