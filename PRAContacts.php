<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">
                <h2>PRA'S Contacts</h2>

                <div class="action addnew">
                    <a href="?action=addnew" class="btn btn-new btn-submit">Add New</a>
                </div>
                <?php 

    $data = [
        'id' => '',
        'name' => '',
        'contact_persons' => '',
        'email_address' => '',
        'contact_numbers' => ''
    ];

$form_title = "Add New Record";
$form_action = "add";
$record_id = "";
$delete_confirmation = false;

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = sanitize_input($_GET['id']);
    $record_id = $id;

    if ($_GET['action'] === 'edit') {
        $sql = "SELECT * FROM pra_contacts WHERE id = ?";
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
            $data['contact_persons'] = $row['contact_persons'];
            $data['email_address'] = $row['email_address'];
            $data['contact_numbers'] = $row['contact_numbers'];
            $form_title             = "Edit Record";
            $form_action            = "edit";
        } else {
            echo "<div class='info info-error'>Record not found.</div>";
            exit;
        }
        $stmt->close();
    } elseif ($_GET['action'] === 'delete') {
        $delete_confirmation = true;
        $sql_name = "SELECT * FROM pra_contacts WHERE id = ?";
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
}

// Process form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    if( $_POST["form_action"] == "edit" || $_POST["form_action"] == "add"){
        $name = sanitize_input($_POST['name']);
        $contact_persons = sanitize_input($_POST['contact_persons']);
        $email_address = sanitize_input($_POST['email_address']);
        $contact_numbers = sanitize_input($_POST['contact_numbers']);
    }

    if ($_POST['form_action'] === 'edit' && !empty($_POST['record_id'])) {
        $id_to_update = sanitize_input($_POST['record_id']);
        $update_sql = "UPDATE pra_contacts SET name=?, contact_persons=?, email_address=?, contact_numbers=? WHERE id=?";
        $stmt = $conn->prepare($update_sql);
        if ($stmt === false) {
            die("Error preparing update statement: " . $conn->error);
        }
        $stmt->bind_param("ssssi", $name, $contact_persons, $email_address, $contact_numbers, $id_to_update);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>Record updated successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "PRAContacts.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error updating record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'add') {
        $insert_sql = "INSERT INTO pra_contacts (name, contact_persons, email_address, contact_numbers) VALUES (?, ?, ?, ? )";
        $stmt = $conn->prepare($insert_sql);
        if ($stmt === false) {
            die("Error preparing insert statement: " . $conn->error);
        }
        $stmt->bind_param("ssss", $name, $contact_persons, $email_address, $contact_numbers);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>New record added successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "PRAContacts.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error adding record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'confirm_delete' ) {
        $id_to_delete = sanitize_input($_POST['record_id']);
        $delete_sql = "DELETE FROM pra_contacts WHERE id = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        if ($stmt_delete === false) {
            die("Error preparing delete statement: " . $conn->error);
        }
        $stmt_delete->bind_param("i", $id_to_delete);
        if ($stmt_delete->execute()) {
            echo "<div class='info info-success'>Record deleted successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "PRAContacts.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error deleting record: " . $stmt_delete->error . "</div>";
        }
        $stmt_delete->close();
    } else {
        echo "Invalid form action.";
    }
}

?>

                <div class="form-container" <?php if(!isset($_GET["action"])): ?> style="display:none;" <?php endif; ?>>
                    <?php if(isset($_GET["action"]) && $_GET["action"] != "delete"): ?>
                    <h3><?=$form_title?></h3>
                    <form id="evaluation-form" class="data-form" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                        <input type="hidden" name="form_action" value="<?php echo $form_action; ?>">
                        <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                        <!-- Same structure as professional but with different options -->
                        <div class="form-row">
                            <div class="form-col">
                                <label>Name:</label>
                                <input type="text" placeholder="Name" name="name"
                                    value="<?= htmlspecialchars($data['name']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Contact Persons:</label>
                                <input type="text" placeholder="Contact Person(s)" name="contact_persons"
                                    value="<?= htmlspecialchars($data['contact_persons']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Email Address:</label>
                                <input type="text" placeholder="Email Address" name="email_address"
                                    value="<?= htmlspecialchars($data['email_address']) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Contact No(s):</label>
                                <input type="text" placeholder="+36 123-4567-890" name="contact_numbers"
                                    value="<?= htmlspecialchars($data['contact_numbers']) ?>" required>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="PRAContacts.php" class="btn btn-cancel">Cancel</a>
                            <button type="submit"
                                class="btn-submit"><?php echo ($form_action === 'edit') ? 'Update' : 'Submit'; ?></button>
                        </div>
                    </form>

                    <?php else: ?>
                    <div class="confirm-delete">
                        <h3>Delete Record</h3>
                        <p><b><?= $data["name"] ?></b> record will be deleted. Proceed?</p>

                        <form id="Denied-form" class="data-form" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                            <input type="hidden" name="form_action" value="confirm_delete">
                            <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                            <div class="delete-action">
                                <a href="PRAContacts.php" class="btn btn-cancel">Cancel</a>
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
                "No.",
                "Name",
                "Contact Persons",
                "Email Address",
                "Contact Numbers"
            ];
            $data = [];
            $sql = "SELECT * FROM pra_contacts ORDER BY id DESC";
            $result = $conn->query($sql);
            $offset = 0;
            if ($result->num_rows > 0) {
                $count = $offset + 1;
                while($row = $result->fetch_assoc()) {
                    
                    $d = [ 
                        $count, 
                        $row["name"], 
                        $row["contact_persons"], 
                        $row["email_address"], 
                        $row["contact_numbers"], 
                        $row["id"],
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
            </div><!-- end /content -->
        </div><!-- end /content-wrapper -->
    </div> <!-- end /page-wrapper -->
</div><!-- end wrapper -->

<script>
jQuery(function() {
    $(".btn-cancel").on("click", function() {
        $(".form-container").slideToggle();
    });
});
</script>

<?php include("footer.php"); ?>