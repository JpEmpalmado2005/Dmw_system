<?php include("header.php"); ?>
<div class="wrapper">
    <?php include("sidebar.php"); ?>
    <div class="page-wrapper">
        <?php include("top-nav.php"); ?>
        <div class="content-wrapper">
            <div class="content">
                <h2>Government</h2>

                <div class="action addnew">
                    <a href="?action=addnew" class="btn btn-new btn-submit">Add New</a>
                </div>
                <?php 

    $data = [
        'id' => '',
        'name' => '',
        'firstname' => '',
        'middlename' => '',
        'lastname' => '',
        'contact_number' => '',
        'email_address' => '',
        'birthdate' => '',
        'sex' => '',
        'age' => '',
        'height_cm' => '',
        'weight_kg' => '',
        'educ_attainment' => '',
        'present_address' => '',
        'passport_validity' => '',
        'id_presented' => '',
        'id_number' => ''
    ];

$form_title = "Add New Record";
$form_action = "add";
$record_id = "";
$delete_confirmation = false;

if (isset($_GET['action']) && isset($_GET['id'])) {
    $id = sanitize_input($_GET['id']);
    $record_id = $id;

    if ($_GET['action'] === 'edit') {
        $sql = "SELECT * FROM gov_to_gov WHERE id = ?";
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
            $data['firstname'] = $row['firstname'];
            $data['middlename'] = $row['middlename'];
            $data['lastname'] = $row['lastname'];
            $data['email_address'] = $row['email_address'];
            $data['contact_number'] = $row['contact_number'];
            $data['birthdate'] = $row['birthdate'];
            $data['sex'] = $row['sex'];
            $data['age'] = $row['age'];
            $data['height_cm'] = $row['height_cm'];
            $data['weight_kg'] = $row['weight_kg'];
            $data['educ_attainment'] = $row['educ_attainment'];
            $data['present_address'] = $row['present_address'];
            $data['passport_validity'] = $row['passport_validity'];
            $data['id_presented'] = $row['id_presented'];
            $data['id_number'] = $row['id_number'];
            $form_title = "Edit Record";
            $form_action = "edit";
        } else {
            echo "<div class='info info-error'>Record not found.</div>";
            exit;
        }
        $stmt->close();
    } elseif ($_GET['action'] === 'delete') {
        $delete_confirmation = true;
        $sql_name = "SELECT * FROM gov_to_gov WHERE id = ?";
        $stmt_name = $conn->prepare($sql_name);
        if ($stmt_name === false) {
            die("Error preparing statement: " . $conn->error);
        }
        $stmt_name->bind_param("i", $id);
        $stmt_name->execute();
        $result_name = $stmt_name->get_result();
        if ($result_name->num_rows === 1) {
            $row = $result_name->fetch_assoc();
            $data['id'] = $row['id'];
            $data['firstname'] = $row['firstname'];
            $data['middlename'] = $row['middlename'];
            $data['lastname'] = $row['lastname'];
            $data['email_address'] = $row['email_address'];
            $data['contact_number'] = $row['contact_number'];
            $data['sex'] = $row['sex'];
            $data['name'] = $row['firstname'] . " " . $row["lastname"];
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
        $firstname = sanitize_input($_POST['firstname']);
        $middlename = sanitize_input($_POST['middlename']);
        $lastname = sanitize_input($_POST['lastname']);
        $email_address = sanitize_input($_POST['email_address']);
        $contact_number = sanitize_input($_POST['contact_number']);
        $birthdate = sanitize_input($_POST['birthdate']);
        $sex = sanitize_input($_POST['sex']);
        
        $age = sanitize_input($_POST['age']);
        $height_cm = sanitize_input($_POST['height_cm']);
        $weight_kg = sanitize_input($_POST['weight_kg']);
        $educ_attainment = sanitize_input($_POST['educ_attainment']);
        $present_address = sanitize_input($_POST['present_address']);
        $passport_validity = sanitize_input($_POST['passport_validity']);
        $id_presented = isset($_POST['id_presented']) ? sanitize_input($_POST['id_presented']) : "";
        $id_number = sanitize_input($_POST['id_number']);

    }

    if ($_POST['form_action'] === 'edit' && !empty($_POST['record_id'])) {
        $id_to_update = sanitize_input($_POST['record_id']);

        $upload_path = null;

        if (isset($_FILES['id_presented']) && $_FILES['id_presented']['error'] === UPLOAD_ERR_OK) {
            $upload_path = uploadFile($_FILES['id_presented']);
        }
    
        if ($upload_path) {
            // Include id_presented in update
            $update_sql = "UPDATE gov_to_gov SET 
                firstname=?, middlename=?, lastname=?, 
                email_address=?, contact_number=?, sex=?, birthdate=?, 
                age=?, height_cm=?, weight_kg=?, educ_attainment=?, 
                present_address=?, passport_validity=?, id_presented=?, id_number=? 
                WHERE id=?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("sssssssiiisssssi", 
                $firstname, $middlename, $lastname, 
                $email_address, $contact_number, $sex, $birthdate, 
                $age, $height_cm, $weight_kg, $educ_attainment, 
                $present_address, $passport_validity, $upload_path, $id_number, 
                $id_to_update
            );
        } else {
            // Exclude id_presented from update
            $update_sql = "UPDATE gov_to_gov SET 
                firstname=?, middlename=?, lastname=?, 
                email_address=?, contact_number=?, sex=?, birthdate=?, 
                age=?, height_cm=?, weight_kg=?, educ_attainment=?, 
                present_address=?, passport_validity=?, id_number=? 
                WHERE id=?";
            $stmt = $conn->prepare($update_sql);
            $stmt->bind_param("sssssssiiissssi", 
                $firstname, $middlename, $lastname, 
                $email_address, $contact_number, $sex, $birthdate, 
                $age, $height_cm, $weight_kg, $educ_attainment, 
                $present_address, $passport_validity, $id_number, 
                $id_to_update
            );
        }

        if ($stmt->execute()) {
            echo "<div class='info info-success'>Record updated successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "GovToGov.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error updating record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'add') {

        // Upload file if provided
        $id_presented_path = null;
        if (isset($_FILES['id_presented']) && $_FILES['id_presented']['error'] === UPLOAD_ERR_OK) {
            $id_presented_path = uploadFile($_FILES['id_presented']); 
        }

        // Prepare insert SQL
        $insert_sql = "INSERT INTO gov_to_gov (
            firstname, middlename, lastname, email_address, contact_number,
            sex, birthdate, age, height_cm, weight_kg, educ_attainment,
            present_address, passport_validity, id_presented, id_number
        ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($insert_sql);
        if ($stmt === false) {
            die("Error preparing insert statement: " . $conn->error);
        }


        $id_presented = $id_presented_path ?? ''; 
        $stmt->bind_param(
            "sssssssiiisssss",
            $firstname, $middlename, $lastname, $email_address, $contact_number,
            $sex, $birthdate, $age, $height_cm, $weight_kg,
            $educ_attainment, $present_address, $passport_validity,
            $id_presented, $id_number
        );

        if ($stmt->execute()) {
            echo "<div class='info info-success'>New record added successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "GovToGov.php"; }, 1500);</script>';
        } else {
            echo "<div class='info info-error'>Error adding record: " . $stmt->error . "</div>";
        }
        $stmt->close();
    } elseif ($_POST['form_action'] === 'confirm_delete' ) {
        $id_to_delete = sanitize_input($_POST['record_id']);
        $delete_sql = "DELETE FROM gov_to_gov WHERE id = ?";
        $stmt_delete = $conn->prepare($delete_sql);
        if ($stmt_delete === false) {
            die("Error preparing delete statement: " . $conn->error);
        }
        $stmt_delete->bind_param("i", $id_to_delete);
        if ($stmt_delete->execute()) {
            echo "<div class='info info-success'>Record deleted successfully!</div>";
            echo '<script>setTimeout(function(){ window.location.href = "GovToGov.php"; }, 1500);</script>';
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
                    <form id="denied-form" class="data-form" action="<?=$_SERVER['PHP_SELF']?>" method="POST"
                        enctype="multipart/form-data">
                        <input type="hidden" name="form_action" value="<?php echo $form_action; ?>">
                        <input type="hidden" name="record_id" value="<?php echo $record_id; ?>">
                        <div class="form-row">
                            <div class="form-col">
                                <label>Firstname:</label>
                                <input type="text" placeholder="First Name" name="firstname"
                                    value="<?= htmlspecialchars($data['firstname']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Middle Name:</label>
                                <input type="text" placeholder="Middle Name" name="middlename"
                                    value="<?= htmlspecialchars($data['middlename']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Last Name:</label>
                                <input type="text" placeholder="Last Name" name="lastname"
                                    value="<?= htmlspecialchars($data['lastname']) ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <label>Date of Birth:</label>
                                <input type="date" class="date-picker" name="birthdate"
                                    value="<?= htmlspecialchars(date("Y-m-d", strtotime($data["birthdate"]))) ?>"
                                    required>
                            </div>
                            <div class="form-col">
                                <label>Email Address:</label>
                                <input type="text" placeholder="Email Address" name="email_address"
                                    value="<?= htmlspecialchars($data['email_address']) ?>" required>
                            </div>
                            <div class="form-col">
                                <label>Contact Number:</label>
                                <input type="text" placeholder="Contact Number" name="contact_number"
                                    value="<?= htmlspecialchars($data['contact_number']) ?>" required>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <label>Sex:</label>
                                <select name="sex">
                                    <option value="Male"
                                        <?=isset($data["sex"]) && $data["sex"] == "Male" ? "selected='selected'" : "" ?>>
                                        Male</option>
                                    <option value="Female"
                                        <?=isset($data["sex"]) && $data["sex"] == "Female" ? "selected='selected'" : "" ?>>
                                        Female</option>
                                </select>
                            </div>
                            <div class="form-col">
                                <label>Age:</label>
                                <input type="number" name="age" value="<?= htmlspecialchars($data['age']) ?>">
                            </div>
                            <div class="form-col">
                                <label>Height(cm):</label>
                                <input type="number" name="height_cm"
                                    value="<?= htmlspecialchars($data['height_cm']) ?>">
                            </div>
                            <div class="form-col">
                                <label>Weight(kg):</label>
                                <input type="number" name="weight_kg"
                                    value="<?= htmlspecialchars($data['weight_kg']) ?>">
                            </div>
                            <div class="form-col" style="flex: 2">
                                <label>Educational Attainment:</label>
                                <select name="educ_attainment">
                                    <option value="Elementary"
                                        <?=isset($data["educ_attainment"]) && $data["educ_attainment"] == "Elementary" ? "selected='selected'" : "" ?>>
                                        Elementary</option>
                                    <option value="Elementary Undergraduate"
                                        <?=isset($data["educ_attainment"]) && $data["educ_attainment"] == "Elementary Undergraduate" ? "selected='selected'" : "" ?>>
                                        Elementary Undergraduate</option>
                                    <option value="High School"
                                        <?=isset($data["educ_attainment"]) && $data["educ_attainment"] == "High School" ? "selected='selected'" : "" ?>>
                                        High School</option>
                                    <option value="High School Undergraduate"
                                        <?=isset($data["educ_attainment"]) && $data["educ_attainment"] == "High School Undergraduate" ? "selected='selected'" : "" ?>>
                                        High School Undergraduate</option>
                                    <option value="College"
                                        <?=isset($data["educ_attainment"]) && $data["educ_attainment"] == "College" ? "selected='selected'" : "" ?>>
                                        College</option>
                                    <option value="College Undergraduate"
                                        <?=isset($data["educ_attainment"]) && $data["educ_attainment"] == "College Undergraduate" ? "selected='selected'" : "" ?>>
                                        College Undergraduate</option>
                                    <option value="Master's Degree"
                                        <?=isset($data["educ_attainment"]) && $data["educ_attainment"] == "Master's Degree" ? "selected='selected'" : "" ?>>
                                        Master's Degree</option>
                                    <option value="Doctorate Degree"
                                        <?=isset($data["educ_attainment"]) && $data["educ_attainment"] == "Doctorate Degree" ? "selected='selected'" : "" ?>>
                                        Doctorate Degree</option>
                                    <option value="Others"
                                        <?=isset($data["educ_attainment"]) && $data["educ_attainment"] == "Others" ? "selected='selected'" : "" ?>>
                                        Others: _____________</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-row">
                            <div class="form-col">
                                <label>Present Address:</label>
                                <input type="text" name="present_address"
                                    value="<?= htmlspecialchars($data['present_address']) ?>">
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-col">
                                <label>Passport Validity:</label>
                                <input type="date" name="passport_validity"
                                    value="<?= htmlspecialchars(date("Y-m-d", strtotime($data["passport_validity"]))) ?>">
                            </div>
                            <div class="form-col">
                                <label>ID Number:</label>
                                <input type="text" name="id_number" value="<?= htmlspecialchars($data['id_number']) ?>">
                            </div>
                            <div class="form-col file">
                                <label>ID Presented:</label>
                                <input type="file" name="id_presented" value="<?= htmlspecialchars($data['id_presented']) ?>">
                            </div>
                            <div class="form-col">
                                <?php
                                    if (isset($data['id_presented']) && strpos($data['id_presented'], 'uploads/') !== false) {
                                        echo '<br><a class="btn btn-outline-primary" href="' . htmlspecialchars($data['id_presented']) . '" target="_blank"><i class="fa fa-eye"></i> View uploaded file</a>';
                                    }
                                ?>
                            </div>
                        </div>

                        <div class="form-actions">
                            <a href="GovToGov.php" class="btn btn-cancel">Cancel</a>
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
                                <a href="GovToGov.php" class="btn btn-cancel">Cancel</a>
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
                                    "Last Name",
                                    "First Name",
                                    "Middle Name",
                                    "Email Address",
                                    "Contact Number",
                                    "Sex"
                                ];
                                $data = [];
                                $sql = "SELECT * FROM gov_to_gov ORDER BY created_at DESC";
                                $result = $conn->query($sql);
                                $offset = 0;
                                if ($result->num_rows > 0) {
                                    $count = $offset + 1;
                                    while($row = $result->fetch_assoc()) {
                                        
                                        $d = [ 
                                            $count, 
                                            $row["lastname"], 
                                            $row["firstname"], 
                                            $row["middlename"], 
                                            $row["email_address"], 
                                            $row["contact_number"], 
                                            $row["sex"], 
                                            $row["id"]
                                        ];

                                        array_push($data, $d) ;
                                        $count++;
                                    }
                                }
                                echo generateDataTable( $headers, $data, "No records found", true, true );
                            ?>
                        </div>
                    </div>
                </div>

            </div><!-- end /content -->
        </div><!-- end /content-wrapper -->
    </div> <!-- end /page-wrapper -->
</div><!-- end wrapper -->


<div class="modal fade" id="info-modal" tabindex="-1" role="dialog" aria-labelledby="InfoModal" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="detail-table-container">
                    <table class="table-details">
                        <tr>
                            <th>Last Name</th>
                            <td class='lastname'></td>
                        </tr>
                        <tr>
                            <th>First Name</th>
                            <td class='firstname'></td>
                        </tr>
                        <tr>
                            <th>Middle Name</th>
                            <td class='middlename'></td>
                        </tr>
                        <tr>
                            <th>Sex</th>
                            <td class='sex'></td>
                        </tr>
                        <tr>
                            <th>Birth Date</th>
                            <td class='birthdate'></td>
                        </tr>
                        <tr>
                            <th>Age </th>
                            <td class='age'></td>
                        </tr>
                        <tr>
                            <th>Height (cm)</th>
                            <td class='height_cm'></td>
                        </tr>
                        <tr>
                            <th>Weight (kg)</th>
                            <td class='weight_kg'></td>
                        </tr>
                        <tr>
                            <th>Education Attainment</th>
                            <td class='educ_attainment'></td>
                        </tr>
                        <tr>
                            <th>Contact Number</th>
                            <td class='contact_number'></td>
                        </tr>
                        <tr>
                            <th>Present Address</th>
                            <td class='present_address'></td>
                        </tr>
                        <tr>
                            <th>Email Address</th>
                            <td class='email_address'></td>
                        </tr>
                        <tr>
                            <th>Passport Validity</th>
                            <td class='passport_validity'></td>
                        </tr>
                        <tr>
                            <th>ID Presented</th>
                            <td class='id_presented'>

                            </td>
                        </tr>
                        <tr>
                            <th>ID Number</th>
                            <td class='id_number'></td>
                        </tr>
                        <tr>
                            <th>Taiwan Work Experience</th>
                            <td class='taiwan_exp'></td>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td class='taiwan_company'></td>
                        </tr>
                        <tr>
                            <th>Date Started</th>
                            <td class='taiwan_date_started'></td>
                        </tr>
                        <tr>
                            <th>Date Ended</th>
                            <td class='taiwan_date_started'></td>
                        </tr>
                        <tr>
                            <th>Job Experience(Aside from Taiwan)</th>
                            <td class='job_exp'></td>
                        </tr>
                        <tr>
                            <th>Company Name</th>
                            <td class='job_company_name'></td>
                        </tr>
                        <tr>
                            <th>Date Started</th>
                            <td class='job_date_started'></td>
                        </tr>
                        <tr>
                            <th>Date Ended</th>
                            <td class='job_date_ended'></td>
                        </tr>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



<script>
$(document).ready(function() {

    $(".view-btn").on("click", function() {
        var _id = $(this).data("id");
        var _table = "gov_to_gov";
        var _action = "view";

        var formData = new FormData();
        formData.append("id", _id);
        formData.append("table", _table);
        formData.append("action", _action);

        $.ajax({
            type: "POST",
            url: "Ajax.php",
            data: formData,
            processData: false,
            contentType: false,
            dataType: "json",
        })
        .done(function(data) {

            for (const key in data) {
                if (data.hasOwnProperty(key)) {
                    if (key === 'id_presented' && typeof data[key] === 'string' && data[key].includes('uploads/')) {
                        $(".table-details ." + key).html(
                            `<a class="" href="${data[key]}" target="_blank">View uploaded file</a>`
                        );
                    } else {
                        $(".table-details ." + key).text(data[key]);
                    }
                }
            }
            $('#info-modal').modal({
                show: true,
                keyboard: false,
                backdrop: 'static'
            });
        })
        .fail(function(xhr, status, error) {
            console.error("error:", status, error);
        });
    });
});
</script>

<?php include("footer.php"); ?>