<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">
                <?php
                if(isset($user["manage_staff"]) && $user["manage_staff"] == 0 ):
                    echo "<div class='info info-error'>You don't have a permission to manage accounts.</div>";
                else:?>
                <h2>Manage Accounts</h2>
                <?php if(isset($user["manage_staff"]) && $user["manage_staff"] == 1 ):?>
                <div class="action addnew">
                    <a href="?action=addnew" class="btn btn-new btn-submit">Add New</a>
                </div>
                <?php endif; ?>

                <?php
        $data = [
            'id' => '',
            'name' => '',
            'username' => '',
            'email_address' => '',
            'account_type' => '',
            'is_approved' => ''
        ];

        $form_title = "Add New User";
        $form_action = "add";
        $record_id = "";
        $delete_confirmation = false;

        if (isset($_GET['action']) && isset($_GET['id'])) {
            $id = sanitize_input($_GET['id']);
            $record_id = $id;

            if(isset($user["manage_staff"]) && $user["manage_staff"] == 1 ){
                if ($_GET['action'] === 'edit') {

                    $sql = "SELECT * FROM users WHERE id = ?";
                    $stmt = $conn->prepare($sql);
                    if ($stmt === false) {
                        die("Error preparing statement: " . $conn->error);
                    }
                    $stmt->bind_param("i", $id);
                    $stmt->execute();
                    $result = $stmt->get_result();

                    if ($result->num_rows === 1) {
                        $row                    = $result->fetch_assoc();
                        $data['id']             = $row['id'];
                        $data['name']           = $row['name'];
                        $data['username']       = $row['username'];
                        $data['email_address']  = $row['email_address'];
                        $data['account_type']   = $row['account_type'];
                        $form_title             = "Edit Record";
                        $form_action            = "edit";
                    } else {
                        echo "<div class='info info-error'>Record not found.</div>";
                        exit;
                    }
                    $stmt->close();
                } elseif ($_GET['action'] === 'delete') {
                    $delete_confirmation = true;
                    $sql_name = "SELECT * FROM users WHERE id = ?";
                    $stmt_name = $conn->prepare($sql_name);
                    if ($stmt_name === false) {
                        die("Error preparing statement: " . $conn->error);
                    }
                    $stmt_name->bind_param("i", $id);
                    $stmt_name->execute();
                    $result_name = $stmt_name->get_result();
                    if ($result_name->num_rows === 1) {
                        $row_name = $result_name->fetch_assoc();
                        $data['name'] = $row_name['name'];
                    } else {
                        echo "<div class='info info-error'>Record not found for deletion.</div>";
                        exit;
                    }
                    $stmt_name->close();
                }
            }else{
                echo "<div class='info info-error'>You don't have a permission to manage accounts.</div>";
                exit;
            }
        }

        // Process form submission
        if ($_SERVER["REQUEST_METHOD"] === "POST") {

            if( $_POST["form_action"] == "edit" || $_POST["form_action"] == "add"){
                $name = sanitize_input($_POST['name']);
                $username = sanitize_input($_POST['username']);
                $account_type = sanitize_input($_POST['account_type']);
                $email_address = sanitize_input($_POST['email_address']);
                $password = sanitize_input($_POST['password']);
                $confirm_password = sanitize_input($_POST['confirm_password']);
            }

            if ($_POST['form_action'] === 'edit' && !empty($_POST['record_id'])) {
                
                $id_to_update = sanitize_input($_POST['record_id']);

                $update_sql = "UPDATE users SET name=?, username=?, email_address=?, account_type=? WHERE id=?";
                $stmt = $conn->prepare($update_sql);

                if ($stmt === false) {
                    die("Error preparing update statement: " . $conn->error);
                }

                $stmt->bind_param("ssssi", $name, $username, $email_address, $account_type, $id_to_update);

                if ($stmt->execute()) {
                    echo "<div class='info info-success'>Record updated successfully!</div>";
                    echo '<script>setTimeout(function(){ window.location.href = "ManageAccounts.php"; }, 1500);</script>';
                } else {
                    echo "<div class='info info-error'>Error updating record: " . $stmt->error . "</div>";
                }

                $stmt->close();
            } elseif ($_POST['form_action'] === 'add') {
                $insert_sql = "INSERT INTO users (name, username, email_address, account_type, password) VALUES (?, ?, ?, ?, ?)";
                $stmt = $conn->prepare($insert_sql);
                if ($stmt === false) {
                    die("Error preparing insert statement: " . $conn->error);
                }
                $stmt->bind_param("sssss", $name, $username, $email_address, $account_type, $password);

                if ($stmt->execute()) {
                    echo "<div class='info info-success'>New record added successfully!</div>";
                    echo '<script>setTimeout(function(){ window.location.href = "ManageAccounts.php"; }, 1500);</script>';
                } else {
                    echo "<div class='info info-error'>Error adding record: " . $stmt->error . "</div>";
                }
                $stmt->close();
            } elseif ($_POST['form_action'] === 'confirm_delete' ) {

                if($_POST["record_id"] == 1){
                    echo "<div class='info info-error'>Error deleting record: Primary system account cannot be deleted.</div>";
                }else{
                    $id_to_delete = sanitize_input($_POST['record_id']);
                    $delete_sql = "DELETE FROM users WHERE id = ?";
                    $stmt_delete = $conn->prepare($delete_sql);
                    if ($stmt_delete === false) {
                        die("Error preparing delete statement: " . $conn->error);
                    }
                    $stmt_delete->bind_param("i", $id_to_delete);
                    if ($stmt_delete->execute()) {
                        echo "<div class='info info-success'>Record deleted successfully!</div>";
                        echo '<script>setTimeout(function(){ window.location.href = "ManageAccounts.php"; }, 1500);</script>';
                    } else {
                        echo "<div class='info info-error'>Error deleting record: " . $stmt_delete->error . "</div>";
                    }
                    $stmt_delete->close();
                }

            } else {
                echo "Invalid form action.";
            }
        }

        ?>

                <div class="form-container" <?php if(!isset($_GET["action"])): ?> style="display:none;" <?php endif; ?>>
                    <?php if(isset($_GET["action"]) && $_GET["action"] != "delete"): ?>
                    <h3><?=$form_title?></h3>
                    <form id="account-form" class="data-form" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                        <input type="hidden" name="form_action" value="<?php echo $form_action; ?>">
                        <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                        <!-- Same structure as professional but with different options -->
                        <div class="form-row">
                            <div class="form-col">
                                <label>Name:</label>
                                <input type="text" placeholder="Name" name="name"
                                    value="<?= htmlspecialchars($data['name'] ?? "") ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Email Address:</label>
                                <input type="text" placeholder="Email Address" name="email_address"
                                    value="<?= htmlspecialchars($data['email_address'] ?? "") ?>" required>
                            </div>
                            <div class="form-col"></div>
                        </div>
                        <div class="form-row">
                        <div class="form-col">
                                <label>Account Type:</label>
                                <select name="account_type" required>
                                    <option <?=$data['account_type'] == "Division" ? "selected='selected'" : ''?>
                                        value="Division">Division</option>
                                    <option <?=$data['account_type'] == "Regional" ? "selected='selected'" : ''?>
                                        value="Regional">Regional</option>
                                    <option <?=$data['account_type'] == "Staff" ? "selected='selected'" : ''?>
                                        value="Staff">Staff</option>
                                </select>
                            </div>
                            <div class="form-col">
                                <label>Username:</label>
                                <input type="text" placeholder="Username" name="username"
                                    value="<?= htmlspecialchars($data['username']) ?>" required>
                            </div>
                            <div class="form-col"></div>
                        </div>
                        <div class="form-row">

                            <?php if($form_action === "edit"): ?>
                            <div class="form-col">
                                <label>Old Password:</label>
                                <input type="password" name="old_password">
                            </div>
                            <?php endif; ?>
                            <div class="form-col">
                                <label>Password:</label>
                                <input type="password" name="password">
                            </div>
                            <div class="form-col">
                                <label>Confirm Password:</label>
                                <input type="password" name="confirm_password">
                            </div>
                            <?php if($form_action === "add"): ?>
                                <div class="form-col"></div>
                            <?php endif; ?>
                        </div>
                        <?php if($form_action === "edit"): ?>
                        <div class="form-row">
                            <p><small><i>Leave password field(s) blank to keep old password</i></small></p>
                        </div>
                        <?php endif; ?>
                        <div class="form-actions">
                            <a href="ManageAccounts.php" class="btn btn-cancel">Cancel</a>
                            <button type="submit"
                                class="btn-submit"><?php echo ($form_action === 'edit') ? 'Update' : 'Submit'; ?></button>
                        </div>
                    </form>

                    <?php else: ?>
                    <div class="confirm-delete">
                        <h3>Delete Record</h3>
                        <p><b><?= $data["name"] ?></b> record will be deleted. Proceed?</p>

                        <form id="delete-form" class="data-form" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                            <input type="hidden" name="form_action" value="confirm_delete">
                            <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                            <div class="delete-action">
                                <a href="ManageAccounts.php" class="btn btn-cancel">Cancel</a>
                                <button type="submit" class="btn btn-submit-delete">Confirm</button>
                            </div>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
                <div class="card">
                    <div class="card-body">
                        <div class="table-container">
                            <?php
                $headers = [
                    "ID",
                    "Name",
                    "Username",
                    "Email",
                    "Type",
                    "Status"
                ];
                $data = [];
                $offset = 0;
                $sql = "SELECT * FROM users ORDER BY id ASC";
                $result = $conn->query($sql);
                if ($result->num_rows > 0) {
                    $count = $offset + 1;
                    while($row = $result->fetch_assoc()) {
                        $d = [ 
                            $count, 
                            $row["name"], 
                            $row["username"], 
                            $row["email_address"], 
                            $row["account_type"],
                            $row["is_approved"] == 0 ? "Pending Approval" : ($row["is_approved"] == 1 ? "Approved" : "Rejected"),
                            $row["id"]
                        ];
                        array_push($data, $d) ;
                        $count++;
                    }
                }
                echo generateDataTable( $headers, $data, "No records found", true );
            ?>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

            </div><!-- end /content -->
        </div><!-- end /content-wrapper -->
    </div> <!-- end /page-wrapper -->
</div><!-- end wrapper -->

<script>
document.addEventListener("DOMContentLoaded", function () {
    const form = document.getElementById("account-form");
    if (!form) return;

    form.addEventListener("submit", function (e) {
        const formAction = form.querySelector("input[name='form_action']");
        if (!formAction || formAction.value !== "add") return;

        const passwordInput = form.querySelector("input[name='password']");
        const confirmInput = form.querySelector("input[name='confirm_password']");
        const password = passwordInput?.value.trim();
        const confirm = confirmInput?.value.trim();

        if (!password || !confirm) {
            e.preventDefault();
            alert("Password and Confirm Password cannot be empty.");
            return;
        }

        if (password !== confirm) {
            e.preventDefault();
            alert("Passwords do not match.");
        }
    });
});
</script>



<?php include("footer.php"); ?>