<?php  

function testStatus($status)
{
    $tableau = ["admin"=>null, "propriétaire"=>null, "locataire"=>null, "user"=>null];
    if ($status >=8) {
        $tableau["admin"] = true;
        $status -= 8;
    }
    if ($status >=4) {
        $tableau["propriétaire"] = true;
        $status -= 4;
    }
    if ($status >=2){
        $tableau["locataire"] = true;
        $status -= 2;
    }
    if ($status >=1){
        $tableau["user"] = true;
        $status -= 1;
    }
    return $tableau;
}