<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'priority_id',
        'status_id',
        'title',
        'description',
        'assign_user_id'
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function user(){
        return $this->belongsToMany(User::class);
    }

    public function category(){
        // return dd($this->belongsTo(Category::class));
        return $this->belongsTo(Category::class);
    }

    public function priority(){
        return $this->belongsTo(Priority::class);
    }

    public function status(){
        return $this->belongsTo(Status::class);
    }

}
