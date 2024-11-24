<?php

namespace App\Traits;

use Illuminate\Http\Request;
use App\MenuModel;
use DB;
use SendGrid\Mail\Mail;

trait Fungsi {
    public static function getmenu1($role_id)
    {
        $menu = DB::table('menus')->whereNull('deleted_at')->join('role_menus','menus.id','=','role_menus.menu_id')->where('role_id',$role_id)->where('menus.parent_menu_id',0)->select('menus.name as name','no_urut','slug','icon','menus.menu_id as menu_id','parent_menu_id')->orderBy('no_urut','asc')->get();
        
        return $menu;   

    }

    public static function getmenuall1()
    {
        $menu = DB::table('menus')->whereNull('deleted_at')->where('menus.parent_menu_id',0)->select('menus.name as name','no_urut','slug','icon','menus.menu_id as menu_id','parent_menu_id','menus.id as id')->orderBy('no_urut','asc')->get(); 
         // print_r($menu);
         // exit();
        return $menu;   

    }

    public static function getsubmenu1($role_id)
    {
        $submenu = DB::table('menus')->whereNull('deleted_at')->join('role_menus','menus.id','=','role_menus.menu_id')->where('role_id',$role_id)->where('menus.menu_id',0)->select('menus.name as name','no_urut','slug','icon','menus.menu_id as menu_id','parent_menu_id')->orderBy('no_urut','asc')->get();
        return $submenu;
    }

    public static function getsubmenuall1()
    {
        $submenu = DB::table('menus')->whereNull('deleted_at')->where('menus.menu_id',0)->select('menus.name as name','no_urut','slug','icon','menus.menu_id as menu_id','parent_menu_id','menus.id as id')->orderBy('no_urut','asc')->get();
        return $submenu;
    }
	
	public static function getmenu($role_id)
    {
    	$menu = DB::select("select b.id as id,b.name as name,b.menu_id as menu_id,b.slug as slug,b.icon as icon,b.no_urut from menus b join role_menus r on b.id = r.menu_id where r.role_id = '$role_id' and b.parent_menu_id = '0' order By b.no_urut asc;");  
         // print_r($menu);
         // exit();
        return $menu;   

    }

    public static function getmenuall()
    {
        $menu = DB::select("select b.id as id,b.name as name,b.menu_id as menu_id,b.slug as slug from menus b where b.parent_menu_id = '0';");  
         // print_r($menu);
         // exit();
        return $menu;   

    }

    public static function getsubmenu($role_id)
    {
    	 $submenu = DB::select("select b.id as id,b.name as name,b.parent_menu_id as parent_menu_id,b.slug as slug,b.icon as icon,no_urut from menus b join role_menus r on b.id = r.menu_id where r.role_id = '$role_id' and b.menu_id = '0' order by b.no_urut asc;");
        return $submenu;
    }

    public static function getsubmenuall()
    {
         $submenu = DB::select("select b.id as id,b.name as name,b.parent_menu_id as parent_menu_id,b.slug as slug from menus b where b.menu_id = '0';");
        return $submenu;
    }


    public static function S3_PATH(){
        $env = 'https://kandidat.s3-id-jkt-1.kilatstorage.id';
        return $env;
    }
    public static function AWS_SECRET_ACCESS_KEY(){
        $env = '';
        return $env;
    }
    public static function AWS_ACCESS_KEY_ID(){
        $env = '';
        return $env;
    }

    public static function FIREBASE_CREDENTIAL(){
        $env = '';
        return $env;
    }
    //

    public static function NotifeAndroid($id,$action,$id_object,$title,$messages,$tipe,$detail) {
            
        $firebase_token = DB::table('users')->where('id',$id)->select('firebase_android','firebase_ios')->get();
        if ($firebase_token->isNotEmpty()) {
            // firebase android
            if ($firebase_token[0]->firebase_android != null || $firebase_token[0]->firebase_android != '') {
                $url = 'https://fcm.googleapis.com/fcm/send';
                $registrationIds = array($firebase_token[0]->firebase_android);
                     
                // prepare the message
                $fields = array (
                            'registration_ids' => $registrationIds,
                            "notification" => array(
                                "body" => $messages,
                                "title" =>$title,
                                "click_action" => 'FLUTTER_NOTIFICATION_CLICK'
                            ),
                            "data" => array("body" =>$messages,"title"=>"Notifikasi","tipe" => $tipe,"tipe_detail" => $detail,'id_detail'=>$id_object)
                    );
                
                $headers = array (
                    'Authorization: key=' . "",
                    'Content-Type: application/json'
                );


                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL,$url);
                curl_setopt( $ch,CURLOPT_POST,true);
                curl_setopt( $ch,CURLOPT_HTTPHEADER,$headers);
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false);
                curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode($fields));
                $result = curl_exec($ch);
                curl_close($ch);

                //echo $result;
            }

            // firebase ios
            if ($firebase_token[0]->firebase_ios != null || $firebase_token[0]->firebase_ios != '') {
                $url = 'https://fcm.googleapis.com/fcm/send';
                $registrationIds = array($firebase_token[0]->firebase_ios);
                     
                // prepare the message
                $fields = array (
                            'registration_ids' => $registrationIds,
                            "notification" => array(
                                "body" => $messages,
                                "title" =>$title,
                                "click_action" => 'FLUTTER_NOTIFICATION_CLICK'
                            ),
                            "data" => array("body" =>$messages,"title"=>"Notifikasi","tipe" => $tipe,"tipe_detail" => $detail,'id_detail'=>$id_object)
                    );
                
                $headers = array (
                    'Authorization: key=' . "",
                    'Content-Type: application/json'
                );


                $ch = curl_init();
                curl_setopt( $ch,CURLOPT_URL,$url);
                curl_setopt( $ch,CURLOPT_POST,true);
                curl_setopt( $ch,CURLOPT_HTTPHEADER,$headers);
                curl_setopt( $ch,CURLOPT_RETURNTRANSFER,true);
                curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER,false);
                curl_setopt( $ch,CURLOPT_POSTFIELDS,json_encode($fields));
                $result = curl_exec($ch);
                curl_close($ch);

                //echo $result;
            }
        }
    }

    public static function sendMessage_zenzifa($nomor,$message)
    {
        $phone_no = $nomor;
       
            
        $userkey="45o2qa"; // userkey lihat di zenziva
        $passkey="";

        $url = "https://gsm.zenziva.net/api/sendsms/";
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS,
        'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$phone_no.'&pesan='.$message);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $results = curl_exec($curlHandle);
        // UPDATE TOKEN
        $data['message'] = 'Berhasil Registarsi';

        return json_encode($results);
            
    }

    public static function sendWa_zenzifa($nomor,$message)
    {
        $phone_no = $nomor;
       
            
        $userkey="45o2qa"; // userkey lihat di zenziva
        $passkey="";

        $url = "https://gsm.zenziva.net/api/sendWA/";
        $curlHandle = curl_init();
        curl_setopt($curlHandle, CURLOPT_URL, $url);
        curl_setopt($curlHandle, CURLOPT_POSTFIELDS,
        'userkey='.$userkey.'&passkey='.$passkey.'&nohp='.$phone_no.'&pesan='.$message);
        curl_setopt($curlHandle, CURLOPT_HEADER, 0);
        curl_setopt($curlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYHOST, 2);
        curl_setopt($curlHandle, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($curlHandle, CURLOPT_TIMEOUT,30);
        curl_setopt($curlHandle, CURLOPT_POST, 1);
        $results = curl_exec($curlHandle);
        // UPDATE TOKEN
        $data['message'] = 'Berhasil Registarsi';

        return json_encode($results);
            
    }  

    public static function BlastWA($message,$phone) {
        $apiURL = "https://api.chat-api.com/instance295279/";
        $token = "";
        $data = json_encode(
            array(
                'chatId'=>$phone.'@c.us',
                'body'=>$message
            )
        );
        $url = $apiURL.'message?token='.$token;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $data
                )
            )
        );
        $response = file_get_contents($url,false,$options);
        $res_json = json_decode($response);
        if ($response == true) {
            $res = "true";
        } else {
            $res = "false";
        }
    }

    public static function BlastWA_two($message,$phone) {
        $apiURL = "https://api.chat-api.com/instance295186/";
        $token = "";
        $data = json_encode(
            array(
                'chatId'=>$phone.'@c.us',
                'body'=>$message
            )
        );
        $url = $apiURL.'message?token='.$token;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $data
                )
            )
        );
        $response = file_get_contents($url,false,$options);
        $res_json = json_decode($response);
        if ($response == true) {
            $res = "true";
        } else {
            $res = "false";
        }
    }

    public static function BlastWA_tiga($message,$phone) {
        $apiURL = "https://api.chat-api.com/instance295273/";
        $token = "";
        $data = json_encode(
            array(
                'chatId'=>$phone.'@c.us',
                'body'=>$message
            )
        );
        $url = $apiURL.'message?token='.$token;
        $options = stream_context_create(
            array('http' =>
                array(
                    'method'  => 'POST',
                    'header'  => 'Content-type: application/json',
                    'content' => $data
                )
            )
        );
        $response = file_get_contents($url,false,$options);
        $res_json = json_decode($response);
        if ($response == true) {
            $res = "true";
        } else {
            $res = "false";
        }
    }

    public static function EmailSending($email_x,$password,$name) {
        $email = new Mail();
        $email->setFrom("iluniftuidev@gmail.com", "Alumni FT UI");
        $email->setSubject("Pemberitahuan");
        $email->addTo($email_x, $name);
        $email->setTemplateId('');
        $id = base64_encode($email_x);
        $link = "";

        $substitutions = [
              "greeting" => "Yth ".$name,
              "password" => $password
        ];
        $email->addDynamicTemplateDatas($substitutions);
        $sendgrid = new \SendGrid('');
        try {
            $response = $sendgrid->send($email);
            $data['status'] = $response->statusCode() . "\n";
            $data['header'] = ($response->headers());
            $data['body'] = $response->body() . "\n";
        } catch (Exception $e) {
            $data['status'] = 'Caught exception: '. $e->getMessage() ."\n";
        }

        return $data;
    }
   


}

?>
