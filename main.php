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
    echo "WELCOME ". htmlspecialchars($_SESSION["username"]); 
?>

<html>
    <body>
   
        <div>
            <button onclick="window.location.href='/name.php'">Change name</button>
            <button onclick="window.location.href='/password.php'">Change password</button>
        </div>
   
    </body>

</html>