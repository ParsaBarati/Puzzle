<?php
function fw_preLoader(){
    return '<div id="fw-preloader" class="fw-preloader">
    <div class="fw-preloader-body">
        <div class="fw-preloader-wrapper fw-big fw-active">
            <div class="fw-spinner-layer fw-spinner-blue">
                <div class="fw-circle-clipper fw-left">
                    <div class="fw-circle"></div>
                </div>
                <div class="fw-gap-patch">
                    <div class="fw-circle"></div>
                </div>
                <div class="fw-circle-clipper fw-right">
                    <div class="fw-circle"></div>
                </div>
            </div>
            <div class="fw-spinner-layer fw-spinner-red">
                <div class="fw-circle-clipper fw-left">
                    <div class="fw-circle"></div>
                </div>
                <div class="fw-gap-patch">
                    <div class="fw-circle"></div>
                </div>
                <div class="fw-circle-clipper fw-right">
                    <div class="fw-circle"> </div>
                </div>
            </div>
            <div class="fw-spinner-layer fw-spinner-yellow">
                <div class="fw-circle-clipper fw-left">
                    <div class="fw-circle"></div>
                </div>
                <div class="fw-gap-patch">
                    <div class="fw-circle"></div>
                </div>
                <div class="fw-circle-clipper fw-right">
                    <div class="fw-circle"></div>
                </div>
            </div>
            <div class="fw-spinner-layer fw-spinner-green">
                <div class="fw-circle-clipper fw-left">
                    <div class="fw-circle"></div>
                </div>
                <div class="fw-gap-patch">
                    <div class="fw-circle"></div>
                </div>
                <div class="fw-circle-clipper fw-right">
                    <div class="fw-circle"></div>
                </div>
            </div>
        </div>
    </div>
</div>';
}
function loadStyles(){
    global $DARK_MODE;
    return !$DARK_MODE ? '<link rel="stylesheet" href="dist/css/fw_styles.css">' : '<link rel="stylesheet" href="dist/css/fw_styles_darkMode.css">';
}

if(!function_exists('sendPushNotification'))
{
    function sendPushNotification($push_id, $title, $body) {

        ignore_user_abort();
        ob_start();
        $apikey = 'AAAAX6r45l0:APA91bF0K2XnH1awmc3DfW0jwqzSJhyoUqp_1ClF-8jTp4zJFc_Sx5_as_8XjK7TzvaM16uwjqTJ8fe5IsFlbNxPmKzb2m1koWzmu9OMk8eKRVG67gMmP4MvoZCVYpcvr3yORAdZ9zFP';
        define( 'API_ACCESS_KEY', $apikey );

        $msg = array
        (
            'body' 	=>  $body,
            'title'	=> $title,
            'icon'	=> 'myicon',/*Default Icon*/
            'sound' => 'mySound'/*Default sound*/
        );
        $fields = array
        (
            'to'		=> $push_id,
            //'registration_ids' => $b ,
            'notification'	=> $msg
        );

        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );
#Send Reponse To FireBase Server
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        var_dump($result);
        curl_close( $ch );
//echo $result;
    }
}