<?php

    header("Content-type: text/javascript");
    /*
        you should server side cache this response, especially if your site is active
    */
    $data = isset($_GET['data'])?$_GET['data']:'';
    if (!empty($data)) {
        $data = explode("|", $data);
        $responses = array();
        if (!empty($data)) {
            foreach ($data as $key) {
                list($instance,$currency,$address) = explode('_',$key);
                switch ($currency) {
                    case 'bitcoin': 
                        $response = get_bitcoin($address);
                        break;
                    case 'litecoin': 
                        $response = get_litecoin($address);
                        break;
                    case 'dogecoin': 
                        $response = get_dogecoin($address);
                        break;
                }
                $responses[$instance] = $response;
            }
        }
        echo 'var COINWIDGETCOM_DATA = '.json_encode($responses).';';
    }

    function get_bitcoin($address) {
        $return = array();
        $data = get_request('http://blockchain.info/address/'.$address.'?format=json&limit=0');
        if (!empty($data)) {
            $data = json_decode($data);
            $return += array(
                'count' => (int) $data->n_tx,
                'amount' => (float) $data->total_received/100000000
            );
            return $return;
        }
    }

    function get_litecoin($address) {
        $return = array();
        $data = get_request('http://ltc.blockr.io/api/v1/address/info/'.$address);
        if (!empty($data)) {
            $data = json_decode($data);
            $return += array(
                'count' => (int) $data->data->nb_txs,
                'amount' => (float) $data->data->totalreceived
            );
            return $return;
        }
    }
    
    function get_dogecoin($address) {
        $return = array();
        $data = get_request('https://dogechain.info/api/v1/address/balance/'.$address);
        if (!empty($data)) {
            $data = json_decode($data);
            $return += array(
                'count' => 1,
                'amount' => (float) $data->balance
            );
            return $return;
        }
    }

    function get_request($url,$timeout=4) {
        if (function_exists('curl_version')) {
            $curl = curl_init();
            curl_setopt($curl, CURLOPT_URL, $url);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
            curl_setopt($curl, CURLOPT_CONNECTTIMEOUT, $timeout);
            curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
            curl_setopt($curl, CURLOPT_USERAGENT,'Mozilla/5.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13');
            $return = curl_exec($curl);
            curl_close($curl);
            return $return;
        } else {
            return @file_get_contents($url);
        }
    }

    function parse($string,$start,$stop) {
        if (!strstr($string, $start)) return;
            if (!strstr($string, $stop)) return;
                $string = substr($string, strpos($string,$start)+strlen($start));
                $string = substr($string, 0, strpos($string,$stop));
                return $string;
    }