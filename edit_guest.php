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
        <div class="row mt-5">
            <div class="col-md-6">
                <?php
                include_once 'action/conn.php';
                if (isset($_GET['id'])) {
                    $guest_id = $_GET['id'];

                    // Select the guest data from the database
                    $sql = "SELECT * FROM guest WHERE guest_id = ?";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param("i", $guest_id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows > 0) {
                        // Fetch the guest data
                        $row = $result->fetch_assoc();
                    } else {
                        echo "No guest found.";
                        exit;
                    }
                } else {
                    echo "No ID provided.";
                    exit;
                }

                ?>
                <h1>Update guest : <?php echo $row['guest_name']; ?></h1>
                <form method="POST" action="action/update_guest.php" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="guest_name">Name:</label>
                        <input type="text" name="guest_name" class="form-control" id="guest_name"
                            value="<?php echo htmlspecialchars($row['guest_name']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="guest_email">Email:</label>
                        <input type="email" name="guest_email" class="form-control" id="guest_email"
                            value="<?php echo htmlspecialchars($row['guest_email']); ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="current_image">Current Image:</label><br>
                        <?php if (!empty($row['guest_image'])): ?>
                            <img src="images/<?php echo htmlspecialchars($row['guest_image']); ?>"
                                alt="<?php echo htmlspecialchars($row['guest_name']); ?>"
                                style="max-width: 200px; max-height: 200px; border: 1px solid #ccc;">
                        <?php else: ?>
                            <p>No image available.</p>
                        <?php endif; ?>
                    </div>
                    <div class="form-group">
                        <label for="guest_image">Image (optional):</label>
                        <input type="file" name="guest_image" class="form-control-file" id="guest_image">
                    </div>
                    <input type="hidden" name="guest_id" value="<?php echo $row['guest_id']; ?>">
                    <button type="submit" class="btn btn-primary">Update Guest</button>
                    <a href="../index.php" class="btn btn-secondary">Cancel</a>
                </form>
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