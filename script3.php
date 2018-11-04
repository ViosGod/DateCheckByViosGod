<?php

function checkDateMy($Str) {
   
    if (strlen($Str) < 6) return false;
    if ($Str{2}!=".") return false; 
    if (strlen($Str) != 8 && strlen($Str)>5 && strlen($Str)<10) return false;
    if ((strlen($Str) == 8 || strlen($Str) == 10) && $Str{5}!=".")return false;
    if (strlen($Str) != 10 && strlen($Str)>8)return false;

    for ($i=0; $i < strlen($Str); $i++) { 
        if ($i!=2 && $i!=5) {
             if (!ctype_digit ($Str{$i})) {
                echo $Str{$i} . "<br>";
                return false;
             }
        }
    }
    $year = (int)substr($Str, 6, 4);
    if ($year>9999 || $year<1) return false;
    $mounth = (int)substr($Str, 3, 2);
    if ($mounth>12 || $mounth<1) return false;
    $day = (int)substr($Str, 0, 3);
    if ($day>31 || $mounth<1) return false;
    return true;
}

function dateConvert($Str) {
    if (checkDateMy($Str)) {
        if (strlen($Str) == 8) {
            if ((int)substr($Str, 6)<50) $Str=substr_replace($Str, "20", 6, 0);
            else $Str=substr_replace($Str, "19", 6, 0);
            
        }
        else return $Str;

    }
    else return "EmptyDate";
    
}




function weekOfMonthF($YY, $MM, $DD)
    {
        $weekNum = (int)date("W", mktime(0, 0, 0, $MM, $DD, $YY))
            - (int)date("W", mktime(0, 0, 0, $MM, 01, $YY)) + 1;
        return (int)$weekNum;
    }



function dayOfWeek($YY, $MM, $DD) {
$weekNum = (int)date("w", mktime(0, 0, 0, $MM, $DD, $YY));
        return (int)$weekNum;
}


function numInMounth($year, $mounth, $day) {
    $DOW=dayOfWeek($year, $mounth, $day);
    if (dayOfWeek($year, $mounth, 01)<$DOW) return weekOfMonthF($year, $mounth, $day)+1;
    else return weekOfMonthF($year, $mounth, $day);
}

function lastDayInMount($mounth, $year) {
    if ($mounth==1 || $mounth==3 || $mounth==5 || $mounth==7 || $mounth==8 || $mounth==10 || $mounth==12) return 31;
    else if ($mounth==2) {
        if ($year%4==0) return 29;
        else return 28;
    }
    else return 30;
}

function lastWeekInMount($mounth, $year) {
    return weekOfMonthF($year, $mounth, lastDayInMount($mounth, $year));
}
// Выводим HTML-заголовки:
echo '<html>';
echo '<head>';
echo '<meta http-equiv="Content-Type" content="text/html; charset=windows-1251">';
echo '<title>Result</title>';
echo '</head>';
echo '<body>';
echo '<h3></h3>';
echo "<p>Value of input data: <b>".$_POST['textfield']."</b></p>";

$Str = $_POST['textfield'];

echo dateConvert($Str) . "<br>";

if (!checkDateMy($Str)){
            echo "It is not date!";
        }
else if (strlen($Str) == 10 || strlen($Str) == 5 || strlen($Str) == 8) {

$year = (int)substr($Str, 6, 4);


$mounth = (int)substr($Str, 3, 2);


$day = (int)substr($Str, 0, 3);

$dayOfWeek = (int)dayOfWeek($year, $mounth, $day);

$weekOfMount = (int)weekOfMonthF($year, $mounth, $day);


if ((int)$dayOfWeek==(int)4 && (int)weekOfMonthF($year, $mounth, $day)==(int)4 && (int)$mounth==(int)11) {
        echo "Thursday of the 4th week of November";
        
    }
elseif ($dayOfWeek==1 && (int)weekOfMonthF($year, $mounth, $day)==3 && $mounth==1) {
        echo "Monday of the 3rd week of January";
        
    }
elseif ($dayOfWeek==1 && (int)weekOfMonthF($year, $mounth, $day)==lastWeekInMount($mounth, $year) && $mounth==3) {
        echo "Monday of the last week of March";
        
    }
elseif ((int)$dayOfWeek==(int)4 && (int)weekOfMonthF($year, $mounth, $day)==(int)4 && (int)$mounth==(int)11) {
        echo "Thursday of the 4th week of November";
        
    }
elseif ($day==1 && $mounth==1) {
        echo "New Year";
        
    }
elseif ($day==7  && $mounth==1) {
        echo "Merry Christmas";
        
    }
elseif ($day>=1 && $day<=7  && $mounth==5) {
        echo "May's holiday";
        
    }

else {
        echo "It is a usual day";
        
     }

}
echo '</body>';
echo '</html>';
?>