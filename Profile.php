<?php include("header.php"); ?>
<div class="wrapper profile">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">
                <h2>Profile</h2>
                <?php 
                    $user_id = $_SESSION["user_id"];
                    $message = "";
                    $error = "";
                    // Handle profile update
                    if ($_SERVER["REQUEST_METHOD"] === "POST") {
                        $name = trim($_POST["name"]);
                        $email = trim($_POST["email"]);
                        $old_password = $_POST["old_password"];
                        $new_password = $_POST["new_password"];
                        $confirm_password = $_POST["confirm_password"];

                        if (!empty($name) && !empty($email)) {
                            if (!empty($old_password) && !empty($new_password) && !empty($confirm_password)) {
                                if ($old_password == $user["password"]) {
                                    if ($new_password === $confirm_password) {
                                        $stmt = $conn->prepare("UPDATE users SET name = ?, email_address = ?, password = ? WHERE id = ?");
                                        $stmt->bind_param("sssi", $name, $email, $new_password, $user_id);
                                        $stmt->execute();
                                        $stmt->close();
                                        $message = "Profile and password updated successfully.";
                                    } else {
                                        $error = "New password and confirmation do not match.";
                                    }
                                } else {
                                    $error = "Incorrect current password.";
                                }
                            } else {
                                // Only update name and email
                                $stmt = $conn->prepare("UPDATE users SET name = ?, email_address = ? WHERE id = ?");
                                $stmt->bind_param("ssi", $name, $email, $user_id);
                                $stmt->execute();
                                $stmt->close();
                                $message = "Profile updated successfully.";
                            }
                            // Refresh user data after update
                            $user = getUser($user_id);
                        } else {
                            $error = "Name and email cannot be empty.";
                        }
                    }
                    if (!empty($error)) {
                        echo '<div class="info info-error">' . htmlspecialchars($error) . '</div>';
                        echo '<script>setTimeout(function(){ window.location.href = "Profile.php"; }, 1500);</script>';
                    } elseif (!empty($message)) {
                        echo '<div class="info info-success">' . htmlspecialchars($message) . '</div>';
                        echo '<script>setTimeout(function(){ window.location.href = "Profile.php"; }, 1500);</script>';
                    }
                   
                    ?>
                <form id="profile-form" class="data-form" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                    <div class="form-container">
                        <div class="row">
                            <div class="col-md-6">
                                <h3>Profile Information</h3>
                                <div class="form-row">
                                    <div class="form-col">
                                        <label>Name:</label>
                                        <input type="text" placeholder="Name" name="name" value="<?=$user["name"]?>"
                                            required>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-col">
                                        <label>Username:</label>
                                        <input type="text" placeholder="username" name="username"
                                            value="<?=$user["username"]?>" required readonly>
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-col">
                                        <label>Email Address:</label>
                                        <input type="email" placeholder="test@mail.com" name="email"
                                            value="<?=$user["email_address"]?>" required>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <h3>Change Password</h3>
                                <p><small>Leave password field(s) blank if you do not wish to change password</small></p>
                                <div class="form-row">
                                    <div class="form-col">
                                        <label>Current Password:</label>
                                        <input type="password" placeholder="Enter current password" name="old_password"
                                            value="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-col">
                                        <label>New Password:</label>
                                        <input type="password" placeholder="Enter new password" name="new_password"
                                            value="">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-col">
                                        <label>Confirm Password:</label>
                                        <input type="password" placeholder="Confirm new password"
                                            name="confirm_password" value="">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="form-actions">
                            <button type="submit" class="btn-submit">Update Profile</button>
                        </div>
                </form>
            </div><!-- end /content -->
        </div><!-- end /content-wrapper -->
    </div> <!-- end /page-wrapper -->
</div><!-- end wrapper -->

<?php include("footer.php"); ?>