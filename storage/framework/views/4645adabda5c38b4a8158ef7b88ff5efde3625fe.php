<?php $__env->startSection('content'); ?>
    <div class="container-fluid">
        <div class="fade-in">
            <div class="row">
                <div class="col-sm-12">
                    <div class="card">

                        <div class="card-header">
                            <h4 class="mb-3">Daily Sales Report</h4>
                            <div class="d-flex flex-wrap align-items-center gap-3 p-3 bg-light rounded shadow-sm">
                                <div class="form-group mb-0" style="padding-right: 15px">
                                    <label for="fromDate" class="small text-muted">From Date</label>
                                    <input type="text" id="fromDate" class="form-control" placeholder="Select From Date">
                                </div>
                                <div class="form-group mb-0">
                                    <label for="toDate" class="small text-muted">To Date</label>
                                    <input type="text" id="toDate" class="form-control" placeholder="Select To Date">
                                </div>
                                <div class="button-group" style="padding-top: 20px;padding-left: 30px">
                                    <button id="filterBtn" class="btn" style="background: #007bff; color: white; border-radius: 25px; padding: 10px 20px; font-weight: bold; border: none; transition: all 0.3s ease-in-out;" onmouseover="this.style.background='#0056b3'" onmouseout="this.style.background='#007bff'">Filter</button>
                                    <button id="reloadBtn" class="btn" style="background: #6c757d; color: white; border-radius: 25px; padding: 10px 20px; font-weight: bold; border: none; transition: all 0.3s ease-in-out;" onmouseover="this.style.background='#545b62'" onmouseout="this.style.background='#6c757d'">Reload</button>
                                    <a id="downloadBtn" class="btn" style="background: #28a745; color: white; border-radius: 25px; padding: 10px 20px; font-weight: bold; border: none; transition: all 0.3s ease-in-out;" onmouseover="this.style.background='#1e7e34'" onmouseout="this.style.background='#28a745'">Download Report</a>
                                </div>
                            </div>
                        </div>

                        <div class="card-body table-responsive">
                            <table id="stockTable" class="table table-bordered table-striped">
                                <thead>
                                <tr>
                                    <th>Bill Number</th>
                                    <th>Payment Method</th>
                                    <th>Grand Total</th>
                                    <th>Amount Received</th>
                                    <th>Created Date</th>
                                </tr>
                                </thead>
                                <tbody id="stockBody">
                                <?php $__empty_1 = true; $__currentLoopData = $bills; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $bill): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                                    <tr>
                                        <td>INV<?php echo e($bill->id); ?></td>
                                        <td><?php echo e($bill->payment_method); ?></td>
                                        <td><?php echo e($bill->grand_total); ?></td>
                                        <td><?php echo e($bill->amount_received); ?></td>
                                        <td><?php echo e($bill->created_at); ?></td>
                                    </tr>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                                    <tr>
                                        <td colspan="5" class="text-center">No data found</td>
                                    </tr>
                                <?php endif; ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('javascript'); ?>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
    <script src="https://cdn.jsdelivr.net/npm/moment/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>

    <script>
        $(document).ready(function () {

            $('#reloadBtn').click(function () {
                location.reload();
            });

            let stockTable = $('#stockTable').DataTable({
                "paging": true,
                "searching": true,
                "info": true,
                "ordering": true
            });

            // Initialize date range pickers
            $('#fromDate').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            $('#toDate').daterangepicker({
                singleDatePicker: true,
                autoUpdateInput: false,
                locale: {
                    format: 'YYYY-MM-DD'
                }
            });

            // Manually update input fields when a date is selected
            $('#fromDate').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.startDate.format('YYYY-MM-DD'));
            });

            $('#toDate').on('apply.daterangepicker', function (ev, picker) {
                $(this).val(picker.endDate.format('YYYY-MM-DD'));
            });

            // Filter Button Click Event
            $('#filterBtn').click(function () {
                let fromDate = $('#fromDate').val();
                let toDate = $('#toDate').val();

                if (!fromDate || !toDate) {
                    alert('Please select both From Date and To Date.');
                    return;
                }

                $.ajax({
                    url: "<?php echo e(route('daily-sales-report.filter')); ?>",
                    type: "GET",
                    data: { date_range: fromDate + ' - ' + toDate },
                    success: function (response) {
                        stockTable.clear(); // Clear existing table data

                        if (response.data.length > 0) {
                            $.each(response.data, function (index, cloth) {
                                stockTable.row.add([
                                    cloth.id,
                                    cloth.payment_method,
                                    cloth.grand_total,
                                    cloth.amount_received,
                                    cloth.created_at,
                                ]).draw(false);
                            });
                        } else {
                            alert('No data found for the selected date range.');
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error fetching filtered data:", error);
                        alert("Failed to fetch filtered data. Please try again.");
                    }
                });
            });

            // Download Button Click Event
            $('#downloadBtn').click(function () {
                let fromDate = $('#fromDate').val();
                let toDate = $('#toDate').val();
                console.log('Date Range for download:', fromDate, toDate);
                location.href = "<?php echo e(route('daily-sales-report.export')); ?>?from_date=" + fromDate + "&to_date=" + toDate;
            });
        });

    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('dashboard.base', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\Cotton Street Stock Management\cotton-street-stock-management\resources\views/dashboard/cs-sales-report/baily-sales-report.blade.php ENDPATH**/ ?>