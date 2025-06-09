<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">

                <h2>Denied</h2>

                <!-- <div class="action addnew">
        <a href="?action=addnew" class="btn btn-new btn-submit">Add New</a>
    </div> -->
                <?php 

    $data = [
    'id' => '',
    'name' => '',
    'date' => '',
    'jobsite' => '',
    'reason' => '' 
];

$form_title = "Add New Record";
$form_action = "add";
$record_id = "";
$delete_confirmation = false;

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = sanitize_input($_GET['id']);
    $record_id = $id;

    if ($_GET['action'] === 'edit') {
        $sql = "SELECT id, name, date, jobsite, reason FROM direct_hire WHERE id = ?";
        $stmt = $conn->prepare($sql);
        if ($stmt === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt->bind_param("i", $id);
        $stmt->execute();
        $result = $stmt->get_result();

        if ($result->num_rows === 1) {
            $row = $result->fetch_assoc();
            $data['id'] = $row['id'];
            $data['name'] = $row['name'];
            $data['date'] = date("d/m/Y", strtotime($row['date']));
            $data['jobsite'] = $row['jobsite'];
            $data['reason'] = $row['reason'];
            $form_title = "Edit Record";
            $form_action = "edit";
        } else {
            echo "<div class='info info-error'>Record not found.</div>";
            exit;
        }
        $stmt->close();
    } elseif ($_GET['action'] === 'delete') {
        $delete_confirmation = true;
        $sql_name = "SELECT name FROM direct_hire WHERE id = ?";
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
        $date = sanitize_input($_POST['date']);
        $jobsite = sanitize_input($_POST['jobsite']);
        $reason = sanitize_input($_POST['reason']);
    }

    if ($_POST['form_action'] === 'edit' && !empty($_POST['record_id'])) {
        $id_to_update = sanitize_input($_POST['record_id']);
        $update_sql = "UPDATE direct_hire SET name=?, date=?, jobsite=?, reason=?, type='denied' WHERE id=?";
        $stmt = $conn->prepare($update_sql);
        if ($stmt === false) {
            die("Error preparing update statement: " . $conn->error);
        }
        $stmt->bind_param("ssssi", $name, $date, $jobsite, $reason, $id_to_update);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>Record updated successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "Denied.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error updating record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'add') {
        $insert_sql = "INSERT INTO direct_hire (name, date, jobsite, reason, type) VALUES (?, ?, ?, ?, ? )";
        $type = "denied";
        $stmt = $conn->prepare($insert_sql);
        if ($stmt === false) {
            die("Error preparing insert statement: " . $conn->error);
        }
        $stmt->bind_param("sssss", $name, $date, $jobsite, $reason, $type);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>New record added successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "Denied.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error adding record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'confirm_delete' ) {
        $id_to_delete = sanitize_input($_POST['record_id']);
        $delete_sql = "DELETE FROM direct_hire WHERE id = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        if ($stmt_delete === false) {
            die("Error preparing delete statement: " . $conn->error);
        }
        $stmt_delete->bind_param("i", $id_to_delete);
        if ($stmt_delete->execute()) {
            echo "<div class='info info-success'>Record deleted successfully!</div>";
            // Optionally redirect after successful deletion
            echo '<script>setTimeout(function(){ window.location.href = "Denied.php"; }, 1500);</script>';
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
                    <form id="denied-form" class="data-form" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                        <input type="hidden" name="form_action" value="<?php echo $form_action; ?>">
                        <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                        <div class="form-row">
                            <div class="form-col">
                                <label>Name:</label>
                                <input type="text" placeholder="Name" name="name"
                                    value="<?= htmlspecialchars($data['name']) ?>" required>
                            </div>
                            <?php
                $newDateStr = "";
                if(!empty($data["date"])){
                    $newDate = DateTime::createFromFormat('d/m/Y', $data["date"]);
                    $newDateStr = $newDate->format('Y-m-d');
                }
            ?>
                            <div class="form-col">
                                <label>Date:</label>
                                <input type="date" class="date-picker" name="date" value="<?= $newDateStr ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <label>Jobsite:</label>
                                <input type="text" placeholder="Location" name="jobsite"
                                    value="<?= htmlspecialchars($data['jobsite']) ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <label>Reason:</label>
                                <textarea class="resizable-textarea" name="reason"
                                    placeholder="Reason"><?= htmlspecialchars($data['reason']) ?></textarea>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="Denied.php" class="btn btn-cancel">Cancel</a>
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
                                <a href="Denied.php" class="btn btn-cancel">Cancel</a>
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
                "Date",
                "Jobsite",
                "Type",
                "Reason"
            ];
            $data = [];
            $sql = "SELECT * FROM direct_hire WHERE status='denied' ORDER BY created_at DESC";
            $result = $conn->query($sql);
            $offset = 0;
            if ($result->num_rows > 0) {
                $count = $offset + 1;
                while($row = $result->fetch_assoc()) {
                    
                    $d = [ 
                        $count, 
                        $row["name"], 
                        date("m/d/Y", strtotime($row["date"])), 
                        $row["jobsite"], 
                        ucfirst($row["type"]), 
                        $row["reason"], 
                        $row["id"]
                    ];

                    array_push($data, $d) ;
                    $count++;
                }
            }
            $customRenderer = function($row, $id) {
                $page = strtolower($row[4]) == "household" ? "Household.php" : "Professional.php";
                return "<a class='icon-btn edit-btn' href='$page?action=edit&id=" . htmlspecialchars($id) . "'><i class='fas fa-edit'></i></a>";
            };
            echo generateDataTable( $headers, $data, "No Denied records found", true, false, $customRenderer );
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