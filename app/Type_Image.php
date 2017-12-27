<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Type_Image extends Model
{
    protected $table = 'type_image';
    protected $primaryKey = 'ID_type_image';
    public $timestamps = false;

    public function album()
    {
        return $this->hasMany('App\Album', 'ID_type_image');
    }

    public function albumCount()
    {
        return $this->album()
            ->selectRaw('ID_type_image, count(*) as aggregate')
            ->groupBy('ID_type_image');
    }
}
