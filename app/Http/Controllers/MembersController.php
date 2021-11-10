<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class MembersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $message = '';
        if (session()->has('message')) {
            $message = session()->get('message');
        }
        $users = new User();
        $userList = $users->select(['id','name','email','status'])->get();
        return view('members.index',compact('message', 'userList'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $previous = url()->previous();
        return view('members.create',compact('previous'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|unique:users|string',
            'password' => 'present',
            'password_type' => 'present'
        ]);

        $message = 'Usuário criado com sucesso, a senha de acesso definida é ';

        if($input['password_type'] == 1) {
            $returnPassword = $input['password'] = $this->passwordGenerator(8);
            $message .= $returnPassword;
        } else {
            $message .= $input['password'];
        }

        $input['password'] = Hash::make($input['password']);
        
        User::create($input);

        return redirect()->to(route('members.index'))->with('message',$message);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit($member)
    {
        $previous = url()->previous();
        $user = User::find($member);
        return view('members.edit',compact('user', 'previous'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $member)
    {
        $input = $request->validate([
            'name' => 'required|string',
            'email' => 'required|string',
            'password_type' => 'present'
        ]);

        $message = 'Usuário atualizdo com sucesso';

        if ($input['password_type'] == 1){
            $input['password'] = $this->passwordGenerator(8);
            $message .= ' e a senha foi alterada para '.$input['password'];
            $input['password'] = Hash::make($input['password']);
        }

        User::find($member)->update($input);

        return redirect()->to(route('members.index'))->with('message',$message);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy($member)
    {
        User::destroy($member);
        $message = 'Usuário deletado com sucesso';
        
        return redirect()->to(route('members.index'))->with('message',$message);

    }
}
