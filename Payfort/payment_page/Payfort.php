<?php

    namespace App\Lib;

    use App\Models\Paymentmeta;
    use Carbon\Carbon;
    use Session;
    use Illuminate\Http\Request;
    use Http;
    use Str;

    class Payfort
    {
        

        public static function make_payment($array)
            {

                function milliseconds()
                {

                    $mt = explode(' ', microtime());
                    return ((int)$mt[1]) * 1000 + ((int)round($mt[0] * 1000));

                }

                function calculateSignature($arrData, $signType = 'request')
                {

                    $shaString             = '';
                    ksort($arrData);
                    foreach ($arrData as $k => $v) {
                        $shaString .= "$k=$v";
                    }
                
                    if ($signType == 'request') {
                        $shaString = '199caIwKH6sK/q276LXEyh_]' . $shaString . '199caIwKH6sK/q276LXEyh_]';
                    }
                    else {
                        $shaString = '199caIwKH6sK/q276LXEyh_]' . $shaString . '199caIwKH6sK/q276LXEyh_]';
                    }
                    $signature = hash('sha256', $shaString);
                
                    return $signature;

                }

            $mill = milliseconds();
            // echo 'سيتم تحويلك لصفحة الدفع';

            $requestParams = array(
                'service_command' => 'TOKENIZATION',
                'access_code' => 'wVSCmf3P16ceEbRiRCob',
                'merchant_identifier' => 'c09baf0a',
                'merchant_reference' => $mill,
                'language' => 'ar',
                'token_name' => 'Wp5Vmp',
                'return_url' => 'https://masoolpay.com/stat',
                );        
            
            $requestParams = array(
            'service_command' => 'TOKENIZATION',
            'access_code' => 'wVSCmf3P16ceEbRiRCob',
            'merchant_identifier' => 'c09baf0a',
            'merchant_reference' => $mill,
            'language' => 'ar',
            'token_name' => 'Wp5Vmp',
            'return_url' => 'https://masoolpay.com/stat',
            'signature' => calculateSignature($requestParams, $signType = 'request'),
            );
            
            $redirectUrl = 'https://sbcheckout.payfort.com/FortAPI/paymentPage';
            echo '<iframe id="theiframe" style="height:100%;width:100%;border:none;margin: 0 auto;" name="myframe" id="frame1" src="'.$redirectUrl.'"></iframe>';
            echo "<html xmlns='https://www.w3.org/1999/xhtml'>\n<head>";
            echo "<style>
                    h1
                    {
                        color:red;
                    }
            </style></head><body>\n";
            echo "<form target='myframe' action='$redirectUrl' method='post' name='frm'>\n";
            foreach ($requestParams as $a => $b) {
                echo "\t<input type='hidden' name='".htmlentities($a)."' value='".htmlentities($b)."'>\n";
            }
            echo "\t<script type='text/javascript'>\n";
            echo "\t\tdocument.frm.submit();\n";
            echo "\t</script>\n";
            echo "</form>\n";
            ?>
            <?php
            echo "</body>";
            echo "\n</html>";
        }

    }
?>