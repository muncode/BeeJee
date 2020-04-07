<?
    if (isset($_GET['red'])) {
      $sql2 = mysqli_query($link, "SELECT * FROM `tasks` WHERE `id`={$_GET['red']}");
      $product = mysqli_fetch_array($sql2);
    }
  ?>
  <form method="post" action="">
    <table>
      <tr>
        <td><div class='title'>Имя: </div>
            <input type="text" name="1name" value="<?= isset($_GET['red']) ? $product['name'] : ''; ?>" required>
        <br/>
            <div class='title'>E-mail: </div>
            <input type="text" name="1mail" value="<?= isset($_GET['red']) ? $product['mail'] : ''; ?>" required>            
        </td>
        <td>
            <div class='title'>Текст: </div>
            <textarea type="text" name="1text" required style="width: 500px; height: 50px;"><?= isset($_GET['red']) ? $product['text'] : ''; ?>
            </textarea>
            <br/>
            <input type="radio" name="1status" value="0" 
            <?  if (isset($_GET['red'])) {if ($product['status']=='0'){ echo "checked" ;};}?>>
            <div class='title'>Не выполнено </div>
            <input type="radio" name="1status" value="1" 
            <?  if (isset($_GET['red'])) {if ($product['status']=='1'){ echo "checked" ;};}?>>
            <div class='title'>Выполнено </div>
            <br/>
            <input type="submit" value="OK">
        </td>
    </tr>
    </table>
  </form>

<?

    if (isset($_POST["1name"])) {

        if ((isset($_GET['red']))&&($product['text']==($_POST['1text']))){
          $sql2 = mysqli_query($link, "UPDATE `tasks` SET `name` = '{$_POST['1name']}',`mail` = '{$_POST['1mail']}',`text` = '{$_POST['1text']}',`status` = '{$_POST['1status']}' WHERE `id`={$_GET['red']}"); 
          ?>
<meta http-equiv='Refresh' content='0; url=/'>
<?
      }

    if ((isset($_GET['red']))&&($product['text']!=($_POST['1text']))) {
          $sql2 = mysqli_query($link, "UPDATE `tasks` SET `name` = '{$_POST['1name']}',`mail` = '{$_POST['1mail']}',`text` = '{$_POST['1text']}',`status` = '{$_POST['1status']}',`edit` = '1' WHERE `id`={$_GET['red']}");
      } 

      //Если вставка прошла успешно
      if ($sql2) {
        echo '<p>Успешно!</p>';
        ?>
<meta http-equiv='Refresh' content='0; url=/'>
<?
      } else {
        echo '<p>Произошла ошибка: ' . mysqli_error($link) . '</p>';
      }
    }
    ?>

<table>
<?
$result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result)){
        if ($row['status']==1){$stat="Выполнено";}
        else {$stat="Не выполнено";}
        if ($row['edit']==1){$ed="Отредактировано администратором";}
        else {$ed="";}
            echo 
            "<tr class='task'>
                    <td class='left'> <div class='title'>Имя: </div>" .
                        $row['name'] . "<br/><div class='title'>E-mail: </div>" . $row['mail'] .
                    "</td>
                    <td class='right'><div class='title'>Текст задания: </div>"  . 
                        htmlspecialchars($row['text']) .
                    "</td>
                    <td>
                        <a href='?red={$row['id']}'>Изменить</a>
                    </td>
              </tr>
              <tr class='status'>
                    <td>" .
                        $stat . 
                    "</td>
                    <td>" . 
                        $ed;
                    "</td>                     
            </tr>";
        }
    ?>  
</table>

    
