<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AccountHead extends Model
{
  protected $fillable = [ 'account_id', 'name', 'type'];

  public function getRouteKeyName()
  {
    return 'account_id';
  }

  public function accountheadledgers()
  {
    return $this->hasMany(AccountHeadLedger::class);
  }

  public function getCrTotalAttribute()
  {
    return $this->accountheadledgers->sum('cr_amount');
  }

  public function getDrTotalAttribute()
  {
    return $this->accountheadledgers->sum('dr_amount');
  }

}
