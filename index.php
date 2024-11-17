<!doctype html>
<html lang="en">

<head>
    <title>Title</title>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <diV class="row mt-5">
            <div class="col-md-12">
                <h1>Guest Add</h1>
                <?php 
                            if(isset($_GET['successMsg'])){ ?>
                                <div class=" col-md-4 alert alert-success" role="alert">
                                    <?php echo $_GET['successMsg']; ?>    
                                </div>
                                <?php 
                            }
                            ?>
                <form method="POST" action="action/upload_action.php" enctype="multipart/form-data">
                <div class="form-group">
                        <label for="exampleInputEmail1">Username </label>
                        <input type="text" name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email">
                       
                    </div>
                    <div class="form-group">
                        <label for="exampleInputEmail1">Email address</label>
                        <input name="email" type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                            placeholder="Enter email">
                        <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone
                            else.</small>
                    </div>
                    <div class="form-group">
                        <label for="file">File Upload</label>
                        <input type="file" name="image"  class="form-control-file" id="file">
                        <?php 
                            if(isset($_GET['msg'])){ ?>
                                <div class=" col-md-4 alert alert-danger" role="alert">
                                    <?php echo $_GET['msg']; ?>    
                                </div>
                                <?php 
                            }
                            ?>
                      
                    </div>
                    <div class="form-check">
                        <input type="checkbox" class="form-check-input" id="exampleCheck1">
                        <label class="form-check-label" for="exampleCheck1">Check me out</label>
                    </div>
                    <button type="submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </diV>
        <div class="row mt-5">
                            <h1>Guest list</h1>
                <div class="col-md-12">
                        <table class="table table-striped table-inverse table-responsive">
                            <thead class="thead-inverse">
                                <tr>
                                    <th>#</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th> Image</th>
                                    <th> Delete</th>
                                    <th> Edit</th>
                                </tr>
                                </thead>
                                <?php 
                                    include_once 'action/conn.php';
                                    $sql = "SELECT * FROM guest order by   guest_id desc";
                                    $result = $conn->query($sql);
                                    if ($result->num_rows > 0) {
                                        while($row = $result->fetch_assoc()) {
                                            echo "<tr>";
                                            echo "<td>" . $row['guest_id'] . "</td>";
                                            echo "<td>" . $row['guest_name'] . "</td>";
                                            echo "<td>" . $row['guest_email'] . "</td>";
                                            echo "<td><img src='images/" . $row['guest_image'] . "' width='50px' height='50px'/></td>";
                                            echo "<td> 
                                            <form method='POST' action='action/delete_guest.php'>
                                            <input type='hidden' name='id' value='" . $row['guest_id'] . "'>
                                            <input type='hidden' name='image_name' value='" . $row['guest_image'] . "'>

                                            <button type='submit' class='btn btn-danger'>Delete</button>
                                            </form>
                                            
                                            ";
                                            echo "<td> <a href='edit_guest.php?id=" . $row['guest_id'] . "' class='btn btn-success'>Edit</td>";
                                            echo "</tr>";
                                        }
                                    }
                                ?>
    
                        </table>
                </div>
            </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
        crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
        crossorigin="anonymous"></script>
</body>

</html>