<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">
                <h2>Job Fair Monitoring Summary</h2>

                <?php 

    $data = [
        'id' => '',
        'date' => '',
        'venue' => '',
        'male_applicants' => '',
        'female_applicants' => '',
        'invited_agencies' => '',
        'agencies_with_jfa' => '',
        'dmw_staff' => ''
    ];

$form_title = "Add New Record";
$form_action = "add";
$record_id = "";
$delete_confirmation = false;

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = sanitize_input($_GET['id']);
    $record_id = $id;

    if ($_GET['action'] === 'edit') {
        $sql = "SELECT * FROM job_fairs WHERE id = ?";
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
            $data['date'] = $row['date'];
            $data['venue'] = $row['venue'];
            $data['male_applicants'] = $row['male_applicants'];
            $data['female_applicants'] = $row['female_applicants'];
            $data['invited_agencies'] = $row['invited_agencies'];
            $data['agencies_with_jfa'] = $row['agencies_with_jfa'];
            $data['dmw_staff'] = $row['dmw_staff'];
            $form_title = "Edit Record";
            $form_action = "edit";
        } else {
            echo "<div class='info info-error'>Record not found.</div>";
            exit;
        }
        $stmt->close();
    } elseif ($_GET['action'] === 'delete') {
        $delete_confirmation = true;
        $sql_name = "SELECT * FROM job_fairs WHERE id = ?";
        $stmt_name = $conn->prepare($sql_name);
        if ($stmt_name === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt_name->bind_param("i", $id);
        $stmt_name->execute();
        $result_name = $stmt_name->get_result();
        if ($result_name->num_rows === 1) {
            $row_name = $result_name->fetch_assoc();
            $data['name'] = $row_name['venue'] . " ( " . $row_name["date"] . " ) ";
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
        $date = sanitize_input($_POST['date']);
        $venue = sanitize_input($_POST['venue']);
        $male_applicants = sanitize_input($_POST['male_applicants']);
        $female_applicants = sanitize_input($_POST['female_applicants']);
        $invited_agencies = sanitize_input($_POST['invited_agencies']);
        $agencies_with_jfa = sanitize_input($_POST['agencies_with_jfa']);
        $dmw_staff = sanitize_input($_POST['dmw_staff']);
    }

    if ($_POST['form_action'] === 'edit' && !empty($_POST['record_id'])) {
        $id_to_update = sanitize_input($_POST['record_id']);
        $update_sql = "UPDATE job_fairs SET male_applicants=?, female_applicants=?, invited_agencies=?, agencies_with_jfa=?, dmw_staff=? WHERE id=?";
        $stmt = $conn->prepare($update_sql);
        if ($stmt === false) {
            die("Error preparing update statement: " . $conn->error);
        }
        $stmt->bind_param("iiiisi", $male_applicants, $female_applicants, $invited_agencies, $agencies_with_jfa, $dmw_staff, $id_to_update);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>Record updated successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "JobFairsSummary.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error updating record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'add') {
        $insert_sql = "INSERT INTO job_fairs ( male_applicants, female_applicants, invited_agencies, agencies_with_jfa, dmw_staff ) VALUES (?, ?, ?, ?, ? )";
        $stmt = $conn->prepare($insert_sql);
        if ($stmt === false) {
            die("Error preparing insert statement: " . $conn->error);
        }
        $stmt->bind_param("iiiis", $male_applicants, $female_applicants, $invited_agencies, $agencies_with_jfa, $dmw_staff);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>New record added successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "JobFairsSummary.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error adding record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'confirm_delete' ) {
        $id_to_delete = sanitize_input($_POST['record_id']);
        $delete_sql = "DELETE FROM job_fairs WHERE id = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        if ($stmt_delete === false) {
            die("Error preparing delete statement: " . $conn->error);
        }
        $stmt_delete->bind_param("i", $id_to_delete);
        if ($stmt_delete->execute()) {
            echo "<div class='info info-success'>Record deleted successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "JobFairsSummary.php"; }, 1500);</script>';
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

                        <div class="form-row">
                            <div class="form-col">
                                <label>Date:</label>
                                <input type="date" class="date-picker" name="date"
                                    value="<?= htmlspecialchars(date("Y-m-d", strtotime($row["date"]))) ?>" readonly>
                            </div>
                            <div class="form-col" style="flex: 2">
                                <label>Venue:</label>
                                <input type="text" name="venue" value="<?= htmlspecialchars($data['venue']) ?>"
                                    readonly>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <label>Male Applicants:</label>
                                <input type="number" name="male_applicants"
                                    value="<?= htmlspecialchars($data['male_applicants']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Female Applicants:</label>
                                <input type="number" name="female_applicants"
                                    value="<?= htmlspecialchars($data['female_applicants']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Invited Agencies:</label>
                                <input type="number" name="invited_agencies"
                                    value="<?= htmlspecialchars($data['invited_agencies']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Agencies with JFA:</label>
                                <input type="number" name="agencies_with_jfa"
                                    value="<?= htmlspecialchars($data['agencies_with_jfa']) ?>" required>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label>DMW Staff:</label>
                                <input type="text" name="dmw_staff" value="<?= htmlspecialchars($data['dmw_staff']) ?>"
                                    required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <a href="JobFairsSummary.php" class="btn btn-cancel">Cancel</a>
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
                                <a href="JobFairsSummary.php" class="btn btn-cancel">Cancel</a>
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
                "Date",
                "Venue",
                "Male Applicants",
                "Female Applicants",
                "Invited Agencies",
                "Agencies with JFA",
                "DMW Staff"
            ];
            $data = [];
            $sql = "SELECT * FROM job_fairs ORDER BY id DESC";
            $result = $conn->query($sql);
            $offset = 0;
            if ($result->num_rows > 0) {
                $count = $offset + 1;
                while($row = $result->fetch_assoc()) {
                    
                    $d = [ 
                        $count, 
                        date("m/d/Y", strtotime($row["date"])), 
                        $row["venue"], 
                        $row["male_applicants"],
                        $row["female_applicants"],
                        $row["invited_agencies"],
                        $row["agencies_with_jfa"],
                        $row["dmw_staff"],
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