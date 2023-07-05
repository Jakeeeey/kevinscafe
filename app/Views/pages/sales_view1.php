<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('admin_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {

        $('#date-filter').change(function() {
            let month = formatMonth($(this).val());
            let day = formatDay($(this).val());
            let year = formatYear($(this).val());
            dateFilter(month + " " + day + ", " + year);

        });

        $('#reset-button').click(function() {
            $('#date-filter').val("")
            dateFilter("");
        })

        $('.view-button-row').click(function() {
            $.post(
                "<?= base_url() ?>" + "/sales1/get_sales_details", {
                    //"http://kevinscafe.epizy.com/sales/get_sales_details", {

                    placed_order_id: $(this).parent().parent().children('td.placed-order-id-row').text()
                },
                function(data) {
                    $('#order-details').html(data);
                }
            );
        });

        function formatMonth(updated_at) {
            const month_array = ["January", "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];
            let month = month_array[new Date(updated_at).getMonth()];
            return month;
        }

        function formatDay(updated_at) {
            let day = new Date(updated_at).getDate();
            return day;
        }

        function formatYear(updated_at) {
            let year = new Date(updated_at).getFullYear();
            return year;
            alert(new Date(updated_at))
        }

        function dateFilter(salesDate) {
            $('#sales-table').children('tr').each(function(i, val) {
                if ($(this).find('.date-row').text().indexOf(salesDate) > -1) {
                    $(this).show()
                } else {
                    $(this).hide()
                }
            })
            $('#total-sales').text($('#sales-table').children("tr:visible").length)
        }

    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5 p-5 bg-white shadow border border-1">
    <div class="d-flex justify-content-around mb-3">
        <div class="p-2">
            <div class="input-group">
                <input class="form-control" type="date" name="" id="date-filter">
                <button type="reset" id="reset-button">Reset</button>
            </div>
        </div>
        <div class="p-2">
            <div class="input-group">
                <select class="form-select" name="" id="">
                    <option disabled selected>Filter</option>
                    <option value="">This Day</option>
                    <option value="">This Week</option>
                    <option value="">This Month</option>
                </select>
                <button class="btn btn-info" type="submit">Filter</button>
            </div>
        </div>
    </div>

    <div>
        <b>Total Sales:</b> <span id="total-sales"><?= count($completed_orders); ?></span>
    </div>

    <table class="table table-hover">
        <thead>
            <tr>
                <th></th>
                <th>Order ID</th>
                <!-- <th>Order Type</th> -->
                <th>Date</th>
                <th>Total Amount</th>
            </tr>
        </thead>
        <tbody id="sales-table">
            <?php if (!empty($completed_orders)) : ?>
                <?php foreach ($completed_orders as $completed) : ?>
                    <tr>
                        <td>
                            <button type="button" class="btn btn-info view-button-row" data-bs-toggle="modal" data-bs-target="#sales">View</button>
                        </td>
                        <td class="placed-order-id-row"><?= $completed['placed_order_id']; ?></td>
                        <td class="order-type-row" hidden><?= $completed['order_type']; ?></td>
                        <td class="date-row"><?= date('F j, Y h:i A', strtotime($completed['updated_at'])); ?></td>
                        <td class="total-amount-row"><?= $completed['total_amount']; ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php else : ?>
        </tbody>
    </table>
    <h1 class="text-center mt-5">Empty</h1>
<?php endif; ?>
</div>


<!-- The Modal -->
<div class="modal fade" id="sales">
    <div class="modal-dialog modal-dialog-scrollable modal-fullscreen-sm-down">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Sales</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body" id="order-details">
                <!-- nasa controller yung laman -->
            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>


<?= $this->endSection(); ?>