
<?php if(isset($errorinfo)): ?>
	<?php echo($errorinfo); ?>
<?php endif; ?>

<?php if(isset($completed)): ?>
	<?php echo($completed); ?>
<?php endif; ?>

<div class="complete-info" id="error-info">
	<div class="server-check">
		<label id="_collection-not_found"></label>
	</div>
		
	<div class="timer-release-button">
		<input id="xbox-close" type="button" class="buttonPro red" value="CLOSE"/>
	</div>
</div>

<div class="complete-info" id="complete-info">
	<div class="server-check">
		<label id="_collection-finish"></label>
	</div>
		
	<div class="timer-release-button">
		<input id="ybox-close" type="button" class="buttonPro orange" value="CLOSE"/>
	</div>
</div>

{{-- <?php if(isset($customer_detail)): ?> --}}
	<script src="{{asset('assets/global/js/validation.beyond.js')}}"></script>
	<script src="{{asset('assets/global/js/transactions.beyond.js')}}"></script>
	
<!-- DataTables CSS -->
<link rel="stylesheet" type="text/css" href="{{asset('assets/global/DataTables-1.10.7/media/css/jquery.dataTables.min.css')}}">
<!-- DataTables -->
<script type="text/javascript" charset="utf8" src="{{asset('assets/global/DataTables-1.10.7/media/js/jquery.dataTables.min.js')}}"></script>	
	<div id="account-history-rw" class="account-history">
		<div id="account-history" class="account-history-inner">
			<div class="head-account-history"><label id="_label_related_contract">CALL HISTORY</label><div class="hide-history" id="rw-close-history"></div></div>
				<div class="account-history-content">
					{{-- <?php
					// $this->db->where(array('FIELD_VALUE_TYPE'=>'select_phone_number'));
					// $this->db->or_where(array('FIELD_VALUE_TYPE'=>'textarea'));
					// $kolom=$this->db->order_by('ORDER','asc')->get('tblSetupParameter')->result(); 

					?> --}}
					<!-- START HISTORY -->
					<div id="_wrap_history">
					<table id="tb-show-history">
						<thead>
							<tr>
								<th>ASSIGNMENT DATE</th>
								<th>AGENT NAME</th>
                                {{-- <?php 
								$header1 = $this->db->where('isShowHistory','Ya')->group_by('questCode')->order_by("sort", "asc")->get_where('tblMasterQuestions',array('campaign'=>$this->session->userdata('campaign')))->result();
								foreach ($header1 as $key => $value) { 
                                    ?> --}}
									{{-- <th><?= $value->questDesc ?></th> --}}
								{{-- <?php  } ?> --}}
							</tr>
						</thead>
					</table>
					</div>
					
					<!-- END HISTORY -->
					<!-- START RELATED CONTRACT -->	
					<div id="_wrap_related">
					<table id="tb-show-related">
						{{-- <?php
						// $related =$this->db->order_by('fieldOrder','asc')->get_where('tblSetupMasterTask',array('typeName'=>$this->session->userdata('typeTask')))->result();
						?> --}}
						<thead>
							<tr>
								<?php 
                                // foreach ($related as $tk) {
								?>
								<th><?php  
                                    // echo $tk->fieldName
                                    ?>
                                </th>
								<?php 
                                    // }
                                ?>
							</tr>
						</thead>
					</table>			
					</div>
				</div>
		</div>
	</div>

	<div id="payment-history-rw" class="account-history">
		<div id="payment-history" class="account-history-inner">
			<div class="head-account-history"><label>PAYMENT HISTORY</label><div class="hide-history" id="rw-close-payment-history"></div></div>
				<div class="account-history-content">
					<!-- START HISTORY -->
					<table id="tb-payment-history">
						<thead>
							<tr>
								<th>PAYMENT DATE</th>
								<th>AGREEMENTNO</th>
								<th>CUSTOMER ID</th>
								<th>AMOUNT</th>
								<th>CREATED TIME</th>
							</tr>
						</thead>
					</table>
				</div>
		</div>
	</div>

	<div class="dLeft">
	<?php // echo $this->session->userdata('callBack') ?>
		{{-- <?php if($this->session->userdata('callBack') == 0){ ?>
		
			<?php if($this->session->userdata('counter') <> 0){ ?>
			<div class="hCustDet">
				<label>Customer Info</label><div class="head-image-grey"></div>
			</div>
			<?php } else{ ?>
			<div class="hCustDet">
				<label>Customer Info</label><div class="head-image"></div>
			</div>
			<?php } 
			
		} else{ ?>--}}
		
			<div class="hCustDet w-100">
				<label>Customer Info</label><div class="head-image-callback"></div>
			</div>
		
		{{-- <?php } ?> --}}
		
		<?php //print_r($CUSTOMER_DETAIL->result());?>
		<?php 
            // foreach($customer_info as $info_customer){ 
            ?> 
		<?php 
            // foreach($customer_detail as $detail_customer){ 
            ?>
			
				<div class="custRows border-bottom">
					<div class="lCust">
						<label class="lCustLabel">
                            <?php 
                                // echo($info_customer['DESCRIPTION']); 
                            ?>
                            Description
                        </label>
					</div>
					<div class="vCust">
						<label class="vCustLabel">
						<?php 
                            // if(strlen($detail_customer[$info_customer['PARAMETER']]) < 1):
							
							// 	echo("-"); 
							
							// else: 
							
							// 	echo($detail_customer[$info_customer['PARAMETER']]); 
							
							// endif; 
                            ?>
                            Value Description
						</label>
					</div>
				</div>
			
		<?php 
            // }} 
        ?>
		<div id="customer_hide"></div>
		
		{{-- <input id="UNIQUE_ID" type="hidden" value="{{ $detail_customer['unique_id'] }}"/> --}}
		{{-- <input id="AGREEMENT_NO" type="hidden" value="{{$detail_customer['agreementNo']}}"/> --}}
		{{-- <input id="namacampaign" type="hidden" value="{{$detail_customer['campaign']}}"/> --}}
		{{-- <input id="phones" type="hidden" value="<?php 
            // foreach($last as $numbers){ $numbers = $numbers['number']; echo(trim(",".$numbers)); } 
        ?>"/> --}}
		{{-- <input id="AGENT_NAME" type="hidden" value="{{ $this->session->userdata('fName') }}"/> --}}
		<!-- <input id="RELATED_CONTRACT" type="hidden" value="$detail_customer['RELATED_CONTRACT']"/> -->

		{{-- <?php 
			$whereListRelated= array('paramCategory' => '9', 'paramState'=>'Y' );
			$ListRelated=$this->db->get_where('tblParameter',$whereListRelated)->result();
			foreach ($ListRelated as $list) { 
		?>
			<input id="<?php echo $list->paramValue ?>" type="hidden" value="<?php echo($detail_customer[$list->paramValue]); ?>"/>

		<?php }?> --}}

		{{-- <?php 
			$wheretaskCustID= array('typeName' => $this->session->userdata('typeTask'), 'isCusID'=>'Y' );
			$taskCustID=$this->db->order_by('fieldOrder','asc')->get_where('tblSetupMasterTask',$wheretaskCustID)->result();
			foreach ($taskCustID as $id) { 
		?>
		<input id="Customer_ID" type="hidden" value="<?php echo($detail_customer[$id->fieldName]); ?>"/>
		<?php }?> --}}

<!--set passedinfo -->
		 {{-- <?php
			$wheretaskod= array('typeName' => $this->session->userdata('typeTask'), 'isOverdue'=>'Y' );
			$taskod=$this->db->order_by('fieldOrder','asc')->get_where('tblSetupMasterTask',$wheretaskod)->result();
			foreach ($taskod as $od) {
		?>
			<input id="DAYS_OVERDUE" type="hidden" value="<?php echo($detail_customer[$od->fieldName]); ?>"/> 
		<?php }?>  --}}
		{{-- <?php
			$wheretaskinfo= array('typeName' => $this->session->userdata('typeTask'), 'isCusName'=>'Y' );
			$taskinfo=$this->db->order_by('fieldOrder','asc')->get_where('tblSetupMasterTask',$wheretaskinfo)->result();
			foreach ($taskinfo as $info) {
		?>
		<input id="NAME" type="hidden" value="<?php echo($detail_customer[$info->fieldName]); ?>"/>
		<?php }?> --}}
							
<!--/set passedinfo -->
		<!-- Start new address -->
		{{-- <?php $new = false; if($new): ?>
			<?php $this->view('templates/callScreen/customerNewAddress'); ?>
		<?php endif; ?>	 --}}
		<!-- End new address -->
		
		<div class="custRows _low-height _show-detail _with-border-bottom">
			<div id="show-details" class="lCust full">
				<a href="#" class="lCustLabelDetails" id="a-show-details">SHOW</a>
		
			</div>
		</div>
		
	</div>
    
    @include('website.page.callCenter.customerValidation')
    @include('website.page.callCenter.customerFinalResults')
	<?php  // $this->view('templates/callScreen/customerFinalResults'); ?>

{{-- <?php endif; ?> --}}