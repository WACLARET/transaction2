<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Withdraw extends Model
{
    public static function updateData($id, $data){
        DB::table('withdaraw')->where('id', $id)->update($data);
    }

    
    protected $fillable = [
        'withdraw'
    ];
}
