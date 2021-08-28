<?php include ( "inc/connect.inc.php" ); ?>
<?php 

ob_start();
session_start();
if (!isset($_SESSION['user_login'])) {
	header("location: login.php");
}
else {
	$user = $_SESSION['user_login'];
	$result = $con->query("select * from user WHERE id=".$user);
		$get_user_email = $result->fetch(PDO::FETCH_ASSOC);
			$uname_db = $get_user_email['firstName'];
			$uemail_db = $get_user_email['email'];

			$umob_db = $get_user_email['mobile'];
			$uadd_db = $get_user_email['address'];
}


if (isset($_REQUEST['cid'])) {
		$cid = $_REQUEST['cid'];
		if($con->query("delete from cart WHERE pid=".$cid." and uid=".$user)){
		header('location: mycart.php?uid='.$user.'');
	}else{
		header('location: index.php');
	}
}
if (isset($_REQUEST['aid'])) {
		$aid = $_REQUEST['aid'];
		$result = $con->query("select * from cart WHERE pid=".$aid);
		$get_p = $result->fetch(PDO::FETCH_ASSOC);
		$num = $get_p['quantity'];
		$num += 1;

		if($con->query("update cart set quantity=".$num." WHERE pid=".$aid." and uid=".$user)){
		header('location: mycart.php?uid='.$user.'');
	}else{
		header('location: index.php');
	}
}
if (isset($_REQUEST['sid'])) {
		$sid = $_REQUEST['sid'];
		$result = $con->query("select * from cart WHERE pid=".$sid);
		$get_p = $result->fetch(PDO::FETCH_ASSOC);
		$num = $get_p['quantity'];
		$num -= 1;
		if ($num <= 0){
			$num = 1;
		}
		if($con->query("update cart set quantity=".$num." WHERE pid=".$sid." and uid=".$user)){
		header('location: mycart.php?uid='.$user.'');
	}else{
		header('location: index.php');
	}
}


?>