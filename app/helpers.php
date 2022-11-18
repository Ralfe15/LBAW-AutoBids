<?php
if (!function_exists('bid_step')) {
    function bid_step($current_bid){
        $table = array(100 => 5000, 50=>2500, 25=>1000, 10 => 500, 5 =>250, 2.5=>100,
            1=>25, 0.5=>5, 0.25=>1, 0.05=>0.01);
        foreach($table as $incr=>$max){
            if($current_bid >= $max){
                $current_bid+=$incr;
                break;
            }
        }

        return $current_bid;
    }
}
if (!function_exists('credits_format')) {
    function credits_format($credits){
        return number_format($credits, 2, '.');
    }
}
if (!function_exists('secsToStr')){
    function secsToStr($secs) {
        if($secs>=86400){$days=floor($secs/86400);$secs=$secs%86400;$r=$days.' day';if($days<>1){$r.='s';}if($secs>0){$r.=', ';}}
        if($secs>=3600){$hours=floor($secs/3600);$secs=$secs%3600;$r.=$hours.' hour';if($hours<>1){$r.='s';}if($secs>0){$r.=', ';}}
        if($secs>=60){$minutes=floor($secs/60);$secs=$secs%60;$r.=$minutes.' minute';if($minutes<>1){$r.='s';}if($secs>0){$r.=', ';}}
        $r.=$secs.' second';if($secs<>1){$r.='s';}
        return $r;
    }
}

