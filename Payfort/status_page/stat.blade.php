<?php
if($_SERVER['REQUEST_METHOD'] == 'POST')
{
    $find="عملية ناجحة";
    $count=count($_POST);
    sort($_POST);
    $position = -1;
    for($i=0;$i<$count;$i++)
    {
        if($_POST[$i]==$find)
        {
            $position=$i;
        }
    }
    if($position >= 0)
    {
    echo 'تمت عملية الدفع بنجاح';
    }
    else
    {
        echo 'لم تكتمل عملية الدفع';
    }
    header('refresh: 3;url=https://masoolpay.com');
}
else
{
    header('Location: https://masoolpay.com');
}
?>
