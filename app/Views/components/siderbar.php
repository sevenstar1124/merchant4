<ul class="account-siderbar">

	<li class="<?php if ($active == 'profile') echo 'active' ?>"><a href="<?php echo site_url("/account/dashboard"); ?>"><i class="icon ion-ios-contact"></i> My Profile</a></li>

	<li class="<?php if ($active == 'bussiness') echo 'active' ?>"><a href="<?php echo site_url("/account/businessInfo"); ?>"><i class="icon ion-card"></i> Business Info</a></li>

	<li class="<?php if ($active == 'upload') echo 'active' ?>"><a href="<?php echo site_url("/account/uploadCenter"); ?>"><i class="icon ion-upload"></i> Upload Center</a></li>

	<li class="<?php if ($active == 'card') echo 'active' ?>"><a href="<?php echo site_url("/account/card_info"); ?>"><i class="icon ion-card"></i> Credit Card Info</a></li>

	<li class="<?php if ($active == 'product') echo 'active' ?>"><a href="<?php echo site_url("/account/register_product"); ?>"><i class="ion-ios-medkit"></i> Products</a></li>

	<li class="<?php if ($active == 'transaction') echo 'active' ?>"><a href="<?php echo site_url("/account/transaction_history"); ?>"><i class="ion-ios-paper"></i> Transaction History</a></li>

	<li class="<?php if ($active == 'withdraw') echo 'active' ?>"><a href="<?php echo site_url("/account/withdraw_money"); ?>"><i class="ion-merge"></i> Withdraw Money</a></li>

	<li class="<?php if ($active == 'inbox') echo 'active' ?>"><a href="<?php echo site_url("/account/inbox"); ?>"><i class="ion-email"></i> Inbox <span class="message-count-box" style="display: none;"></span></a></li>

	<li class="<?php if ($active == 'api') echo 'active' ?>"><a href="<?php echo site_url("/account/api"); ?>"><i class="ion-cloud"></i> API</a></li>

	<li class="<?php if ($active == 'invoices') echo 'active' ?>"><a href="<?php echo site_url("/account/invoices"); ?>"><i class="ion-document"></i> Invoice</a></li>
</ul>