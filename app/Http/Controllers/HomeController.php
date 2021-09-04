<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use DB;
use App\Models\Subjecttable;
use App\Models\Timeallot;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        /*$this->middleware('auth');*/
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }


    public function submit(Request $request){

        $validatedData = $request->validate([
            'perdaysub' => 'required',
            'totsub' => 'required',
            'hrworkdays' => 'required|integer|between:1,9',
            'workdays' => 'required|integer|between:1,7',
            
            
        ],
        [
            'perdaysub.required' => 'Please Input perdaysub',
            'totsub.required' => 'Please Input totsub',
            'hrworkdays.required' => 'Please Input hrworkdays',
            'workdays.required' => 'Please Input workdays',
             
           
        ]);

        $dataid = Timeallot::insertGetId(
              [ 'Working_days' => $request->workdays,
                'working_hours_per_day'=>$request->hrworkdays,
                'Total_Subjects'=>$request->totsub,
                'subjects_per_day'=>$request->perdaysub


              ]);

        Session::put(['totalsub' => $request->totsub,
                    'total' => $request->total,
                    'cid'=>$dataid,
                    'workday'=>$request->workdays,
                    'subjects_per_day'=>$request->perdaysub
                        ]);
       /* return back()->with('success', 'successfully.');*/
        return Redirect()->route('subjectform',$dataid);
    }


    public function subjectform($id){

      
        
        return view('subjectform')->with(['id'=>$id]);
    }

    public function generate(Request $request){
$id=$request->id;
        $cnt=0;
                 for($i=0;$i<sizeof($request->get('subhr'));$i++)
                 {


                    
                        $cnt=$cnt+$request->get('subhr')[$i];
                        
                    }

                    if($cnt==Session::get('total'))
                        {
                            for($i=0;$i<sizeof($request->get('subhr'));$i++)
                                {

                                $dataid = Subjecttable::insertGetId(
                                [ 'subject_name' => $request->get('subjectname')[$i],
                                          'subject_hr'=>$request->get('subhr')[$i],
                                          'c_id'=>Session::get('cid') ]
                                    );
                                 }

                                
                                 return redirect()->route('table',$id);
                      

                        }else{
                            return back()->with('error', 'not match your total hrs');

                        }



    }

    public function table($id){

                $data1=Timeallot::find($id);

                $data = DB::table('subjecttables')
            ->select(['subjecttables.subject_hr as hr','subjecttables.subject_name as name'])
            
                ->where('c_id',$data1->id)
             
    
    
                ->get();


              
              
               return view('timetable',compact('data'));


    }
                 


    
}
