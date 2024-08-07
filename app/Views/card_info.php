<?php
echo view('templates/header');
?>
<section id="about">
  <div class="container">
    <div class="row">
      <div class="col-md-3" style="padding: 0px 10px 0px 0px;">
        <?php
        echo view("components/siderbar", array('active' => 'card'));
        ?>
      </div>
      <div class="col-md-9" style="padding: 0px 0px 0px 10px;">
        <div class="account-panel <?php if (session()->get("active_status") == "Inactive") echo "inactive-panel"; ?>">
          <?php
          $member = get_row("member", array("id" => session()->get("member_id")));
          ?>
          <div class="title">
            My Card Info
          </div>
          <div style="font-size: 20px;">
            Balance : $<?php echo $member['balance']; ?>
          </div>
          <div class="row">
            <div class="col-md-12">
              <form action="<?php echo site_url("account/update_card_info"); ?>" method="post" name="update_profile">

                <div class="col-md-12" style="margin-top: 5px;">
                  <div class="form-group">
                    <label for="email">Card Number<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="card_number" required="" id="card_number" placeholder="xxxx xxxx xxxx xxxx" value="<?php echo $member['card_number']; ?>">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">Expiry Date<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="expiry_date" required="" id="expiry_date" placeholder="mm/yyyy" value="<?php echo $member['expiry_date']; ?>">
                  </div>
                </div>

                <div class="col-md-6">
                  <div class="form-group">
                    <label for="email">CVV<span style="color: red">*</span></label>
                    <input type="text" class="form-control" name="cvv" required="" id="cvv" placeholder="xxx" value="<?php echo $member['cvv']; ?>">
                  </div>
                </div>
                <div class="col-md-6">
                  <button class="btn btn-info"> Save</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section> <!-- /#about -->



<!--
==================================================
Call To Action Section Start
================================================== -->
<section id="call-to-action">
  <div class="container">
    <div class="row">
      <div class="col-md-12">
        <div class="block">
          <h2 class="title wow fadeInDown" data-wow-delay=".3s" data-wow-duration="500ms">SO WHAT YOU THINK ?</h1>
            <p class="wow fadeInDown" data-wow-delay=".5s" data-wow-duration="500ms">All purchases with Virsympay are purchases of the Virsymcoin Cryptocurrency,<br /> we convert all purchases to the currency of your choice.</p>
            <a href="<?php echo site_url("contact"); ?>" class="btn btn-default btn-contact wow fadeInDown" data-wow-delay=".7s" data-wow-duration="500ms">Contact With Me</a>
        </div>
      </div>

    </div>
  </div>
</section>


<?php
echo view('templates/footer');
?>