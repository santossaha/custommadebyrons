<?php

namespace App\Models\Front;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use DB;
class UserProfile extends Model
{
	protected $table = 'user_address';

  public function GetUserAddress($user_id=''){
    	
		$query = DB::table('user_address')
              ->select('user_address.*','countries.name as country_name','states.name as state_name')
              ->leftJoin('countries', function ($join) {
                      $join->on('countries.id','=','user_address.country');
                    })
              ->leftJoin('states', function ($join) {
                      $join->on('states.id','=','user_address.state');
                    })
              ->where('user_id', $user_id)
               ->where('deleted_at',NULL)
              ->where('status','Active');
        $data = $query->orderBy('id','DESC')->paginate(6);
        return $data;
	}
	public function addAddress($data=''){
    return $res=DB::table('user_address')->insert($data);
  }
  public function getDetailsDefaultUseraddress($user_id=''){
    return $user_address_details = DB::table('user_address')
          ->select('user_address.*')
          ->where('user_id','=',$user_id)
          ->where('deleted_at',NULL)
          ->where('status','=','Active')
          ->where('default_address','=',1)
          ->first();
  }
  public function UserDefaultAddressUpdate($data='',$id){
    return $res = DB::table('user_address')->where('id','=',$id)->update($data);
  }
  public function DeleteUserAddressData($id=''){
    return $res =DB::table('user_address')->where('id', '=', $id)->delete();
  }
  public function UpdateUserAddressData($data=''){
    return $res = DB::table('user_address')->where('id','=',$data['id'])->update($data);
  }
  public function getAllUseraddress($user_id=''){
    $query = DB::table('user_address')
              ->select('user_address.*','countries.name as country_name','states.name as state_name')
              ->leftJoin('countries', function ($join) {
                      $join->on('countries.id','=','user_address.country');
                    })
              ->leftJoin('states', function ($join) {
                      $join->on('states.id','=','user_address.state');
                    })
              ->where('user_id', $user_id)
               ->where('deleted_at',NULL)
              ->where('status','Active');
        $data = $query->orderBy('id','DESC')->paginate(6);
        return $data;
  }
    
}
