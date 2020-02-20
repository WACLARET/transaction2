<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Home extends Model
{
    public static function updateData($id, $data){
        DB::table('deposit')->where('id', $id)->update($data);
    }

    
    protected $fillable = [
        'phoneNumber'
    ];
}
