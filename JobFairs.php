<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">
                <h2>Job Fairs</h2>

                <div class="action addnew">
                    <a href="?action=addnew" class="btn btn-new btn-submit">Add New</a>
                </div>
                <?php 

    $data = [
        'id' => '',
        'date' => '',
        'venue' => '',
        'pra_id' => '',
        'peso_id' => '',
        'custom_persons' => '',
        'custom_contacts' => '',
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
            $data['pra_id'] = $row['pra_id'];
            $data['peso_id'] = $row['peso_id'];
            $data['custom_persons'] = $row['custom_persons'];
            $data['custom_contacts'] = $row['custom_contacts'];
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
        $pra_id = sanitize_input($_POST['pra_id']);
        $peso_id = sanitize_input($_POST['peso_id']);
        $custom_persons = sanitize_input($_POST['custom_persons']);
        $custom_contacts = sanitize_input($_POST['custom_contacts']);
    }

    if ($_POST['form_action'] === 'edit' && !empty($_POST['record_id'])) {
        $id_to_update = sanitize_input($_POST['record_id']);
        $update_sql = "UPDATE job_fairs SET date=?, venue=?, pra_id=?, peso_id=?, custom_persons=?, custom_contacts=? WHERE id=?";
        $stmt = $conn->prepare($update_sql);
        if ($stmt === false) {
            die("Error preparing update statement: " . $conn->error);
        }
        $stmt->bind_param("ssiissi", $date, $venue, $pra_id, $peso_id, $custom_persons, $custom_contacts, $id_to_update);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>Record updated successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "JobFairs.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error updating record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'add') {
        $insert_sql = "INSERT INTO job_fairs ( date, venue, pra_id, peso_id, custom_persons, custom_contacts ) VALUES (?, ?, ?, ?, ?, ? )";
        $stmt = $conn->prepare($insert_sql);
        if ($stmt === false) {
            die("Error preparing insert statement: " . $conn->error);
        }
        $stmt->bind_param("ssiiss", $date, $venue, $pra_id, $peso_id, $custom_persons, $custom_contacts);

        if ($stmt->execute()) {
            echo "<div class='info info-success'>New record added successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "JobFairs.php"; }, 1500);</script>';
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
            echo '<script>setTimeout(function(){ window.location.href = "JobFairs.php"; }, 1500);</script>';
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
                        <input type="hidden" name="custom_contacts" value="">
                        <input type="hidden" name="custom_persons" value="">

                        <div class="form-row">
                            <div class="form-col">
                                <label>Date:</label>
                                <input type="date" class="date-picker" name="date"
                                    value="<?= htmlspecialchars(date("Y-m-d", strtotime($data["date"]))) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Venue:</label>
                                <input type="text" name="venue" value="<?= htmlspecialchars($data['venue']) ?>"
                                    required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <label>PRA'S Contacts:</label>
                                <select name="pra_id">
                                    <option value="">N/A</option>
                                    <?php
                        $sql_pra = "SELECT * FROM pra_contacts ORDER BY name ASC";
                        $result = $conn->query($sql_pra);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                    <option <?= $row["id"] == $data["pra_id"] ? "selected='selected'" : "" ?>
                                        value="<?=$row["id"]?>"><?=$row["name"]?> ( <?=$row["contact_persons"] ?> )
                                    </option>
                                    <?php
                            }
                        }
                    ?>
                                </select>
                            </div>
                            <div class="form-col">
                                <label>PESO Contacts:</label>
                                <select name="peso_id">
                                    <option value="">N/A</option>
                                    <?php
                        $sql_peso = "SELECT * FROM peso_contacts ORDER BY office_address ASC";
                        $result = $conn->query($sql_peso);
                        if ($result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                ?>
                                    <option <?= $row["id"] == $data["peso_id"] ? "selected='selected'" : "" ?>
                                        value="<?=$row["id"]?>"><?=$row["office_address"]?> ( <?=$row["province"] ?> )
                                    </option>
                                    <?php
                            }
                        }
                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="JobFairs.php" class="btn btn-cancel">Cancel</a>
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
                                <a href="JobFairs.php" class="btn btn-cancel">Cancel</a>
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
                "PRA'S Contact",
                "PESO Contact",
            ];
            $data = [];
            $sql = "SELECT * FROM job_fairs ORDER BY id DESC";
            $result = $conn->query($sql);
            $offset = 0;
            if ($result->num_rows > 0) {
                $count = $offset + 1;
                while($row = $result->fetch_assoc()) {
                    
                    $pra_data =  empty($row["pra_id"]) ? "N/A" : getData($row["pra_id"], "pra_contacts");
                    if(is_array($pra_data)){
                        $pra_data =  $pra_data["name"] . "( " . $pra_data["contact_persons"]. " )";
                    }

                    $peso_data =  empty($row["peso_id"]) ? "N/A" : getData($row["peso_id"], "peso_contacts");
                    if(is_array($peso_data)){
                        $peso_data =  $peso_data["office_address"] . "( " . $peso_data["province"]. " )";
                    }
                    
                    $d = [ 
                        $count, 
                        date("m/d/Y", strtotime($row["date"])), 
                        $row["venue"], 
                        $pra_data,
                        $peso_data, 
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