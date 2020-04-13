<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ManageUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   $user = auth()->user();

        $data['users'] = User::where('id','!=', $user->id)->paginate(5);
        return view('manageusers',$data);
    }

    public function search(Request $request)
    {   $user = auth()->user();
        $search = $request->get('search');
        $data['users'] = User::where('name', 'like', '%'.$search.'%')->where('id','!=', $user->id)->Paginate(5);
        return view('manageusers', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       return view('auth/newuser');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
      /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function store(request $request ) 
    {   $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);    
        $user = new User ([
                'name' => $request->get('name'),
                'email' => $request->get('email'),
                'password' => Hash::make($request->get('password')),
                'user_level' =>$request->get('user_level')
            ]);

        $user->save();
        return redirect()->route('manageusers')->with('success','User was successfully created.');
       
             
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   $user = auth()->user();

        if($id!=$user->id){
            $data['user'] = User::find($id);
            if($data['user']['user_level']==0)
            {
                $data['selected0']="selected='selected'";
            }
            else if($data['user']['user_level']==1)
            {
                $data['selected1']="selected='selected'";
            }
            return view('auth/edit', $data);
        }
        else{
            return redirect()->route('manageusers')->with('error','You cannot edit your own account in this section.');
        }
        
    }

    public function changepassword()
    {
        return view('mypwdchange');
    }

    public function changepasswordstore()
    {   $currentuser = auth()->user();
        if($currentuser)
        {
            $user = User::where('id', $currentuser->id)->first();
            $this->validate($request, ['password' => ['required', 'string', 'min:8', 'confirmed']]);
            $user->password = Hash::make($request->get('password'));
            $user->save();
            return redirect()->route('changepwd')->with('success','Password was successfully changed.');
        }
        else
        {
            return redirect()->route('changepwd')->with('error','Failed.');
        }  
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $user = User::where('id', $id)->first();
        
            if($user)
            {   $this->validate($request, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
        ]);   
                $user->email = $request->get('email');
                $user->name = $request->get('name');
                if($request->get('password')!="")
                {   $this->validate($request, ['password' => ['required', 'string', 'min:8', 'confirmed']]);
                    $user->password = Hash::make($request->get('password'));
                }
                $user->user_level = $request->get('user_level');
                $user->save();
                return redirect()->route('manageusers')->with('success','User was successfully updated.');
            }
            else{
                return redirect()->route('manageusers')->with('error','Unfortunately an error has occurred.');
            }
            
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $loggeduser = auth()->user();

        if($id!=$loggeduser->id){
            $user = User::find($id); 

            if($user) {
    
                $user->delete();
                $success= true;
    
            }
            else{
                $success= false;
            }
            
            if($success==true)
            {
                return redirect()->route('manageusers')->with('success','User was successfully deleted.');
            }
            else{
                return redirect()->route('manageusers')->with('error','Failed.');
            }
        }
        else{
            return redirect()->route('manageusers')->with('error','You cannot delete your own account.');
        }
        
       
    }
}
