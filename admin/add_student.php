<?php
// Include any necessary files, session checks, etc.
include '../includes/config.php';
include '../includes/auth_validate.php';

// Check if admin
if (!isset($_SESSION['admin']) || $_SESSION['admin'] != 1) {
    header("Location: ../login.php");
    exit;
}

// Process form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // First, create a user account
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    
    // Check if email already exists
    $check_query = "SELECT id FROM users WHERE email = '$email'";
    $check_result = mysqli_query($conn, $check_query);
    
    if (mysqli_num_rows($check_result) > 0) {
        $_SESSION['error_msg'] = "Email already exists!";
    } else {
        // Insert user
        $user_query = "INSERT INTO users (email, password, role) VALUES ('$email', '$password', 'student')";
        if (mysqli_query($conn, $user_query)) {
            $user_id = mysqli_insert_id($conn);
            
            // Now insert student details
            $name = mysqli_real_escape_string($conn, $_POST['name']);
            $session = mysqli_real_escape_string($conn, $_POST['session']);
            $aadhaar_no = mysqli_real_escape_string($conn, $_POST['aadhaar_no']);
            $father_name = mysqli_real_escape_string($conn, $_POST['father_name']);
            $mother_name = mysqli_real_escape_string($conn, $_POST['mother_name']);
            $dob = mysqli_real_escape_string($conn, $_POST['dob']);
            $nationality = mysqli_real_escape_string($conn, $_POST['nationality']);
            $category = mysqli_real_escape_string($conn, $_POST['category']);
            $sex = mysqli_real_escape_string($conn, $_POST['sex']);
            $blood_group = mysqli_real_escape_string($conn, $_POST['blood_group']);
            $religion = mysqli_real_escape_string($conn, $_POST['religion']);
            $guardian_name = mysqli_real_escape_string($conn, $_POST['guardian_name']);
            $guardian_address = mysqli_real_escape_string($conn, $_POST['guardian_address']);
            $guardian_mobile = mysqli_real_escape_string($conn, $_POST['guardian_mobile']);
            $relation_with_guardian = mysqli_real_escape_string($conn, $_POST['relation_with_guardian']);
            $residence_status = mysqli_real_escape_string($conn, $_POST['residence_status']);
            $student_address = mysqli_real_escape_string($conn, $_POST['student_address']);
            $state = mysqli_real_escape_string($conn, $_POST['state']);
            $district = mysqli_real_escape_string($conn, $_POST['district']);
            $pin = mysqli_real_escape_string($conn, $_POST['pin']);
            $alternate_mobile = mysqli_real_escape_string($conn, $_POST['alternate_mobile']);
            $reg_no = mysqli_real_escape_string($conn, $_POST['reg_no']);
            $roll_no = mysqli_real_escape_string($conn, $_POST['roll_no']);
            
            $student_query = "INSERT INTO students (user_id, name, session, aadhaar_no, father_name, mother_name, 
                            dob, nationality, category, sex, blood_group, religion, guardian_name, guardian_address, 
                            guardian_mobile, relation_with_guardian, residence_status, student_address, state, 
                            district, pin, alternate_mobile, reg_no, roll_no) 
                            VALUES ($user_id, '$name', '$session', '$aadhaar_no', '$father_name', '$mother_name', 
                            '$dob', '$nationality', '$category', '$sex', '$blood_group', '$religion', '$guardian_name', 
                            '$guardian_address', '$guardian_mobile', '$relation_with_guardian', '$residence_status', 
                            '$student_address', '$state', '$district', '$pin', '$alternate_mobile', '$reg_no', '$roll_no')";
            
            if (mysqli_query($conn, $student_query)) {
                $_SESSION['success_msg'] = "Student added successfully!";
                header("Location: manage_students.php");
                exit;
            } else {
                // If student insertion fails, delete the created user
                $delete_user = "DELETE FROM users WHERE id = $user_id";
                mysqli_query($conn, $delete_user);
                $_SESSION['error_msg'] = "Error adding student: " . mysqli_error($conn);
            }
        } else {
            $_SESSION['error_msg'] = "Error creating user: " . mysqli_error($conn);
        }
    }
}

include '../includes/header.php';
?>

<div class="container mt-4">
    <h2>Add New Student</h2>
    
    <?php if(isset($_SESSION['error_msg'])): ?>
        <div class="alert alert-danger"><?php echo $_SESSION['error_msg']; unset($_SESSION['error_msg']); ?></div>
    <?php endif; ?>
    
    <div class="card">
        <div class="card-header">
            <h4>Student Information</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="">
                <div class="row">
                    <div class="col-md-6">
                        <h5>Account Information</h5>
                        <div class="form-group">
                            <label>Email*</label>
                            <input type="email" name="email" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Password*</label>
                            <input type="password" name="password" class="form-control" required>
                        </div>
                        
                        <h5 class="mt-4">Basic Information</h5>
                        <div class="form-group">
                            <label>Name*</label>
                            <input type="text" name="name" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Session*</label>
                            <input type="text" name="session" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Aadhaar Number*</label>
                            <input type="text" name="aadhaar_no" class="form-control" required>
                        </div>
                        
                        <div class="form-group">
                            <label>Father's Name</label>
                            <input type="text" name="father_name" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Mother's Name</label>
                            <input type="text" name="mother_name" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Date of Birth</label>
                            <input type="date" name="dob" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Nationality</label>
                            <input type="text" name="nationality" class="form-control" value="Indian">
                        </div>
                        
                        <div class="form-group">
                            <label>Category</label>
                            <select name="category" class="form-control">
                                <option value="General">General</option>
                                <option value="SC">SC</option>
                                <option value="ST">ST</option>
                                <option value="OBC">OBC</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Sex</label>
                            <select name="sex" class="form-control">
                                <option value="Male">Male</option>
                                <option value="Female">Female</option>
                                <option value="Other">Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Blood Group</label>
                            <input type="text" name="blood_group" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Religion</label>
                            <input type="text" name="religion" class="form-control">
                        </div>
                    </div>
                    
                    <div class="col-md-6">
                        <h5>Contact & Guardian Information</h5>
                        <div class="form-group">
                            <label>Guardian's Name</label>
                            <input type="text" name="guardian_name" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Guardian's Address</label>
                            <textarea name="guardian_address" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>Guardian's Mobile</label>
                            <input type="text" name="guardian_mobile" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Relation with Guardian</label>
                            <input type="text" name="relation_with_guardian" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Residence Status</label>
                            <select name="residence_status" class="form-control">
                                <option value="Day Scholar">Day Scholar</option>
                                <option value="Hosteler">Hosteler</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label>Student Address</label>
                            <textarea name="student_address" class="form-control" rows="3"></textarea>
                        </div>
                        
                        <div class="form-group">
                            <label>State</label>
                            <input type="text" name="state" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>District</label>
                            <input type="text" name="district" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>PIN Code</label>
                            <input type="text" name="pin" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>Alternate Mobile</label>
                            <input type="text" name="alternate_mobile" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>University Registration No.</label>
                            <input type="text" name="reg_no" class="form-control">
                        </div>
                        
                        <div class="form-group">
                            <label>University Roll No.</label>
                            <input type="text" name="roll_no" class="form-control">
                        </div>
                    </div>
                </div>
                
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-primary">Add Student</button>
                    <a href="manage_students.php" class="btn btn-secondary">Cancel</a>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
