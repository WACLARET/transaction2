<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cash extends Model
{
    public static function updateData($id, $data){
        DB::table('cash')->where('id', $id)->update($data);
    }

    
    protected $fillable = [
        'amount' , 'pNumber'
    ];
}
