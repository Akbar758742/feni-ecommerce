<?php

namespace App\Http\Controllers\Frontend;

use App\Models\User;
use Illuminate\Http\Request;
use App\Mail\verificationEmail;
use App\Models\Backend\Product;
use App\Models\Backend\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use SebastianBergmann\CodeUnit\FunctionUnit;

class FrontendController extends Controller
{
        public  function index()
        {
            $categories=Category::with('products')->withCount('products')->where('status',1)->get();



            return view('frontend.home',compact('categories'));

        }
        public function productDetails($id)

        {
            $product=Product::find($id);
            return view('frontend.product-details',compact('product'));
        }

        public function addToCart(Request $request)
        {
            if(!Auth::check())
            {
                return redirect("user-login");
            }



        }

        public function userLogin()
        {
            return view('frontend.auth.login');
        }

        public function userRegister( Request $request)

        {
            $user= new User();
            $user->name=$request->name;
            $user->mobile=$request->mobile;
            $user->email=$request->email;
            $user->otp=rand(10000,99999);
            $user->password=Hash::make($request->password);
            $user->save();

            Mail::to($request->email)->send(new verificationEmail($user->otp));

            return back()->with('success','register successfully');
        }

        public function otpVerification($otp)
        {
          $user=User::where('otp',$otp)->first();
          if($user)
          {
            $user->email_verified_at=date('Y-m-d H:i:s');
            $user->save();
            return redirect('user-login')->with('success','Email verified successfully');
          }
          else
          {
            return back()->with('error','Invalid OTP');
          }
        }

        public function userLoginPost( Request $request){

            $user=User::where('email',$request->email)->first();
            if($user->email_verified_at==null)
            {
                return back()->with('danger','Email not verified');
            }

            $credentials=[
                'email'=>$request->email,
                'password'=>$request->password
            ];
            if(Auth::attempt($credentials))
            {
                return redirect('/')->with('success','Login successfully');
            }
            else
            {
                return back()->with('error','Invalid credentials');
            }

        }

}
