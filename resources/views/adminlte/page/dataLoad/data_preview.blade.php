				<?php
					$jumlah_header=count($header);
					$jumlah_data=count($header_data);
					$jumlah_data=count($data_data);
					
				?>
				<section  class="panel">
					<div class="alert alert-info">
						<button aria-hidden="true" data-dismiss="alert" id="close-preview"class="close" type="button">×</button>
						<center>
							<p><b>Preview</b></p>
						</center>
						<?php if($jumlah_header>$jumlah_data||$jumlah_header>$jumlah_data):?>
						<div class="alert alert-danger">
							<p>Warning: Column no match !</p>
						</div>
						<?php else:?>
						<div class="alert alert-success">
							<p>Please check again column match !</p>
						</div>
						<?php endif;?>
						<div class="table-responsive">
						<table class="table table-bordered table-striped table-responsive"data-url="assets/ajax/ajax-datatables-sample.json">
							<thead>
								<tr>
									<?php for($h=0;$h < $jumlah_header; $h++){?>
										<?php if($h<$jumlah_data&&$h<$jumlah_data):?>
											<th><?php echo $header[$h];?></th>
										<?php else:?>
											<th style="background-color:#ff7a7a"><?php echo $header[$h];?></th>
										<?php endif;?>
									<?php }?>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?php 
									for($h=0;$h < $jumlah_header; $h++){
										if($h<$jumlah_data):?>
									<td><?php echo $header_data[$h];?></td>
								        <?php else:?>	
									<td style="background-color:#f2dede"></td>
									<?php endif;
									}?>
								</tr>
								<tr  style="background-color: #f9f9f9">
									<?php 
									for($h=0;$h < $jumlah_header; $h++){
										if($h<$jumlah_data):?>
									<td><?php echo $data_data[$h];?></td>
								        <?php else:?>	
									<td style="background-color:#f2dede"></td>
									<?php endif;
									}?>
								</tr>
							</tbody>
						</table>
						</div>
						<center>
							<?php if($jumlah_header<=$jumlah_data&&$jumlah_header<=$jumlah_data):?>
							<button id="upload_task_new_next" type="button" class="btn btn-success"><i class="fa fa-cloud-upload"></i>Next Upload</button>
							<?php endif;?>
						</center>
					</div>
				</section>
				<script type="text/javascript">
					$("#upload_task_new_next").click(function(){
						if($('#userfile').val().length > 0){
							var data = new FormData($('#file')[0]);
							var xhr, provider;

							xhr = jQuery.ajaxSettings.xhr();			
							$("#upload_task_new_next").hide();
							$.ajax({
								headers: {
									'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
								},
								url: '/c_data_application/importcsvnext',
								data: data,
								cache: false,
								contentType: false,
								processData: false,
								type: 'POST',
								beforeSend: function() {
									var percentComplete = '100%';
									$('#progress').addClass('progress-striped');
									$('#progress-bar').removeClass('progress-bar-info').addClass('progress-bar-warning');
									$('#progress-bar').width(percentComplete);
									$('#progress-bar').html('Processing...');
								},
								success: function(t){
									var percentComplete = '100%';
										$('#progress').removeClass('progress-striped');
										$('#progress-bar').removeClass('progress-bar-warning').addClass('progress-bar-success');
										$('#progress-bar').width(percentComplete);
										$('#progress-bar').html('Uploaded');

										var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
										var notice = new PNotify({
											title: 'Notification',
											text: 'SUCCESS_UPLOAD '+ t + ' ROWS DATA',
											type: 'success',
											addclass: 'stack-bar-top',
											stack: stack_bar_top,
											width: "100%"
										});
									$("#preview-data").fadeIn("slow").html('').promise().done(function() {
									
									});	
									$("#upload_task_new_next").hide();
									// if(t > 0){
									// 	$('#application_data').dataTable( {
									// 			"bDestroy": true,
									// 			"ajax": {    
									// 				"url": "/c_data_application/ajax_data",    
									// 				"type": "POST",
									// 				"data": {
									// 			}
													
									// 		}		
									// 	});
									// }
								}
							});
						}
						
						else{
							var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
							var notice = new PNotify({
								title: 'Notification',
								text: 'INPUT_ERROR_OR_EMPTY_FIELD',
								type: 'error',
								addclass: 'stack-bar-top',
								stack: stack_bar_top,
								width: "100%"
							});
						}	
					})
				</script>