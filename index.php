<?
session_start();
ini_set('display_errors',1);
error_reporting(E_ALL);
require 'db.php';
?>
<!DOCTYPE html>
<html>
  <head>
    <link rel="stylesheet" href="style.css">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <script src="//code.jquery.com/jquery-1.10.2.js"></script>
    <script>
$(document).ready(function(){
$("#login2").click(function(){
    $('#login').css("display","table-cell");
});
$("#add2").click(function(){
    $('#add').css("display","table");
});
});
</script>
    <title>Задачи</title>
  </head>
  <body>
    <h1><a href="/">Задачи</a></h1>
    <table>
      <tr><td>
            <?if (isset($_SESSION["authoris"])){              
            if ($_SESSION["authoris"]){
            echo "Админ";?>
          </td>
          <td>
            <br/><a href='?exit=1'>Выйти</a>
          </td></tr>
            <?};}
            else{
            echo "Гость";
            ?>
          </td>
          <td>
            <a href='#' id="login2">Войти</a>
          </td></tr>
          <tr><td colspan="2" id="login">
            <form method="POST">
            Логин <input name="login" type="text" required><br/>
            Пароль <input name="password" type="password" required><br/>
            <input name="submit" type="submit" value="Войти">
            </form>
          </td></tr>
            <?}?>
    </table><?
// Выход
if (isset($_GET["exit"])) { 
    if ($_GET["exit"] == 1) {
        $_SESSION = array(); 
        session_destroy(); ?>
        <meta http-equiv='Refresh' content='0; url=/'>
        <?
    }
}
// Вход
if(isset($_POST['submit']))
{ 
    $query = mysqli_query($link,"SELECT id, password FROM users WHERE login='".mysqli_real_escape_string($link,$_POST['login'])."'");
    $data = mysqli_fetch_assoc($query);
    // Сравниваем пароли
    if($data['password'] == $_POST['password'])
    {
        $_SESSION["authoris"] = true;?>
        <meta http-equiv='Refresh' content='0; url=/'>
        <?
    }
    else
    {
        $_SESSION["authoris"] = false;
        print "Вы ввели неправильный логин/пароль";
    }
}?>

<td><?
if (isset($_SESSION["authoris"])){
  if ($_SESSION["authoris"]){
    require 'admin.php'; 
  }
}
else
  { 
    require 'content.php';
  }
?>
  </body>
</html>
