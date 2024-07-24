var phase_status = 1;
$(function(){
	phase_status = $("#phase_status").val();
	displayPhaseStatus();
	$("body").on('click','.step-prev-btn', function(){
		phase_status --;
		if(phase_status == 0) phase_status = 1;
		displayPhaseStatus();
	})

	$("body").on('click','.step-next-btn', function(){
		if(phase_status != 6){
			$('.step-box[data-stage="'+phase_status+'"]').find('input[type="text"]').each(function(){
				vaildateObj($(this));
			})
			$('.step-box[data-stage="'+phase_status+'"]').find('input[type="number"]').each(function(){
				vaildateObj($(this));
			})
			$('.step-box[data-stage="'+phase_status+'"]').find('input[type="date"]').each(function(){
				vaildateObj($(this));
			})
			$('.step-box[data-stage="'+phase_status+'"]').find('textarea').each(function(){
				vaildateObj($(this));
			})
			if(phase_status == 3){
				if($('input[name="bank_deposit_account"]').val() != $('input[name="bank_deposit_account_confirm"]').val()){
					$('input[name="bank_deposit_account_confirm"]').addClass('require-error');
				}
			}
			if(phase_status == 4){
				if($("input[name='total_pro']").val() != 100){
					$("input[name='total_pro']").addClass('require-error');
				}
				if($("input[name='total_order']").val() != 100){
					$("input[name='total_order']").addClass('require-error');
				}
			}
			if($(".require-error").length > 0){
				return;
			}
		}
		$.ajax({
	    	url: base_url + "profileStep/saveStep",
			type: "post",
			data:  new FormData(document.getElementById('step_form')),
			contentType: false,
		    processData:false,
		    dataType:'json',
			success: function(res){	
				if(res.status == "ok"){
					phase_status ++;
					if(phase_status > 6) {
						document.location.replace(base_url);
						phase_status = 6;
					}
					displayPhaseStatus();
				}
			},
			complete: function(res){
			},
		  	error: function() 
	    	{
	    	} 	        
	   });
	})
	$("body").on('change','#second_owner', function(){
		if($(this).prop('checked')){
			$(".second_owner_wrap").show();
		} else {
			$(".second_owner_wrap").hide();
		}
	})
	$("body").on('change','#owner_us_city', function(){
		if($(this).prop('checked')){
			$(".owner_ssn").eq(0).html("Passport Issuing Country");
			$(".owner_ssn").eq(1).html("Passport expiry date");
		} else {
			$(".owner_ssn").html("SSN");
		}
	})
	$("body").on('change','#owner2_us_city', function(){
		if($(this).prop('checked')){
			$(".owner2_ssn").eq(0).html("Passport Issuing Country");
			$(".owner2_ssn").eq(1).html("Passport expiry date");
		} else {
			$(".owner2_ssn").html("SSN");
		}
	})
	
	$("body").on('focus','.require-error', function(){
		$(this).removeClass("require-error");
	})

	$("body").on('focus','.pro-calc', function(){
		$('.pro-calc').removeClass("require-error");
		$("input[name='total_pro']").removeClass('require-error');
	})
	$("body").on('focus','.order-calc', function(){
		$('.order-calc').removeClass("require-error");
		$("input[name='total_order']").removeClass('require-error');
	})
	$("body").on("click",'.step-active-item', function(){
		phase_status = $(this).data('value');
		displayPhaseStatus();
	})
	$("body").on("change",".pro-calc", function(){
		var total_val = $("input[name='swiped_pro']").val() * 1 + $("input[name='keyed_pro']").val() * 1;
		$("input[name='total_pro']").val(total_val);
	})
	$("body").on("change",".order-calc", function(){
		var total_val = $("input[name='premise_order']").val() * 1 + $("input[name='mail_order']").val() * 1+ $("input[name='phone_order']").val() * 1+ $("input[name='interent_order']").val() * 1;
		$("input[name='total_order']").val(total_val);
	})
})
				
function vaildateObj($this){
	if($this.val() == "") {
		$this.addClass('require-error');
	}
	if(!$("#second_owner").prop('checked') && $this.attr('name').indexOf('owner2') >= 0){
		$this.removeClass('require-error');
	}

	if($this.attr('name').indexOf('email') >= 0 && $this.val() != ""){
		var email = $this.val();
        var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
        if( !emailReg.test(email)) {
			$this.addClass('require-error');
        }
    }
}
function displayPhaseStatus(){
	$("#phase_status").val(phase_status);
	$(".require-error").removeClass("require-error");
	$(".step-active-item").removeClass("step-active-item");
	$(".step-current-item").removeClass("step-current-item");
	for(var i = 0; i < phase_status - 1; i++){
		$('.step-item').eq(i).addClass('step-active-item');
	}
	$('.step-item').eq(phase_status-1).addClass('step-current-item');
	$(".step-box").hide();
	$('.step-box[data-stage="'+phase_status+'"]').fadeIn();
	if(phase_status == 6){
		$(".step-box").show();
		$(".step-next-btn").html("Save");
		$(".setp-stage-title").html('Final Reviews');
	} else {
		$(".step-next-btn").html("Next step");
		$(".setp-stage-title").html($('.step-box[data-stage="'+phase_status+'"]').find(".step-box-title").html());
	}
	$(".setp-stage").html(`Step ${phase_status} - 6`);
	if(phase_status == 1){
		$(".step-prev-btn").hide();
	} else {
		$(".step-prev-btn").show();
	}
}