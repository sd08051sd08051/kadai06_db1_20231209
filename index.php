<?php 
require_once('includes/db.php');
$sql = "SELECT * FROM notes";
// mysqli_query($conn,$sql);
$stmt = $pdo->prepare("SELECT * FROM notes");
$status = $stmt->execute();

if($_SERVER["REQUEST_METHOD"]=="POST"){
    $title  = $_POST['title'];
    $content = $_POST['content'];
    $important = $_POST['important'];
    
    // セキュリティー対策として、プレースホルダーを使用したPDOの準備された文を使用
    $stmt = $pdo->prepare("INSERT INTO notes (title, content, important) VALUES (?, ?, ?)");
    $stmt->bindParam(1, $title, PDO::PARAM_STR);
    $stmt->bindParam(2, $content, PDO::PARAM_STR);
    $stmt->bindParam(3, $important, PDO::PARAM_INT);
    $stmt->execute();
    echo "success";
   
}
?>



<!DOCTYPE html>
<html>
    <head>
        <title>Notes App</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <body>
        <header> 
            Notes App
        </header>
        <div>
                <div>
                    <a class="nav-link" href="new.php">Add a new note</a>
                </div>
                <?php 
                while ($note=mysqli_fetch_assoc($notes)){

                
                ?>
                    <div class="note">
                        <div class="titleContainer">
                            <span class="nt-title"><?php echo $note['title'];  ?></span>
                            <div class="nt-links">
                                <a class="nt-link" href=<?php echo 'edit.php?id='.$note['id'];  ?>>edit note</a>
                                <a class="nt-link" href="<?php echo 'delete.php?id='.$note['id'];  ?>">[X] delete note</a>
                            </div>                 
                        </div>
                    
                         <div class="nt-content"><?php if($note['important']){
                            echo "<span class='imp'>IMPORTANT</span>";
                         } ?><?php echo $note['content'];  ?></div>
                    </div>
                    <?php } 
                    mysqli_free_result($notes);
                    ?>
        </div> 
    </body>
</html>


<?php 
require_once('includes/footer.php'); ?>
