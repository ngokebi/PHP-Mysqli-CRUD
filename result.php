<!DOCTYPE html>
<html lang = "en">
<body style="background-color:Khaki;">
<head>
<meta charset = "utf-8">
    <title> Staff Result </title>
</head>
<body>
<form method="get" action="" enctype="multipart/form-data"> 
    <input type="text" name="name" size = "25" placeholder = "Staff Search"/> 
    <input type="submit" name="search" value="Search Now" /> 
    </form>
<p ><h2 align = "center"> Staff Results </h2></p>
<table width = "1000" border = "5" align = "center">

    <tr>
        <td>ID</td>
        <td>Name</td>
        <td>Email</td>
        <td>Address</td>
        <td>Department</td>
        <td>StaffID</td>
    </tr>

<?php 
include "config.php";
if(isset($_GET["search"])) {
$bb = $_GET["name"];
$sql = "SELECT * FROM details where name like '%$bb'";
$query = mysqli_query($link,$sql);
while($row_query = mysqli_fetch_array($query)) {

    $id = $row_query["id"];
    $name = $row_query["name"];
    $email = $row_query["email"];
    $address = $row_query["address"];
    $department = $row_query["department"];
    $staffID = $row_query["staffID"];

?>

<tr>
    <td><?php echo $id; ?></td>
    <td><?php echo $name; ?></td>
    <td><?php echo $email; ?></td>
    <td><?php echo $address; ?></td>
    <td><?php echo $department; ?></td>
    <td><?php echo $staffID; ?></td>

</tr>
<?php } ?>
</table>

</body>
</html>
<?php } else
$sql = "SELECT * FROM details where staffID like '%$bb'";
$query = mysqli_query($link,$sql);
while($row_query = mysqli_fetch_array($query)) {

    $id = $row_query["id"];
    $name = $row_query["name"];
    $email = $row_query["email"];
    $address = $row_query["address"];
    $department = $row_query["department"];
    $staffID = $row_query["staffID"];



echo "<tr>
    <td><?php echo $id; ?></td>
    <td><?php echo $name; ?></td>
    <td><?php echo $email; ?></td>
    <td><?php echo $address; ?></td>
    <td><?php echo $department; ?></td>
    <td><?php echo $staffID; ?></td>

</tr>";
}
?>