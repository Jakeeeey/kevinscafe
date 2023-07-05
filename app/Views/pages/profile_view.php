<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('user_dashboard_title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
    $(document).ready(function(){

    });
</script>
<?= $this->endSection(); ?>


<?= $this->section('body'); ?>

<div class="container mt-5 mb-5">

    <?php if (session()->getTempdata('success')) : ?>
        <div class="alert alert-success alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?= session()->getTempdata('success'); ?></strong>
        </div>
    <?php endif; ?>
    <?php if (session()->getTempdata('error')) : ?>
        <div class="alert alert-danger alert-dismissible fade show">
            <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            <strong><?= session()->getTempdata('error'); ?></strong>
        </div>
    <?php endif; ?>

    <div class="bg-white p-5">
        <?= form_open(); ?>
        <div>
            <h3>Profile</h3>
            <div class="mt-3 mb-3">
                <label class="form-label" for="first_name"><b>First Name:</b></label>
                <input class="form-control" type="text" name="first_name" id="first_name" value="<?= $user_info['first_name']; ?>">
                <span><?= display_error($validation, 'first_name'); ?></span>
            </div>
            <div class="mb-3">
                <label class="form-label" for="last_name"><b>Last Name:</b></label>
                <input class="form-control" type="text" name="last_name" id="last_name" value="<?= $user_info['last_name']; ?>">
                <span><?= display_error($validation, 'last_name'); ?></span>
            </div>
            <div class="mb-3">
                <?php if (isset($validation) && $validation->hasError('mobile_num')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'mobile_num') ?></strong>
                    </div>
                <?php endif; ?>
                <label class="form-label" for="mobile_num"><b>Mobile Number:</b></label>
                <input class="form-control" type="text" name="mobile_num" id="mobile_num" value="<?= $user_info['mobile_num']; ?>">
            </div>
            <div class="mb-3">
                <input class="form-control btn-primary" type="submit" value="Update Profile" name="update_profile">
            </div>
        </div>
        <?= form_close(); ?>
        <hr>
        <div>
            <h3>Billing Address</h3>

            <div class="mt-5 mb-5">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#add-address">
                    Add Address
                </button>
                <button type="button" class="btn btn-info" data-bs-toggle="modal" data-bs-target="#edit-address">
                    Edit Address
                </button>
            </div>
            <div class="mb-5" id="display-address">
                <?php if(!empty($user_address)): ?>
                <?php foreach ($user_address as $key => $address) : ?>
                    <div class="mb-3">
                        <?php if ($address['status'] == 'active') : ?>
                            <input onclick="enablebtn()" type="radio" class="btn btn-primary" name="address" checked value="<?= $address['address_id']; ?>">
                        <?php elseif ($address['status'] == 'inactive') : ?>
                            <input onclick="enablebtn()" type="radio" class="btn btn-primary" name="address" value="<?= $address['address_id']; ?>">
                        <?php endif; ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="collapse" data-bs-target="#demo<?= $key; ?>">Address <?= $key + 1; ?>
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class=" mb-1 bi bi-arrow-down-short" viewBox="0 0 16 16">
                                <path fill-rule="evenodd" d="M8 4a.5.5 0 0 1 .5.5v5.793l2.146-2.147a.5.5 0 0 1 .708.708l-3 3a.5.5 0 0 1-.708 0l-3-3a.5.5 0 1 1 .708-.708L7.5 10.293V4.5A.5.5 0 0 1 8 4z" />
                            </svg>
                        </button>
                        <div id="demo<?= $key; ?>" class="collapse ms-5">
                            <p class="mt-3 mb-3"><b>Line 1: </b><?= $address['line_1']; ?></p>
                            <p class="mb-3"><b>Line 2: </b><?= $address['line_2']; ?></p>
                            <p class="mb-3"><b>City: </b><?= $address['city']; ?></p>
                            <p class="mb-3"><b>State: </b><?= $address['state']; ?></p>
                            <p class="mb-3"><b>Postal Code: </b><?= $address['postal_code']; ?></p>
                            <p class="mb-3"><b>Country: </b><?= $address['country']; ?></p>
                            <div>
                                <?= form_open(); ?>
                                    <button onclick="alert('delete address <?= $key+1; ?>?')" value="<?= $address['address_id']; ?>" type="submit" class="btn btn-danger" name="delete_address">Delete</button>
                                <?= form_close(); ?>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
            <div>
                <button onclick="updateActiveAddress()" type="button" class="btn btn-primary" id="save-address" disabled>Save Changes</button>
            </div>
            <?php else: ?>
            <?php endif; ?>


            <!-- The Modal -->
            <div class="modal fade" id="add-address">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Add Address</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <?= form_open(); ?>
                        <div class="modal-body">
                            <div>
                                <label class="form-label" for="line_1">Line 1:</label>
                                <input class="form-control" type="text" name="line_1" id="line_1">
                            </div>
                            <div>
                                <label class="form-label" for="line_2">Line 2: (optional)</label>
                                <input class="form-control" type="text" name="line_2" id="line_2">
                            </div>
                            <div>
                                <label class="form-label" for="city">City:</label>
                                <input class="form-control" type="text" name="city" id="city">
                            </div>
                            <div>
                                <label class="form-label" for="state">State:</label>
                                <input class="form-control" type="text" name="state" id="state">
                            </div>
                            <div>
                                <label class="form-label" for="postal_code">Postal Code:</label>
                                <input class="form-control" type="text" name="postal_code" id="postal_code">
                            </div>
                            <div>
                                <label class="form-label" for="country">Country:</label>
                                <input class="form-control" type="text" name="country" id="country">
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" name="add_address">Add</button>
                            <?= form_close(); ?>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>

            <!-- The Modal -->
            <div class="modal fade" id="edit-address">
                <div class="modal-dialog">
                    <div class="modal-content">

                        <!-- Modal Header -->
                        <div class="modal-header">
                            <h4 class="modal-title">Edit Address</h4>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                        </div>

                        <!-- Modal body -->
                        <?= form_open(); ?>
                        <div class="modal-body">
                            <div>
                                <label class="form-label" for="line_1">Line 1:</label>
                                <input class="form-control" type="text" name="line_1" id="line_1">
                            </div>
                            <div>
                                <label class="form-label" for="line_2">Line 2: (optional)</label>
                                <input class="form-control" type="text" name="line_2" id="line_2">
                            </div>
                            <div>
                                <label class="form-label" for="city">City:</label>
                                <input class="form-control" type="text" name="city" id="city">
                            </div>
                            <div>
                                <label class="form-label" for="state">State:</label>
                                <input class="form-control" type="text" name="state" id="state">
                            </div>
                            <div>
                                <label class="form-label" for="postal_code">Postal Code:</label>
                                <input class="form-control" type="text" name="postal_code" id="postal_code">
                            </div>
                            <div>
                                <label class="form-label" for="country">Country:</label>
                                <input class="form-control" type="text" name="country" id="country">
                            </div>
                        </div>

                        <!-- Modal footer -->
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-success" name="add_address">Add</button>
                            <?= form_close(); ?>
                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        <!--<= form_open(); ?>
    <div>
        <h3>Billing</h3>
        <div class="mt-3 mb-3">
            <label class="form-label" for="line_1"><b>Line 1:</b></label>
            <input class="form-control" type="text" name="line_1" id="line_1" placeholder="house number, street, barangay" value="<= $user_info['line_1'] ?>">

        </div>
        <div class="mb-3">
            <label class="form-label" for="line_2"><b>Line 2:</b></label>
            <input class="form-control" type="text" name="line_2" id="line_2" placeholder="house number, street, barangay" value="<= $user_info['line_2'] ?>">

        </div>
        <div class="mb-3">
            <label class="form-label" for="city"><b>City:</b></label>
            <input class="form-control" type="text" name="city" id="city" placeholder="City" value="<= $user_info['city'] ?>">

        </div>
        <div class="mb-3">
            <label class="form-label" for="state"><b>State:</b></label>
            <input class="form-control" type="text" name="state" id="state" placeholder="State" value="<= $user_info['state'] ?>">

        </div>
        <div class="mb-3">
            <php if (isset($validation) && $validation->hasError('postal_code')) : ?>
                <div class="alert alert-danger alert-dismissible fade show">
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                    <strong><= display_error($validation, 'postal_code') ?></strong>
                </div>
            <php endif; ?>
            <label class="form-label" for="postal_code"><b>Postal Code:</b></label>
            <input class="form-control" type="text" name="postal_code" id="postal_code" placeholder="postal code" value="<= $user_info['postal_code'] ?>">
        </div>
        <div class="mb-3">
            <label class="form-label" for="country"><b>Country:</b></label>
            <input class="form-control" type="text" name="country" id="country" placeholder="Country" value="<= $user_info['country'] ?>">
            <span><= display_error($validation, 'country') ?></span>
        </div>
        <div class="mb-3">
            <input class="form-control btn-primary" type="submit" value="Update Billing" name="update_billing">
        </div>
    </div>
    <= form_close(); ?>-->
        <hr>
        <?= form_open(); ?>
        <div>
            <h3>Change Password</h3>
            <div class="mt-3 mb-3">
                <label class="form-label" for="old_pass"><b>Old Password:</b></label>
                <input class="form-control" type="password" name="old_pass" id="old_pass" placeholder="Old Password">
                <?php if (isset($validation) && $validation->hasError('old_pass')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'old_pass') ?></strong>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="new_pass"><b>New Password:</b></label>
                <input class="form-control" type="password" name="new_pass" id="new_pass" placeholder="New Password">
                <?php if (isset($validation) && $validation->hasError('new_pass')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'new_pass') ?></strong>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <label class="form-label" for="confirm_pass"><b>Confirm New Password:</b></label>
                <input class="form-control" type="password" name="confirm_pass" id="confirm_pass" placeholder="Confirm New Password">
                <?php if (isset($validation) && $validation->hasError('confirm_pass')) : ?>
                    <div class="alert alert-danger alert-dismissible fade show">
                        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                        <strong><?= display_error($validation, 'confirm_pass') ?></strong>
                    </div>
                <?php endif; ?>
            </div>
            <div class="mb-3">
                <input class="form-control btn-primary" type="submit" value="Update Password" name="update_pass">
            </div>
        </div>
        <?= form_close(); ?>
    </div>

</div>
<script>
    function enablebtn() {
        document.getElementById('save-address').disabled = false;
    }

    function updateActiveAddress() {
        const address = document.querySelector('input[name="address"]:checked').value;
        window.location.replace('<?= base_url() ?>' + "/profile/update_address?address_id='; ?>" + address);
    }
</script>
<?= $this->endSection(); ?>