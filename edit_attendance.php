<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM attendance WHERE id=$id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $attendance = $result->fetch_assoc();
    } else {
        echo "No attendance record found with the given ID.";
        exit();
    }
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id = $_POST['id'];
    $status = $_POST['status'];
    $date = $_POST['date'];

    $sql = "UPDATE attendance SET status='$status', date='$date' WHERE id=$id";
    if ($conn->query($sql) === TRUE) {
        echo "Attendance record updated successfully";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Attendance</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        form { margin-bottom: 20px; }
        label { display: block; margin-bottom: 5px; }
        input[type="date"], select { width: 100%; padding: 8px; margin-bottom: 10px; }
        button { padding: 10px 15px; background-color: #4CAF50; color: white; border: none; cursor: pointer; }
        button:hover { background-color: #45a049; }
        .box { width: 300px; padding: 10px; border: 1px solid #ddd; margin-bottom: 20px; }
    </style>
</head>
<body>
    <div class="box">
        <h1>Edit Attendance</h1>
        <form action="edit_attendance.php" method="POST">
            <input type="hidden" name="id" value="<?php echo isset($attendance['id']) ? $attendance['id'] : ''; ?>">
            <label for="date">Date:</label>
            <input type="date" id="date" name="date" value="<?php echo isset($attendance['date']) ? $attendance['date'] : ''; ?>" required>

            <label for="status">Status:</label>
            <select id="status" name="status" required>
                <option value="Present" <?php if (isset($attendance['status']) && $attendance['status'] == 'Present') echo 'selected'; ?>>Present</option>
                <option value="Absent" <?php if (isset($attendance['status']) && $attendance['status'] == 'Absent') echo 'selected'; ?>>Absent</option>
            </select>

            <button type="submit">Update Attendance</button>
        </form>
    </div>
    <a href="index.php">Back to Student List</a>
</body>
</html>
