<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryPost extends Model
{
    use HasFactory;

    // Specifies the database table that model maps to.
    protected $table = 'category_post';

    // Defines which attributes can be mass-assigned.
    protected $fillable = ['category_id','post_id'];

    // Disables timestamps for the model
    public $timestamps = false;


    // To get the name of the Category
    public function category(){ 
        return $this->belongsTo(Category::class);
    }

    
}
