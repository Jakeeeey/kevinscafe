<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('user_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>
<?= $this->section('script'); ?>
<script>
    $(document).ready(function() {
        if ($('#first-name').val() == "" || $('#last-name').val() == "" || $('#mobile-num').val() == "" || $('#line-1').val() == "") {
            $('#save-info-button').attr('disabled', true)
        }

        $('#first-name').keyup(function() {
            controlButton()
        })

        $('#last-name').keyup(function() {
            controlButton()
        })

        $('#mobile-num').keyup(function() {
            controlButton()
        })

        $('#line-1').keyup(function() {
            controlButton()
        })

        $('#line-2').keyup(function() {
            controlButton()
        })

        function controlButton() {
            if ($('#first-name').val() == "" || $('#last-name').val() == "" || $('#mobile-num').val() == "" || $('#line-1').val() == "") {
                $('#save-info-button').attr('disabled', true)
            } else {
                $('#save-info-button').attr('disabled', false)
            }
        }
        // $('#edit-info').click(function() {
        //     $.post(
        //         "<= base_url() ?>" + "/profile1/get_info", {
        //             id: '<= session()->get('logged_user_id'); ?>'
        //         },
        //         function(data) {
        //             $('#edit-personal-info').html(data);
        //         }
        //     );
        // })

        if("<?= session()->getTempdata('success') ?>"){
            setTimeout(function(){  
                $('.alert').hide();
            }, 5000);
        }
    });
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div class="container mt-5 mb-5">

    <div class="row">
        <div class="col-3"></div>

        <div class="col-6 border border-1 border-dark shadow p-5 bg-white">
            <?php if (session()->getTempdata('success')) : ?>
                <div class="alert alert-success alert-dismissible fade show mt-3 mb-5">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong>Success!</strong> <?= session()->getTempdata('success'); ?>.
                </div>
            <?php endif; ?>

            <div class="d-flex justify-content-between">
                <div>
                    <h1>Personal Info</h1>
                </div>
                <div><button type="button" class="btn btn-info" id="edit-info" data-bs-toggle="modal" data-bs-target="#edit-info-modal">
                        Edit
                    </button></div>
            </div>
            <p><b>Email: </b><?= $user_info['email'] ?></p>
            <p><b>Name: </b><?= $user_info['first_name'] . ' ' . $user_info['last_name'] ?></p>
            <p><b>Mobile: </b><?= $user_info['mobile_num'] ?></p>

            <hr>

            <div class="d-flex justify-content-between">
                <div>
                    <h1>Delivery Address</h1>
                </div>
            </div>

            <p><b>Line 1: </b><?= $user_info['line_1'] ?></p>
            <p><b>Line 2: </b><?= $user_info['line_2'] ?></p>
            <p><b>City: </b><?= $user_info['city'] ?></p>
            <p><b>State: </b><?= $user_info['state'] ?></p>
            <p><b>Postal Code: </b><?= $user_info['postal_code'] ?></p>
            <p><b>Country: </b><?= $user_info['country'] ?></p>

        </div>

        <div class="col-3"></div>
    </div>
</div>

<!-- The Modal -->
<div class="modal fade" id="edit-info-modal">
    <div class="modal-dialog modal-fullscreen-sm-down">
        <div class="modal-content">

            <!-- Modal Header -->
            <div class="modal-header">
                <h4 class="modal-title">Edit Info</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>

            <!-- Modal body -->
            <div class="modal-body">
                <?= form_open(); ?>
                <div class="mb-3 mt-3">
                    <label for="email">Email:</label>
                    <input type="text" class="form-control" id="email" name="email" value="<?= $user_info['email']; ?>" readonly>
                </div>
                <div class="mb-3 mt-3">
                    <label for="first-name">First Name:</label>
                    <input type="text" class="form-control" id="first-name" placeholder="Enter First Name" name="first-name" value="<?= $user_info['first_name']; ?>">
                </div>
                <div class="mb-3 mt-3">
                    <label for="last-name">Last Name:</label>
                    <input type="text" class="form-control" id="last-name" placeholder="Enter Last Name" name="last-name" value="<?= $user_info['last_name']; ?>">
                </div>
                <div class="mb-3">
                    <label for="mobile-number">Mobile Number:</label>
                    <input type="text" class="form-control" id="mobile-number" placeholder="Enter Mobile Number" name="mobile-number" value="<?= $user_info['mobile_num']; ?>">
                </div>
                <div class="mb-3">
                    <label for="line-1">Line 1:</label>
                    <input type="text" class="form-control" id="line-1" placeholder="Enter Line 1" name="line-1" value="<?= $user_info['line_1']; ?>">
                </div>
                <div class="mb-3">
                    <label for="line-2">Line 2:</label>
                    <input type="text" class="form-control" id="line-2" placeholder="Enter Line 2" name="line-2" value="<?= $user_info['line_2']; ?>">
                </div>
                <div class="mb-3">
                    <label for="city">City:</label>
                    <input type="text" class="form-control" id="city" placeholder="Enter City" name="city" value="<?= $user_info['city']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="state">State:</label>
                    <input type="text" class="form-control" id="state" placeholder="Enter State" name="state" value="<?= $user_info['state']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="postal-code">Postal Code:</label>
                    <input type="text" class="form-control" id="postal-code" placeholder="Enter Postal Code" name="postal-code" value="<?= $user_info['postal_code']; ?>" readonly>
                </div>
                <div class="mb-3">
                    <label for="country">Country:</label>
                    <input type="text" class="form-control" id="country" placeholder="Enter Country" name="country" value="<?= $user_info['country']; ?>" readonly>
                </div>

            </div>

            <!-- Modal footer -->
            <div class="modal-footer">
                <button type="submit" class="btn btn-success" name="edit-profile" id="save-info-button" data-bs-dismiss="modal">Save</button>
                <?= form_close(); ?>
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection(); ?>