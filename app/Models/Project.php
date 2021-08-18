<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'rate',
        'budget',
        'final_price',
        'location',
        'status',
        'owner_id',
        'developer_id',
        'category_id',
        'image'

    ];
    public function client(){
        return $this->belongsTo(User::class , 'owner_id');
    }

    public function developer(){
        return $this->belongsTo(User::class , 'developer_id');
    }

    public function skills(){
        return $this->belongsToMany(Skill::class);
    }
}
