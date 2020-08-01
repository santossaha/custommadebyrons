<?php
/**
 * Created by PhpStorm.
 * User: DvlprBalram
 * Date: 08-06-2019
 * Time: 14:42
 */

namespace App\Customclass;

use App\Model\ProductsModel;
use Exception;

class Datavalue
{
    public function muliple_send_message($mobile_nos_array,$message){
        for($i=0;$i<count($mobile_nos_array);$i++){
            if(!empty($mobile_nos_array[$i]))
            {
                if(preg_match('/^\d{10}$/',$mobile_nos_array[$i]))
                {
//                    $ch = curl_init('https://www.txtguru.in/imobile/api.php?');
//                    curl_setopt($ch, CURLOPT_POST, 1);
//                    curl_setopt($ch, CURLOPT_POSTFIELDS, "username=alokraj7080&password=luvumapa1&source=CHCKSM&dmobile=91".$mobile_nos_array[$i]."&message=".$message);
//                    curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//                    $data = curl_exec($ch);
                }
            }
        }
    }
    public function send_message($mobile_no,$message){

        if(preg_match('/^\d{10}$/',$mobile_no))
        {
//            $ch = curl_init('https://www.txtguru.in/imobile/api.php?');
//            curl_setopt($ch, CURLOPT_POST, 1);
//            curl_setopt($ch, CURLOPT_POSTFIELDS, "username=alokraj7080&password=luvumapa1&source=CHCKSM&dmobile=91".$mobile_no."&message=".$message);
//            curl_setopt($ch, CURLOPT_RETURNTRANSFER,1);
//            $data = curl_exec($ch);
        }
    }
    public function upload_pic($file, $new_path)
    {
        if(is_string($file)){
            $image_parts = explode("data:image/png;base64,", $file);
            $image_parts_jpeg = explode("data:image/jpeg;base64,", $file);
            if($image_parts[0]=='data:image/png;base64,'){
                $ext = '.png';
                //$image_type_arr = explode("image/", $image_parts[0]);
                $image = base64_decode($image_parts[1]);
                $image_name = str_random(6).'_' . time() . $ext;
                $path = public_path('/uploads/'.$new_path.'/'.$image_name);
                try {
                    file_put_contents($path, $image);
                    return $image_name;
                }catch (Exception $e){
                    return $e;
                }
            }else{
                $ext='.jpeg';
                //$image_type_arr = explode("image/", $image_parts[0]);
                $image = base64_decode($image_parts_jpeg[1]);
                $image_name = str_random(6).'_' . time() . $ext;
                $path = public_path('/uploads/'.$new_path.'/'.$image_name);
                try {
                    file_put_contents($path, $image);
                    return $image_name;
                }catch (Exception $e){
                    return $e;
                }
            }

        }else{
            return 'Not string';
        }

    }
    public function check_slug($slug,$id=null){
        if($id==null){
            $check = ProductsModel::where('slug',$slug)->count();
        }else{
            $check = ProductsModel::where('product_id','<>',$id)->where('slug',$slug)->count();
        }
        return $check;
    }


}
