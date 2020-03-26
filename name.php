<?php
    require __DIR__ . '/vendor/autoload.php';
    use Google\Cloud\Datastore\DatastoreClient;
    session_start();
   
    if(!isset($_SESSION["username"]))
   {
    header("Location: /login.php");
   }
   
    $projectId = 'thiennguyen-003';
    $datastore = new DatastoreClient([
        'projectId' => $projectId
    ]);
    if(isset($_POST['newname']))
   {
        $_SESSION["username"] = $_POST['newname'];
        $kind = 'id';
        $name =  $_SESSION["id"];
        $key = $datastore->key($kind, $name);
        $user = $datastore->lookup($key);
        $user['name'] = htmlspecialchars($_POST['newname']);
        $datastore->update($user);
        $datastore->commit();
        header("Location: /main.php");
                
   }
   else
   {
        echo "User name cannot be empty";
   }
?>

<html>
    <body>
    <form method="post">
        <div>New User Name: <input type = "text" name = "newname"></textarea></div>
        <div><input type="submit" value="Change"></div>
    </form>
    </body>
</html>