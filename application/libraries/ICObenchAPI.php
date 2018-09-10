<?php

class ICObenchAPI {

    private $privateKey	= '7f06a59b-222c-4671-96e4-9ea100986ad3';
    private $publicKey	= '2db28f8a-a32f-41ea-9372-047439e03328';
    private $apiUrl		= 'https://icobench.com/api/v1/';
    public	$result;

    public function getICOs($type = 'all', $data = ''){
        return $this->send('icos/' . $type, $data);
    }
    public function getICO($icoId, $data = ''){
        return $this->send('ico/' . $icoId, $data);
    }
    public function getOther($type){
        return $this->send('other/' . $type, '');
    }
    public function getPeople($type = 'registered', $data = ''){
        return $this->send('people/' . $type, $data);
    }

    private function send($action, $data){

        $dataJson = json_encode($data);
        $sig = base64_encode(hash_hmac('sha384', $dataJson, $this->privateKey, true));

        $ch = curl_init($this->apiUrl . $action);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $dataJson);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($dataJson),
                'X-ICObench-Key: ' . $this->publicKey,
                'X-ICObench-Sig: ' . $sig)
        );

        $reply = curl_exec($ch);
        $ff = $reply;
        $reply = json_decode($reply,true);

        if(isset($reply['error'])){
            $this->result = $reply['error'];
            return false;
        }else if(isset($reply['message'])){
            $this->result = $reply['message'];
            return true;
        }else if(isset($reply)){
            $this->result = json_encode($reply);
            return true;
        }else{
            $this->result = htmlspecialchars($ff);
            return false;
        }
    }

    public function result(){
        return $this->result;
    }
}

/*// PHP Example - Show all ICOs list
$api = new ICObenchAPI();
$api->getICOs("all");
echo '<pre>';
print_r(json_decode($api->result));
echo '</pre>';

// PHP Example - Go to page 2 of all ICOs list
$api = new ICObenchAPI();
$api->getICOs('all',['page'=>2]);

echo $api->result;

// PHP Example - Show all active ICOs and order them by Rating DESC
$api = new ICObenchAPI();
$api->getICOs("all",["orderDesc"=>"rating","status"=>"active"]);

echo $api->result;

// PHP Example - Show details on ICO ID 472
$api = new ICObenchAPI();
$api->getICO(472);

echo $api->result;*/
