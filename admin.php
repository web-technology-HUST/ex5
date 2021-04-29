<?php
define ('DEVELOPMENT_ENVIRONMENT',true);

define('DB_NAME', 'todo');
define('DB_USER', 'root');
define('DB_PASSWORD', '');
define('DB_HOST', 'localhost');

$_dbHandle = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
if($_dbHandle) {
	echo 'kết nối thành công';
}
else echo "kết nối thất bại";
mysqli_select_db($_dbHandle, DB_NAME);

$sql_listcate="select * from categories";
$row_listcate=mysqli_query($_dbHandle,$sql_listcate);

if(isset($_POST['add'])) {
	$id = $_POST['id'];
	$title = $_POST['title'];
	$description = $_POST['description'];
	$sql_insert=("insert into categories (id, title, description) value('$id','$title', '$description')");
	mysqli_query($_dbHandle, $sql_insert);
	header('location:admin.php');
}

?>


<!DOCTYPE html>
<html>
<head>
	<title>Todo</title>
	<style>
		table, th, td {
  		border: 1px solid black;
  		border-collapse: collapse;
  		padding-left: 100px;
  		padding-top: 20px;
  		padding-bottom: 30px;
  		padding-right: 100px;
  		font-size: 20px;
		}
		input {
			
		}
		#input_text {
		padding-left: 0px;
  		padding-top: 0px;
  		padding-bottom: 0px;
  		padding-right: 0px;
  		width: 300px;
  		height: 75px;
	</style>
</head>
<body>
	<h1>Category Administration </h1>
	<form action="" method="post">
		<table>
			<tr>
				<th>Cat ID</th>
				<th>Title</th>
				<th>Description</th>
			</tr>
			<?php  
				while($listcate=mysqli_fetch_array($row_listcate)) {
			?>
			<tr>
				<td> <?php echo $listcate['id'] ?></td>
				<td> <?php echo $listcate['title'] ?></td>
				<td> <?php echo $listcate['description'] ?></td>
			</tr>
			<?php 
				}
			?>
			<tr >
				<td>
					<input type="text" name="id" class="input_text">
				</td>
				<td>
					<input type="text" name="title" class="input_text">
				</td>
				<td>
					<input type="text" name="description" class="input_text">
				</td>
			</tr>
		</table>
		<p><input type="submit" name="add" value="Add Category" style="font-size: 20px;"></p>
	</form>

</body>
</html>