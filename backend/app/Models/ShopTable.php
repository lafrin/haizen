<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ShopTable extends Model
{
  protected $guarded = ['id'];

  // private $id;
  // private $newPeople;
  // private $name;
  // private $status;

  // public function setTableData($id, $newPeople, $name, $status){
  //   $this->id = $id;
  //   $this->newPeople = $newPeople;
  //   $this->name = $name;
  //   $this->status = $status;
  // }
  private $toastr;
  private $state;

  public function setEnable(){
    $this->update([
        'status' => config( 'const.HALL.EN.enable' )['num'],
    ]);
    $this->toastr = $this->name. "テーブルを使用可に変更";
    $this->state = $this->max_people."名席";
  }

  public function setUse(){
    $this->update([
        'status' => config( 'const.HALL.EN.use' )['num'],
        'people' => $this->people,
    ]);
    $this->toastr = $this->people."名様を".$this->name. "テーブルにご案内";
    $this->state = $this->people.'名';
  }

  public function setCleaning(){
    $this->update([
        'status' => config( 'const.HALL.EN.cleaning' )['num'],
    ]);
    $this->toastr = $this->name. "テーブルを清掃中に変更";
    $this->state = '清掃';
  }


  public function setDisable(){
    $this->update([
        'status' => config( 'const.HALL.EN.disable' )['num'],
    ]);
    $this->toastr = $this->name. "テーブルを使用不可に変更";
    $this->state = '不可';
  }

  public function getTableData($action){
    return [
      'id' => $this->id,
      'people' => $this->people,
      'name' => $this->table_name,
      'maxPeople' => $this->max_people,
      'action' => $action,
      'toastr' => $this->toastr,
      'state' => $this->state,
    ];
  }
}
