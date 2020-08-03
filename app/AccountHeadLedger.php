<?php

namespace App;

use App\AccountHead;
use Illuminate\Database\Eloquent\Model;

class AccountHeadLedger extends Model
{
    protected $fillable = [
    	'account_head_id', 
    	'account_head_account_id',
    	'account_name',
    	'dr_amount', 
    	'cr_amount', 
    	'date', 
    	'postman_name',
        'remark',

    ];

    public function accounthead()
    {
    	return $this->belongsTo(AccountHead::class, 'account_head_id', 'id');
    }
}
