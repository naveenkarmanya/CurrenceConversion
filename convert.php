<?php
function currency_convert($amount, $from, $to) {
    $result = file_get_contents('http://www.xe.com/currencyconverter/convert/?Amount='.$amount.'&From='.$from.'&To='.$to);
    preg_match('/<td width="47%" align="left" class="rightCol">(.*?)<td width="6%" valign="middle" align="center" rowspan="2" class="invCol">/s', $result, $data);
    $explode = explode('"', $result);
    print_r($data);
   
    if ($explode[1] == '' || $explode[3] == '') {
        return false;
    } else {
        return array($explode[1], $explode[3]);
    }
}

if (isset($_POST['amount'], $_POST['from'], $_POST['to'])) {
    $amount = (int) $_POST['amount'];
    $from = $_POST['from'];
    $to = $_POST['to'];

    $convertion = currency_convert($amount, $from, $to);
    if ($convertion == false) {
        echo 'Sorry! somthing wrong';
    } else {
        echo $convertion[0] . ' " ' . $convertion[1];
    }
}
?>