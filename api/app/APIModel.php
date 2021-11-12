<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use DB;

class APIModel extends Model
{
    use SoftDeletes;
    public $parent = [];

    // public function children($childName){
    //   $joinedTable = $this;
    //   foreach($this->children as $childName => $child){
    //     $joinedTable = $joinedTable
    //   }
    //   return $joinedTable;
    // }
    public function getTableColumns() {
        return $this->getConnection()->getSchemaBuilder()->getColumnListing($this->getTable());
    }
    // public function getTableDetail(){
    //   return $this->getConnection()->getSchemaBuilder()->listTableDetails("inventory");
    // }
    public function newModel($table, $attribute){
      $modelName = "App\\".str_replace(' ', '', ucwords(str_replace('_', ' ', str_singular($table))));
      return new $modelName($attribute);
    }

    public function getCreatedAtAttribute($value){
      $value = str_replace('T', ' ', $value);
      $value = str_replace('Z', '', $value);
      return substr($value, 0, 19);
    }
  
    public function getUpdatedAtAttribute($value){
      $value = str_replace('T', ' ', $value);
      $value = str_replace('Z', '', $value);
      return substr($value, 0, 19);
    }
  
    public function getDeletedAtAttribute($value){
      $value = str_replace('T', ' ', $value);
      $value = str_replace('Z', '', $value);
      return substr($value, 0, 19);
    }
  
    public function formatDateTime($dateTime){
      $dateTime = str_replace('T', ' ', $dateTime);
      $dateTime = str_replace('Z', '', $dateTime);
      $dateTime = substr($dateTime, 0, 19);
      return $dateTime;
    }
}
