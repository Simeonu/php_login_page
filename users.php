<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My_Table</title>
    <link rel="stylesheet" href="index.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
</head>
<body>

    <div class="container my-4">

        <table class="table caption-top">

            <thead>
              <tr>
                <th scope="col">S/n</th>
                <th scope="col">Name</th>
                <th scope="col">Email</th>
                <th scope="col">Gender</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
            <?php   
                require_once('db.php');   
                $sql   = "SELECT * FROM `user_info`";
                $query = $con->query($sql);

                if($query){
                    $counter = 0;
                    while($row = $query->fetch_assoc()){
                        
                        echo '<tr>
                                <th scope="row">'.( ++$counter ).'</th>
                                <td>'.$row['name'].'</td>
                                <td>'.$row['email'].'</td>
                                <td>'.$row['gender'].'</td>
                                <td>
                                    <a  href = "?u='.$row['user_id'].'&action=edit" class="btn btn-secondary btn-sm"> <i class="bi bi-pencil"></i> Edit</a>
                                    <a  href = "?u='.$row['user_id'].'&action=del" class="btn btn-danger btn-sm"><i class="bi bi-trash3"></i> delete</a>
                                </td>
                            </tr>
                        ';

                    } 
                  
                }



                // Trying to Delete record
                if(isset($_GET['u']) &&  !empty($_GET['u'])){

                    if(isset($_GET['action']) &&  !empty($_GET['action'])){
                        $action = trim($_GET['action']);
                        $id     = intval(trim($_GET['u'])); 
                        switch($action){
                            case 'del': 
                                // do the Delete from the db
                                $sql_del = "DELETE FROM `user_info` WHERE `user_id` = '$id'";
                                // execute the query
                                $q = $con->query($sql_del);
                                if($q){
                                   echo '<div class="alert alert-succcess" role="alert"> Successfuly Deleted Record!</div>';
                                }else{
                                   echo '<div class="alert alert-danger" role="alert"> Error Deleting Record!</div>';
                                }
                            break;

                            case 'edit':


                            break;
                        }
                    }


                }
            
            ?>


            </tbody>
          </table>

    </div>


</body>
</html>