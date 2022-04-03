<?php
error_reporting(E_ALL ^ E_NOTICE);
ini_set("display_errors", 1);

// Without the line below, the time comes in UTC.
// date_default_timezone_set('America/Sao_Paulo');

function now ($timeserver) {
    $now = floor(microtime(true) * 1000);
    $ret = array('now' => $now);
    // try {
    //     $socket = fsockopen("udp://$timeserver", 123, $err_no, $err_str, 1);

    //     if ($socket) {
    //         if (fwrite($socket, chr(bindec('00'.sprintf('%03d', decbin(3)).'011')).str_repeat(chr(0x0), 39).pack('N', time()).pack("N", 0))) {
    //             stream_set_timeout($socket, 1);
    //             $unpack0 = unpack("N12", fread($socket, 48));
                
    //             $ret = array('result' => true, 'date' => $ret = date('Y-m-d H:i:s', $unpack0[7]), 'raw' => $unpack0, );
    //         }
    //     }
    // } catch (Exception $e) {
    //     $ret = array("result" => false, "message" => 'Exception while reading NTP date: ' . $e->getMessage() . PHP_EOL);
    // } finally {
    //     if ($socket) {
    //         fclose($socket);
    //     }
    // }
    return $ret;
}

header('Content-Type: application/json; charset=UTF-8');
print json_encode(now('ntp.nict.jp'));
// Using it
//print 'Date from NTP Server: ' . query_ntp_server ('ntp.nict.jp') . PHP_EOL;
?>