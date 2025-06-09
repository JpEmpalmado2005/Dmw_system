<script src="assets/plugins/slimscrollbar/jquery.slimscroll.min.js"></script>
<script src="assets/js/sleek.bundle.js"></script>
<!-- <script src="js/DirectData.js"></script> -->
<script src="//cdn.datatables.net/2.3.0/js/dataTables.min.js"></script>
<script src="js/moment.min.js"></script>
<script src="js/bootstrap-datetimepicker.min.js"></script>
<script>
    let table = new DataTable('.data-table', {
        language : { "zeroRecords": " " },
        pageLength: 50,
        responsive: true,
    });

</script>
</body>

</html>