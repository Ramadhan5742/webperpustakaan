<?php 
$koneksi = mysqli_connect("localhost","root","","program_sederhana");
 if (mysqli_connect_errno()){
	echo "Koneksi database gagal : " . mysqli_connect_error();
}
 ?>

9.	Buat file dengan nama cek_login.php dengan syntaks sebagai berikut:
<?php 
session_start();  
include 'koneksi.php'; 
$username = $_POST['username'];
$password = $_POST['password'];
$login = mysqli_query($koneksi,"select * from user where username='$username' and password='$password'");

$cek = mysqli_num_rows($login);
if($cek > 0){
	$data = mysqli_fetch_assoc($login);
	if($data['level']=="admin"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "admin";
		header("location:halaman_admin.php");
	}else if($data['level']=="pegawai"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "pegawai";
		header("location:halaman_pegawai.php");
	}else if($data['level']=="pengurus"){
		$_SESSION['username'] = $username;
		$_SESSION['level'] = "pengurus";
		header("location:halaman_pengurus.php");
	}else{
		header("location:index.php?pesan=gagal");
	}	
}else{
	header("location:index.php?pesan=gagal");
}
?>

 