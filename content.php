<?
    // Количество задач на страницу
    $num = 3;
    // Страница
    if (isset($_GET['page'])){
        $page = $_GET['page'];
    }
    // Количество задач
    $result3 = mysqli_query($link,"SELECT COUNT(*) FROM tasks");
    $posts = mysqli_fetch_array($result3);

    if (empty($page) or $page < 0) $page = 1;
    $start = $page * $num - $num;
    // Url
    $uri = $_SERVER['PHP_SELF'].'?';
    if ( $_SERVER['QUERY_STRING'] != '' ) {
        foreach( $_GET as $key => $value ) {
            if ( $key != 'page' ) $uri = $uri.$key.'='.urlencode($value).'&';
        }
    }
    // GET сортировка
        if (isset($_GET['sort'])){
            if($_GET['sort']==0){
                $s='ORDER by id ASC';
            }
            if($_GET['sort']==1){
                $s='ORDER by name ASC';
            }
            if($_GET['sort']==2){
                $s='ORDER by name DESC';
            }
            if($_GET['sort']==3){
                $s='ORDER by mail ASC';
            }
            if($_GET['sort']==4){
                $s='ORDER by mail DESC';
            }
            if($_GET['sort']==5){
                $s='ORDER by status ASC';
            }
            if($_GET['sort']==6){
                $s='ORDER by status DESC';
            }
        }
    $sql = "SELECT * FROM tasks $s LIMIT $start, $num";
    ?>

<table>
    <tr><td id="pagination"><?
    for($i = 1; $i <= (ceil($posts[0]/3)); $i++){
        echo '<a href="'.$uri.'page='.($i).'"> '.($i).' </a>';
    }?></td >
    <td class='sort'>
        Сортировать по: <?
echo '<a href="'.$_SERVER['PHP_SELF'].'?sort=1&page='.$page.'">Имени по возрастанию</a> / ';
echo '<a href="'.$_SERVER['PHP_SELF'].'?sort=2&page='.$page.'">Имени по убыванию</a> / ';
echo '<a href="'.$_SERVER['PHP_SELF'].'?sort=3&page='.$page.'">E-mail по возрастанию</a> / ';
echo '<a href="'.$_SERVER['PHP_SELF'].'?sort=4&page='.$page.'">E-mail по убыванию</a> / ';
echo '<a href="'.$_SERVER['PHP_SELF'].'?sort=5&page='.$page.'">Статусу задачи по возрастанию</a> / ';
echo '<a href="'.$_SERVER['PHP_SELF'].'?sort=6&page='.$page.'">Статусу задачи по убыванию</a> / ';
    ?></td>
    </tr>

    <?php
    $result = mysqli_query($link, $sql);
    while ($row = mysqli_fetch_array($result)){
        if ($row['status']==1){$stat="Выполнено";
    }
        else {
            $stat="Не выполнено";
        }
        if ($row['edit']==1){
            $ed="Отредактировано администратором";
        }
        else {
            $ed="";
        }
            echo 
            "<tr class='task'>
                    <td class='left'> <div class='title'>Имя: </div>" .
                        $row['name'] . "<br/><div class='title'>E-mail: </div>" . $row['mail'] .
                    "</td>
                    <td class='right'><div class='title'>Текст задания: </div>" . 
                        htmlspecialchars($row['text']) .
                    "</td>
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
<a href='#' id='add2'>Добавить задачу</a>
<?
require'add.php';
?>
