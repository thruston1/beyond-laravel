<div class="dLeft mLeft" >
    <div class="custRows">
    <div class="hCustDet">
        <label>Collection</label>
    </div>
    {{-- @include('website.page.callCenter.question') --}}
    
    <div class="hCustDet from-top">
        <label>Today Performance</label>
    </div>

    <div class="custRows">
        <div class="lCust full">
            <div class="t_performance">
                <?php $total = 0 ?>
                <?php // foreach($totalPerform/*->result()*/ as $total_perform): $total = $total_perform->TOTAL; endforeach; ?>
                <?php echo("<span class=\"summary-param\">CALLED TODAY : </span><span class=\"count-summary-value\">".$total."</span>"); ?>
            </div>
    {{-- <?php foreach($perform/*->result()*/ as $rows1p): ?>
            <div class="c_performance">
                <?php echo("<span class=\"summary-param\">" . $rows1p->PARAMETER . " : </span><span class=\"count-summary-value\">" . $rows1p->COUNT . "</span>");
                if( $total > 0 ): echo(" (<span class=\"count-percent\">".round($rows1p->COUNT / ($total / 100),2)."%)</span>");
                else: echo("<b class=\"count-percent\"> (0%)</b>");
                endif; ?>
            </div>	
    <?php endforeach; ?> --}}
            <div class="c_performance">
                <span class="summary-param"> Nama parameter : </span><span class="count-summary-value">0</span>
                <span class="count-percent">0</span>
                <b class="count-percent"> (0%)</b>
            </div>	
        
        </div>
    </div>
    

</div>
