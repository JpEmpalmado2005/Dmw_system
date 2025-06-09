<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">
                <h2>Payment</h2>

                <div class="action addnew">
                    <a href="?action=addnew" class="btn btn-new btn-submit">Add New</a>
                </div>
                <?php 

    $data = [
        'id' => '',
        'counter_no' => '',
        'Type' => '',
        'Time_In' => '',
        'Time_out' => '',
        'Total_pct' => ''
    ];

$form_title = "Add New Record";
$form_action = "add";
$record_id = "";
$delete_confirmation = false;

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = sanitize_input($_GET['id']);
    $record_id = $id;

    if ($_GET['action'] === 'edit') {
        $sql = "SELECT * FROM work_resumption WHERE id = ?";
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
            $data['counter_no']     = $row['counter_no'];
            $data['Type']           = $row['Type'];
            $data['Time_In']        = $row['Time_In'];
            $data['Time_out']       = $row['Time_out'];
            $data['Total_pct']      = $row['Total_pct'];
            $form_title             = "Edit Record";
            $form_action            = "edit";
        } else {
            echo "<div class='info info-error'>Record not found.</div>";
            exit;
        }
        $stmt->close();
    } elseif ($_GET['action'] === 'delete') {
        $delete_confirmation = true;
        $sql_name = "SELECT * FROM work_resumption WHERE id = ?";
        $stmt_name = $conn->prepare($sql_name);
        if ($stmt_name === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt_name->bind_param("i", $id);
        $stmt_name->execute();
        $result_name = $stmt_name->get_result();
        if ($result_name->num_rows === 1) {
            $row_name = $result_name->fetch_assoc();
            $data['name'] = $row_name['first_name'] . " " . $row_name["last_name"];
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
        $counter_no = sanitize_input($_POST['counter_no']);
        $Type = sanitize_input($_POST['type']);
        $Time_In = sanitize_input($_POST['time_in']);
        $Time_out = sanitize_input($_POST['time_out']);
        $Total_pct = sanitize_input($_POST['total_pct']);
    }

    if ($_POST['form_action'] === 'edit' && !empty($_POST['record_id'])) {
        $id_to_update = sanitize_input($_POST['record_id']);
        $update_sql = "UPDATE work_resumption SET counter_no=?, Time_In=?, Time_out=?, Total_pct=?, Type=? WHERE id=?";
        $stmt = $conn->prepare($update_sql);
        if ($stmt === false) {
            die("Error preparing update statement: " . $conn->error);
        }
        $stmt->bind_param("sssssi", $counter_no, $Time_In, $Time_out, $Total_pct, $Type, $id_to_update);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>Record updated successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "Payment.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error updating record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'add') {
        $insert_sql = "INSERT INTO work_resumption (counter_no, Time_In, Time_out, Total_pct, Type) VALUES (?, ?, ?, ?, ? )";
        $stmt = $conn->prepare($insert_sql);
        if ($stmt === false) {
            die("Error preparing insert statement: " . $conn->error);
        }
        $stmt->bind_param("sssss", $counter_no, $Time_In, $Time_out, $Total_pct, $Type);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>New record added successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "Payment.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error adding record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'confirm_delete' ) {
        $id_to_delete = sanitize_input($_POST['record_id']);
        $delete_sql = "DELETE FROM work_resumption WHERE id = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        if ($stmt_delete === false) {
            die("Error preparing delete statement: " . $conn->error);
        }
        $stmt_delete->bind_param("i", $id_to_delete);
        if ($stmt_delete->execute()) {
            echo "<div class='info info-success'>Record deleted successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "Payment.php"; }, 1500);</script>';
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
                                <label>Type:</label>
                                <input type="text" placeholder="Type" name="type"
                                    value="<?= htmlspecialchars($data['Type']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Time In:</label>
                                <input type="text" placeholder="Time" name="time_in"
                                    value="<?= htmlspecialchars($data['Time_In']) ?>"  onkeydown="return false" required>
                            </div>
                            <div class="form-col">
                                <label>Time Out:</label>
                                <input type="text" placeholder="Time" name="time_out"
                                    value="<?= htmlspecialchars($data['Time_out']) ?>"  onkeydown="return false" required>
                            </div>

                            <div class="form-col">
                                <label>Counter No:</label>
                                <input type="text" name="counter_no"
                                    value="<?= htmlspecialchars($data['counter_no']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Total PCT:</label>
                                <input type="text" placeholder="Total PCT"name="total_pct"
                                    value="<?= htmlspecialchars($data['Total_pct']) ?>" required>
                            </div>
                        </div>
                        <div class="form-actions">
                            <a href="Payment.php" class="btn btn-cancel">Cancel</a>
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
                                <a href="Payment.php" class="btn btn-cancel">Cancel</a>
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
                "Counter No.",
                "Type",
                "Time In",
                "Time Out",
                "Total PCT"
            ];
            $data = [];
            $sql = "SELECT * FROM work_resumption ORDER BY id DESC";
            $result = $conn->query($sql);
            $offset = 0;
            if ($result->num_rows > 0) {
                $count = $offset + 1;
                while($row = $result->fetch_assoc()) {
                    
                    $d = [ 
                        $count, 
                        $row["counter_no"], 
                        $row["Type"], 
                        $row["Time_In"], 
                        $row["Time_out"], 
                        $row["Total_pct"],
                        $row["id"],
                    ];

                    array_push($data, $d) ;
                    $count++;
                }
            }
            echo generateDataTable( $headers, $data, "No payment records found", true );
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

    $('input[name="time_in"], input[name="time_out"]').datetimepicker({
        format: 'YYYY-MM-DD HH:mm:ss', // MySQL datetime format
        icons: {
            time: 'fa fa-clock',
            date: 'fa fa-calendar',
            up: 'fa fa-chevron-up',
            down: 'fa fa-chevron-down',
            previous: 'fa fa-chevron-left',
            next: 'fa fa-chevron-right',
            today: 'fa fa-check',
            clear: 'fa fa-trash',
            close: 'fa fa-times'
        }
    });
});
</script>

<?php include("footer.php"); ?>