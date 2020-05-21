<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Withdraw;
use View;
use Auth;
use DB;

class WithdrawController extends Controller
{
    public function withdraw(Request $request){
        try { 
       
      
        $current_logged_in = Auth::user()->phoneNumber;
        $all_deposits = DB::table('homes')->where('phoneNumber', '=' , $current_logged_in )->pluck("deposit")->sum();
        // dd($all_deposits);
        
                // $count_value = count($all_candidates);
                // $candidate_number = $count_value + 1;

                $message = new withdraw;
                // $message->phoneNumber = $custom_number; 
                $message->phoneNumber = $current_logged_in;
                
                if($request->input('withdraw') > $all_deposits){
                    $request->session()->flash('alert-danger', ' Insuficient Balance');
                    return redirect('/home');
                } else  {
                    $message->withdraw=$request->input('withdraw');
                    $message->save(); //save the message
                    $request->session()->flash('alert-success', ' Success Withdraw');
                    return redirect('/home');
                }           
                
            
        }
        
        catch (Exception $e){
            return redirect('/home')->with('failed','Deposit Failed');
        }   
    }
}
