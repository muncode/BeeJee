<?
    $link = mysqli_connect("127.0.0.1", "root", "", "bee");
    $s = 'ORDER by id ASC';
    $sql = "SELECT * FROM tasks $s";
?>
