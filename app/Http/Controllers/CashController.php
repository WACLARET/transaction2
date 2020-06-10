<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Cash;
use View;
use Auth;
use DB;

class CashController extends Controller
{
    public function cash(Request $request){
        try { 
        $current_logged_in = Auth::user()->phoneNumber;
        
                // $count_value = count($all_candidates);
                // $candidate_number = $count_value + 1;

                $message = new cash;
                // $message->phoneNumber = $custom_number; 
                $message->phoneNumber = $current_logged_in;
                $message->amount=$request->input('amount');
                $message->pNumber=$request->input('pNumber');
               
                $user = Cash::where('phoneNumber', '=', $request->pNumber)->first();
                if (!$user) {
                    // user doesn't exist
                    $request->session()->flash('alert-danger', ' number does not exist');
                    return redirect('/home');
                 }
                if($user){
                    $message->save(); //save the message
                    $request->session()->flash('alert-success', ' Success Transfer');
                    return redirect('/home');
                }
                
                    // $message->save(); //save the message
                    // $request->session()->flash('alert-success', ' Success Transfer');
                    // return redirect('/home');
                
        }
        
        catch (Exception $e){
            return redirect('/home')->with('failed','Deposit Failed');
        }   
    }
} 
