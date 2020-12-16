<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data = User::all([
            'id',
            'name',
            'email',
            'created_at'
        ]);

        return $this->success([
            'data'      => $data,
            'header'    => [
                [
                    'text'  => 'ID',
                    'value' => 'id'
                ],
                [
                    'text'  => 'Name',
                    'value' => 'name'
                ],
                [
                    'text'  => 'Email',
                    'value' => 'email'
                ],
                [
                    'text'  => 'Actions',
                    'value' => 'actions'
                ],
            ]
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $data = collect($request->validate([
            'id'        => 'nullable',
            'name'      => 'required',
            'email'     => ['required',  Rule::unique('users')->ignore($request->input('id')), 'email'],
        ]));

        if (isset($data['id'])) {
            $user = User::find($data['id'])->update($data->except('role')->toArray());
            $user = User::find($data['id']);
        } else {
            unset($data['id']);
            $user = User::create($data->except('role')->toArray());
        }

        $user->syncRoles($data->get('role'));

        return $this->success();
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
