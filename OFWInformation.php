<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">
                <h2>OFW'S Information</h2>

                <div class="action addnew">
                    <a href="?action=addnew" class="btn btn-new btn-submit">Add New</a>
                </div>
                <?php 

    $data = [
    'id' => '',
    'first_name' => '',
    'last_name' => '',
    'middle_name' => '',
    'order_no' => '',
    'sex' => '',
    'address' => '',
    'destination' => ''
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
            $data['first_name']     = $row['first_name'];
            $data['last_name']      = $row['last_name'];
            $data['middle_name']    = $row['middle_name'];
            $data['address']        = $row['address'];
            $data['sex']            = $row['sex'];
            $data['destination']    = $row['destination'];
            $data['order_no']       = $row['order_no'];
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
        $first_name = sanitize_input($_POST['first_name']);
        $last_name = sanitize_input($_POST['last_name']);
        $middle_name = sanitize_input($_POST['middle_name']);
        $destination = sanitize_input($_POST['destination']);
        $address = sanitize_input($_POST['address']);
        $order_no = sanitize_input($_POST['order_no']);
        $sex = sanitize_input($_POST['sex']);
    }

    if ($_POST['form_action'] === 'edit' && !empty($_POST['record_id'])) {
        $id_to_update = sanitize_input($_POST['record_id']);
        $update_sql = "UPDATE work_resumption SET first_name=?, last_name=?, middle_name=?, destination=?, address=?, order_no=?, sex=? WHERE id=?";
        $stmt = $conn->prepare($update_sql);
        if ($stmt === false) {
            die("Error preparing update statement: " . $conn->error);
        }
        $stmt->bind_param("sssssssi", $first_name, $last_name, $middle_name, $destination, $address, $order_no, $sex, $id_to_update);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>Record updated successfully!</div>";
            //echo '<script>setTimeout(function(){ window.location.href = "OFWInformation.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error updating record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'add') {
        $insert_sql = "INSERT INTO work_resumption (first_name, last_name, middle_name, destination, address, order_no, sex) VALUES (?, ?, ?, ?, ?, ?, ? )";
        $type = "denied";
        $stmt = $conn->prepare($insert_sql);
        if ($stmt === false) {
            die("Error preparing insert statement: " . $conn->error);
        }
        $stmt->bind_param("sssssss", $first_name, $last_name, $middle_name, $destination, $address, $order_no, $sex);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>New record added successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "OFWInformation.php"; }, 1500);</script>';
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
            // Optionally redirect after successful deletion
            echo '<script>setTimeout(function(){ window.location.href = "OFWInformation.php"; }, 1500);</script>';
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
                    <form id="professional-form" class="data-form" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                        <input type="hidden" name="form_action" value="<?php echo $form_action; ?>">
                        <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                        <div class="form-row">
                            <div class="form-col">
                                <label>Last Name:</label>
                                <input type="text" placeholder="LastName" name="last_name"
                                    value="<?= htmlspecialchars($data['last_name']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>First Name:</label>
                                <input type="text" name="first_name" placeholder="FirstName"
                                    value="<?= htmlspecialchars($data['first_name']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Middle Name:</label>
                                <input type="text" name="middle_name" placeholder="MiddleName"
                                    value="<?= htmlspecialchars($data['middle_name']) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Order No:</label>
                                <input type="text" name="order_no" value="<?= htmlspecialchars($data['order_no']) ?>"
                                    required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col" style="flex: 2">
                                <label>Address:</label>
                                <input type="text" placeholder="123 st. Example 5678 Example" name="address"
                                    value="<?= htmlspecialchars($data['address']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Sex:</label>
                                <div class="radio-group">
                                    <label>
                                        <input type="radio" name="sex" value="Male"
                                            <?php echo isset($data['sex']) && $data['sex'] == "Male" ? 'checked': '' ?>>
                                        Male
                                    </label>
                                    <label><input type="radio" name="sex" value="Female"
                                            <?php echo isset($data['sex']) && $data['sex'] == "Female" ? 'checked': '' ?>>
                                        Female
                                    </label>
                                </div>
                            </div>
                            <div class="form-col">
                                <label>Destination:</label>
                                <input type="text" placeholder="Location" name="destination"
                                    value="<?= htmlspecialchars($data['destination']) ?>" required>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="OFWInformation.php" class="btn btn-cancel">Cancel</a>
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
                                <a href="OFWInformation.php" class="btn btn-cancel">Cancel</a>
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
                "O.R No.",
                "Lastname",
                "Firstname",
                "Middlename",
                "Sex",
                "Address",
                "Destination",
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
                        $row["order_no"], 
                        $row["last_name"], 
                        $row["first_name"], 
                        $row["middle_name"], 
                        $row["sex"],
                        $row["address"],
                        $row["destination"],
                        $row["id"],
                    ];

                    array_push($data, $d) ;
                    $count++;
                }
            }

            $customRenderer = function($row, $id) {
               $edit = "<a class='icon-btn edit-btn' href='?action=edit&id=" . htmlspecialchars($id) . "'><i class='fas fa-edit'></i></a>";
               $delete = "<a class='icon-btn delete-btn' href='?action=delete&id=" . htmlspecialchars($id) . "'><i class='fas fa-trash'></i></a>";
               $pdf = "<a class='icon-btn view-btn' onclick='criticalSkills(". htmlspecialchars($id) . ");' data-id='" . htmlspecialchars($id) . "'><i class='fas fa-eye'></i></a>";
               return $edit . $delete . $pdf;
            };

            echo generateDataTable( $headers, $data, "No OFW Information records found", true, false, $customRenderer );
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