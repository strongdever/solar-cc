<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.min.js"></script>

<script type="text/javascript">
	$(document).ready(function() {
		jQuery.validator.addMethod('uniqueUuid', function(value) {
		    var uuidsJson = '<?php echo json_encode( get_carports_uuids() ); ?>';
			var uuids = JSON.parse(uuidsJson);
		    
		    return $.inArray(value, uuids) === -1;
		}, '商品IDが既に存在します。')

		$("form#carportNewModalForm").validate({
		    ignore: ":hidden",
			errorPlacement: function (error, element) {
				if ($(element).parent('.input-inline').length) {
					error.insertAfter($(element).parent('.input-inline'));
	            } else {
					error.insertAfter(element);
				}
			},
		    rules: {
				uuid: {
					required: true,
					uniqueUuid: true,
					maxlength: 255
				},
				company: {
					required: true,
					maxlength: 255
				},
				address: {
					required: true,
					maxlength: 255
				},
				phone: {
					required: true,
					minlength: 10,
					matches: "[0-9\-\(\)\s]+",
				},
				email: {
					required: true,
					email: true,
					maxlength: 255
				},
				manager: {
					required: true,
					maxlength: 255
				},
				contract_type_id: {
					required: true,
				},
				started_at: {
					required: true,
					maxlength: 255
				},
				unit_price: {
					required: true,
					maxlength: 255
				},
				bill_name: {
					required: true,
					maxlength: 255
				},
				bill_zipcode: {
					required: true,
					maxlength: 255
				},
				bill_address1: {
					required: true,
					maxlength: 255
				},
		    },
		    messages: {
				uuid: {
		        	required: "商品IDを入力してください。",
		      	},
				company: {
		        	required: "発電所登録名を入力してください。"
		      	},
			  	address: {
		        	required: "設置場所を入力してください。"
		      	},
			  	phone: {
		        	required: "電話番号を入力してください。",
					minlength: "10文字以上入力してください。",
					matches: "電話番号が無効です。"
		      	},
			  	email: {
		        	required: "メールアドレスを入力してください。",
					email: "メールアドレスが無効です。",
		      	},
			  	manager: {
		        	required: "担当者名を入力してください。"
		      	},
			  	contract_type_id: {
		        	required: "契約形態を選択してください。"
		      	},
			  	started_at: {
		        	required: "開始日を入力してください。"
		      	},
			  	unit_price: {
		        	required: "自家消費分販売電力単価を入力してください。"
		      	},
			  	bill_name: {
		        	required: "請求先名を入力してください。"
		      	},
			  	bill_zipcode: {
		        	required: "請求先郵便番号を入力してください。"
		      	},
			  	bill_address1: {
		        	required: "請求先住所１を入力してください。"
		      	},
		    },
	  	});

	  	$("form#carportUpdateModalForm").validate({
		    ignore: ":hidden",
			errorPlacement: function (error, element) {
				if ($(element).parent('.input-inline').length) {
					error.insertAfter($(element).parent('.input-inline'));
	            } else {
					error.insertAfter(element);
				}
			},
		    rules: {
				uuid: {
					required: true,
					maxlength: 255
				},
				company: {
					required: true,
					maxlength: 255
				},
				address: {
					required: true,
					maxlength: 255
				},
				phone: {
					required: true,
					minlength: 10,
					matches: "[0-9\-\(\)\s]+",
				},
				email: {
					required: true,
					email: true,
					maxlength: 255
				},
				manager: {
					required: true,
					maxlength: 255
				},
				contract_type_id: {
					required: true,
				},
				started_at: {
					required: true,
					maxlength: 255
				},
				unit_price: {
					required: true,
					maxlength: 255
				},
				bill_name: {
					required: true,
					maxlength: 255
				},
				bill_zipcode: {
					required: true,
					maxlength: 255
				},
				bill_address1: {
					required: true,
					maxlength: 255
				},
		    },
		    messages: {
				uuid: {
		        	required: "商品IDを入力してください。",
		      	},
				company: {
		        	required: "発電所登録名を入力してください。"
		      	},
			  	address: {
		        	required: "設置場所を入力してください。"
		      	},
			  	phone: {
		        	required: "電話番号を入力してください。",
					minlength: "10文字以上入力してください。",
					matches: "電話番号が無効です。"
		      	},
			  	email: {
		        	required: "メールアドレスを入力してください。",
					email: "メールアドレスが無効です。",
		      	},
			  	manager: {
		        	required: "担当者名を入力してください。"
		      	},
			  	contract_type_id: {
		        	required: "契約形態を選択してください。"
		      	},
			  	started_at: {
		        	required: "開始日を入力してください。"
		      	},
			  	unit_price: {
		        	required: "自家消費分販売電力単価を入力してください。"
		      	},
			  	bill_name: {
		        	required: "請求先名を入力してください。"
		      	},
			  	bill_zipcode: {
		        	required: "請求先郵便番号を入力してください。"
		      	},
			  	bill_address1: {
		        	required: "請求先住所１を入力してください。"
		      	},
		    },
	  	});

		$(document).on('click', '.caportDetailModalLink', function(e) {
			e.preventDefault();
			$('#carportDetailModal .modal-dialog').empty();
			var carportID = $(this).data('id');
			$.ajaxSetup({
		      	headers: {
		        	'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		      	}
		    });
			$.ajax({
				type:'POST',
				url: "<?php echo e(route('ajax-carport.show')); ?>",
				data: {
					id: carportID,
				},
				success: function (data) {
					$('#carportDetailModal .modal-dialog').html(data);
				},
				error: function (response, status, error) {
					console.log(error);
				},
	        });
			return true;
		});

		$(document).on('click', '.carport-other-fee-add .btn-info', function(e) {
			var formWrapper = $(this).parent('.carport-other-fee-add').prev('.carport-other-fee-wrapper');
			if( formWrapper.find('input[name="fee_name[]"]').val() != "" ) {
				var newRowHTML = `
					<div class="form-row fee-item-row mb-0">
	                    <div class="form-col fee-name-col mb-24 mb-sp-20">
	                        <div class="input-group">
	                            <label for="fee_name" class="label"><?php echo e(__('品名')); ?></label>
	                            <div class="input-inline">
	                                <input type="text" class="form-control sdd" name="fee_name[]">
	                            </div>
	                        </div>
	                    </div>
						<div class="form-col fee-unit-col mb-24 mb-sp-20">
	                        <div class="input-group">
	                            <label for="fee_unit" class="label"><?php echo e(__('単位')); ?></label>
	                            <div class="input-inline">
	                                <input type="text" class="form-control ss" name="fee_unit[]">
	                            </div>
	                        </div>
	                    </div>
	                    <div class="form-col fee-value-col mb-24 mb-sp-20">
	                        <div class="input-group">
	                            <label for="fee_value" class="label"><?php echo e(__('単価')); ?></label>
	                            <div class="input-inline">
	                                <input type="number" class="form-control ss" name="fee_value[]">
	                                <span class="text">円</span>
	                            </div>
	                        </div>
	                    </div>
	                </div>`;
				$(formWrapper).append(newRowHTML);
			}
		});
	});
</script><?php /**PATH E:\xampp\htdocs\solar-cc\resources\views/scripts/save-modal-carport-script.blade.php ENDPATH**/ ?>