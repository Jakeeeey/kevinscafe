<?= $this->extend('templates/base'); ?>

<?= $this->section('title'); ?>
<?= $page_title; ?>
<?= $this->endSection(); ?>

<?= $this->section('script_src'); ?>
<script src="https://www.paypal.com/sdk/js?client-id=AUbwX2KFd-3jzOJkR5gnYElUtsiatNjqs3csVCLj18d2yLREsHQ2UwA8IBrb_lnTkHms54Jrqx7nZpGL&currency=PHP"></script>
<?= $this->endSection(); ?>

<?= $this->section('script'); ?>
<script>
  $(document).ready(function() {

    paypal.Buttons({
      // Set up the transaction
      createOrder: function(data, actions) {
        return actions.order.create({
          purchase_units: [{
            amount: {
              value: '10.00'
            }
          }]
        });
      },
      // Finalize the transaction
      onApprove: function(data, actions) {
        // Capture the payment
        return actions.order.capture().then(function(details) {
          // Redirect to the success URL
          window.location.href = "<?= base_url(); ?>" + "/login";
        });
      },
      // Handle errors
      onError: function(error) {
        // Redirect to the failed URL
        window.location.href = "<?= base_url(); ?>" + "/login";
      }
    }).render('#paypal-button-container');

  })
</script>
<?= $this->endSection(); ?>

<?= $this->section('body'); ?>

<div id="paypal-button-container"></div>

<?= $this->endSection(); ?>