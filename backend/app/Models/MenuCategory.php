<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    //
    protected $guarded = ['id'];

    public static function selectList(){
        $categories = MenuCategory::all();
        $list = array();
        // $list += array( 'null' => '');
        foreach ($categories as $category) {
            $list += array( $category->id => $category->name);
        }
        return $list;
    }

    public function getAddNameIdAttribute(){
        return $this->id . '_' . $this->name;
    }
}
