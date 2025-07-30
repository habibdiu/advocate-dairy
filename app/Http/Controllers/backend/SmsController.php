<?php

namespace App\Http\Controllers\backend;

use PDOException;
use Illuminate\Support\Facades\File;
use App\Models\SmsHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Routing\Controllers\HasMiddleware;
use App\Http\Middleware\backendAuthenticationMiddleware;
use Illuminate\Support\Facades\Auth;

class SmsController extends Controller implements HasMiddleware
{
    public static function middleware()
    {
        return [
            backendAuthenticationMiddleware::class
        ];
    }

    public function sms_add(Request $request)
    {
        $data = [];
        if ($request->isMethod('post')) {
            
            try {
                SmsHistory::create([
                    'branch_id' => $request->branch_id,
                    'send_date_time' => $request->send_date_time,
                    'message' => $request->message,
                    'receiver_numbers' => $request->receiver_numbers,
                    'total_receivers' => $request->total_receivers,
                    'sms_parts' => $request->sms_parts,
                    'total_sms_cost' => $request->total_sms_cost,
                    'sms_sent_status' => $request->sms_sent_status,
                    'created_by'=>Auth::user()->id
                ]);
                
                return back()->with('success', 'Added Successfully');
            } catch (PDOException $e) {
                return back()->with('error', 'Failed Please Try Again');
            }
        }
        $data['active_menu'] = 'sms_add';
        $data['page_title'] = 'SMS Add';
        return view('backend.pages.sms_add', compact('data'));
    }
    
    public function sms_list()
    {
        $data = [];
        $data['sms_list'] = SmsHistory::all();
        $data['active_menu'] = 'sms_list';
        $data['page_title'] = 'SMS List';
        return view('backend.pages.sms_list', compact('data'));
    }
    public function sms_delete($id)
    {
        $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];
        $sms = SmsHistory::find($id);
        if ($sms) {
            if (File::exists($sms->photo)) {
                File::delete($sms->photo);
            }
            $sms->delete();
            $server_response =  ['status' => 'SUCCESS', 'message' => 'Deleted Successfully'];
        } else {
            $server_response =  ['status' => 'FAILED', 'message' => 'Not Found'];
        }
        echo json_encode($server_response);
    }
}
