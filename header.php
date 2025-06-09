<?php 
session_start(); 

include( "db_connect.php" );
include( "functions.php" ); 

if(empty($_SESSION)){
    header("Location: LOGIN.php");
    exit;
}else{
    $user = getUser($_SESSION["user_id"]);
}

if(isset($_POST["logout"])){
    $_SESSION = [];
    session_destroy();
    header("Location: LOGIN.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en" dir="ltr">
<head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Migrant Workers Processing Division</title>
    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="favicon/favicon-16x16.png">
    <link rel="manifest" href="favicon/site.webmanifest">
    <!-- GOOGLE FONTS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,500|Poppins:400,500,600,700|Roboto:400,500" rel="stylesheet" />
    <link href="https://cdn.materialdesignicons.com/4.4.95/css/materialdesignicons.min.css" rel="stylesheet" />
    <link rel="stylesheet" type="text/css" href="css/bootstrap-datetimepicker.min.css">
    <!-- SLEEK CSS -->
    <link id="sleek-css" rel="stylesheet" href="assets/css/sleek.css" />
    <!-- DataTAble -->
    <link rel="stylesheet" href="//cdn.datatables.net/2.3.0/css/dataTables.dataTables.min.css">
    <script src="assets/plugins/jquery/jquery.min.js"></script>
    <script src="assets/plugins/nprogress/nprogress.js"></script> 
    <link id="backend-css" rel="stylesheet" href="css/backend.css" />
    <link id="backend-css" rel="stylesheet" href="css/custom.css" />

    <script src="https://unpkg.com/pdf-lib@1.4.0"></script>
    <script src="https://unpkg.com/downloadjs@1.4.7"></script>

    <script>
      const { PDFDocument, StandardFonts } = PDFLib;

      async function criticalSkills(id) {
        try {
          // Fetch the data first
          const response = await fetch("Ajax.php", {
            method: "POST",
            headers: { "Content-Type": "application/x-www-form-urlencoded" }, 
            body: new URLSearchParams({ id, action: "critical" }),
          });

          if (!response.ok) throw new Error("Network response was not ok");
          const data = await response.json();

          const pdfDoc = await PDFDocument.create();
          const timesRomanFont = await pdfDoc.embedFont(StandardFonts.TimesRoman);

          const page = pdfDoc.addPage([600, 850]);
          page.setFont(timesRomanFont);

          const today = new Date();
          const formattedDate = today.toLocaleDateString("en-US");

          page.drawText('FM-DMWNCR-04-EF-09-C', { x: 20, y: 830, size: 8 });
          page.drawText('Effectivity Date: February 1, 2023', { x: 20, y: 820, size: 8 });

          page.drawText('Department of Migrant Workers', { x: 110, y: 780, size: 28 });
          page.drawText('MIGRANT WORKERS PROCESSING DIVISION - RO IVA', { x: 90, y: 760, size: 16 });
          page.drawText('Basement Andenson Bldg. II, Brgy. Parian, Calamba City, Laguna 4027', { x: 140, y: 750, size: 10 });

          page.drawText('REQUEST TO PROCESS RETURNING WORKER CRITICAL SKILLS', { x: 65, y: 710, size: 16 });

          page.drawText('FOR', { x: 20, y: 680, size: 16 });
          page.drawText(':', { x: 100, y: 680, size: 16 });
          page.drawText('ATTY. JULYN S. AMBITO-FERMIN', { x: 180, y: 680, size: 16 });
          page.drawText('Director IV - Land-based Accreditation Bureau', { x: 180, y: 665, size: 14 });

          page.drawText('DATE', { x: 20, y: 635, size: 16 });
          page.drawText(':', { x: 100, y: 635, size: 16 });
          page.drawText(formattedDate, { x: 180, y: 635, size: 16 });

          page.drawRectangle({ x: 20, y: 620, width: 550, height: 0.5 });

          const lines = [
            ["Control Number", `${data.control_no}`],
            ["Name of Worker", `${data.first_name} ${data.last_name}`],
            ["Position", ""],
            ["Salary", "_______________ / MONTH"],
            ["Destination", data.destination],
            ["Name of the new principal", ""],
            ["Employment Duration", ""],
            ["Date of arrival", ""],
            ["Date of departure", ""],
            ["Remarks", "* Changed Employer"]
          ];

          let y = 590;
          for (const [label, value] of lines) {
            page.drawText(label, { x: 40, y, size: 12 });
            page.drawText(value, { x: 220, y, size: 12 });
            y -= 20;
          }
          
          page.drawRectangle({ x: 20, y: 390, width: 550, height: 0.5 });

          page.drawText('Recommeding Approval to Process', { x: 350, y: 360, size: 12 });
          page.drawRectangle({ x: 350, y: 310, width: 200, height: 0.5 });
          page.drawText('ATTY. APRIL R. CASABUENA', { x: 370, y: 300, size: 12 });
          page.drawText('Regional Director', { x: 410, y: 290, size: 10 });

          page.drawText('Approved for Processing', { x: 220, y: 250, size: 12 });
          page.drawRectangle({ x: 200, y: 200, width: 200, height: 0.5 });
          page.drawText('ATTY. JULYN S. AMBITO-FERMIN', { x: 205, y: 190, size: 12 });
          page.drawText('Director IV - Land-based Accreditation Bureau', { x: 205, y: 180, size: 10 });

          const pdfBytes = await pdfDoc.save();
          download(pdfBytes, "critical-skills.pdf", "application/pdf");

        } catch (error) {
          console.error("Failed to generate PDF:", error);
        }
      }

  </script>
    
</head>

<body class="header-fixed sidebar-fixed sidebar-dark header-light" id="body">





