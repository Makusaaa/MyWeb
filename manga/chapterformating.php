<?php
    function linkformat($e){
        $Index = "";
        $t = substr($e,0,1);
        if($t != "1"){
            $Index = "-index-".$t;
        }
        $n = (int)substr($e,1,strlen($e)-2);
        $m = "";
        $a = $e[strlen($e)-1];
        if ($a != "0"){
            $m = ".".$a;
        }
        return "-chapter-".$n.$m.$Index.".html";
    }

    function imgformat($e){
        $chapter = sprintf('%04d',$e);
        $odd = $e[strlen($e)-1];
        if($odd == "0"){
            return $chapter;
        }
        return $chapter.'.'.$odd;
    }

    function showformat($e){
        $chapter = (int)substr($e,1,strlen($e)-2);
        $odd = $e[strlen($e)-1];
        if($odd == "0"){
            return $chapter;
        }
        return $chapter.'.'.$odd;
    }
?>