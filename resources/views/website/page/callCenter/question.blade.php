<?php $question_first=$this->db->limit(1)->group_by('questCode')->order_by('sort','ASC')->get_where('tblMasterQuestions',array('state' => 'Y', 'campaign'=> $this->session->userdata('campaign')))->result();?>
<!-- <?php var_dump($question_first)?> -->
<?php foreach($question_first as $qf):
    // var_dump($qf);
    ?>
    <?php if($qf->remarkType=='PHONELIST'):?>
            <div class="module-row">
                
                    <div class="lCust full">
                        <label class="lCustLabel1" style="line-height:28px" ><?php echo $qf->questDesc?></label>
                    </div>
            </div>
            <div class="vCustSel full">
                <!-- <textarea id="Remark<?php echo $qf->questCode?>" class="vAmount"></textarea> -->
                <select id="Remark<?php echo $qf->questCode?>" class="vAmount">
                            <?php
                            $val=1;
                            $task1=$this->db->order_by('fieldOrder','ASC')->get_where('tblSetupMasterTask',array('isPhone'=>"Y",'typeName'=> $this->session->userdata('typeTask') ))->result();
                            foreach ($task1 as $ta):?>
                            <?php if(strlen(preg_replace("/[^0-9]/", "", $customer_detail[0][$ta->fieldName])) > 5 ): ?>
                                <option value="<?php echo $customer_detail[0][ $ta->fieldName]?>"><?php echo $ta->fieldName?></option>
                            <?php endif;?>
                            <?php $val=$val+1; 
                            endforeach;?>
                    </select>
            </div>
            <script type="text/javascript">
                
                        var n = "remark=" + "PHONELIST"  + "&next=" + "<?php echo $qf->nextQuest ?>";
                        $.ajax({
                            type: "POST",
                            url: "/doAjax/getQuestions",
                            data: n,
                            cache: false,
                            success: function(n) {
                                <?php if($qf->nextQuest=="END"):?>
                                    $("#final").show();
                                    $("#vResult").prop("disabled", false);
                                    $("#vResult").addClass("selected");
                                    $( '#resultSave' ).css({ 'display': 'block' });	
                                <?php else:?>
                                $("#Result_Parameter<?php echo $qf->nextQuest?>").fadeIn("slow").html(n).promise().done(function() {
                                    
                                })
                                <?php endif;?>
                            }
                        });
                   
                </script>
    <?php endif;?>
    <?php if($qf->remarkType=='TEXTAREA'):?>
            <div class="module-row">
                
                    <div class="lCust full">
                        <label class="lCustLabel1" style="line-height:28px" ><?php echo $qf->questDesc?></label>
                    </div>
            </div>
            <div class="vCustSel full">
                <textarea id="Remark<?php echo $qf->questCode?>" class="vAmount"></textarea>
            </div>
            <script type="text/javascript">
                
                        var n = "remark=" + "TEXTAREA"  + "&next=" + "<?php echo $qf->nextQuest ?>";
                        $.ajax({
                            type: "POST",
                            url: "/doAjax/getQuestions",
                            data: n,
                            cache: false,
                            success: function(n) {
                                <?php if($qf->nextQuest=="END"):?>
                                    $("#final").show();
                                    $("#vResult").prop("disabled", false);
                                    $("#vResult").addClass("selected");
                                    $( '#resultSave' ).css({ 'display': 'block' });	
                                <?php else:?>
                                $("#Result_Parameter<?php echo $qf->nextQuest?>").fadeIn("slow").html(n).promise().done(function() {
                                    
                                })
                                <?php endif;?>
                            }
                        });
                   
                </script>
    <?php endif;?>
    <?php if($qf->remarkType=='FREETEXT'):?>
            <div class="module-row">
                
                    <div class="lCust full">
                        <label class="lCustLabel1" style="line-height:28px"><?php echo $qf->questDesc?></label>
                    </div>
            </div>
            <div class="vCustSel full">	
                <input id="Remark<?php echo $qf->questCode?>" class="vAmount">
            </div>
            <script type="text/javascript">
                
                        var n = "remark=" + "FREETEXT"  + "&next=" + "<?php echo $qf->nextQuest ?>";
                        $.ajax({
                            type: "POST",
                            url: "/doAjax/getQuestions",
                            data: n,
                            cache: false,
                            success: function(n) {
                                <?php if($qf->nextQuest=="END"):?>
                                    $("#final").show();
                                    $("#vResult").prop("disabled", false);
                                    $("#vResult").addClass("selected");
                                    $( '#resultSave' ).css({ 'display': 'block' });	
                                <?php else:?>
                                $("#Result_Parameter<?php echo $qf->nextQuest?>").fadeIn("slow").html(n).promise().done(function() {
                                    
                                })
                                <?php endif;?>
                            }
                        });
                   
                </script>
    <?php endif;?>
    <?php if($qf->remarkType=='DATE'):?>
            
            
                <div class="module-row">
                    <div class="lCust full">
                        <label class="lCustLabel1" style="line-height:28px"><?php echo $qf->questDesc?></label>
                    </div>
                </div>
                <div class="vCustSel full">
                        <input id="Remark<?php echo $qf->questCode?>" type="text" class="vDatePick date" readonly="readonly" />
                </div>
                <script type="text/javascript">
                
                    $(".date").datepicker(
                       {dateFormat: "yy-mm-dd"}
                    );
                
                </script>
                <script type="text/javascript">
                
                        var n = "remark=" + "DATE"  + "&next=" + "<?php echo $qf->nextQuest ?>";
                        $.ajax({
                            type: "POST",
                            url: "/doAjax/getQuestions",
                            data: n,
                            cache: false,
                            success: function(n) {
                                <?php if($qf->nextQuest=="END"):?>
                                    $("#final").show();
                                    $("#vResult").prop("disabled", false);
                                    $("#vResult").addClass("selected");
                                    $( '#resultSave' ).css({ 'display': 'block' });	
                                <?php else:?>
                                $("#Result_Parameter<?php echo $qf->nextQuest?>").fadeIn("slow").html(n).promise().done(function() {
                                    
                                })
                                <?php endif;?>
                            }
                        });
                   
                </script>
    <?php endif;?>
    <?php if($qf->remarkType=='TIME'):?>
            
            
            <div class="module-row">
                    <div class="lCust full">
                        <label class="lCustLabel1" style="line-height:28px"><?php echo $qf->questDesc?></label>
                    </div>
            </div>
            
            <div class="vCustSel full">
                <input readonly="readonly" class="vDatePick time" type="text" id="Remark<?php echo $qf->questCode?>" value="" />

            </div>
            <script type="text/javascript">
            $(function(){
                $('.time').timepicker({
                    timeFormat: 'HH:mm',
                    addSliderAccess: true,
                    sliderAccessArgs: { touchonly: false }
                });
            });
        </script>
            <script type="text/javascript">
                
                        var n = "remark=" + "TIME"  + "&next=" + "<?php echo $qf->nextQuest ?>";
                        $.ajax({
                            type: "POST",
                            url: "/doAjax/getQuestions",
                            data: n,
                            cache: false,
                            success: function(n) {
                            
                                <?php if($qf->nextQuest=="END"):?>
                                    $("#final").show();
                                    $("#vResult").prop("disabled", false);
                                    $("#vResult").addClass("selected");
                                    $( '#resultSave' ).css({ 'display': 'block' });	
                                <?php else:?>
                                $("#Result_Parameter<?php echo $qf->nextQuest?>").fadeIn("slow").html(n).promise().done(function() {
                                    
                                })
                                <?php endif;?>
                            }
                        });
                   
                </script>
    <?php endif;?>
    <?php if($qf->remarkType=='LOV'):?>
        <div class="module-row" id="vComment">
            <div class="lCust full">
                <label class="lCustLabel1" style="line-height:28px"><?php echo $qf->questDesc?></label>
            </div>
        </div>
            <div class="vCustSelComment full">
                <?php $question_list=$this->db->order_by('id','ASC')->get_where('tblMasterQuestions',array('state' => 'Y','questCode' => $qf->questCode,'campaign'=> $this->session->userdata('campaign')))->result();?>

                <select id="Remark<?php echo $qf->questCode?>" class="vAmount">
                    <option value="0" selected>_<?php echo $qf->questDesc?>_</option>
                    <?php foreach($question_list as $ql): ?>
                    <option value="<?php echo($ql->answerDesc);?>::<?php echo($ql->nextQuest); ?>::<?php echo($ql->nade1); ?>::<?php echo($ql->nade2); ?>"><?php echo($ql->answerDesc);?></option>
                    <?php endforeach; ?>
                </select>
            </div>
        <script type="text/javascript">
            
            $("#Remark<?php echo $qf->questCode?>").change(function() {
                var t = $(this).find("option:selected").val().split("::");
                var n = "remark=" + t[0]  + "&next=" + t[1]+ "&no=" + t[3];

                var r = confirm("Apakah anda yakin? Answer = "+ t[0] + " ?");
                if (r == true && t[0]!= '0') {
                    $.ajax({
                        type: "POST",
                        url: "/doAjax/getQuestions",
                        data: n,
                        cache: false,
                        success: function(n) {
                            if(t[1]=="END"){
                                        $("#final").show();
                                        $("#vResult").prop("disabled", false);
                                        $("#vResult").addClass("selected");
                                        $( '#resultSave' ).css({ 'display': 'block' });	
                                    }else{
                                        $("#Result_Parameter"+t[1]).fadeIn("slow").html(n).promise().done(function() {
                                            
                                        });
                                        $("#Remark<?php echo $qf->questCode?>").prop( "disabled", true );
                            }
                        }
                    })
                }
            });
        </script>
    <?php endif;?>
<?php endforeach;?>
<?php $question_all=$this->db->order_by('sort','ASC')->group_by('questCode')->get_where('tblMasterQuestions',array('state' => 'Y','campaign'=> $this->session->userdata('campaign')))->result();?>
    <?php foreach($question_all as $all): ?>
        <div id="Result_Parameter<?php echo $all->questCode;?>" style="border-bottom: 1px solid #eee2"></div>
    <?php endforeach; ?>
    <div class="module-row">
        <div class="module-column-single">
            <input type="hidden" id="testParam">
        </div>
    </div>
<div class="module-row body-action-code ">
        <div class="module-column-single">
            <!--<select id="vResult" disabled="disabled">-->
            <?php
                $cek_code_parameter=$this->db->get_where('tblConfigParam',array('paramCode'=>'parameter', 'campaign'=>$this->session->userdata('campaign')));
                $code_param="";
                foreach ($cek_code_parameter->result() as $ccp) {
                    $code_param=$ccp->paramValue;
                }
            ?>
            <input id="vResult" type="hidden" />
            <script type="text/javascript">
                $('#Remark<?php echo($code_param)?>').change(function(){
                    var z = $(this).find("option:selected").val().split("::");
                    
                    $('#vResult').val(z[0]);
                });
            </script>
        </div>
</div>
<div class="module-row body-action-code ">
        <div class="module-column-single">
            <!--<select id="vResult" disabled="disabled">-->
            <?php
                $cek_code_sp=$this->db->get_where('tblConfigParam',array('paramCode'=>'questionssuccessphone', 'campaign'=>$this->session->userdata('campaign')));
                $code_param_sp="";
                foreach ($cek_code_sp->result() as $ccs) {
                    $code_param_sp=$ccs->paramValue;
                }
            ?>
            <input id="vSuccessPhone" type="hidden" />
            <script type="text/javascript">
                
                var n = $('#Remark<?php echo($code_param_sp)?>').val();
                    
                $('#vSuccessPhone').val(n);
                    
                $('#Remark<?php echo($code_param_sp)?>').change(function(){
                    var z = $(this).find("option:selected").val();
                     $('#vSuccessPhone').val(z);
                });
            </script>
        </div>
</div>
<div class="module-row body-action-code ">
        <div class="module-column-single">
            <!--<select id="vResult" disabled="disabled">-->
            <?php
                $cek_code_p=$this->db->get_where('tblConfigParam',array('paramCode'=>'questionspromise', 'campaign'=>$this->session->userdata('campaign')));
                $code_param_p="";
                foreach ($cek_code_p->result() as $ccpp) {
                    $code_param_p=$ccpp->paramValue;
                }
            ?>
            <input id="vPtpDate" type="hidden" />
            <script type="text/javascript">
                
                var m = $('#Remark<?php echo($code_param_p)?>').val();
                    
                $('#vPtpDate').val(m);
                    
                $('#Remark<?php echo($code_param_p)?>').change(function(){
                    var m = $('#Remark<?php echo($code_param_p)?>').val();
                    
                    $('#vPtpDate').val(m);
                });
            </script>
        </div>
</div>
<div class="module-row body-action-code ">
        <div class="module-column-single">
            <!--<select id="vResult" disabled="disabled">-->
            <?php
                $cek_code_cb=$this->db->get_where('tblConfigParam',array('paramCode'=>'questionscallback', 'campaign'=>$this->session->userdata('campaign')));
                $code_param_cb="";
                foreach ($cek_code_cb->result() as $ccb) {
                    $code_param_cb=$ccb->paramValue;
                }
            ?>
            <input id="vCallback" type="hidden" />
            <script type="text/javascript">
                
                var o = $('#Remark<?php echo($code_param_p)?>').val();
                    
                $('#vCallback').val(o);
                    
                $('#Remark<?php echo($code_param_cb)?>').change(function(){
                    var o = $('#Remark<?php echo($code_param_cb)?>').val();
                    
                    $('#vPtpDate').val(o);
                });
            </script>
        </div>
</div>
    <div id="resultSave" class="custRows" style="display:none;padding-left: 8px;">
        <div class="vCustSelComment full">
            <input id="saveResult" type="button" class="buttonPro green small" value="SAVE RESULT"/>

        </div>
    </div>	
</div>

<?php $question_all=$this->db->group_by('questCode')->order_by('sort','ASC')->get_where('tblMasterQuestions',array('state' => 'Y','campaign'=>$this->session->userdata('campaign')))->result();?>
                                    <?php 
                                    $resultcode='';
                                    foreach($question_all as $all): 
                                        $resultcode= $resultcode.$all->questCode.'|';

                                    endforeach;
                                    $resultcode=substr($resultcode,0,-1);
                                    ?>
<script type="text/javascript">

                                $("#saveResult").click(function() {			
                                    $("#saveResult").val('Loading....');
                                    $("#saveResult").prop('disabled', true);
                                       var success_phone = $("#Remark<?php echo($code_param_sp)?>").val();
                                    let text = "<?php echo($code_param_p)?>";
                                    const myArray = text.split(",");
                                    var promise,promise1;
                                    $.each(myArray, function(key, value) {
                                        var cek = '#Remark'+value;
                                        promise1 = $(cek).val();
                                        if(promise1 !== undefined){
                                            promise = promise1;
                                        }
                                    });
                                    var callback = $("#Remark<?php echo($code_param_cb)?>").val();
                                    var parameterasli=$("#Remark<?php echo $code_param?>").val().split("::");
                                    var ctc_mandatory=1;
                                     
                                    var answercode='';
                                     <?php foreach($question_all as $all): ?>
                                         var gk='';
                                         var gk = $("#Remark<?php echo $all->questCode?>").val();
                                         if(gk){
                                             var a = $("#Remark<?php echo $all->questCode?>").val().split('::');
                                             var gk= a[0];
                                         }else{
                                             var gk='-';
                                         }
                                         var answercode=answercode + gk + '|';

                                     <?php endforeach; ?>
                                     var answercode = answercode.substr(0,answercode.length-1);
                                    var resultcode = '<?php echo $resultcode?>';
                                      

                                    if(ctc_mandatory==1){
                                        
                                        $.ajax({
                                            type: "POST",
                                            url: "/doAuth/transRecords",
                                            data: {
                                                Customer_ID : $("#Customer_ID").val(),
                                                uniqueId : $("#UNIQUE_ID").val(),
                                                param : parameterasli[0],
                                                promiseDate : promise,
                                                no_kontrak : $("#AGREEMENT_NO").val(),
                                                agent_name : $('#AGENT_NAME').val(),
                                                answercode : answercode,
                                                resultcode: resultcode,
                                                callBack : callback,
                                                successPhone : success_phone
                                            },
                                            cache: false,
                                             beforeSend: function(){									
                                                            $( '#progress-overlay' ).fadeIn(100, function(){

                                                                $( '#progress' ).css({ 'display': 'block' });
                                                                $( '#progress' ).html("<img src='resources/assets/images/gears.svg?"+ Math.random() + "'/>");	

                                                            })			
                                                        
                                                        },	
                                            success: function(n) {
                                                location.reload(true);
                                            },
                                            error: function (error) {
                                                alert('error; ' + eval(error));
                                            }
                                         });                
                                    }else{  						
                                        $("#saveResult").prop("disabled", false);
                                        alert('SORRY, NEED PERSON CONTACTED CANNOT BE BLANK, THANK YOU FOR YOUR PATIENCE AND COOPERATION');	
                                    }
                                })              
  
                
                
    
    
</script>

<?php 
    $cek_campaign_related= $this->db->get_where('tblMasterCampaign',array('relatedState'=>'Y','campaignName'=>$this->session->userdata('campaign')));
?>
<?php if($cek_campaign_related->num_rows() > 0 ):?>
<!-- Start results-ajax-data -->
<div id="related_new">
    <div class="hCustDet from-top">
        <label>Related Contract</label>
    </div>
    <style type="text/css">.label-message{ font-size: 10px; }</style>
    <div class="custRows">
        <div class="vCust-mid full content-message from-top">
            <label class="label-message">
                <b> Customer ID </b>: <label id="namacustomer"></label>
                
            </label>
        </div>
        <?php $cek_list_related=$this->db->get_where('tblSumRelated',array('campaign'=>$this->session->userdata('campaign')))->result();
        foreach($cek_list_related as $clr):?>
            <div class="vCust-mid full content-message from-top">
            <label class="label-message">
                
                <b><?php echo $clr->fieldDesc?> </b>: <label id="<?php echo $clr->fieldName?>"></label>
            </label>
        </div>
        <?php endforeach;?>
        <div class="vCust-mid full content-message from-top">
            <label class="label-message">
                
                <b> Total Kontrak </b>: <label id="jumlah_related">1</label>
            </label>
        </div>
        <div class="vCust-mid full content-message from-top">
            <label class="label-message">
                
                <b> Jumlah Payment </b>: <label id="jumlah_payment">0</label>
            </label>
        </div>
        <div class="vCust">
            <input id="_show_all_contract" type="button" class="buttonPro small green" value="Show Detail"/>
        </div>
        
    </div>

</div>
<!-- End ajax-data -->
<script type="text/javascript">
    var a =$('#Customer_ID').val();
        $.ajax({
                type:"GET",
                url:"<?php echo base_url()?>doAjax/cek_related",
                data:{
                    cusid :a,
                    campaign:'<?php echo $this->session->userdata('campaign');?>'
                },
                success:function(n){
                    const obj = JSON.parse(n);
                    jumlah_related=0;
                    jumlah_payment=0;
                    <?php foreach ($cek_list_related as $clr2):?>
                            var <?php echo $clr2->fieldName?> =0;
                            
                    <?php endforeach;?>
                    console.log(obj);
                    for(i=1;i <= obj.length ;i++){
                        jumlah_related =jumlah_related+1;
                        
                            if(parseInt(obj[i-1].isPaid)!=1){
                                <?php foreach ($cek_list_related as $clr2):?>
                                    <?php echo $clr2->fieldName?> = parseInt(<?php echo $clr2->fieldName?>) + parseInt(obj[i-1].<?php echo $clr2->fieldName ?>.replace(/,.*|[^0-9]/g, ''), 10);
                                <?php endforeach;?>
                            }else{
                                jumlah_payment=jumlah_payment+1;
                            }
                        
                    }

                    <?php foreach ($cek_list_related as $clr2):?>
                            $('#<?php echo $clr2->fieldName?>').text(<?php echo $clr2->fieldName?>);
                    <?php endforeach;?>
                    $('#namacustomer').text(a);
                    $('#jumlah_related').text(jumlah_related);
                    $('#jumlah_payment').text(jumlah_payment);
                    if(jumlah_related==1){
                        $('#related_new').hide();
                    }
                },
                error:function(){
                    alert('error; ' + eval(error));
                }
            });
    
</script>
<?php endif;?>
