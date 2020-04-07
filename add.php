<table id="add">
	<tr><td>
<form method="POST" action="">
    <input name="name" type="text" placeholder="Имя" required><br/>
    <input name="mail" type="text" placeholder="E-mail" required>
</td><td>
    <textarea name="text" type="text" placeholder="Текст" required style="width: 500px; height: 50px;"></textarea>
    <input type="submit" value="Отправить"/>
    </form>
</td></tr></form>
<?
if (isset($_POST['name']) && isset($_POST['text']) && isset($_POST['mail'])){
if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL))
{
    
    // Переменные с формы
    $name = $_POST['name'];
    $mail = $_POST['mail'];
    $text = $_POST['text'];

$result2 = mysqli_query($link, "INSERT INTO tasks (name,mail,text) VALUES ('$name','$mail','$text')");

if ($result2 == true){
    echo "Информация занесена в базу данных";
}else{
    echo "Информация не занесена в базу данных";
}?>
<meta http-equiv='Refresh' content='0; url=/'>
<?
echo "<script>alert(\"Задача добавлена.\");</script>"; 
}
else {
	echo "<script>alert(\"E-mail введен не верно!\");</script>"; 
}}
?>
