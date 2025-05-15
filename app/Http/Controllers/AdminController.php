<?php

namespace App\Http\Controllers;

use App\Http\Requests\register_userRequest;
use App\Http\Requests\UserRequest;
use App\Mail\send_mail;
use App\Models\Course;
use App\Models\Menu;
use App\Models\Slider;
use App\Models\User;
use App\Traits\mail_reset_pass;
use App\Traits\StorageImageTrait;
use DB;
use Hash;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Mail;
use Log;
use Str;
use Validator;

class AdminController extends Controller
{

    use StorageImageTrait;
    use mail_reset_pass;

    public function loginAdmin()
    {

        return view('login');
    }

    public function postLoginAdmin(Request $request)
    {
       
        $remember = $request->has('remember_me') ? true : false;
        if (
            auth()->attempt([
                'email' => $request->email,
                'password' => $request->password
            ], $remember)
        ) {
            //id_role = 2
            if (auth()->user()->roles->contains('id', 2)) {
                return redirect()->route('homePage');

            } else {
                return redirect('home');

            }

            

        }
        $status['value'] = "username or pass not correct!";
        return view('login', compact('status'));


    }

    public function logout(Request $request)
    {

        Auth::logout();

        $request->session()->invalidate();
        
        $request->session()->regenerateToken();
        Cache::flush();
        $sliderList = Slider::all();
        $menu_list = Menu::all();
        

        return redirect()->route('general');
    }

    public function register(Request $request)
    {
        return view('register');
    }

    public function post_register(register_userRequest $request)
    {

        DB::beginTransaction();

        $data = $this->storageTraitUpload($request, "file_path", 'User');
        // dd($data);

        $user = User::firstOrCreate([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'avatar_image_path' => $data['file_path']
        ]);
        $user->roles()->attach($request->role);

        DB::commit();
        $test = "Đăng kí thành công ";
        return redirect()->route('login', compact('test'));
    }

    public function reset_pass(){
        
        return view('foget_password');

    }

    public function get_pass(Request $request){
        $user = new User;
       
        try{
            $pass = $user->get_New_Pass($request->email);
            ///dd($pass);
            if($pass == ""){
                $status['value'] = "email  not correct!";
                return view('foget_password', compact('status'));

            }
            else{
                $this->mail_reset_pass($user, $request->email);
          
            return redirect()->route('login');

            }
            

        }
        catch (\Exception $e) {
            Log::error('message' . $e->getMessage() . 'Line' . $e->getLine());
            $status['value'] = "email  not correct!";
            return view('foget_password', compact('status'));
        }

       
      

    }

   




}