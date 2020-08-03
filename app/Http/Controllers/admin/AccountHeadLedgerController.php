<?php

namespace App\Http\Controllers\admin;

use App\AccountHead;
use App\AccountHeadLedger;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAccountHeadLedger;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Excel;

use Auth;

class AccountHeadLedgerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.account-head-ledger.index', [
            'result' => AccountHeadLedger::orderBy('account_head_id')->paginate(20),
        ]);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.account-head-ledger.create',[
            'accountheads' => AccountHead::all(),
            'postmen' => DB::select('select * from delivery_postman'),
            

        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\Response
     */
    public function store(StoreAccountHeadLedger $request)
    {
        // dd($request->amount);
        $acc_head = AccountHead::find($request->account_head_id);
        AccountHeadLedger::create([
            'account_head_id' => $acc_head->id,
            'account_head_account_id' => $acc_head->account_id,
            'account_name' => $acc_head->name,
            'dr_amount' => $acc_head->type === 'Debit' ? $request->amount : '',
            'cr_amount' => $acc_head->type === 'Credit' ? $request->amount : '',
            'date' => $request->date,
            'postman_name' => $request->postman_name,
            'remark' => $request->remark,
        ]);
        return redirect(route('account.head.ledger.index'));
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
    public function edit(AccountHeadLedger $ledger)
    {
        return view('admin.account-head-ledger.create',[
            'result' => $ledger,
            'accountheads' => AccountHead::all(),
            'postmen' => DB::select('select * from delivery_postman'),
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(AccountHeadLedger $ledger,StoreAccountHeadLedger $request)
    {
        $acc_head = AccountHead::find($request->account_head_id);
        $ledger->update([
            'account_head_id' => $acc_head->id,
            'account_head_account_id' => $acc_head->account_id,
            'account_name' => $acc_head->name,
            'dr_amount' => $acc_head->type === 'Debit' ? $request->amount : '',
            'cr_amount' => $acc_head->type === 'Credit' ? $request->amount : '',
            'date' => $request->date,
            'postman_name' => $request->postman_name,
            'remark' => $request->remark,
        ]);
        return redirect(route('account.head.ledger.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(AccountHeadLedger $ledger)
    {
      $ledger->delete();
      return redirect(route('account.head.ledger.index'));
  }

  public function summary()
  {
      return view('admin.account-head-ledger.summary', [
        'result' => AccountHead::paginate(20),
    ]);
  }

  public function search_ledger(Request $request)
  {
      $name_date=date("Y/m/d H:i:sa");
    $start_date = $request->input('start_date');
    $end_date = $request->input('end_date');
    $query = "SELECT * from account_head_ledgers as ah";
    
    if($start_date !=null && $end_date !=null){
  
    $query=$query.(" WHERE ah.date BETWEEN '$start_date' AND '$end_date' 
        ");
    }
      
    
     $response=DB::select($query.(" ORDER BY ah.id DESC"));
    // dd($result);
    if(Input::get('search'))
    {
        $page = LengthAwarePaginator::resolveCurrentPage();
        $pageSize = 100;
         $res = array_slice($response, $pageSize * ($page - 1), $pageSize, true);
        $result = new \Illuminate\Pagination\LengthAwarePaginator($res, count($response), $pageSize, $page);
        return view('admin.account-head-ledger.search', compact('result'));

    }    
    if(Input::get('print')){

        $data= json_decode( json_encode($response), true);

       return Excel::create('ledger'.$name_date, function($excel) use ($data) {
           $excel->sheet('mySheet', function($sheet) use ($data)
           {
            $sheet->cell('A1', function($cell) {$cell->setValue('no');});
            $sheet->cell('B1', function($cell) {$cell->setValue('Account Head ID');});
            $sheet->cell('C1', function($cell) {$cell->setValue('Account Head Account ID');});
            $sheet->cell('D1', function($cell) {$cell->setValue('Account Head Name');});
            $sheet->cell('E1', function($cell) {$cell->setValue('Dr Amount');});
            $sheet->cell('F1', function($cell) {$cell->setValue('Cr Amount');});
            $sheet->cell('G1', function($cell) {$cell->setValue('Date');});
            $sheet->cell('H1', function($cell) {$cell->setValue('Postman Name');});
            $sheet->cell('I1', function($cell) {$cell->setValue('Remark');});
            $j=1;
            if (!empty($data)) {
                
               foreach ($data as $key => $value) {
                   $i= $key+2;
     
                   $sheet->cell('A'.$i, $j++);
                   $sheet->cell('B'.$i, $value['account_head_id']);
                   $sheet->cell('C'.$i, $value['account_head_account_id']);
                   $sheet->cell('D'.$i, $value['account_name']);
                   $sheet->cell('E'.$i, $value['dr_amount']);
                   $sheet->cell('F'.$i, $value['cr_amount']);
                   $sheet->cell('G'.$i, $value['date']);
                   $sheet->cell('H'.$i, $value['postman_name']);
                   $sheet->cell('I'.$i, $value['remark']);
               }
           }
       });
       })->download("csv");

   }







}
}
