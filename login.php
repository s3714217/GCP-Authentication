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
    
    
    if(array_key_exists('id', $_POST)) {
        if(array_key_exists('pass', $_POST))
        {
            $kind = 'id';
            $name = htmlspecialchars($_POST['id']);
            $key = $datastore->key($kind, $name);
            $user = $datastore->lookup($key);
            
            if($user['password'] == htmlspecialchars($_POST['pass']))
            {
                $_SESSION["username"] = $user['name'];
                $_SESSION["id"] = $name;
                header("Location: /main.php");
              
            }
            else
            {
                echo "User id or password is invalid";
            }
        }
    }
   
?>

<html>
    <body>
    <form method="post">
        <div>User ID: <input type = "text" name = "id"></textarea></div>
        <div>Password: <input type = "password" name = "pass"></textarea></div>
        <div><input type="submit" value="Log In"></div>
    </form>
    </body>

</html>
