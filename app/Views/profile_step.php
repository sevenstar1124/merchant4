 <!DOCTYPE html>
 <html class="no-js">

 <head>
 	<!-- Basic Page Needs
        ================================================== -->
 	<meta charset="utf-8">
 	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
 	<link rel="icon" href="<?php echo base_url('assets/client_assets/images/favicon.png'); ?>">
 	<title>Merchant virsympay</title>
 	<meta name="description" content="">
 	<meta name="keywords" content="">
 	<meta name="author" content="">
 	<!-- Mobile Specific Metas
        ================================================== -->
 	<meta name="format-detection" content="telephone=no">
 	<meta name="viewport" content="width=device-width, initial-scale=1">


 	<!-- Template CSS Files
        ================================================== -->
 	<!-- Twitter Bootstrs CSS -->
 	<link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/bootstrap/bootstrap.min.css'); ?>">
 	<!-- Ionicons Fonts Css -->
 	<link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/ionicons/ionicons.min.css'); ?>">
 	<!-- animate css -->
 	<link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/animate-css/animate.css'); ?>">
 	<!-- Hero area slider css-->
 	<link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/slider/slider.css'); ?>">
 	<!-- owl craousel css -->
 	<link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/owl-carousel/owl.carousel.css'); ?>">
 	<link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/owl-carousel/owl.theme.css'); ?>">
 	<!-- Fancybox -->
 	<link rel="stylesheet" href="<?php echo base_url('assets/client_assets/plugins/facncybox/jquery.fancybox.css'); ?>">
 	<!-- template main css file -->
 	<link rel="stylesheet" href="<?php echo base_url('assets/client_assets/css/style.css'); ?>">
 	<link rel="stylesheet" href="<?php echo base_url('assets/client_assets/css/jquery.dataTables.css'); ?>">
 	<link rel="stylesheet" href="<?php echo base_url('assets/client_assets/css/step.css'); ?>">
 	<script type="text/javascript">
 		var base_url = '<?php echo base_url(); ?>';
 	</script>
 </head>

 <body>

 	<?php
		$member_data = get_row('member_data', array("member_id" => session()->get("member_id")));
		if (session()->get("warning") != "") {
		?>
 		<div id="alert_error_wrap" class="float-alert animated fadeInRight col-xs-11 col-sm-4 alert alert-danger" style="z-index: 10000; float: right; margin-top: 10px;">
 			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 				<span aria-hidden="true">&times;</span>
 			</button>
 			<span class="fa fa-bell-o" data-notify="icon"></span><span class="alert-title"><?php echo session()->get("warning"); ?></span>
 		</div>

 	<?php
			session()->remove("warning");
		}
		?>

 	<?php
		if (session()->get("success") != "") {
		?>
 		<div id="alert_error_wrap" class="float-alert animated fadeInRight col-xs-11 col-sm-4 alert alert-success" style="z-index: 10000; float: right; margin-top: 10px;">
 			<button type="button" class="close" data-dismiss="alert" aria-label="Close">
 				<span aria-hidden="true">&times;</span>
 			</button>
 			<span class="fa fa-bell-o" data-notify="icon"></span><span class="alert-title"><?php echo session()->get("success"); ?></span>
 		</div>

 	<?php
			session()->remove("success");
		}
		?>
 	<style type="text/css">
 		.step-cation {
 			margin-top: 10px;
 			border: 1px solid #ccc;
 			padding: 10px;
 			text-align: center;
 			border-radius: 5px;
 			background: #ebebeb;
 			color: red;
 		}
 	</style>

 	<header id="top-bar">
 		<div class="container">
 			<div class="" style="text-align: center;">
 				<a href="<?php echo base_url(); ?>" style="font-size: 40px;">
 					<img src="<?php echo base_url('assets/client_assets/images/logo.png'); ?>" alt="" style="height: 50px;">
 					VIRSYMPAY
 				</a>
 			</div>
 		</div>
 	</header>
 	<section>
 		<div class="container" style="min-height: calc(100VH - 75px);">
 			<form action="<?php echo site_url("profileStep/saveStep"); ?>" method="post" name="step_form" id="step_form">
 				<input type="hidden" name="phase_status" id="phase_status" value="<?php echo $member_data['phase_status'] ?? 1; ?>">
 				<div class="row">
 					<div class="col-md-12">
 						<div class="step-item-wrap">
 							<div class="step-item" data-value="1">
 								<div class="step-number">
 									<div class="step-number-content">1</div>
 									<div class="step-number-line step-number-line-first"></div>
 								</div>
 								<div class="step-number-desc">
 									Business Information
 								</div>
 							</div>

 							<div class="step-item" data-value="2">
 								<div class="step-number">
 									<div class="step-number-content">2</div>
 									<div class="step-number-line"></div>
 								</div>
 								<div class="step-number-desc">
 									Business Ownership
 								</div>
 							</div>

 							<div class="step-item" data-value="3">
 								<div class="step-number">
 									<div class="step-number-content">3</div>
 									<div class="step-number-line"></div>
 								</div>
 								<div class="step-number-desc">
 									Bank Information
 								</div>
 							</div>

 							<div class="step-item" data-value="4">
 								<div class="step-number">
 									<div class="step-number-content">4</div>
 									<div class="step-number-line"></div>
 								</div>
 								<div class="step-number-desc">
 									Business Background
 								</div>
 							</div>

 							<div class="step-item" data-value="5">
 								<div class="step-number">
 									<div class="step-number-content">5</div>
 									<div class="step-number-line"></div>
 								</div>
 								<div class="step-number-desc">
 									Marketing & Fulfillment
 								</div>
 							</div>

 							<div class="step-item" data-value="6">
 								<div class="step-number">
 									<div class="step-number-content">6</div>
 									<div class="step-number-line step-number-line-last"></div>
 								</div>
 								<div class="step-number-desc">
 									Final Reviews
 								</div>
 							</div>
 						</div>
 					</div>
 					<div class="col-md-12">
 						<div style="border-top: 1px solid #ccc; border-bottom: 1px solid #ccc; width: 100%; padding: 5px 0px; margin-top: 20px;">
 							<div class="setp-stage-title-wrap">
 								<div class="setp-stage-title">Business and Adress Information</div>
 								<div class="setp-stage">Step 1 - 6</div>
 							</div>
 						</div>
 					</div>
 					<div class="col-md-12">
 						<div class="step-cation">All fields are required. Please fill out all fields correctly.</div>
 					</div>
 					<div class="col-md-12">
 						<div class="step-box" data-stage="1">
 							<div class="step-box-title">
 								Business and Address Information
 							</div>
 							<div class="step-box-content">
 								<div class="row">
 									<div class="col-md-8" style="border-right: 1px solid #d9e7e0;">
 										<div class="step-box-sub-title">
 											Business Information
 										</div>
 										<div class="row">
 											<div class="col-md-6">
 												<div class="form-group step-input-wrap">
 													<label>DBA Name</label>
 													<input type="text" class="form-control" name="dba_name" value="<?php echo $member_data['dba_name'] ?? ''; ?>">
 												</div>
 												<div class="form-group step-input-wrap">
 													<label>Federal Tax ID</label>
 													<input type="text" class="form-control" name="federal_tax_id" value="<?php echo $member_data['federal_tax_id'] ?? ''; ?>">
 												</div>
 												<div class="form-group step-input-wrap">
 													<label>Name on Tax Return</label>
 													<input type="text" class="form-control" name="name_tax_return" value="<?php echo $member_data['name_tax_return'] ?? ''; ?>">
 												</div>
 												<div class="form-group step-input-wrap">
 													<label>Registration Country</label>
 													<select class="form-control" name="country_of_registration">
 														<?php
															$countries = get_rows("countries");
															// if($member_data['country_of_registration'] == "") $member_data['country_of_registration'] = "United States of America";
															$country_of_registration = $member_data['country_of_registration'] ?? "United States of America";
															foreach ($countries as $key => $country) {
																if ($country_of_registration == $country['long_name'])
																	echo '<option value="' . $country['long_name'] . '" selected>' . $country['long_name'] . '</option>';
																else
																	echo '<option value="' . $country['long_name'] . '">' . $country['long_name'] . '</option>';
															}
															?>
 													</select>
 												</div>

 											</div>
 											<div class="col-md-6">
 												<div class="form-group step-input-wrap">
 													<label>Business Contact Email</label>
 													<input type="text" class="form-control" name="business_email" value="<?php echo $member_data['business_email'] ?? ''; ?>">
 												</div>
 												<div class="form-group step-input-wrap">
 													<label>Business Start Date(mm/dd/yyyy)</label>
 													<input type="date" class="form-control" name="business_start_date" value="<?php echo $member_data['business_start_date'] ?? ''; ?>">
 												</div>
 												<div class="form-group step-input-wrap">
 													<label>Business Types</label>
 													<select class="form-control" name="business_type">
 														<?php
															$business_types = array('Corporation', 'Limited Liability Company', 'Sole Proprietorship');
															$mem_btype = $member_data['business_type'] ?? '';
															foreach ($business_types as $key => $business_type) {
																if ($mem_btype == $business_type)
																	echo '<option value="' . $business_type . '" selected>' . $business_type . '</option>';
																else
																	echo '<option value="' . $business_type . '">' . $business_type . '</option>';
															}
															?>
 													</select>

 												</div>
 												<div class="form-group step-input-wrap">
 													<label>Descriptor</label>
 													<input type="text" class="form-control" name="descriptor" value="<?php echo $member_data['descriptor'] ?? ''; ?>">
 												</div>
 											</div>
 											<div class="col-md-12">
 												<div class="form-group step-input-wrap">
 													<label>Business Description</label>
 													<textarea class="form-control" name="details_business" style="resize: vertical; height:100px;"><?php echo $member_data['details_business'] ?? ''; ?></textarea>
 												</div>
 											</div>
 										</div>
 									</div>
 									<div class="col-md-4">
 										<div class="step-box-sub-title">
 											Business Information
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>DBA Adreess Street</label>
 											<input type="text" class="form-control" name="dba_address" value="<?php echo $member_data['dba_address'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>DBA State/Province</label>
 											<input type="text" class="form-control" name="dba_state" value="<?php echo $member_data['dba_state'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>DBA City</label>
 											<input type="text" class="form-control" name="dba_city" value="<?php echo $member_data['dba_city'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>DBA Zip/Postal Code</label>
 											<input type="text" class="form-control" name="dba_zipcode" value="<?php echo $member_data['dba_zipcode'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>DBA Country</label>
 											<select class="form-control" name="dba_country">
 												<?php
													$dba_country = $member_data['dba_country'] ?? "United States of America";
													foreach ($countries as $key => $country) {
														if ($dba_country == $country['long_name'])
															echo '<option value="' . $country['long_name'] . '" selected>' . $country['long_name'] . '</option>';
														else
															echo '<option value="' . $country['long_name'] . '">' . $country['long_name'] . '</option>';
													}
													?>
 											</select>
 										</div>

 									</div>
 								</div>
 							</div>
 						</div>

 						<div class="step-box" data-stage="2">
 							<div class="step-box-title">
 								Business Ownership
 							</div>
 							<div class="step-box-content">
 								<div class="row">
 									<div class="col-md-4" style="border-right: 1px solid #d9e7e0;">
 										<div class="step-box-sub-title">
 											Owner Information
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>Name</label>
 											<input type="text" class="form-control" name="owner_name" value="<?php echo $member_data['owner_name'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Title</label>
 											<input type="text" class="form-control" name="owner_title" value="<?php echo $member_data['owner_title'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Ownership Percentage</label>
 											<input type="number" class="form-control" name="ownership_percentage" value="<?php echo $member_data['ownership_percentage'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Email</label>
 											<input type="text" class="form-control" name="owner_email" value="<?php echo $member_data['owner_email'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Mobile Phone</label>
 											<input type="text" class="form-control" name="owner_phone" value="<?php echo $member_data['owner_phone'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Skype ID</label>
 											<input type="text" class="form-control" name="owner_skype_id" value="<?php echo $member_data['owner_skype_id'] ?? ''; ?>">
 										</div>
 									</div>

 									<div class="col-md-4">
 										<div class="step-box-sub-title">
 											Owner Address
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>Home Address Street</label>
 											<input type="text" class="form-control" name="owner_address" value="<?php echo $member_data['owner_address'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Home City</label>
 											<input type="text" class="form-control" name="owner_city" value="<?php echo $member_data['owner_city'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Home State/Province</label>
 											<input type="text" class="form-control" name="owner_state" value="<?php echo $member_data['owner_state'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Home Zip/Postal Code</label>
 											<input type="text" class="form-control" name="owner_zipcode" value="<?php echo $member_data['owner_zipcode'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Home Country</label>
 											<select class="form-control" name="country_of_registration">
 												<?php
													$owner_country = $member_data['owner_country'] ?? "United States of America";
													foreach ($countries as $key => $country) {
														if ($owner_country == $country['long_name'])
															echo '<option value="' . $country['long_name'] . '" selected>' . $country['long_name'] . '</option>';
														else
															echo '<option value="' . $country['long_name'] . '">' . $country['long_name'] . '</option>';
													}
													?>
 											</select>
 										</div>
 										<div class="form-group step-radio-wrap">
 											<label>Not a US Citizen ?
 												<input type="checkbox" class="form-control" name="owner_us_city" id="owner_us_city" <?php echo $member_data !== [] && $member_data['owner_us_city'] == 1 ? 'checked="checked"' : ''; ?>>
 											</label>
 										</div>
 									</div>

 									<div class="col-md-4" style="border-left: 1px solid #d9e7e0;">
 										<div class="step-box-sub-title">
 											Owner Personal
 										</div>
 										<div class="form-group step-input-wrap">
 											<label class="owner_ssn"><?php echo $member_data !== [] && $member_data['owner_us_city'] == 1 ? "Passport Issuing Country" : "SSN"; ?></label>
 											<input type="text" class="form-control" name="owner_ssn_1" value="<?php echo $member_data['owner_ssn_1'] ?? ''; ?>">
 										</div>


 										<div class="form-group step-input-wrap">
 											<label class="owner_ssn"><?php echo $member_data !== [] && $member_data['owner_us_city'] == 1 ? "Passport expiry date" : "SSN"; ?></label>
 											<input type="text" class="form-control" name="owner_ssn_2" value="<?php echo $member_data['owner_ssn_2'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Owner Birthday (mm/dd/yyy)</label>
 											<input type="date" class="form-control" name="owner_birthday" value="<?php echo $member_data['owner_birthday'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>DL</label>
 											<input type="text" class="form-control" name="owner_dl" value="<?php echo $member_data['owner_dl'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>DL Expiry (mm/dd/yyy)</label>
 											<input type="date" class="form-control" name="owner_dl_expire_date" value="<?php echo $member_data['owner_dl_expire_date'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>DL State</label>
 											<input type="text" class="form-control" name="owner_dl_state" value="<?php echo $member_data['owner_dl_state'] ?? ''; ?>">
 										</div>


 									</div>
 								</div>
 								<div class="row">
 									<div class="col-md-12">
 										<div class="form-group step-radio-wrap">
 											<label>Second Owner
 												<input type="checkbox" class="form-control" name="second_owner" id="second_owner" <?php echo $member_data !== [] && $member_data['second_owner'] == 1 ? 'checked="checked"' : ''; ?>>
 											</label>
 										</div>
 									</div>
 								</div>
 								<div class="row second_owner_wrap" <?php echo $member_data !== [] && $member_data['second_owner'] == 1 ? '' : 'style="display:none"'; ?>>
 									<div class="col-md-4" style="border-right: 1px solid #d9e7e0;">
 										<div class="step-box-sub-title">
 											Second Owner Information
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>Name</label>
 											<input type="text" class="form-control" name="owner2_name" value="<?php echo $member_data['owner2_name'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Title</label>
 											<input type="text" class="form-control" name="owner2_title" value="<?php echo $member_data['owner2_title'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Ownership Percentage</label>
 											<input type="text" class="form-control" name="owner2ship_percentage" value="<?php echo $member_data['owner2ship_percentage'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Email</label>
 											<input type="text" class="form-control" name="owner2_email" value="<?php echo $member_data['owner2_email'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Mobile Phone</label>
 											<input type="text" class="form-control" name="owner2_phone" value="<?php echo $member_data['owner2_phone'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Skype ID</label>
 											<input type="text" class="form-control" name="owner2_skype_id" value="<?php echo $member_data['owner2_skype_id'] ?? ''; ?>">
 										</div>
 									</div>

 									<div class="col-md-4">
 										<div class="step-box-sub-title">
 											Second Owner Address
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>Home Address Street</label>
 											<input type="text" class="form-control" name="owner2_address" value="<?php echo $member_data['owner2_address'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Home City</label>
 											<input type="text" class="form-control" name="owner2_city" value="<?php echo $member_data['owner2_city'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Home State/Province</label>
 											<input type="text" class="form-control" name="owner2_state" value="<?php echo $member_data['owner2_state'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Home Zip/Postal Code</label>
 											<input type="text" class="form-control" name="owner2_zipcode" value="<?php echo $member_data['owner2_zipcode'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Home Country</label>
 											<select class="form-control" name="country_of_registration">
 												<?php
													$owner2_country = $member_data['owner2_country'] ?? "United States of America";
													foreach ($countries as $key => $country) {
														if ($owner2_country == $country['long_name'])
															echo '<option value="' . $country['long_name'] . '" selected>' . $country['long_name'] . '</option>';
														else
															echo '<option value="' . $country['long_name'] . '">' . $country['long_name'] . '</option>';
													}
													?>
 											</select>
 										</div>
 										<div class="form-group step-radio-wrap">
 											<label>Not a US Citizen ?
 												<input type="checkbox" class="form-control" name="owner2_us_city" id="owner2_us_city" <?php echo $member_data !== [] && $member_data['owner2_us_city'] == 1 ? 'checked="checked"' : ''; ?>>
 											</label>
 										</div>
 									</div>

 									<div class="col-md-4" style="border-left: 1px solid #d9e7e0;">
 										<div class="step-box-sub-title">
 											Second Owner Personal
 										</div>
 										<div class="form-group step-input-wrap">
 											<label class="owner2_ssn"><?php echo $member_data !== [] && $member_data['owner2_us_city'] == 1 ? 'Passport Issuing Country' : 'SSN' ?></label>
 											<input type="text" class="form-control" name="owner2_ssn_1" value="<?php echo $member_data['owner2_ssn_1'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label class="owner2_ssn"><?php echo $member_data !== [] && $member_data['owner2_us_city'] == 1 ? 'Passport expiry date' : 'SSN' ?></label>
 											<input type="text" class="form-control" name="owner2_ssn_2" value="<?php echo $member_data['owner2_ssn_2'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Owner Birthday (mm/dd/yyy)</label>
 											<input type="date" class="form-control" name="owner2_birthday" value="<?php echo $member_data['owner2_birthday'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>DL</label>
 											<input type="text" class="form-control" name="owner2_dl" value="<?php echo $member_data['owner2_dl'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>DL Expiry (mm/dd/yyy)</label>
 											<input type="date" class="form-control" name="owner2_dl_expire_date" value="<?php echo $member_data['owner2_dl_expire_date'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>DL State</label>
 											<input type="text" class="form-control" name="owner2_dl_state" value="<?php echo $member_data['owner2_dl_state'] ?? ''; ?>">
 										</div>
 									</div>
 								</div>
 							</div>
 						</div>

 						<div class="step-box" data-stage="3">
 							<div class="step-box-title">
 								Bank Information and Credit Crad Processing
 							</div>
 							<div class="step-box-content">
 								<div class="row">
 									<div class="col-md-8" style="border-right: 1px solid #d9e7e0;">
 										<div class="step-box-sub-title">
 											Bank Information
 										</div>
 										<div class="row">
 											<div class="col-md-6">
 												<div class="form-group step-input-wrap">
 													<label>Settlement Bank</label>
 													<input type="text" class="form-control" name="settlement_bank" value="<?php echo $member_data['settlement_bank'] ?? ''; ?>">
 												</div>
 												<div class="form-group step-input-wrap">
 													<label>Bank Contact</label>
 													<input type="text" class="form-control" name="bank_contact" value="<?php echo $member_data['bank_contact'] ?? ''; ?>">
 												</div>
 												<div class="form-group step-input-wrap">
 													<label>Settlement Transit ABA</label>
 													<input type="text" class="form-control" name="bank_transit_aba" value="<?php echo $member_data['bank_transit_aba'] ?? ''; ?>">
 												</div>
 												<div class="form-group step-input-wrap">
 													<label>Account Holder Type</label>
 													<input type="text" class="form-control" name="account_folder_type" value="<?php echo $member_data['account_folder_type'] ?? ''; ?>">
 												</div>

 											</div>
 											<div class="col-md-6">
 												<div class="form-group step-input-wrap">
 													<label>Deposit Account</label>
 													<input type="text" class="form-control" name="bank_deposit_account" value="<?php echo $member_data['bank_deposit_account'] ?? ''; ?>">
 												</div>

 												<div class="form-group step-input-wrap">
 													<label>Confirm Deposit Account</label>
 													<input type="text" class="form-control" name="bank_deposit_account_confirm" value="<?php echo $member_data['bank_deposit_account'] ?? ''; ?>">
 												</div>

 												<div class="form-group step-input-wrap">
 													<label>IBAN/SWIFT Code</label>
 													<input type="text" class="form-control" name="bank_swift_code" value="<?php echo $member_data['bank_swift_code'] ?? ''; ?>">
 												</div>
 											</div>
 											<div class="col-md-12">
 												<div style="font-size: 14px; font-style: italic; color: #969696;">
 													Upon entering banking details, you agree to Virsympay monthly charge of $25USD account will be charge each month this same time automated for all our merchants, we want every merchant from this point to have their bank details and credit card on file so our billing system can automatically process it each month. mandatory that each and every merchant HAS to enter their bank details and it is processed with a confirmation in order to proceed from now on. Using this API. This way we are guaranteed an automated billing from each merchant account and alleviates us from manually doing it as it now automatic.
 												</div>
 											</div>
 										</div>
 									</div>
 									<div class="col-md-4">
 										<div class="step-box-sub-title">
 											Merchant Phone, Email, Etc
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>Location Phone</label>
 											<input type="text" class="form-control" name="merchant_phone" value="<?php echo $member_data['merchant_phone'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Contact Email</label>
 											<input type="text" class="form-control" name="merchant_contact_email" value="<?php echo $member_data['merchant_contact_email'] ?? ''; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Web Address</label>
 											<input type="text" class="form-control" name="merchant_web_address" value="<?php echo $member_data['merchant_web_address'] ?? ''; ?>">
 										</div>
 									</div>

 									<div class="col-md-12" style="margin-top: 20px;">
 										<div class="step-box-sub-title">
 											Credit Card Processing
 										</div>
 										<div style="margin-top:20px;">
 											<label>Has the business or any associated owner even been terminated as a Visa @ Master Card @ Discover @ American Express merchant?</label>
 											<div style="display: flex; grid-gap: 40px; margin-top: 5px;">
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="card_status" <?php echo $member_data !== [] && $member_data['card_status'] == 1 ? 'checked = "checked"' : ''; ?> value="1">
 														Yes
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="card_status" <?php echo $member_data !== [] && $member_data['card_status'] == 1 ? '' : 'checked = "checked"'; ?> value="0">
 														No
 													</label>
 												</div>
 											</div>
 										</div>

 										<div style="margin-top:20px;">
 											<label>Do you currently VISA / Master Card / Discover / American Express. If Yes, please submit 3 most currently months statements.</label>
 											<div style="display: flex; grid-gap: 40px; margin-top: 5px;">
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="card_statment" <?php echo $member_data !== [] && $member_data['card_statment'] == 1 ? 'checked = "checked"' : ''; ?> value="1">
 														Yes
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="card_statment" <?php echo $member_data !== [] && $member_data['card_statment'] == 1 ? '' : 'checked = "checked"'; ?> value="0">
 														No
 													</label>
 												</div>
 											</div>
 										</div>

 										<div style="margin-top:20px;">
 											<label>Are there third parties/Payment application involved with your?</label>
 											<div style="display: flex; grid-gap: 40px; margin-top: 5px;">
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="third_payment" <?php echo $member_data !== [] && $member_data['third_payment'] == 1 ? 'checked = "checked"' : ''; ?> value="1">
 														Yes
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="third_payment" <?php echo $member_data !== [] && $member_data['third_payment'] == 1 ? '' : 'checked = "checked"'; ?> value="0">
 														No
 													</label>
 												</div>
 											</div>
 										</div>

 										<div style="margin-top:20px;">
 											<label>If your Business PCI Compliant?</label>
 											<div style="display: flex; grid-gap: 40px; margin-top: 5px;">
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="pci_compliant" <?php echo $member_data !== [] && $member_data['pci_compliant'] == 1 ? 'checked = "checked"' : ''; ?> value="1">
 														Yes
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="pci_compliant" <?php echo $member_data !== [] && $member_data['pci_compliant'] == 1 ? '' : 'checked = "checked"'; ?> value="0">
 														No
 													</label>
 												</div>
 											</div>
 										</div>

 										<div style="margin-top:20px;">
 											<label>Has Your Business had any ongoing or prior Data compromise investigations?</label>
 											<div style="display: flex; grid-gap: 40px; margin-top: 5px;">
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="ongoing_data" <?php echo $member_data !== [] && $member_data['ongoing_data'] == 1 ? 'checked = "checked"' : ''; ?> value="1">
 														Yes
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="ongoing_data" <?php echo $member_data !== [] && $member_data['ongoing_data'] == 1 ? '' : 'checked = "checked"'; ?> value="0">
 														No
 													</label>
 												</div>
 											</div>
 										</div>

 									</div>
 								</div>
 							</div>
 						</div>

 						<div class="step-box" data-stage="4">
 							<div class="step-box-title">
 								Business Background
 							</div>
 							<div class="step-box-content">
 								<div class="row">
 									<div class="col-md-4">
 										<div class="form-group step-input-wrap">
 											<label>Transaction Profile</label>
 											<select class="form-control" name="transaction_profile">
 												<?php
													$transaction_profiles = ['Online', 'Phone', 'Mail', 'InStore / In-person', 'Offline(requires higher verification)'];
													// if($member_data['country_of_registration'] == "") $member_data['country_of_registration'] = "United States of America";
													$mem_tp = $member_data['transaction_profile'] ?? '';
													foreach ($transaction_profiles as $key => $transaction_profile) {
														if ($transaction_profile == $mem_tp)
															echo '<option value="' . $transaction_profile . '" selected>' . $transaction_profile . '</option>';
														else
															echo '<option value="' . $transaction_profile . '">' . $transaction_profile . '</option>';
													}
													?>
 											</select>
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>Maximum Monthly Sale Volume</label>
 											<input type="number" class="form-control" name="max_monthly_sale" value="<?php echo $member_data['max_monthly_sale'] ?? ''; ?>">
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>Avg. Ticket</label>
 											<input type="number" class="form-control" name="avg_ticket" value="<?php echo $member_data['avg_ticket'] ?? ''; ?>">
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>Highest Ticket</label>
 											<input type="number" class="form-control" name="highest_ticket" value="<?php echo $member_data['highest_ticket'] ?? ''; ?>">
 										</div>
 									</div>

 									<div class="col-md-4">
 										<div class="form-group step-input-wrap">
 											<label>Swiped %</label>
 											<input type="number" class="form-control pro-calc" name="swiped_pro" value="<?php echo $member_data['swiped_pro'] ?? 0; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Keyed %</label>
 											<input type="number" class="form-control pro-calc" name="keyed_pro" value="<?php echo $member_data['keyed_pro'] ?? 0; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Total</label>
 											<input type="number" class="form-control" name="total_pro" value="<?php echo $member_data['total_pro'] ?? ''; ?>" readonly="true">
 										</div>
 										<div class="total-error-wrap">
 											Total percentage sum of Swiped and Keyed Percentage cannot be greater than or less than 100 is just equal to 100.
 										</div>
 									</div>
 									<div class="col-md-4">
 										<div class="form-group step-input-wrap">
 											<label>On Promise</label>
 											<input type="number" class="form-control order-calc" name="premise_order" value="<?php echo $member_data['premise_order'] ?? 0; ?>">
 										</div>

 										<div class="form-group step-input-wrap">
 											<label>Mail Order</label>
 											<input type="number" class="form-control order-calc" name="mail_order" value="<?php echo $member_data['mail_order'] ?? 0; ?>">
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>Telephone Order</label>
 											<input type="number" class="form-control order-calc" name="phone_order" value="<?php echo $member_data['phone_order'] ?? 0; ?>">
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>Internet</label>
 											<input type="number" class="form-control order-calc" name="interent_order" value="<?php echo $member_data['interent_order'] ?? 0; ?>">
 										</div>
 										<div class="form-group step-input-wrap">
 											<label>Total</label>
 											<input type="number" class="form-control" name="total_order" value="<?php echo $member_data['total_order'] ?? ''; ?>" readonly>
 										</div>
 									</div>
 								</div>
 							</div>
 						</div>

 						<div class="step-box" data-stage="5">
 							<div class="step-box-title">
 								Marketing & Fulfillment
 							</div>
 							<div class="step-box-content">
 								<div class="row">
 									<div class="col-md-12" style="margin-top: 20px;">
 										<div class="step-box-sub-title">
 											Marketing & Inventory
 										</div>
 										<div style="margin-top:20px;">
 											<label>Where is the product inventory house and maintained?</label>
 											<div style="display: flex; grid-gap: 10px; margin-top: 5px; flex-flow: column;">
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="product_inventory" <?php echo $member_data !== [] && $member_data['product_inventory'] == 1 ? 'checked = "checked"' : ''; ?> value="1">
 														Merchant Location Described in application
 													</label>
 												</div>

 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="product_inventory" <?php echo $member_data !== [] && $member_data['product_inventory'] == 2 ? 'checked = "checked"' : ''; ?> value="2">
 														Merchant warehouse Located at
 													</label>
 												</div>

 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="product_inventory" <?php echo $member_data !== [] && $member_data['product_inventory'] == 3 ? 'checked = "checked"' : ''; ?> value="3">
 														Third party warehouse
 													</label>
 												</div>

 											</div>
 										</div>

 										<div style="margin-top:20px;">
 											<label>Does the merchant use a fulfillment company to warehouse and ship their product?</label>
 											<div style="display: flex; grid-gap: 40px; margin-top: 5px;">
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="fulfillment_compant" <?php echo $member_data !== [] && $member_data['fulfillment_compant'] == 1 ? 'checked = "checked"' : ''; ?> value="1">
 														Yes
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="fulfillment_compant" <?php echo $member_data !== [] && $member_data['fulfillment_compant'] == 1 ? '' : 'checked = "checked"'; ?> value="0">
 														No
 													</label>
 												</div>
 											</div>
 										</div>
 									</div>

 									<div class="col-md-12" style="margin-top: 20px;border-top: 1px solid #d9e7e0;padding-top: 10px;">
 										<div class="step-box-sub-title">
 											Marketing & Merchandise
 										</div>
 										<div style="margin-top:20px;">
 											<label>When methods are used market your products? Please include copies of any ads or direct email pieces being used. For mail order sales, please include an example of the product order form that includes the credit card account number information, cardholder signature and shipping address information.</label>
 											<div style="margin-top: 5px;">
 												<?php
													$market_method = explode(",", $member_data['market_method'] ?? '');
													?>
 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="market_method[]" <?php echo  in_array("Catalog", $market_method) ? 'checked = "checked"' : ''; ?> value="Catalog">
 														Catalog
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="market_method[]" <?php echo  in_array("Cold Calls", $market_method) ? 'checked = "checked"' : ''; ?> value="Cold Calls">
 														Cold Calls
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="market_method[]" <?php echo  in_array("Sales Reps", $market_method) ? 'checked = "checked"' : ''; ?> value="Sales Reps">
 														Sales Reps
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="market_method[]" <?php echo  in_array("Brouchers", $market_method) ? 'checked = "checked"' : ''; ?> value="Brouchers">
 														Brouchers
 													</label>
 												</div>

 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="market_method[]" <?php echo  in_array("Referals", $market_method) ? 'checked = "checked"' : ''; ?> value="Referals">
 														Referals
 													</label>
 												</div>

 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="market_method[]" <?php echo  in_array("Internet", $market_method) ? 'checked = "checked"' : ''; ?> value="Internet">
 														Internet
 													</label>
 												</div>

 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="market_method[]" <?php echo  in_array("Phone Book", $market_method) ? 'checked = "checked"' : ''; ?> value="Phone Book">
 														Phone Book
 													</label>
 												</div>

 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="market_method[]" <?php echo  in_array("Magazines", $market_method) ? 'checked = "checked"' : ''; ?> value="Magazines">
 														Magazines
 													</label>
 												</div>

 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="market_method[]" <?php echo  in_array("Other", $market_method) ? 'checked = "checked"' : ''; ?> value="Other">
 														Other
 													</label>
 												</div>
 											</div>
 										</div>
 									</div>

 									<div class="col-md-12" style="margin-top: 20px;border-top: 1px solid #d9e7e0;padding-top: 10px;  clear: both;">
 										<div class="step-box-sub-title">
 											Merchandise Availability
 										</div>
 										<div style="margin-top:20px;">
 											<label>How is merchandise/service available to the cardholders?</label>
 											<div style="margin-top: 5px;">
 												<?php
													$market_method = explode(",", $member_data['delivery_method'] ?? '');
													?>
 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="delivery_method[]" <?php echo  in_array("Delivery/Carrier Service", $market_method) ? 'checked = "checked"' : ''; ?> value="Delivery/Carrier Service">
 														Delivery/Carrier Service
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="delivery_method[]" <?php echo  in_array("Customer Pickup", $market_method) ? 'checked = "checked"' : ''; ?> value="Customer Pickup">
 														Customer Pickup
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="delivery_method[]" <?php echo  in_array("Merchant's Vehicle Delivers", $market_method) ? 'checked = "checked"' : ''; ?> value="Merchant's Vehicle Delivers">
 														Merchant's Vehicle Delivers
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="delivery_method[]" <?php echo  in_array("At C/H's Establishment", $market_method) ? 'checked = "checked"' : ''; ?> value="At C/H's Establishment">
 														At C/H's Establishment
 													</label>
 												</div>

 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="delivery_method[]" <?php echo  in_array("Fade/Trade Shows", $market_method) ? 'checked = "checked"' : ''; ?> value="Fade/Trade Shows">
 														Fade/Trade Shows
 													</label>
 												</div>

 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="delivery_method[]" <?php echo  in_array("On-line", $market_method) ? 'checked = "checked"' : ''; ?> value="On-line">
 														On-line
 													</label>
 												</div>

 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="delivery_method[]" <?php echo  in_array("US Postal", $market_method) ? 'checked = "checked"' : ''; ?> value="US Postal">
 														US Postal
 													</label>
 												</div>

 												<div class="form-group step-radio-wrap" style="margin:0px; margin-right: 20px; float: left;">
 													<label>
 														<input type="checkbox" class="form-control" name="delivery_method[]" <?php echo  in_array("Other", $market_method) ? 'checked = "checked"' : ''; ?> value="Other">
 														Other
 													</label>
 												</div>

 											</div>
 										</div>

 										<div style="margin-top: 80px; clear: both;">
 											<label>Does the merchant charge a restocking fee? include any published infomation pertaining to restocking fees.</label>
 											<div style="display: flex; grid-gap: 40px; margin-top: 5px;">
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="restocking_fee" <?php echo $member_data !== [] && $member_data['restocking_fee'] == 1 ? 'checked = "checked"' : ''; ?> value="1">
 														Yes
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="restocking_fee" <?php echo $member_data !== [] && $member_data['restocking_fee'] == 1 ? '' : 'checked = "checked"'; ?> value="0">
 														No
 													</label>
 												</div>
 											</div>
 										</div>

 										<div class="form-group" style="margin-top:20px;">
 											<label>What is the merchant's refund and return policy? Include any publish infomation.</label>
 											<textarea class="form-control" name="refun_policy"><?php echo $member_data['refun_policy'] ?? ''; ?></textarea>
 										</div>

 									</div>
 									<div class="col-md-12" style="margin-top: 20px;border-top: 1px solid #d9e7e0;padding-top: 10px;">
 										<div class="step-box-sub-title">
 											Products & Services
 										</div>
 										<div style="margin-top:20px;">
 											<label>
 												For Telephone Order sales, where does the cardholder call to place the order and who records the credit card account number information and authorizes the sale?
 											</label>
 											<div style="display: flex; grid-gap: 40px; margin-top: 5px;">
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="record_card" <?php echo $member_data !== [] && $member_data['record_card'] == 1 ? '' : 'checked = "checked"'; ?> value="2">
 														Merchant Staff
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="record_card" <?php echo $member_data !== [] && $member_data['record_card'] == 1 ? 'checked = "checked"' : ''; ?> value="1">
 														Third Party
 													</label>
 												</div>
 											</div>
 										</div>

 										<div style="margin-top:20px;">
 											<label>
 												Who is responsible for issuing customer refunds?
 											</label>
 											<div style="display: flex; grid-gap: 40px; margin-top: 5px;">
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="refund_issue" <?php echo $member_data !== [] && $member_data['refund_issue'] == 1 ? '' : 'checked = "checked"'; ?> value="2">
 														Merchant Staff
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="refund_issue" <?php echo $member_data !== [] && $member_data['refund_issue'] == 1 ? 'checked = "checked"' : ''; ?> value="1">
 														Third Party
 													</label>
 												</div>
 											</div>
 										</div>

 										<div style="margin-top:20px;">
 											<label>
 												Who is responsible for providing customer service?
 											</label>
 											<div style="display: flex; grid-gap: 40px; margin-top: 5px;">
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="provide_service" <?php echo $member_data !== [] && $member_data['provide_service'] == 1 ? '' : 'checked = "checked"'; ?> value="2">
 														Merchant Staff
 													</label>
 												</div>
 												<div class="form-group step-radio-wrap" style="margin:0px;">
 													<label>
 														<input type="radio" class="form-control" name="provide_service" <?php echo $member_data !== [] && $member_data['provide_service'] == 1 ? 'checked = "checked"' : ''; ?> value="1">
 														Third Party
 													</label>
 												</div>
 											</div>
 										</div>
 									</div>
 								</div>
 							</div>
 						</div>
 						<div class="step-btn-wrap">
 							<div class="step-btn-content">

 								<div style="display:flex; align-items: center; justify-content: flex-start; ">
 									<button type="button" class="btn btn-success step-btn step-prev-btn">Prev Step</button>
 								</div>
 								<div style="display:flex; align-items: center; justify-content: flex-end; ">
 									<button type="button" class="btn btn-success step-btn step-next-btn">Next Step</button>
 								</div>
 							</div>
 						</div>
 					</div>
 				</div>
 			</form>
 		</div>
 	</section>
 	<?php
		echo view('templates/footer');
		?>
 	<script type="text/javascript" src="<?php echo base_url('assets/client_assets/js/step.js'); ?>"></script>