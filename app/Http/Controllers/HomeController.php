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
         $current_logged_in = Auth::User()->phoneNumber;
         $all_deposits = DB::table('homes')->where('phoneNumber', '=' , $current_logged_in )->get();
         
        //  ->select(DB::raw("SUM(deposit) as count"))->where('phoneNumber', '=' , $current_logged_in)->get();
         
        //  ->where('phoneNumber', '=' , $current_logged_in )->get();
    
         return view('home', ['deposits'=>$all_deposits]);
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

    public function getdeposit() {        
        $current_logged_in = Auth::user()->phoneNumber;
        // $sort = addCampaign::where('event_creator_id', $current_logged_in)->sortable()->paginate(5);
        return view('home')->with('deposits');
      }



}
