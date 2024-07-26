<?php
echo view('templates/header');
?>
<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-md-3" style="padding: 0px 10px 0px 0px;">
				<?php
				echo view("components/siderbar", array('active' => 'api'));
				?>
			</div>
			<div class="col-md-9" style="padding: 0px 0px 0px 10px;">

				<div class="api-panel">
					<div class="api-tools-section">
						<button type="button" class="btn btn-success generateAPI" <?php if ($api_key_live != "") echo 'disabled' ?>>Generate API Key</button>

						<a class="btn btn-primary" target="_blank" href="<?php echo site_url('/api/document') ?>" role="button">API Document</a>
					</div>
					<div class="row" style="margin-top:50px;">
						<div class="col-md-2">
							<label>API Endpoint:</label>
						</div>
						<div class="col-md-10">
							<div style="margin-bottom: 30px;">
								<span class="endpoint live"><?php echo site_url('/api/pay'); ?> </span>
							</div>
						</div>
					</div>
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">API Key</h3>
						</div>
						<div class="panel-body">

							<div class="row">
								<div class="col-md-2">
									<label>Live:</label>
								</div>
								<div class="col-md-10">
									<div style="margin-bottom: 30px;">
										<span class="api_value live <?php if ($api_key_live == '') echo 'hidden';  ?>"><?php echo $api_key_live; ?> </span>
									</div>
								</div>
							</div>
							<div class="row">
								<div class="col-md-2">
									<label>SandBox:</label>
								</div>
								<div class="col-md-10">
									<div style="margin-bottom: 30px;">
										<span class="api_value sand <?php if ($api_key_live == '') echo 'hidden';  ?>"><?php echo $api_key_sand; ?> </span>
									</div>
								</div>
							</div>
						</div>
					</div>

					<!-- <div class="panel panel-success">
                        <div class="panel-heading">
                            <h3 class="panel-title">Sacret Key</h3>
                        </div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-2">
                                    <label>Live:</label>
                                </div>
                                <div class="col-md-10">
                                    <div style="margin-bottom: 30px;">
                                        <span class="sac_value live <?php if ($api_key_live == '') echo 'hidden';  ?>"><?php echo $sacret_key_live; ?> </span>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-2">
                                    <label>SandBox:</label>
                                </div>
                                <div class="col-md-10">
                                    <div style="margin-bottom: 30px;">
                                        <span class="sac_value sand <?php if ($api_key_live == '') echo 'hidden';  ?>"><?php echo $sacret_key_sand; ?> </span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div> -->
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

<script>
	$(document).ready(function() {
		$('.generateAPI').click(function() {
			$.ajax({
				url: "<?php echo base_url("account/generateAPI"); ?>",
				method: 'post',
				dataType: 'json',
				success: function(res) {
					$('.api_value.live').text(res.api_key_live)
					$('.api_value.sand').text(res.api_key_sand)
					$('.sac_value.live').text(res.sacret_key_live)
					$('.sac_value.sand').text(res.sacret_key_sand)
					$('.api_value').removeClass('hidden')
					$('.sac_value').removeClass('hidden')
					$('button.generateAPI').attr('disabled', true)
				}
			})
		})
	})
</script>