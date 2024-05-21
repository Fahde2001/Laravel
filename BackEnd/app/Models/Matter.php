<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Matter extends Model
{
    protected $primaryKey = 'idMatter';
    protected $fillable = ['name', 'cof', 'supply_chains', 'user'];

    public function notes()
    {
        return $this->hasMany(Note::class, 'matter');
    }

    public function users()
    {
        return $this->belongsTo(User::class, 'user');
    }
    public function supplyChain()
    {
        return $this->belongsTo(SupplyChain::class, 'supply_chains');
    }
}
