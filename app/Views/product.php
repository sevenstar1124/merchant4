<?php
echo view('templates/header');
?>
<style type="text/css">
    .required {
        color: red;
    }

    tr {
        cursor: pointer;
    }
</style>
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-3" style="padding: 0px 10px 0px 0px;">
                <?php
                $this->load->view("components/siderbar", array('active' => 'product'));
                ?>
            </div>
            <div class="col-md-9" style="padding: 0px 0px 0px 10px;">
                <div class="account-panel <?php if (session()->get("active_status") == "Inactive") echo "inactive-panel"; ?>">
                    <?php
                    $member = get_row("member", array("id" => session()->get("member_id")));
                    ?>
                    <div class="title">
                        Products
                        <button class="btn btn-success pull-right" id="add_product">+ Create Product</button>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div style="font-size: 20px;">
                                Balance : $<?php echo $member['balance']; ?>USD
                            </div>
                        </div>
                        <div class="col-md-6">
                            <button class="btn btn-success  pull-right quick-checkout-btn">+ Quick Checkout</button>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" style="margin-top: 20px;">
                            <div class="product-section">
                                <table id="transaction_table" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Redirect Url</th>
                                            <th>Price</th>
                                            <th>Publish Key</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $products = get_rows("product", array("user_id" => session()->get("member_id")));
                                        foreach ($products as $key => $product) {
                                            echo "<tr data-id='" . $product['id'] . "'>";
                                            echo '<td>' . $product['id'] . '</td>';
                                            echo '<td>' . $product['title'] . '</td>';
                                            echo '<td>' . $product['description'] . '</td>';
                                            echo '<td>' . $product['redirect_url'] . '</td>';
                                            echo '<td>$' . $product['price'] . '</td>';
                                            echo '<td>' . $product['publish_key'] . '</td>';
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <th>Redirect Url</th>
                                            <th>Price</th>
                                            <th>Publish Key</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="quick-checkout-section hidden">
                                <table id="quick-checkout-table" class="display" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th>Product ID</th>
                                            <th>Price</th>
                                            <th>Title</th>
                                            <th>Description</th>
                                            <!-- <th>Email Receipt</th> -->
                                            <th>Qty</th>
                                            <th>Selct Item</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $products = get_rows("product", array("user_id" => session()->get("member_id")));
                                        foreach ($products as $key => $product) {
                                            $member = get_row("member",array("id"=>$product['user_id']));
                                            $disabled="";
                                            if($member['approve_status']!=2 || $member['status']==0){ 
                                                $disabled="disabled";
                                            }

                                            echo "<tr data-id='" . $product['id'] . "' data-price='" . $product['price'] . "' data-title='" . $product['title'] . "' data-publish-key='" . $product['publish_key'] . "'>";
                                            echo '<td>' . $product['id'] . '</td>';
                                            echo '<td>$' . $product['price'] . '</td>';
                                            echo '<td>' . $product['title'] . '</td>';
                                            echo '<td>' . $product['description'] . '</td>';
                                            // echo '<td><input type="email"/></td>';
                                            echo '<td><input type="number" value="0" min="0"/></td>';
                                            echo '<td><input type="checkbox" ' . $disabled . '/></td>';
                                            echo "</tr>";
                                        }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="quick-checkout-result" style="font-size: 20px; margin-top: 20px;">
                                    <div class="row">
                                        <div class="col-md-6">
                                            Product Details
                                        </div>
                                        <div class="col-md-6">
                                            <button class="btn btn-primary btn-lg pull-right quick-checkout-pay" disabled>Click here to CHECKOUT</button>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="content">No selected product</div>
                                        </div>
                                    </div>
                                    <?php $payment_getway = get_row("paymentgetway", array("id" => 1)); ?>
                                    <input type="hidden" class="checkout-fee" value=<?php echo $payment_getway['checkout_fee'] ?>>
                                </div>
                            </div>
                        </div>
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


<div class="modal fade in" id="product_modal" aria-hidden="false" style="display: none;">
    <div class="modal-dialog" style="width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" aria-hidden="true" data-dismiss="modal">×</button>
                <h3 class="modal-title">Create New Product</h3>
            </div>
            <div class="modal-body" style="padding: 10px 0px;">
                <!--  <img id="featureimage" src=""/> -->
                <form id="create_product" data-parsley-validate class="form-horizontal form-label-left" action="<?php echo site_url("account/update_product"); ?>" method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Title <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="title" id="title" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Price <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="price" id="price" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Redirect Url <span class="required">*</span>
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <input type="text" name="redirect_url" id="redirect_url" required="required" class="form-control col-md-7 col-xs-12">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Description
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <textarea style="width: 100%; resize: none;height: 100px; " name="description" id="description"></textarea>
                        </div>
                    </div>
                    <div class="form-group button_html">
                        <label class="control-label col-md-3 col-sm-3 col-xs-12" for="name">Pay Now Button
                        </label>
                        <div class="col-md-6 col-sm-6 col-xs-12">
                            <code id="button_html">
                            </code>
                        </div>
                    </div>

                    <input type="hidden" name="id" id="id">

                    <div class="form-group">
                        <div class="" style="text-align: center;">
                            <button type="submit" class="btn btn-info" id="submit_btn">Create New Product</button>
                            <button type="button" class="btn btn-warning" id="remove_btn" style=" margin-left: 20px; display: none;">Remove Product</button>

                        </div>
                    </div>

                    <div class="ln_solid"></div>
                </form>
            </div>
            <div class="modal-footer">

            </div>
        </div>
    </div>
</div>


<?php
echo view('templates/footer');
?>
<script type="text/javascript">
    $.extend(true, $.fn.dataTable.defaults, {
        "searching": true,
        "ordering": true
    });
    const display_quick_checkout_content = () => {
        let html = ""
        let product_id;
        let product_price;
        let product_title;
        let product_qty;
        let total_price = 0;

        $('#quick-checkout-table input[type="checkbox"]').each(function() {
            if (this.checked) {
                product_id = $(this).closest("tr").data('id');
                product_price = $(this).closest('tr').data('price');
                product_title = $(this).closest('tr').data('title')
                product_qty = $(this).closest('tr').find('input[type="number"]').val();
                html += `<p style="font-size: 14px; font-weight: 500; margin-top: 10px; margin-bottom: 0px;">
                                        <b>Product ID :</b> ${product_id}
                                    </p>
                                    <p style="font-size: 14px; font-weight: 500; margin-bottom: 0px;">
                                        <b>Title :</b> ${product_title}
                                    </p>

                                    <p style="font-size: 14px; font-weight: 500; margin-bottom: 0px;">
                                        <b>Price :</b> $${product_price}
                                    </p>

                                    <p style="font-size: 14px; font-weight: 500; margin-bottom: 0px;">
                                        <b>Qty :</b> ${product_qty}
                                    </p>

                                    <p style="font-size: 16px; font-weight: 500; margin-bottom: 10px;">
                                        <b>Sub Price :</b> $${Math.round(product_qty * product_price * 10)/10}
                                    </p>`;
                total_price += Math.round(product_qty * product_price * 10) / 10;
            }
        })
        if (total_price > 0) {
            $('.quick-checkout-pay').prop("disabled", false)
            html += `
        <p style="font-size: 16px; font-weight: 500; margin-bottom: 0px;">
                        <b>Fee :</b> $${Math.round(total_price * $('.checkout-fee').val()/10) / 10}
                    </p>
        `
            html += `
                    <p style="font-size: 18px; font-weight: 500; margin-bottom: 0px;">
                        <b>Total Price :</b> $${Math.round(total_price + total_price * Number($('.checkout-fee').val()/100)*10)/10}
                    </p>
                `;
        } else {

            $('.quick-checkout-pay').prop("disabled", true)
            html += `
                    <p style="font-size: 18px; font-weight: 500; margin-bottom: 0px;">
                        <b>Total Price :</b> $0
                    </p>
                `;
        }

        $('.quick-checkout-result .content').html(html)

    }
    $(function() {
        $('#transaction_table').DataTable({
            responsive: true
        });

        $('#quick-checkout-table').DataTable({
            responsive: true
        });

        $("#add_product").click(function() {
            $("#create_product")[0].reset();
            $("#submit_btn").html("Create New Product");
            $("#remove_btn").hide();
            $(".button_html").hide();
            $("#product_modal").modal();
        })
        $("body").on("click", "#remove_btn", function() {
            $(this).closest("form").attr("action", "<?php echo site_url("account/remove_product"); ?>");
            $(this).closest("form").submit();
        })
        $("body").on("click", "#transaction_table tbody tr", function() {
            $("#create_product")[0].reset();
            $("#remove_btn").show();
            var id = $(this).data("id");
            $.ajax({
                url: "<?php echo site_url("account/get_product"); ?>",
                data: {
                    id: id
                },
                dataType: "json",
                type: "post",
                success: function(res) {
                    $("#title").val(res.data.title);
                    $("#price").val(res.data.price);
                    $("#description").val(res.data.description);
                    $("#redirect_url").val(res.data.redirect_url);
                    $("#id").val(res.data.id);
                    $(".button_html").show();
                    // https://merchant.virsympay.com/defaultsite
                    $("#button_html").text('<a href="<?php echo site_url("checkout"); ?>/?publish_key=' + res.data.publish_key + '">Pay Now</a>');
                    // $("#button_html").text('<a href="http://localhost/merchant_virsympay/checkout/?publish_key='+res.data.publish_key+'">Pay Now</a>');

                    $("#submit_btn").html("Update");
                    $("#product_modal").modal();
                }
            })

        })

        $('#quick-checkout-table').on('change', 'input[type="checkbox"]', function() {
            display_quick_checkout_content();
        })

        $('#quick-checkout-table').on('change', 'input[type="number"]', function() {
            display_quick_checkout_content();
        })

        $('.quick-checkout-btn').on('click', function() {
            $('.product-section').toggleClass('hidden');
            $('.quick-checkout-section').toggleClass('hidden');
        })

        $('.quick-checkout-pay').click(function() {
            let total_price = 0;
            let products = [];
            $('#quick-checkout-table input[type="checkbox"]').each(function() {
                if (this.checked) {
                    if ($(this).closest('tr').find("input[type='number']").val() > 0) {
                        products.push({
                            "publish_key": $(this).closest('tr').data('publish-key'),
                            "qty": $(this).closest('tr').find("input[type='number']").val()
                        })
                        total_price += Math.round($(this).closest('tr').find("input[type='number']").val() * $(this).closest('tr').data('price') * 10) / 10;
                    }
                }
            })
            let params = JSON.stringify({products: products});
            window.location.href  = `<?php echo site_url("/checkout"); ?>?params=${params}`;
            
        })
    })
</script>