<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\detail;
use Carbon\Carbon;
class PanelController extends Controller
{
    protected $user;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            $this->user = Auth::user();

            return $next($request);
        });
    }

        //Login Page
    public function index()
    {
       return view('index');
    }

     //Dashboard
    public function dashboard()
    {
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
        $summ=detail::orderBy('id','desc')->where('latest',0)->get();
        $buyer=User::where('userRole',2)->orderBy('id','desc')->where('status',0)->get();
        $count=count($summ);
        return view('panel.dashboard')->with(array('count'=>$count,'summ'=>$summ,'buyer'=>$buyer));
    }


     //Dashboard
    public function del_buyer_list()
    {
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
        $buyer=User::where('userRole',2)->orderBy('id','desc')->where('status',1)->get();
        return view('panel.delbuyer',['buyer'=>$buyer]);
    }
    
    //Del User
    public function del_user($id)
    {
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
        User::where('id',$id)->update(['status'=>1]);
        return redirect()->back()->with('success','User Deleted');
    }
    
    
    //Del Order
    public function del_order($id)
    {
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
        detail::where('id',$id)->update(['status'=>2]);
        return redirect()->back()->with('success','Order Deleted Successfully');
    }
    
    //Complete Order
    public function complete_order($id)
    {
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
        detail::where('id',$id)->update(['status'=>1]);
        return redirect()->back()->with('success','Order Completed Successfully');
    }

    //Active User
    public function active_user($id)
    {
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
        User::where('id',$id)->update(['status'=>0]);
        return redirect()->back()->with('success','Buyer Activated');
    }
    
    //Edit User
    public function edit_user($id)
    {
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
       $user=User::find($id);
       return view('panel.edit_user')->with('user',$user);
    }
    
    
    //Detail User
    public function detail_user($id)
    {
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
       $user=User::find($id);
       $active=detail::where('user',$id)->where('status',0)->get();
       $del=detail::where('user',$id)->where('status',2)->get();
       $completed=detail::where('user',$id)->where('status',1)->get();
       return view('panel.detail')->with(array('del'=>$del,'completed'=>$completed,'user'=>$user,'active'=>$active));
    }
    
    //Summary Orders
    public function summary()
    {
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
       $active=detail::where('status',0)->get();
       $del=detail::where('status',2)->get();
       $comp=detail::where('status',1)->get();
       $summ=detail::orderBy('id','desc')->get();
       return view('panel.summary')->with(array('summ'=>$summ,'active'=>$active,'del'=>$del,'comp'=>$comp));
    }
    
    
    //Add Oredr
    public function order(Request $request)
    {
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
       if(isset($request->submit) && $request->submit == 'Submit')
       {
           $this->validate($request,[
               'product'=>'required',
               'id'=>'required|numeric',
               'purchase_rate'=>'required|numeric',
               'dc'=>'required|numeric',
               'sale_rate'=>'required|numeric'
           ]);
        $order=new detail;
        $order->user=$request->id;
        $order->description=$request->product;
        $order->purchase_rate=$request->purchase_rate;
        $order->dc=$request->dc;
        $order->sale_rate=$request->sale_rate;
        $profit=($request->sale_rate)-($request->purchase_rate+$request->dc);
        $order->profit=$profit;
        $order->save();
        return redirect()->back()->with('success','Order Added Successfully');
       }
       
    }


     //Add Buyer
    public function signup(Request $request)
    {
      
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
        if(isset($request->submit) && $request->submit == 'Submit')
        {
            $this->validate($request,[
                'name'=>'required',
                'phone'=>'required|unique:users,email'
            ]);
            $user=new User;
            $user->name=$request->name;
            $user->email=$request->phone;
            $user->password=bcrypt(1122);
            $user->userRole=2;
            $user->save();
            return redirect()->back()->with('success','User Added');

        }
    }
    
    
    //Update Buyer
    public function edit_user_db(Request $request,$id)
    {
      
        if (Auth::check()) {
            if(Auth::user()->userRole != 1)
            {
                return redirect('/');
            }
        }
        else
        {
            return redirect('/');
        }
        if(isset($request->submit) && $request->submit == 'Update')
        {
            $this->validate($request,[
                'name'=>'required',
                'phone'=>'required'
            ]);
            $user=User::find($id);
            if($user->email != $request->phone)
            {
                $this->validate($request,[
                    'phone'=>'unique:users,email'
                ]);
            }
            $user->name=$request->name;
            $user->email=$request->phone;
            $user->save();
            return redirect()->back()->with('success','User Updated');

        }
    }

}
