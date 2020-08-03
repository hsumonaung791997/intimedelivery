<?php

namespace App\Http\Controllers\admin;

use App\AccountHead;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountHead;

class AccountHeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.account-head.index', [
            'result' => AccountHead::paginate(20),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.account-head.create',[
            'credit' => config('account-head.type.0'),
            'debit' => config('account-head.type.1'),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountHead $request)
    {
        AccountHead::create($request->all());
        return redirect(route('account.head.index'));
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
    public function edit(AccountHead $account_id)
    {
        return view('admin.account-head.create', [
            'result' => $account_id,
            'credit' => config('account-head.type.0'),
            'debit' => config('account-head.type.1'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreAccountHead $request, AccountHead $account_id)
    {
        $account_id->update($request->all());
        return redirect(route('account.head.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountHead $account_id)
    {
        $account_id->delete();
        return redirect(route('account.head.index'));
    }
}
