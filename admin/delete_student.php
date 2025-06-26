<?php
// Include any necessary files, session checks, etc.
include '../includes/config.php';
include '../includes/auth_validate.php';

// Check if admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    header("Location: ../login.php");
    exit;
}

$student_id = isset($_GET['id']) ? intval($_GET['id']) : 0;

if (!$student_id) {
    header("Location: manage_students.php");
    exit;
}

// Get user_id from student record to delete associated user account
$query = "SELECT user_id FROM students WHERE id = $student_id";
$result = mysqli_query($conn, $query);
$student = mysqli_fetch_assoc($result);

if ($student) {
    $user_id = $student['user_id'];
    
    // Begin transaction to ensure both records are deleted or none
    mysqli_begin_transaction($conn);
    
    try {
        // Delete student record
        $delete_student = "DELETE FROM students WHERE id = $student_id";
        mysqli_query($conn, $delete_student);
        
        // Delete user account
        $delete_user = "DELETE FROM users WHERE id = $user_id";
        mysqli_query($conn, $delete_user);
        
        // Commit transaction
        mysqli_commit($conn);
        
        $_SESSION['success_msg'] = "Student deleted successfully!";
    } catch (Exception $e) {
        // Rollback in case of error
        mysqli_rollback($conn);
        $_SESSION['error_msg'] = "Error deleting student: " . $e->getMessage();
    }
} else {
    $_SESSION['error_msg'] = "Student not found!";
}

header("Location: manage_students.php");
exit;
?>
