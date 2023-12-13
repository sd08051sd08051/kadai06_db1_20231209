<?php 

require_once('includes/db.php');

//２．データ取得SQL作成
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




// $servername="localhost";
// $username = "sqluser";
// $password="sqlpass";
// $dbname = "notes"; 

// $conn = new mysqli($servername, $username, $password, $database);

// 接続を確認
// if ($conn->connect_error) {
//     die("Connection failed: " . $conn->connect_error);
// }

// ここにコードを追加

// $conn->close();

// $conn=mysqli_connect($servername,$username,$password,$dbname);
// if(!$conn){
//     die("Connection failed" . mysqli_connect_error());
// }
// echo "Connection successful!";

?>

<!DOCTYPE html>
<html>
    <head>
        <title>Notes App</title>
        <link rel="stylesheet" href="styles/style.css">
    </head>
    <header>
                Notes App
    </header>

    <div class="titleDiv">
            <div class="backLink"><a class="nav-link" href="index.php"> Home</a></div>
            <div class="head">New Note</div>
    </div>
    <form action="new.php" method="post">     

            <span class="label">Title</span>
            <input type="text" name="title" />
            
            <span class="label">Content</span>
            <textarea name="content"> </textarea>

            <div class="chkgroup">
                <span class="label-in">Important</span>
                <input type="hidden" name="important" value="0" />
                <input type="checkbox" name="important" value="1" />
            </div>
            
        <input type="submit" />
</html>

<?php 
require_once('includes/footer.php'); ?>