<?php 
    $this->load->view("header");
?>   
<style type="text/css">
    a{
        cursor: pointer;
    }
    .Refund td{
        color: blue;
    }
      .request_refund td{
      color: green;
  }
  .upload-file-wrap{
    border: 1px solid #ccc;
    padding: 10px;
    border-radius: 5px;
    margin-bottom: 20px;
    position: relative;
  }
  .upload-file-show{
        display: flex;
        align-items: center;
        justify-content: center;
        flex-flow: column;
        border: 1px dashed #ccc;
        padding: 20px;
  }
  .upload-file{
    position: absolute;
    left: 0px;
    top: 0px;
    width: 100%;
    height: 100%;
    opacity: 0;
  }
  .upload-form{
    border: 1px solid #f1f1f1;
    border-radius: 5px;
    padding: 20px;
    background-color: #fdfdfd;
  }
  .upload-desc{
    line-height: 26px;
    font-size: 16px;
    border: 1px solid #f1f1f1;
    border-radius: 5px;
    margin-bottom: 20px;
    padding: 20px;
  }
</style>
<section id="about">
    <div class="container">
        <div class="row">
            <div class="col-md-3"  style="padding: 0px 10px 0px 0px;">
                <ul class="account-siderbar">
                    <li><a href="<?php echo site_url("/account/dashboard"); ?>"><i class="ion-ios-contact"></i> My Profile</a></li>
                    <li><a href="<?php echo site_url("/account/businessInfo"); ?>"><i class="icon ion-card"></i> Business Info</a></li>
                    <li class="active"><a href="<?php echo site_url("/account/uploadCenter"); ?>"><i class="icon ion-upload"></i> Upload Center</a></li>
                    <li><a href="<?php echo site_url("/account/card_info"); ?>"><i class="icon ion-card"></i> Credit Card Info</a></li>
                    
                    <li><a href="<?php echo site_url("/account/register_product"); ?>"><i class="ion-ios-medkit"></i>  Products</a></li>
                    <li><a href="<?php echo site_url("/account/transaction_history"); ?>"><i class="ion-ios-paper"></i> Transaction History</a></li>
                    <li><a href="<?php echo site_url("/account/withdraw_money"); ?>"><i class="ion-merge"></i> Withdraw Money</a></li>
                    <li class=""><a href="<?php echo site_url("/account/inbox"); ?>"><i class="ion-email"></i> Inbox  <span class="message-count-box" style="display: none;"></span></a></li>
                    
                </ul>
            </div>
            <div class="col-md-9" style="padding: 0px 0px 0px 10px;">
                <div class="account-panel <?php if(session()->get("active_status") == "Inactive") echo "inactive-panel"; ?>">
                    <?php 
                        $member = get_row("member",array("id"=>session()->get("member_id")));
                    ?>
                    <div class="title">
                        Upload Center
                    </div>
                    <p class="upload-desc">
                        Please submit the following documents:<br/>
                        Company Government Registration / ID<br/>
                        Company Incorporation <br/>
                        Company Proof of Address<br/>
                        Company Bank Statements ( 3 months)<br/>
                        Credit Card or Bank Information <br/>
                        Company Rep Identification (passport, Drivers License,(apostille if requesting for virtual terminal))<br/>
                        Company Rep Bank Statements (3 months, (apostille if requesting for virtual terminal))<br/>
                        Company Rep Proof of Address (apostille if requesting for virtual terminal)<br/>
                    </p>
                    <form name="upload_form" action="<?php echo site_url("/account/uploadDoc"); ?>" method="post"  enctype="multipart/form-data" class="upload-form">
                        <div class="form-group">
                            <label>Document Title</label>
                            <input type="text" name="title" class="form-control" required>
                        </div>
                        <div class="upload-file-wrap">
                            <div class="upload-file-show">
                                <div style="color: #007aff; font-size: 60px;"><i class="icon ion-upload"></i></div>
                                <div class="upload-title">
                                    Drop file or Click here to choose file.
                                </div>
                            </div>
                            <input type="file" name="upload_file" class="upload-file" id="upload_file" required>
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-success">Upload</button>
                        </div>
                        
                        <div style="color: #3395ff;font-style: italic;"> * Uploaded files will appear below </div>
                    </form>

                    <div class="row">
                         <div class="col-md-12" style="margin-top: 20px;">
                            <table id="transaction_table" class="display" style="width:100%">
                                <thead>
                                    <tr>
                                        <th style="width:200px;">Upload Date</th>
                                        <th>Title</th>
                                        <th style="width:120px;"></th>
                                    </tr>
                                </thead>
                                <tbody>
                             <?php
                                 $upload_data = get_rows('upload_history',array('member_id'=>session()->get('member_id')));
                                 foreach ($upload_data as $key => $value) {
                                    echo '<tr>';
                                    echo '<td>'.$value['created_at'].'</td>';
                                    echo '<td>'.$value['title'].'</td>';
                                    echo '<td><a href="'.$value['url'].'" target="_blank"><i class="icon ion-eye"></i> View</a> &nbsp;&nbsp;<a style="color:red;" href="'.site_url("/account/delete_upload/".$value['id']).'"><i class="icon ion-trash-a"></i> Remove</a></td>';
                                    echo '</tr>';
                                 }
                             ?>
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <th>Upload Date</th>
                                        <th>Title</th>
                                        <th></th>
                                    </tr>
                                </tfoot>
                            </table>

                         </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section> <!-- /#about -->

 
<?php 
    $this->load->view("footer");
?> 
<script type="text/javascript">
    $.extend( true, $.fn.dataTable.defaults, {
        "searching": true,
        "ordering": false
    } );

    $(function(){
        $("body").on("change",".upload-file", function(){
            console.log($(this).val());
            if($(this).val() == ""){
                $(".upload-title").html("Drop file or Click here to choose file.");
            } else {
                var fileInput = document.getElementById('upload_file');   
                var filename = fileInput.files[0].name;
                $(".upload-title").html(`<div style="text-align: center;margin-bottom: 5px;"><b>${filename}</b> is selected.</div>Drop file or Click here to choose other file.`);
            }
        })
        $('#transaction_table').DataTable({responsive: true});
        $("body").on("click",".customer-details",function(){
            // publish_key = $(this).data("publish_key");
            id = $(this).data("id");
            status = $(this).data("status");
            $("#transaction_id").val(id);
            $.ajax({
                url: "<?php echo site_url("account/get_transaction"); ?>",
                data:{id:id},
                dataType:"html",
                type:"post",
                success: function(res){
                    $("#refund_btn").hide();
                    if(status == "Paid") 
                        $("#refund_btn").show();

                    $("#transaction_modal .modal-body").html(res);
                    $("#transaction_modal").modal();
                }
            })

        })
    })
</script>
            