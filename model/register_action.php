<?php 

//KONEKSI DATABASE
include '../model/db_connect.php';

//VALIDASI REGISTER
if(isset($_POST['register'])){
    $check=false;
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm = $_POST['confirm'];

//VALIDASI REGISTER KOSONG
    if(empty($firstname) || empty($lastname) || empty($email) || empty($password) || empty($confirm)){
        header("location:../view/register.php?error=Undefined cannot be left empty");
        exit();
    }
    // MENGECEK APAKAH ADA EMAIL SUDAH TERDAFTAR
    else{
        $sql = "SELECT * FROM users WHERE email ='$email'";
        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) == 1){
            
            $row = mysqli_fetch_assoc($result);
            if($row['email']==$email){      
                header("location:../view/register.php?error=Email has been registered");
                exit();
            }
            
        }else{
            if($password == $confirm){
                $query = "INSERT INTO users(email,firstname,lastname,password) VALUES ('$email','$firstname','$lastname','$password')";
                $sql = mysqli_query($conn, $query);
        
                if($sql){
                  header("location:../index.php");
                }else{
                    header("location:../view/register.php?error=Registere failed");
                }
                exit();
            
            }else{
                header("location:../view/register.php?error=password didn't match");
                exit();
            }
        }
    }
}
?>