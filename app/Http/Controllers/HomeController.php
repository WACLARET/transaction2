<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\home;
use View;
use Auth;
use DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */


    public function index(Request $request) {
        try{
            // $balance = 0;
         $current_logged_in = Auth::User()->phoneNumber;
         $all_deposits = DB::table('homes')->where('phoneNumber', '=' , $current_logged_in )->pluck("deposit")->sum();
         $all2_deposits = DB::table('withdraws')->where('phoneNumber', '=' , $current_logged_in )->pluck("withdraw")->sum();
         $withdraw = DB::table('cashes')->where('phoneNumber', '=' , $current_logged_in )->pluck("amount")->sum();
        
        //  dd($all_deposits);
         $balance = $all_deposits - $all2_deposits;

         $finalbalance = $balance - $withdraw;
//  dd($finalbalance);


        //  if ($all_deposits < $all2_deposits){
        //     $request->session()->flash('alert-danger', ' insuff funds');
        //  }
        // else
    
         return view('home', ['deposits'=>$finalbalance]);
        }
            
        catch (Exception $e){
            return redirect('/home')->with('failed','Failed');
        }
      }
    public function submit(Request $request){
        try { 
       
      
        $current_logged_in = Auth::user()->phoneNumber;
        
                // $count_value = count($all_candidates);
                // $candidate_number = $count_value + 1;

                $message = new home;
                // $message->phoneNumber = $custom_number; 
                $message->phoneNumber = $current_logged_in;
                $message->deposit=$request->input('deposit');
                $message->save(); //save the message
                $request->session()->flash('alert-success', ' Success Deposit');
                return redirect('/home');
            
        }
        
        catch (Exception $e){
            return redirect('/home')->with('failed','Deposit Failed');
        }   
    }

    // public function getdeposit() {        
    //     $current_logged_in = Auth::user()->phoneNumber;
    //     // $sort = addCampaign::where('event_creator_id', $current_logged_in)->sortable()->paginate(5);
    //     return view('home')->with('deposits');
    //   }

    



}
