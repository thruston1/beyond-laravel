<script>
	// $(document).ready( function () {
    //     $('#table_id').DataTable();
    // } );
</script>

<?php
	// NOMOR TELP
    $filtered1 = 0;
	$filtered2 = 0;
	$filtered3 = 0;
	$filtered4 = 0;
	$filtered5 = 0;	
	$filtered6 = 0;
	$filtered7 = 0;
	$filtered8 = 0;
	$filtered9 = 0;
	$filtered10 = 0;
	$filtered11 = 0;
	$filtered12 = 0;
	$filtered13 = 0;
	$filtered14 = 0;
	$filtered15 = 0;
	$namePhone1=0;
	$namePhone2=0;
	$namePhone3=0;
	$namePhone4=0;
	$namePhone5=0;
	$namePhone6=0;
	$namePhone7=0;
	$namePhone8=0;
	$namePhone9=0;
	$namePhone10=0;
	$namePhone11=0;
	$namePhone12=0;
	$namePhone13=0;
	$namePhone14=0;
	$namePhone15=0;
	$no=1;

	// foreach ($task as $tk) {
	// 	$ph=$tk->fieldName;

	// 	${'filtered'.$no} = preg_replace("/[^0-9]/", "", $customer_detail[0][$ph]);
	// 	${'numbers'.$no} = $customer_detail[0][$ph];
	// 	${'namePhone'.$no}= $ph;

	// 	$no=$no+1; 	

	// }

	$illegal = "@#$%^&*()+=-[]';,./{}|:<>?~";
?>

<div class="dLeft mLeft">
	<div class="hCustDet w-100">
		<label>Validation</label>
	</div>
	
	<?php 
	$home=0;
	$office=0;
	$emergency=0;
	$no=1;
	// foreach ($task as $tk) {
    //     ?>
	<!-- Telpon #1 -->
		
		<?php 
		// if(strlen(${'filtered'.$no}) > 4 ): 
        ?>

		
		<div class="custRows" >
			<div class="lCust full">
				<label class="lCustLabel"> Label No Telp <?php // echo ${'namePhone'.$no}?></label>
			</div>
		</div>
		<div class="custRows">
			<div class="vCust">
				<?php
					// if(strlen(${'filtered'.$no}) < 5 || strpbrk(${'numbers'.$no}, $illegal)): ?>
						{{-- <input type="button" class="buttonPro" value="INVALID NUMBER" disabled="disabled"/> --}}
				{{-- <?php else: ?> --}}
						<input type="hidden" value="<?php // echo(${'numbers'.$no}); ?>" id="numbers<?php // echo $no;?>"/>
						<input type="hidden" value="<?php // echo(${'filtered'.$no}); ?>" id="filtered<?php // echo $no;?>"/>
						<input id="number<?php // echo $no?>" type="button" class="btn buttonPro <?php 
						// $filtered0='';
						// if($no==1){ $no1=0;}else{$no1=1;}
						// if($no==2){ $no2=0;}else{$no2=2;}
						// if($no==3){ $no3=0;}else{$no3=3;}
						// if($no==4){ $no4=0;}else{$no4=4;}
						// if($no==5){ $no5=0;}else{$no5=5;}
						// if($no==6){ $no6=0;}else{$no6=6;}
						// if($no==7){ $no7=0;}else{$no7=7;}
						// if($no==8){ $no8=0;}else{$no8=8;}
						// if($no==9){ $no9=0;}else{$no9=9;}
						// if($no==10){ $no10=0;}else{$no10=10;}
						// if($no==11){ $no11=0;}else{$no11=11;}
						// if($no==12){ $no12=0;}else{$no12=12;}
						// if($no==13){ $no13=0;}else{$no13=13;}
						// if($no==14){ $no14=0;}else{$no14=14;}
						// if($no==15){ $no15=0;}else{$no15=15;}
						// if(
						// strcmp(${'filtered'.$no1},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no2},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no3},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no4},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no5},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no6},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no7},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no8},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no9},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no10},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no11},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no12},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no13},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no14},${'filtered'.$no}) == 0 || 
						// strcmp(${'filtered'.$no15},${'filtered'.$no}) == 0): 
						// ?>
                        pink
                        {{-- <?php else: ?> --}}
                            {{-- orange --}}
                        {{-- <?php endif; ?>"  --}}
                        "
                        {{-- name="<?php echo($customer_detail[0]['agreementNo']); ?>"  --}}
                        value="CALL 1234
                        <?php   // echo(substr(${'filtered'.$no},0,4)); ?>" 
                        readonly="readonly"/>
				{{-- <?php endif; ?> --}}
			</div>

			<div class="vCustSel_validation">
				<select id="state<?php echo $no?>" class="selCustDet margin-from-right" disabled="disabled">

					{{-- <?php foreach($getPhoneStatus as $rows1): ?> --}}
					{{-- <?php if(count($last) < 1): ?> --}}
					<option value="<?php  // echo($rows1->statusCode); ?>" 
                        <?php //  if($rows1->statusCode < 2): ?>selected<?php // endif; ?>>  
                        <?php // echo($rows1->statusDesc); ?>
                        Select Value
                    </option>
					{{-- <?php else: ?> --}}
					{{-- <option value="<?php echo($rows1->statusCode); ?>" <?php foreach($last as $lasts): if(strcmp(preg_replace("/[^0-9]/", "", $lasts['number']), ${'filtered'.$no}) == 0): if($rows1->statusCode == $lasts['state']): ?>selected<?php endif; endif; endforeach;?>><?php echo($rows1->statusDesc); ?></option> --}}
					{{-- <?php foreach($last as $lasts): if(strcmp(preg_replace("/[^0-9]/", "", $lasts['number']), ${'filtered'.$no}) == 0): if($rows1->statusCode == $lasts['state'] and $lasts['state'] > 1): ?><script>$/*().ready*/(function(){ $('#state<?php echo $no?>').prop('disabled',false);$("#state<?php echo $no?>").addClass("selected"); });</script><?php endif; endif; endforeach;?> --}}
					{{-- <?php endif; ?> --}}
					{{-- <?php endforeach; ?> --}}
				</select>
			</div>
		</div>

		{{-- <?php endif; ?> --}}
	{{-- <?php 
		$no=$no+1; 	
	    }
        ?> --}}


	<!-- MIFTAH -->
	<div class="custRows">
		<div class="lCust full">
			<label class="lCustLabel"><!--COMPLAINT AND -->CUSTOMER INFO</label>
		</div>
		<!-- iwan --><div class="vCust">
			<input type="button" class="buttonPro red" id="complaint-cust" value="COMPLAINT"/>
		</div>
		<!-- end -->
		<div class="vCust">
			<input type="button" class="buttonPro yellow" id="update-cust" value="UPDATE INFO"/>
		</div>
	</div>

	<div class="custRows">
		<div class="lCust full head-message">
			<label class="lCustLabel">Call History</label>
		</div>
	</div>

	<div class="custRows">
		<div class="vCust">
			<input type="button" class="buttonPro blue" id="show-history" value="VIEW HISTORY"/>
			<input type="button" class="buttonPro" id="hide-history" value="CLOSE HISTORY"/>
		</div>

		<!-- MIFTAH -->
		<div class="vCust">
			<a href="#" class="buttonPro red" id="customerMessage">
                ADD MESSAGE
            </a>
            <a href="#" class="buttonPro green" id="saveMessage">
                SAVE MESSAGE
            </a>
		</div>

		<div id="CustMessage">
			<input type="text" name="dataCustMessage" id="dataCustMessage" style="width: 90%;margin: 5px; background-color: #d9d9d9;padding: 5px;">
		</div>

	</div>

	<!-- Notes -->
	<div class="custRows">
		<div class="lCust full head-message">
			<label class="lCustLabel">Notes</label>
		</div>
	</div>

	<div class="custRows">
		<div style="padding: 5px;" class="vCust-mid full content-message mb-3">
			<label id="message-rw" class="label-message">
				<b>
                    Notes here
				<?php 
					// foreach($custMessage as $message){
					// 	if(strlen(trim($message->Notes)) > 0){ echo(trim($message->Notes)); } else{ echo("NO NOTES"); }
					// }
				?>
				</b>
			</label>
		</div><
		<div class="vCust">
			<input type="button" class="buttonPro small blue" id="openscript" value="OPEN SCRIPT"/>
		</div>
		<!-- end -->
		<div class="vCust mb-3">
			<input type="button" class="buttonPro yellow" id="show-history-payment" value="HISTORY PAYMENT"/>
		</div>
	</div>

	<div class="hCustDet from-top">
		<label>INFORMATION</label>
	</div>

		<div class="custRows">
			<div class="lCust full">
				<label><b>TASK START TIME : </b> {{ date('Y-m-d H:i:s') }} <?php  // echo($this->session->userdata('timeStart')); ?> </label>

			</div>
		</div>
		<div class="custRows">
			<div class="lCust full d-flex">
				<div class="color-legend single"></div>
				<div class="label-legend">
					<label>SINGLE NUMBER</label>
				</div>
			</div>
		</div>

		<div class="custRows">
			<div class="lCust full d-flex">
				<div class="color-legend same"></div>
				<div class="label-legend">
					<label>SIMILIAR NUMBER</label>
				</div>
			</div>
		</div>

		<div class="custRows">
			<div class="lCust full d-flex">
				<div class="color-legend invalid"></div>
				<div class="label-legend">
					<label>INVALID NUMBER</label>
				</div>
			</div>
		</div>

		<!-- Start update -->
		<?php 
        // $new = true; if($new): 
        ?>
			<?php // $this->view('templates/callScreen/customerNewUpdate'); ?>
			<?php // $this->view('templates/callScreen/customerComplaint'); ?>
		<?php // endif; ?>

		<script type="text/javascript">
			$(document).on('click', '#openscript', function() {
    			var url = "../C_Script/?noKontrak="+btoa($("#AGREEMENT_NO").val())+"&campaign="+btoa($("#namacampaign").val());

    			openwindow(url);
			});

			function openwindow(url){
			    myWindow = window.open(url, "Script", "width=500, height=780,scrollbars=1,left=900px,toolbar=0");
			}

			function closewindow(){
			    myWindow.close();
			}
		</script>
		<!-- End update -->
	</div>
