<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplyChain extends Model
{
    protected $primaryKey = 'idSupply';


    protected $fillable = [
        'name',
        'users',
    ];

    public function matters()
    {
        return $this->hasMany(Matter::class, 'supply_chains');
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'supply_chains');
    }
    public function students()
    {
        return $this->hasMany(Students::class, 'supply_chains');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'users');
    }

}

