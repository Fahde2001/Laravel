<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Note extends Model
{
    protected $primaryKey = 'idNote';
    protected $fillable=[
        'note',
        'mattreName',
        'coefficient',
        'supply_chains',
        'student'
    ];
    public function supplyChain()
    {
        return $this->belongsTo(SupplyChain::class, 'supply_chains');
    }

    public function student()
    {
        return $this->belongsTo(Students::class, 'student');
    }


}
