<?php

class Smsckz {
    function __construct(modX $modx, array $config = array()) {
        $this->modx = &$modx;
    }

    function send($phone, $text) {
        // Получаем системные настройки для работы и шлём сообщение
        //https://smsc.kz/sys/send.php?login=<login>&psw=<password>&phones=<phones>&mes=<message>


        $data = array(
            'login' => '',
            'psw' => '',
            'phones' => $phone,
            'mes' => $text
        );

        $link = 'https://smsc.kz/sys/send.php?login='.$data['login'].'&psw='.$data['psw'].'&phones='.$data['phones'].'&mes='.$data['mes'].'&charset=utf-8';

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $link);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $res = curl_exec($ch);
        if (curl_getinfo($ch, CURLINFO_HTTP_CODE) == 200 && substr($res, 0, 3) == 100) {
            curl_close($ch);

            return true;
        }
        $this->modx->log(modX::LOG_LEVEL_ERROR, '[Office] Error sending SMS: ' . print_r(curl_getinfo($ch), true));
        curl_close($ch);

        return $res;
    }
}