<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Album extends Model
{
    protected $table = 'album';
    protected $primaryKey = 'ID_image';
    public $timestamps = false;

    public function TypeImage(){
        return $this->belongsTo('App\Type_Image', 'ID_type_image');
    }
}
