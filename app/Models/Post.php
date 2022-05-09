<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function user(){
        return $this->belongsTo(related:User::class);
    }
/* public function setPostImageAttribute($value){
        $this->attributes['post_image'] = asset($value);
    }
    */
    

    public function getPostImageAttribute($value){
      
        if (strpos($value, 'https://') !== FALSE || strpos($value, 'http://') !== FALSE) { return $value; } return asset('images/' . $value);
     }
     
}