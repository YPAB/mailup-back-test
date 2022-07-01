<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Brand extends Model
{
    use HasFactory,SoftDeletes;

    protected $table = 'brands';
    protected $fillable = ['name'];

    public $timestamps = true;
    protected $dates = ['deleted_at'];

    public function products(){
        return $this->hasMany(Product::class);
    }

    public function categories(){
        return $this->hasMany(Category::class);
    }
}
