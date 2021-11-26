<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Account;

class AccountController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Account::select(['uid', 'name'])->get();
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
            'key' => ['required', 'unique:accounts'],
            'secret' => ['required', 'unique:accounts'],
            'name' => ['max:256']
        ]);
        $account = Account::create($request->only(['uid', 'name', 'key', 'secret', 'is_enabled']));
        $account->save();
        return $account;
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function show(string $uid)
    {
        return Account::find($uid)->load(['todos']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, string $uid)
    {
        $account = Account::find($uid);
        $account->update($request->only(['name', 'key', 'secret', 'is_enabled']));
        return $account;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $uid
     * @return \Illuminate\Http\Response
     */
    public function destroy(string $uid)
    {
        return Account::destroy($uid);
    }
}
