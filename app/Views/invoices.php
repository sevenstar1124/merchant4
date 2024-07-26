<?php
echo view('templates/header');
?>

<section id="about">
	<div class="container">
		<div class="row">
			<div class="col-md-3" style="padding: 0px 10px 0px 0px;">
				<?php
				echo view("components/siderbar", array('active' => 'invoices'));
				?>
			</div>
			<div class="col-md-9" style="padding: 0px 0px 0px 10px;">
				<div class="api-panel">
					<div class="panel panel-success">
						<div class="panel-heading">
							<h3 class="panel-title">Invoices</h3>
						</div>
						<div class="panel-body">
							<button class="btn btn-success pull-right" data-toggle="modal" data-target="#createInvoiceModal">+Create a Invoice</button>
							<div class="invoice-table-section row">
								<div class="col-md-12" style="margin-top: 10px;">
									<table id="invoice-table" class="display">
										<thead>
											<tr>
												<th>Date</th>
												<th>Receipt Email</th>
												<th>Description</th>
												<th>Status</th>
												<th>Price</th>
												<th></th>
												<th>Reminder</th>
											</tr>
										</thead>
										<tbody>
											<?php foreach ($invoices as $invoice) {
												$reminder = "";
												if ($invoice['status'] == "paid") {
													$status = '
                                                    <div>
                                                        <div>
                                                            <span class="label label-success">PAID</span>
                                                        </div>
                                                        <div>
                                                            <span>' . $invoice['paid_at'] . '</span>
                                                        </div>

                                                    </div>';
												} else {
													$now_3 = strtotime("-3 day");
													if ($now_3 > strtotime(date($invoice['created_at']))) {
														$status = '<span class="label label-danger">Not Paid</span>';
														if (is_null($invoice['reminder_date'])) {
															$reminder = "<button data-id='" . $invoice['id'] . "' class='btn btn-sm reminder-btn  btn-warning'>Reminder</button>";
														} else {
															if ($now_3 > strtotime(date($invoice['reminder_date']))) {
																$reminder = "<button data-id='" . $invoice['id'] . "' class='btn btn-warning btn-sm reminder-btn'>Reminder</button>";
															} else {
																$reminder = "";
															}
														}
													} else
														$status = '<span class="label label-warning">SENT</span>';
												}
												echo '<tr>';
												echo '<td>' . $invoice['created_at'] . '</td>';
												echo '<td>' . $invoice['email'] . '</td>';
												echo '<td>' . $invoice['comment'] . '</td>';
												echo '<td> ' . $status . ' </td>';
												echo '<td> $' . $invoice['price'] . '</td>';
												echo '<td>
                                                        <div class="btn-group">
                                                            <i class="ion-android-more-vertical dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" style="cursor:pointer;"></i>
                                                            <ul class="dropdown-menu">
                                                                <li><a href="' . site_url("/account/invoice/" . $invoice['id']) . '" target="_blank">View Details</a></li>
                                                                <li><a href="#" class="delete-invoice-modal" data-invoice_id="' . $invoice['id'] . '">Delete</a></li>
                                                            </ul>
                                                        </div>
                                                    </td>';
												echo '<td>' . $reminder . '</td>';
												echo '</tr>';
											} ?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</div>
	<?php
	$products = get_rows("product", array("user_id" => session()->get("member_id")));
	?>
	<div class="modal fade" id="createInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLongTitle">Create Invoice</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<form>
						<div class="form-group email-section">
							<label class="col-form-label">Recipient Email</label>
							<input type="email" class="form-control email" placeholder="Email">
						</div>
						<div class="form-row">
							<div class="form-group col-md-8" style="padding-left: 0px; margin-bottom: 0px;">
								<label class="col-form-label">Product</label>
							</div>
							<div class="form-group col-md-4" style="padding-right: 0px;margin-bottom: 0px;">
								<label class="col-form-label">Count</label>
							</div>
						</div>

						<div class="product-items">
						</div>
						<div class="form-action">
							<p class="add-product">+Add product</p>
						</div>
						<div class="form-row">
							<div class="form-group">
								<textarea class="form-control invouce-comment" placeholder="Comment"></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group col-md-12">
								<p class="total-price pull-right" style="font-size: 13px; font-weight: 500;">Price : $0</p>
							</div>
						</div>
					</form>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary save-btn">Create</button>
				</div>
			</div>
		</div>
	</div>
	<div class="modal fade" id="deleteInvoiceModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h4 class="modal-title" id="exampleModalLongTitle">Delete Invoice</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
					<p style="font-size: 20px; font-weight: 500;">Are you sure to delete the invoice?</p>
					<p style="font-size: 18px;font-weight: 400;">You might be loss the invoice forever.</p>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary delete-btn">Delete</button>
				</div>
			</div>
		</div>
	</div>
	<form id="invoice-create-form" action="<?php echo site_url('/account/invoice_create') ?>" method="post" class="hidden"></form>
	<form id="invoice-reminder-form" action="<?php echo site_url('/account/invoice_reminder') ?>" method="post" class="hidden"></form>
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

<style>
	.modal-header {
		display: flex;
		justify-content: space-between;
	}
</style>

<script>
	let products = `<?php echo json_encode($products); ?>`;
	let product_select_html = `<select class="form-control"><option value="">Select Product</option>`
	JSON.parse(products).map(product => {
		product_select_html += `<option data-price="${product.price}" value="${product.publish_key}">${product.title}</option>`

	})
	product_select_html += `</select>`

	const validateEmail = (email) => {
		return String(email)
			.toLowerCase()
			.match(
				/^(([^<>()[\]\\.,;:\s@"]+(\.[^<>()[\]\\.,;:\s@"]+)*)|(".+"))@((\[[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\])|(([a-zA-Z\-0-9]+\.)+[a-zA-Z]{2,}))$/
			);
	};
	const validateEmailSection = () => {
		const email = $('.email').val()
		let res = true
		if (!validateEmail(email)) {
			res = false
			$('.email-section').addClass('has-error')
			$('.email-section').append(`    
                <span class="help-block">Invalid Email</span>
            `)
		}
		return res
	}

	const validateProductSection = () => {
		let res = true
		$('.product-items .product-item select').each(function() {
			if ($(this).val() == "") {
				res = false
				$(this).closest('.form-group').addClass('has-error')
				$(this).closest('.form-group').append('<span class="help-block">Please select a product</span>')
			}
		})
		return res;
	}

	const update_price = () => {
		let total_price = 0;
		$('.product-items .product-item select').each(function() {
			if ($(this).val() == "") return
			let price = $('option:selected', this).data("price");
			let qty = $(this).closest('.product-item').find('.qty').val()
			total_price += price * qty
		})

		$('.total-price').html(`Price: $${total_price}`)
	}

	$(document).ready(function() {
		var deleted_invoice_id;
		$('.delete-btn').click(function() {
			$.ajax({
				type: "delete",
				url: "<?php echo site_url('account/delete_invoice'); ?>",
				dataType: 'json',
				data: {
					id: deleted_invoice_id
				},
				success: function() {
					window.location.reload(true);
				}
			})
		})
		$('.delete-invoice-modal').click(function(e) {
			e.preventDefault();
			deleted_invoice_id = $(this).data('invoice_id');
			$('#deleteInvoiceModal').modal('show');
		})
		$('.product-items').on('change', '.product-item select', function() {
			update_price()
		})

		$('.product-items').on('change', '.product-item .qty', function() {
			update_price()
		})

		$('#createInvoiceModal').on('show.bs.modal', function(e) {
			$(".email").val("");
			$('.total-price').html('Price : $0')
			$('.product-items').html(`
                <div class="product-item row">
                    <div class="form-group col-md-8">
                        ${product_select_html}
                    </div>
                    <div class="form-group col-md-4">
                        <div style="display: flex; align-items: center;">
                            <input type="number" class="form-control qty" value="1" min="1">
                            <span class="delete-product-action hidden">&times;</span>
                        </div>
                    </div>
                </div>
            `)
		})

		$('.save-btn').click(function() {
			$('.form-group').removeClass('has-error')
			$('.help-block').remove()
			const checkEmail = validateEmailSection()
			const checkProduct = validateProductSection()
			if (!checkEmail || !checkProduct) return false
			let data = [];
			$('.product-items .product-item select').each(function() {
				data.push({
					publish_key: $(this).val(),
					qty: Number($(this).closest('.product-item').find('.qty').val())
				})
			})

			$('#createInvoiceModal').modal('hide');


			$("#invoice-create-form").append(
				`
                    <input type="hidden" name="email" value="${$('.email').val()}">
                    <input type="hidden" name="products" value='${JSON.stringify(data)}'>
                    <input type="hidden" name="comment" value='${$('.invouce-comment').val()}'>

                `
			);
			$("#invoice-create-form").submit();

			// $.ajax({
			//     url: '<?php echo base_url('account/invoice_create') ?>',
			//     type: "post",
			//     dataType: 'json',
			//     data: {
			//         email: $('.email').val(),
			//         products: data,
			//         comment: $('.invouce-comment').val()
			//     },
			//     success: function(res) {
			//         window.location.reload(true);
			//     }
			// })
		})
		$('.form-action').on('click', '.add-product', function() {
			$('.product-items').append(`
                <div class="product-item row">
                    <div class="form-group col-md-8">
                        ${product_select_html}
                    </div>
                    <div class="form-group col-md-4">
                        <div style="display: flex; align-items: center;">
                            <input type="number" class="form-control qty" value="1" min="1">
                            <span class="delete-product-action">&times;</span>
                        </div>
                    </div>
                </div>
            `)
			$('.delete-product-action').removeClass('hidden');
		})

		$('.product-items').on('click', '.delete-product-action', function() {
			$(this).closest('.product-item').remove();
			if ($('.product-items .product-item').length == 1) {
				$('.delete-product-action').addClass('hidden');
			}
			update_price()
		})

		$('#invoice-table').dataTable({
			responsive: true
		})

		$('.reminder-btn').click(function() {
			$("#invoice-reminder-form").append(
				`
                    <input type="hidden" name="id" value="${$(this).data('id')}">
                `
			);
			$("#invoice-reminder-form").submit()
		})


		// $('#recipient-email').inputTags({
		//     autocomplete: {
		//         values: []
		//     },
		//     max: 0,
		//     errors: {
		//         empty: 'Attention, you cannot add an empty tag.',
		//         minLength: 'Attention, your tag must have at least %s characters.',
		//         maxLength: 'Attention, your tag must not exceed %s characters.',
		//         max: 'Warning, the number of tags must not exceed %s.',
		//         exists: 'Warning, this tag already exists!',
		//         autocomplete_only: 'Warning, you must select a value from the list.',
		//         timeout: 8000
		//     },
		//     create: function(evt) {
		//         return false;
		//     },
		// });
	})
</script>