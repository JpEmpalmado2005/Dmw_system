<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">


                <h2>Professional</h2>
                <div class="action addnew">
                    <a href="?action=addnew" class="btn btn-new btn-submit">Add New</a>
                </div>

                <?php 
        $data = [
            'id' => '',
            'name' => '',
            'control_no' => '',
            'jobsite' => '',
            'evaluated' => '', 
            'mwo' => '',     
            'pe' => '',      
            'pcg' => '',     
            'dhad' => '',
            'status' => '',
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
            $sql = "SELECT id, name, control_no, jobsite, evaluated, mwo, pe, pcg, dhad, status, reason FROM direct_hire WHERE id = ?";
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
                $data['control_no'] = $row['control_no'];
                $data['jobsite'] = $row['jobsite'];
                $data['evaluated'] = $row['evaluated'];
                $data['mwo'] = $row['mwo'] ? 'mwo' : '';
                $data['pe'] = $row['pe'] ? 'pe' : '';
                $data['pcg'] = $row['pcg'] ? 'pcg' : '';
                $data['dhad'] = $row['dhad'];
                $data['status'] = $row['status'];
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
            $control_no = sanitize_input($_POST['control_no']);
            $jobsite = sanitize_input($_POST['jobsite']);
            $evaluated = sanitize_input($_POST['evaluated']);
            $mo_checked = isset($_POST['confirmation']) && in_array('mwo', $_POST['confirmation']) ? 1 : 0;
            $pe_checked = isset($_POST['confirmation']) && in_array('pe', $_POST['confirmation']) ? 1 : 0;
            $pcg_checked = isset($_POST['confirmation']) && in_array('pcg', $_POST['confirmation']) ? 1 : 0;
            $dhad = sanitize_input($_POST['dhad']);
            $status = sanitize_input($_POST['status']);
            $reason = sanitize_input($_POST['reason']);
        }

        if ($_POST['form_action'] === 'edit' && !empty($_POST['record_id'])) {
            $id_to_update = sanitize_input($_POST['record_id']);
            $update_sql = "UPDATE direct_hire SET name=?, control_no=?, jobsite=?, evaluated=?, mwo=?, pe=?, pcg=?, dhad=?, type='professional', status=?, reason=? WHERE id=?";
            $stmt = $conn->prepare($update_sql);
            if ($stmt === false) {
                die("Error preparing update statement: " . $conn->error);
            }
            $stmt->bind_param("sssiisssssi", $name, $control_no, $jobsite, $evaluated, $mo_checked, $pe_checked, $pcg_checked, $dhad, $status, $reason, $id_to_update);

            if ($stmt->execute()) {
                echo "<div class='info info-success'>Record updated successfully!</div>";
                echo '<script>setTimeout(function(){ window.location.href = "Professional.php"; }, 1500);</script>';
            } else {
                echo "<div class='info info-error'>Error updating record: " . $stmt->error . "</div>";
            }
            $stmt->close();
        } elseif ($_POST['form_action'] === 'add') {
            $insert_sql = "INSERT INTO direct_hire (name, control_no, jobsite, evaluated, mwo, pe, pcg, dhad, type, status, reason) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $type = "professional";
            $stmt = $conn->prepare($insert_sql);
            if ($stmt === false) {
                die("Error preparing insert statement: " . $conn->error);
            }
            $stmt->bind_param("sssiissssss", $name, $control_no, $jobsite, $evaluated, $mo_checked, $pe_checked, $pcg_checked, $dhad, $type, $status, $reason);

            if ($stmt->execute()) {
                echo "<div class='info info-success'>New record added successfully!</div>";
                echo '<script>setTimeout(function(){ window.location.href = "Professional.php"; }, 1500);</script>';
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
                echo '<script>setTimeout(function(){ window.location.href = "Professional.php"; }, 1500);</script>';
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
                                <label>Name:</label>
                                <input type="text" name="name" placeholder="Name"
                                    value="<?= htmlspecialchars($data['name']) ?>" required>
                            </div>

                            <div class="form-col">
                                <label>Control No:</label>
                                <input type="text" name="control_no"
                                    value="<?= htmlspecialchars($data['control_no']) ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <label>Jobsite:</label>
                                <input type="text" name="jobsite" placeholder="Location"
                                    value="<?= htmlspecialchars($data['jobsite']) ?>">
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <label>Evaluated:</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="evaluated"
                                            <?php echo isset($data['evaluated']) && $data['evaluated'] == 1 ? 'checked': '' ?>
                                            value="1" required> Yes</label>
                                    <label><input type="radio" name="evaluated"
                                            <?php echo isset($data['evaluated']) && $data['evaluated'] == 0 ? 'checked': '' ?>
                                            value="0" required> No</label>
                                </div>
                            </div>

                            <div class="form-col">
                                <label>For Confirmation:</label>
                                <div class="checkbox-group">
                                    <label><input type="checkbox" name="confirmation[]"
                                            <?php echo isset($data['mwo']) && $data['mwo'] == 'mwo' ? 'checked': '' ?>
                                            value="mwo"> Migrant Workers Office (MWO)</label>
                                    <label><input type="checkbox" name="confirmation[]"
                                            <?php echo isset($data['pe']) && $data['pe'] == 'pe' ? 'checked': '' ?>
                                            value="pe"> PE</label>
                                    <label><input type="checkbox" name="confirmation[]"
                                            <?php echo isset($data['pcg']) && $data['pcg'] == 'pcg' ? 'checked': '' ?>
                                            value="pcg"> Philippine Consular General (PCG)</label>
                                </div>
                            </div>

                            <div class="form-col">
                                <label>DHAD:</label>
                                <div class="radio-group">
                                    <label><input type="radio" name="dhad"
                                            <?php echo isset($data['dhad']) && $data['dhad'] == 1 ? 'checked': '' ?>
                                            value="1" required> Emailed</label>
                                    <label><input type="radio" name="dhad"
                                            <?php echo isset($data['dhad']) && $data['dhad'] == 0 ? 'checked': '' ?>
                                            value="0" required> Received</label>
                                </div>
                            </div>
                            <div class="form-col">
                                <label>Status</label>
                                <select name="status">
                                    <option value="pending" <?=isset($data["status"]) && $data["status"] =="pending" ? "selected='selected'" : "" ?>>Pending</option>
                                    <option value="approved" <?=isset($data["status"]) && $data["status"] =="approved" ? "selected='selected'" : "" ?>>Approved</option>
                                    <option value="denied" <?=isset($data["status"]) && $data["status"] =="denied" ? "selected='selected'" : "" ?>>Denied</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-row reason">
                            <div class="form-col">
                                <label>Reason:</label>
                                <textarea class="resizable-textarea" name="reason"
                                    placeholder="Reason"><?= htmlspecialchars($data['reason']) ?></textarea>
                            </div>
                        </div>
                        <div class="form-actions">
                            <a href="Professional.php" class="btn btn-cancel">Cancel</a>
                            <button type="submit"
                                class="btn-submit"><?php echo ($form_action === 'edit') ? 'Update' : 'Submit'; ?></button>
                        </div>
                    </form>
                    <?php else: ?>
                    <div class="confirm-delete">
                        <h3>Delete Record</h3>
                        <p><b><?= $data["name"] ?></b> record will be deleted. Proceed?</p>

                        <form id="professional-form" class="data-form" action="<?=$_SERVER['PHP_SELF']?>" method="POST">
                            <input type="hidden" name="form_action" value="confirm_delete">
                            <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                            <div class="delete-action">
                                <a href="Professional.php" class="btn btn-cancel">Cancel</a>
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
                    "Control No.",
                    "Name",
                    "Jobsite",
                    "Evaluated",
                    "For Confirmation",
                    "DHAD"
                ];
                $data = [];
                $sql = "SELECT * FROM direct_hire WHERE type='professional' AND status <> 'denied' ORDER BY created_at DESC";
                $result = $conn->query($sql);
                $offset = 0;
                if ($result->num_rows > 0) {
                    $count = $offset + 1;
                    while($row = $result->fetch_assoc()) {
                        
                        //$confirmation = $row["mwo"]== 1 && $row["pe"] == 1 && $row["pcg"] == 1 ? "<span class='badge badge-success emailed'>Complete</span>" : "<span class='badge badge-warning emailed'>Incomplete</span>";
                        //$dhad = $row["dhad"] == 1 ? "<span class='badge badge-primary emailed'>Emailed</span>" : "<span class='badge badge-success received'>Received</span>"; 
                        //$evaluated = $row["evaluated"] == 0 ? "<span class='badge badge-danger no'>No</span>" : "<span class='badge badge-success yes'>Yes</span>";
                        
                        $confirmation = $row["mwo"]== 1 && $row["pe"] == 1 && $row["pcg"] == 1 ? "<span class='status-badge complete'>Complete<span>" : "<span class='status-badge incomplete'>Incomplete</span>";
                        $dhad = $row["dhad"] == 1 ? "<span class='status-badge emailed'>Emailed</span>" : "<span class='status-badge received'>Received</span>"; 
                        $evaluated = $row["evaluated"] == 0 ? "<span class='status-badge no'>No</span>" : "<span class='status-badge yes'>Yes</span>";

                        $d = [ 
                            $count, 
                            $row["control_no"], 
                            $row["name"], 
                            $row["jobsite"], 
                            $evaluated, 
                            $confirmation,
                            $dhad,
                            $row["id"]
                        ];

                        array_push($data, $d) ;
                        $count++;
                    }
                }

                $customRenderer = function($row, $id) {
               $edit = "<a class='icon-btn edit-btn' href='?action=edit&id=" . htmlspecialchars($id) . "'><i class='fas fa-edit'></i></a>";
               $delete = "<a class='icon-btn delete-btn' href='?action=delete&id=" . htmlspecialchars($id) . "'><i class='fas fa-trash'></i></a>";
               $pdf = "<a class='icon-btn view-btn' onclick='directHireDocuments(". htmlspecialchars($id) . ");' data-id='" . htmlspecialchars($id) . "'><i class='fas fa-eye'></i></a>";
               return $edit . $delete . $pdf;
            };

                echo generateDataTable( $headers, $data, "No professional records found", true );
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
    $("select[name='status']").on("change", function() {
        if($(this).val() == "denied"){
            $(".form-row.reason").show();
        }else{
            $(".form-row.reason").hide();
        }
        
    }).trigger("change");
});
</script>

<?php include("footer.php"); ?>