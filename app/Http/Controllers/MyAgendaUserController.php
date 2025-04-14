<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\MyAgenda_user;

class MyAgendaUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = MyAgenda_user::all();
        return view('myagenda_user.index', compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('myagenda_user.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'myagenda_user_nama' => 'required|string|max:100',
            'myagenda_user_email' => 'required|email|unique:myagenda_user,myagenda_user_email',
            'myagenda_user_password' => 'required|string|min:3',
        ]);

        MyAgenda_user::create([
            'myagenda_user_nama' => $request->myagenda_user_nama,
            'myagenda_user_email' => $request->myagenda_user_email,
            'myagenda_user_password' => bcrypt($request->myagenda_user_password),
            'myagenda_user_role' => 'pengguna'
        ]);

        return redirect()->route('myagenda_user.index')->with('succes', 'Data pengguna berhasil ditambahkan');
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
    {
        $user = MyAgenda_user::findOrFail($id);
        return view('myagenda_user.edit', compact('user'));
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
        $request->validate([
            'myagenda_user_nama' => 'required|string|max:100',
            'myagenda_user_email' => 'required|email|unique:myagenda_user,myagenda_user_email',
            'myagenda_user_password' => 'nullable|string|min:3',
        ]);

        $user = MyAgenda_user::findOrFail($id);
        if ($request->filled('myagenda_user_password')) {
            $data['myagenda_user_password'] = bcrypt($request->myagenda_user_password);
        }

        $user->update([
            'myagenda_user_nama' => $request->myagenda_user_nama,
            'myagenda_user_email' => $request->myagenda_user_email,

        ]);

        return redirect()->route('myagenda_user.index')->with('succes', 'Data pengguna berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user= MyAgenda_user::findOrFail($id);
        $user->delete();

        return redirect()->route('myagenda_user.index')->with('succes', 'Data pengguna berhasil dihapus');
    }
}
