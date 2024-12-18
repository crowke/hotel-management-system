<?php

include '../config.php';

$id = $_GET['id'];

$sql ="Select * from roombook where id = '$id'";
$re = mysqli_query($conn,$sql);
while($row=mysqli_fetch_array($re))
{
	$Name = $row['Name'];
    $Email = $row['Email'];
    $Country = $row['Country'];
    $Phone = $row['Phone'];
    $RoomType = $row['RoomType'];
    $Bed = $row['Bed'];
    $NoofRoom = $row['NoofRoom'];
    $Meal = $row['Meal'];
    $cin = $row['cin'];
    $cout = $row['cout'];
    $noofday = $row['nodays'];
    $stat = $row['stat'];
}


if($stat == "Не підтверджено")
{
    $st = "Підтверджено";

    $sql = "UPDATE roombook SET stat = '$st' WHERE id = '$id'";
    $result = mysqli_query($conn,$sql);

    if($result){

        $type_of_room = 0;      
        if($RoomType=="Президентська")
        {
            $type_of_room = 3000;
        }
        else if($RoomType=="Вишукана")
        {
            $type_of_room = 2000;
        }
        else if($RoomType=="Гостьова")
        {
            $type_of_room = 1500;
        }
        else if($RoomType=="Звичайна")
        {
            $type_of_room = 1000;
        }
        
        
        if($Bed=="1 ліжко")
        {
            $type_of_bed = $type_of_room * 1/100;
        }
        else if($Bed=="2 ліжка")
        {
            $type_of_bed = $type_of_room * 2/100;
        }
        else if($Bed=="3 ліжка")
        {
            $type_of_bed = $type_of_room * 3/100;
        }
        else if($Bed=="4 ліжка")
        {
            $type_of_bed = $type_of_room * 4/100;
        }
            else if($Bed=="Без ліжок")
        {
            $type_of_bed = $type_of_room * 0/100;
        }

        if($Meal=="Немає")
        {
            $type_of_meal=$type_of_bed * 0;
        }
        else if($Meal=="Сніданок")
        {
            $type_of_meal=$type_of_bed * 2;
        }
        else if($Meal=="Базове")
        {
            $type_of_meal=$type_of_bed * 3;
        }
        else if($Meal=="Повноцінне")
        {
            $type_of_meal=$type_of_bed * 4;
        }
                                                            
        $ttot = $type_of_room *  $noofday * $NoofRoom;
        $mepr = $type_of_meal *  $noofday;
        $btot = $type_of_bed * $noofday;

        $fintot = $ttot + $mepr + $btot;

        $psql = "INSERT INTO payment(id,Name,Email,RoomType,Bed,NoofRoom,cin,cout,noofdays,roomtotal,bedtotal,meal,mealtotal,finaltotal) VALUES ('$id', '$Name', '$Email', '$RoomType', '$Bed', '$NoofRoom', '$cin', '$cout', '$noofday', '$ttot', '$btot', '$Meal', '$mepr', '$fintot')";

        mysqli_query($conn,$psql);

        header("Location:roombook.php");
    }
}
// else
// {
//     echo "<script>alert('Guest Already Confirmed')</script>";
//     header("Location:roombook.php");
// }


?>
