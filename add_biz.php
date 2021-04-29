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

if(isset($_POST)) {
	$name = $_POST['name'];
	$addr = $_POST['addr'];
	$city = $_POST['city'];
	$phone = $_POST['phone'];
	$url = $_POST['url'];
	$category_id = $_POST['category_id'];
	$sql_insert= ("insert into businesses (name, address, city, phone, url) value('$name','$addr', '$city', '$phone', '$url')");
	mysqli_query($_dbHandle, $sql_insert);

	$sql_findid = ("select * from businesses order by id desc limit 1");
	$findid = mysqli_query($sql_findid);
	$row = mysqli_fetch_array($findid);
	$b_id = $row['id'];

	$sql_insert_biz_cate = ("insert into biz_categories (business_id, category_id) value('$b_id', '$category_id')");
	mysqli_query($_dbHandle, $sql_insert_biz_cate);

	header('location:add_biz.php');
}

?>



<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
	<p style="font-size: 50px"><b>Business Registration </b></p>
	<form action="" method="post">
		<div style="width: 50%; background-color: red; float: left">
			<p>Click on one, or control click on multiple categories:
				<select name="category_id">
					<?php  
					while($listcate=mysqli_fetch_array($row_listcate)) {
						?>
						<option value="<?php echo $listcate['id'] ?>"><?php echo $listcate['title'] ?></option>
						<?php  
					}
					?>
				</select>
			</p>
		</div>
		<div style="width: 50%; float: left;">
			<p >
				<span style="margin-right: 20px">Business Name</span>
				<input type="text" name="name">
			</p>
			<p >
				<span style="margin-right: 20px">Address</span>
				<input type="text" name="addr">
			</p>
			<p >
				<span style="margin-right: 20px">City</span>
				<input type="text" name="city">
			</p>
			<p >
				<span style="margin-right: 20px">Telephone</span>
				<input type="text" name="phone">
			</p>
			<p >
				<span style="margin-right: 20px">URL</span>
				<input type="text" name="url">
			</p>
		</div>
		<p><input type="submit" name="add" value="Add Business"></p>
	</form>

</body>
</html>