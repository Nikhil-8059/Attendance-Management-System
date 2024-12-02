<?php
include 'db.php';

// Fetch all students
$sql = "SELECT * FROM students";
$result = $conn->query($sql);
$students = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $students[] = $row;
    }
}

// Fetch all attendance records
$sql = "SELECT a.id, s.name, s.email, a.date, a.status FROM attendance a JOIN students s ON a.student_id = s.id";
$result = $conn->query($sql);
$attendanceRecords = [];
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $attendanceRecords[] = $row;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Student Attendance Management System</title>
    <style>
        body { font-family: Arial, sans-serif; margin: 20px; }
        table { width: 100%; border-collapse: collapse; margin-bottom: 20px; }
        table, th, td { border: 1px solid #ddd; }
        th, td { padding: 8px; text-align: left; }
        th { background-color: #f2f2f2; }
        a { text-decoration: none; color: #00f; }
        a:hover { text-decoration: underline; }
        .box { width: 300px; padding: 10px; border: 1px solid #ddd; margin-bottom: 20px; }
    </style>
</head>
<body>
    <h1>Student Attendance Management System</h1>
    <div class="box">
        <a href="add_student.php">Add New Student</a>
        <a href="mark_attendance.php">Mark Attendance</a>
    </div>
    <h2>Student List</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($students as $student): ?>
                <tr>
                    <td><?php echo $student['id']; ?></td>
                    <td><?php echo $student['name']; ?></td>
                    <td><?php echo $student['email']; ?></td>
                    <td>
                        <a href="edit_attendance.php?id=<?php echo $student['id']; ?>">Edit Attendance</a>
                        <a href="delete_attendance.php?id=<?php echo $student['id']; ?>">Delete Attendance</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <h2>Attendance Records</h2>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($attendanceRecords as $attendance): ?>
                <tr>
                    <td><?php echo $attendance['id']; ?></td>
                    <td><?php echo $attendance['name']; ?></td>
                    <td><?php echo $attendance['email']; ?></td>
                    <td><?php echo $attendance['date']; ?></td>
                    <td><?php echo $attendance['status']; ?></td>
                    <td>
                        <a href="edit_attendance.php?id=<?php echo $attendance['id']; ?>">Edit</a>
                        <a href="delete_attendance.php?id=<?php echo $attendance['id']; ?>">Delete</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>
