<div class="row">
    <?php foreach($campaign as $mc):?>
<div class="col-lg-12">
		
		<script src="{{ asset('assets/web/global/js/examples.datatables.dataaplication.js') }}"></script>
		
		<section class="panel">

				<div class="panel-body">
					<?php if(isset($total) && $total>0){ ?>
					<div class="alert alert-success">
						<strong>Success </strong> inserted (<?php echo $total; ?>) rows data today!
					</div>
					<?php } ?>
				<div>
					<h4>{{ $mc->campaignName }}</h4>
				</div>
				
				<div class="progress progress-striped light active m-md">
					<div id="progress-bar" class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">0%</div>
				</div>
				<div class="form-inline">
					<div id="preview-data" class="w-100"></div>
					<!-- <div class="form-group"> -->
                        <div class="row">
                            <div class="col-12 mb-3">
                                <form id="file" class="form-horizontal form-bordered" action="" enctype="multipart/form-data">
                                    <!-- <div class="col-md-5"> -->
                                        <div class="fileupload fileupload-new" data-provides="fileupload">
                                            <div class="input-append">
                                                <div class="uneditable-input">
                                                    <i class="fa fa-file fileupload-exists"></i>
                                                    <span class="fileupload-preview"></span>
                                                </div>
                                                <span class="btn btn-default btn-file mr-3">
                                                    <span class="fileupload-exists">Change</span>
                                                    <span class="fileupload-new">Select file</span>
                                                    <input id="campaign" name="campaign" value=" {{ $mc->campaignName }} "type="hidden" />
                                                    <input id="type_task" name="type_task" value="{{$mc->typeTask}}"type="hidden" />
                                                    <input id="userfile" name="userfile" type="file" />
                                                </span>
                                                <a href="#" class="btn btn-default fileupload-exists" data-dismiss="fileupload">Remove</a>
                                            </div>
                                        </div>
                                    <!-- </div> -->
                                </form>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <button id="upload_task_new" type="button" class="btn btn-success mr-3"><i class="fa fa-cloud-upload"></i> Upload</button>
                                    <a href="{{ route('admin.' . $thisRoute . '.downloadTxt') }}?key={{ $mc->typeTask }}&campaign={{$mc->campaignName}}"><button type="button" class="btn btn-info" ><i class="fa fa-cloud-upload"></i> Download Template</button></a>
                                    <!--<button id="syncptp" type="button" class="btn btn-warning"><i class="fa fa-process"></i>Sync PTP</button>-->
                                    <!-- <button id="distribute_task" type="button" class="btn btn-warning"><i class="fa fa-random"></i> Distribute</button> -->
                                </div>
                            </div>
                        </div>
						
				</div>	

				<br>
				<br>
				
			</div>
		</section>
	</div>	
	<div class="col-lg-12">
		<div class="alert alert-info nomargin d-none">
			<!-- <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button> -->
			<h4>SYNCHRONIZE DATA TASK</h4>
			<small>* Make Sure your task already bucketed and uploaded</small>
			<p>
				<button id="sync_task" class="btn btn-info mt-xs mb-xs" type="button" fdprocessedid="ovimi">Synchronize Data PTP</button>
				<button id="distribute_task_ghz" class="btn btn-success mt-xs mb-xs" type="button" fdprocessedid="ovimi">Distribute Task</button>
			</p>
		</div>
	</div> 
	<div class="col-lg-12">
	<!-- start: page -->
		<section class="panel">
			<header class="panel-heading">
				<div class="panel-actions">
					<a href="#" class="fa fa-caret-down"></a>
					<a href="#" class="fa fa-times"></a>
				</div>

				<h2 class="panel-title">Data Application Result</h2>
			</header>
			<div class="panel-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="data1" >
                        <thead>
                            <tr>
                                <th>campaign_name</th>
								<th>client_code</th>
								<th>customer_name</th>
								<th>gender</th>
								<th>no_telp_1</th>
								<th>no_telp_2</th>
								<th>no_telp_3</th>
								<th>agreement_no</th>
                            </tr>
                        </thead>
                        <tbody>
							@foreach($data as $list)
							<tr>
								<td>{{ $list->campaign_name }}</td>
								<td>{{ $list->client_code }}</td>
								<td>{{ $list->customer_name }}</td>
								<td>{{ $list->gender }}</td>
								<td>{{ $list->no_telp_1 }}</td>
								<td>{{ $list->no_telp_2 }}</td>
								<td>{{ $list->no_telp_3 }}</td>
								<td>{{ $list->agreement_no }}</td>
							</tr>
							@endforeach
                        </tbody>
                    </table>
                </div>
				
			</div>
		</section>
	<!-- end: page -->
	</div>
<script type="text/javascript">

	
	$("#upload_task_new").click(function(){
		if($('#userfile').val().length > 0){
			var data = new FormData($('#file')[0]);
			var xhr, provider;

			xhr = jQuery.ajaxSettings.xhr();			
			
			$.ajax({
                headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
				url: '{{ route('admin.' . $thisRoute . '.importCsv') }}',
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
				success: function(n){
					var percentComplete = '100%';
					$('#progress').removeClass('progress-striped');
					$('#progress-bar').removeClass('progress-bar-warning').addClass('progress-bar-success');
					$('#progress-bar').width(percentComplete);
					$('#progress-bar').html('Show priview...');
					$("#preview-data").fadeIn("slow").html(n).promise().done(function() {
			                            
					})
				}
			});
		}
		
		else{
			var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
			toastr.error('File Not Found');
		}	
	})

	$(document).on('click', '#sync_task', function (e) {
		e.preventDefault();

		$.ajax({	
			type: "POST",
			url: "/c_data_application/sync_task",
			data: {sync : 0},
			cache: false,
			success: function(s){
				var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
				var notice = new PNotify({
					title: 'Notification',
					text: 'SUCCESS_SYNCHRONIZE '+ s + ' ROWS DATA',
					type: 'success',
					addclass: 'stack-bar-top',
					stack: stack_bar_top,
					width: "100%"
				});
			}
		});
	});

	$(document).on('click', '#distribute_task_ghz', function (e) {
		e.preventDefault();

		$.ajax({	
			type: "POST",
			url: "/c_data_application/distribute_task",
			data: {sync : 0},
			cache: false,
			success: function(s){
				var stack_bar_top = {"dir1": "down", "dir2": "right", "push": "top", "spacing1": 0, "spacing2": 0};
				var notice = new PNotify({
					title: 'Notification',
					text: 'Success Distributed Task',
					type: 'success',
					addclass: 'stack-bar-top',
					stack: stack_bar_top,
					width: "100%"
				});
			}
		});
	});

</script>

<?php endforeach;?>
</div>
