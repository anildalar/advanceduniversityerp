<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Customsms {
    private $_CI;
    var $user;
    var $pass;
    var $senderId;
    var $url;
    var $api_key;
    var $smsGateWay;
    var $baseurl;
    var $sms_portal_id;
    
    function __construct() {
        $this->_CI =& get_instance();
        $this->session_name = $this->_CI->setting_model->getCurrentSessionName();
        $this->_CI->load->library('guzzle');
        $d = $this->_CI->setting_model->getCurrentSchoolSmsCredentials();
        $this->sms_portal_id = $this->_CI->setting_model->getDefualtGatwayId();
        $this->sms_portal_id=$this->sms_portal_id['sms_portal_id'];
       $this->smsGateWay = $d[3];
        if($d[3] == '1'){
            $this->baseurl = 'http://sms2.dollorinfotech.com';
            $this->user        =     $d[0]; //username
            $this->pass        =    $d[1]; //password
            $this->senderId    =    $d[2]; //senderid
        }elseif($d[3] == '2'){
            $this->baseurl = 'http://apivm.valuemobo.com/SMS/SMS_ApiKey.asmx/SMS_APIKeyUC?';
            $this->api_key = $d[4];
            $this->senderId = $d[2];
        }
        
        
    }
    public function str_replacer($content_replace,$sms_content){
        return str_replace(array_keys($content_replace),$content_replace,$sms_content);
    }
    public function sendMy($url){
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($ch);
        if (curl_errno($ch)) {
            echo curl_error($ch);
            echo "\n<br />";
            $contents = '';
        } else {
            curl_close($ch);
            
        }
        var_dump($contents);
        $cookie_name = "sms";
		setcookie($cookie_name, $contents, time() + (86400 * 30), "/"); // 86400 = 1 day
        //die;
        /*$curl = curl_init();
            curl_setopt_array($curl, array(
              CURLOPT_URL => $url,
              CURLOPT_RETURNTRANSFER => true,
              CURLOPT_ENCODING => "",
              CURLOPT_MAXREDIRS => 10,
              CURLOPT_TIMEOUT => 30,
              CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
              CURLOPT_CUSTOMREQUEST => "POST",
              CURLOPT_POSTFIELDS => "",
              CURLOPT_SSL_VERIFYHOST => 0,
              CURLOPT_SSL_VERIFYPEER => 0,
            ));
            $response = curl_exec($curl);
            $err = curl_error($curl);
            curl_close($curl);
            var_dump($response);
            die;*/
    }
    function sendSMS($to, $message){
        if($this->sms_portal_id != '0'){
                $data=$this->_CI->setting_model->getCustomSmsDatabyId($this->sms_portal_id);
                $dt=unserialize($data['gateway_tokan']);
                $myary=[
                    '{{APIKEY}}'=>$dt['api_key'],
                    '{{CLIENTID}}'=>$dt['clientid'],
                    '{{SENDERID}}'=>$dt['SenderID'],
                    '{{MESSAGE}}'=>rawurlencode($message),
                    '{{MOB}}'=>$to,
                    '{{PASS}}'=>$dt['pass'],
                    '{{USER}}'=>$dt['uname'],
                ];
            $url=$this->str_replacer($myary,$data['url']);
            //print_r($url);
            $this->sendMy($url);
        }else{
           if($this->smsGateWay == '1'){
                $content = '/api/sendmsg.php?user='.rawurlencode($this->user) .
                '&pass=' . rawurlencode($this->pass) .
                '&sender=' . rawurlencode($this->senderId) .
                '&phone=' .$to .
                '&text=' . rawurlencode($message).
                '&priority=ndnd&stype=normal';
                $url =  $this->baseurl. $content;
                //echo $url;die;
                $this->getData($url);
                
            }
            if($this->smsGateWay == '2'){
                $content = 'apiKey='. rawurlencode($this->api_key).
                '&cellNoList='.$to.
                '&msgText='. $message.
                '&senderId='.$this->senderId.'&msgType=UC';
                
                 $url =  $this->baseurl. $content;
                //echo $url;die;
                
                //$RESPONCE = $this->getData($url);
                $ch = curl_init();
                curl_setopt ($ch, CURLOPT_URL, $url);
                curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
                curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
                $contents = curl_exec($ch);
                if (curl_errno($ch)) {
                    echo curl_error($ch);
                    echo "\n<br />";
                    $contents = '';
                } else {
                    curl_close($ch);
                }
            } 
        }
    }
    function getData($url){
        $client = new GuzzleHttp\Client();
        try {
            
            $response = $client->request('POST',$url,[]);
            $response->getStatusCode();
            $response->getProtocolVersion();
            $response->getReasonPhrase(); 
            return $response->getBody();
        } catch (GuzzleHttp\Exception\BadResponseException $e) {
            $response = $e->getResponse();
            $responseBodyAsString = $response->getBody()->getContents();
            print_r($responseBodyAsString);
        }
    }
    function getSmsBalance($user = null,$pass = null){
        $url = '';
        if($this->smsGateWay == '1'){
            if($user == '' && $pass == ''){
                $user = $this->user;
                $pass = $this->pass;
            }
            $content = '/api/checkbalance.php?user='.$user.'&pass='.$pass;
            $url = $this->baseurl . $content;
        }if($this->smsGateWay == '2'){
            $url = 'http://apivm.valuemobo.com/SMS/SMS_ApiKey.asmx/SMS_APIGetBalance?apiKey='.$this->api_key.'';
        }
        
        
        //return file_get_contents($url);
        $ch = curl_init();
        curl_setopt ($ch, CURLOPT_URL, $url);
        curl_setopt ($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
        $contents = curl_exec($ch);
        if (curl_errno($ch)) {
          echo curl_error($ch);
          echo "\n<br />";
          $contents = '';
        } else {
          curl_close($ch);
        }
        
        if (!is_string($contents) || !strlen($contents)) {
        echo "Failed to get contents.";
        $contents = '';
        }
        if($this->smsGateWay == '2'){
            
            $contents = explode(':',$contents);
            
            $contents = $contents[1];
        }
        return  $contents;

        //return $this->getData($url);
    }
    
    function sentRegisterSMS($id,$send_to) {
        $message=$this->getStudentRegistrationContent($id);
        
        $this->sendSMS($send_to, $message); 
        return true;
    }
    
    function sentAddFeeSMS($invoice_id, $sub_invoice_id, $send_to) {
        $message = $this->getAddFeeContent($invoice_id, $sub_invoice_id);
        $this->sendSMS($send_to, $message);
        return true;
    }
    public function getAddFeeContent($invoice_id, $sub_invoice_id) {
        $currency_symbol='Rs';//$this->sch_setting[0]['currency_symbol'];
        $school_name='School';//$this->sch_setting[0]['name'];

        $fee = $this->_CI->studentfeemaster_model->getFeeByInvoice($invoice_id, $sub_invoice_id);
        $a = json_decode($fee->amount_detail);
        $record = $a->{$sub_invoice_id};
        $fee_amount = number_format((($record->amount + $record->amount_fine) - $record->amount_discount), 2, '.', ',');
        $msg="Fees received for " . $fee->firstname . " " . $fee->lastname . ". Fees Amount " .$currency_symbol . $fee_amount . "/- Received by ".$school_name;
        return $msg;
    }
    
    function sentAbsentStudentSMS($detail) {
       
        $send_to = $detail['contact_no'];
        $message = $this->getAbsentStudentContent($detail);
        $this->sendSMS($send_to, $message);
         return true;
        
    }
    public function getAbsentStudentContent($student_detail) {
        $school_name = $this->_CI->setting_model->getCurrentSchoolName();
        $student_name = $student_detail['student_name'];
        $msg = "Absent Notice :".$student_name . " was absent on date " . $student_detail['date'] . " from " . $school_name;
        return $msg;
    }
    function sentExamResultSMS($detail) {
        
        $message = $this->getStudentResultContent($detail); 
        $send_to = $detail['guardian_phone'];
        $this->sendSMS($send_to, $message);
        return true;
        
    }
    public function getStudentResultContent($student_result_detail) {

        $school_name = $this->_CI->setting_model->getCurrentSchoolName();
        $student_name = $student_result_detail['student_name'];
        $msg=$student_name." is ".$student_result_detail['result'] . " in ".$student_result_detail['exam_name']." with total marks ".$student_result_detail['achive_marks']." out of ".$student_result_detail['total_marks'].".";
      return $msg;
    }
    
    function sendLoginCredential($chk_mail_sms, $sender_details) {
        
        $message = $this->getLoginCredentialContent($sender_details['credential_for'], $sender_details);
        $send_to = $sender_details['contact_no'];
        
        $this->sendSMS($send_to, $message);
        
        return true;
    }
    public function getLoginCredentialContent($credential_for, $sender_details) {
        if ($credential_for == "student") {
            $student = $this->_CI->student_model->get($sender_details['id']);
            $msg = "Hello " . $student['firstname'] . " " . $student['lastname'] .
                    ", your login details for Url: " . site_url('site/userlogin') . " Username: " . $sender_details['username'] . "\n Password: " . $sender_details['password'];
        } elseif ($credential_for == "parent") {
            $parent = $this->_CI->student_model->get($sender_details['id']);
            $msg = "Hello " . $parent['guardian_name'] . ", your login details for Url: " . site_url('site/userlogin') . " Username: " . $sender_details['username'] . "\n Password: " . $sender_details['password'];
        } elseif ($credential_for == "teacher") {
            $teacher = $this->_CI->teacher_model->get($sender_details['id']);
            $msg = "Hello " . $teacher['name'] . ", your login details for Url: " . site_url('site/userlogin') . " Username: " . $sender_details['username'] . "\n Password: " . $sender_details['password'];
        } elseif ($credential_for == "librarian") {
            $librarian = $this->_CI->librarian_model->get($sender_details['id']);
            $msg = "Hello " . $librarian['name'] . ", your login details for Url: " . site_url('site/userlogin') . " Username: " . $sender_details['username'] . "\n Password: " . $sender_details['password'];
        } elseif ($credential_for == "accountant") {
            $accountant = $this->_CI->accountant_model->get($sender_details['id']);
            $msg = "Hello " . $accountant['name'] . ", your login details for Url: " . site_url('site/userlogin') . " Username: " . $sender_details['username'] . "\n Password: " . $sender_details['password'];
        }
        return $msg;
    }
    public function getStudentRegistrationContent($id){
        $student = $this->_CI->student_model->get($id);
        $msg = "Dear " . $student['firstname'] . " " . $student['lastname'] .
        ", your admission is confirm in Class: " . $student['class'] .
        ", Section: " . $student['section'] . " for Session: " . $this->session_name . ", for more detail contact System Admin.";
        return $msg;
    }
    function sendPushNotify($tokens,$title){
        $url = 'https://fcm.googleapis.com/fcm/send';
        $server_key = 'AAAACtA70gA:APA91bHZAcZVox1mQKhHmNU-6asIE--HV-AN2ZAbGlPbWG7-wJt2kPyRTXL9ERx_N7O_88l_Uu5cuEk5QegpA8QFBmZuaSmN_b10KEKYc-1T5qnTOTCDIAd7vVfpwD_QQef1IuMCmz9T';
        
        $fields = array(
            'registration_ids' => $tokens,
            'priority' => 10,
            'notification' => array('title' => $title, 'body' =>$title ,'sound'=>'Default','icon'=>'fcm_icon','color'=>'#488aff','click_action'=>"FCM_PLUGIN_ACTIVITY"),
            'data'=>array('msg'=>$title)
            
            
        );
        $headers = array(
            'Authorization:key=' . $server_key,
            'Content-Type:application/json'
        );  
        $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $url);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($fields));
            $result = curl_exec($ch);
            if ($result === FALSE) {
                die('FCM Send Error: ' . curl_error($ch));
            }
            curl_close($ch);
            var_dump($result);
        
    }
    
    

   

    
        
}
?>
