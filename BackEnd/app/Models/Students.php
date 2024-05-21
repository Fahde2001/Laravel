<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Students extends Model
{
    protected $primaryKey = 'idStudent';
    protected $fillable=[
        'name',
        'age',
        'supplyChainName',
        'supply_chains',
        'user_id'
    ];


    public function users()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
    public function supplyChains()
    {
        return $this->belongsTo(SupplyChain::class, 'supply_chains');
    }
    public function notes()
    {
        return $this->hasMany(Note::class, 'idStudent');
    }
}

