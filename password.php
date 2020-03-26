<?php
    require __DIR__ . '/vendor/autoload.php';
    use Google\Cloud\Datastore\DatastoreClient;
    session_start();
    $projectId = 'thiennguyen-003';
    $datastore = new DatastoreClient([
        'projectId' => $projectId
    ]);
    
    if(!isset($_SESSION["username"]))
   {
    header("Location: /login.php");
   }
    
    if(isset($_POST['newpass']) && isset($_POST['oldpass']))
   {
       
        $kind = 'id';
        $name =  $_SESSION["id"];
        $key = $datastore->key($kind, $name);
        $user = $datastore->lookup($key);
    if($user['password'] == htmlspecialchars($_POST['oldpass']))
    {
           $user['password'] = htmlspecialchars($_POST['newpass']);
        $datastore->update($user);
        $datastore->commit();
        header("Location: /login.php");
    }
    else
    {
        echo "User password is incorrect";
    }
   }
   
?>

<html>
    <body>
    <form method="post">
        <div>Old Password <input type = "password" name = "oldpass"></textarea></div>
        <div>New Password <input type = "password" name = "newpass"></textarea></div>
        <div><input type="submit" value="Submit"></div>
    </form>
    </body>
</html>