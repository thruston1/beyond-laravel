<div class="top-nav" style="background-color: #00BFFF">
    <div class="top-nav-inner">
        <div class="inner-left">
            <a class="btn btn-success" href="{{route('callCenter.callScreen')}}">CALL SCREEN</a>
        </div>
        <!-- START LOGOUT BUTTON -->		
        <div class="inner-right logout">
            <a href="javascript:;" class="logout-btn"></a>
        </div> 
        <!-- START DATE INFORMATION -->		
        <div class="inner-right dates-nav">
            {{date('l \, j F Y')}}
        </div>

        <!-- END DATE INFORMATION -->

        <!-- START TIME INFORMATION -->	
        <div class="inner-right timer-nav">
            <span class="timer-val" id="hours">{{ date('H') }}</span>:<span class="timer-val" id="minutes"> {{date('i')}} </span>:<span class="timer-val" id="seconds"> {{date('s')}} </span>
        </div>
        <!-- END TIME INFORMATION -->	
    </div>
    <div class="page-wrapper">
        <div id="_box-release" class="_box-release">
            <div class="timer-release">
                <label>RELEASE_AS : <label id="_release-text"></label></label>
            </div>
            
            <div class="timer-release">
                <span class="timer-release-val" id="realtime">0:00:00</span>
            </div>
        
            <div class="timer-release-button">
                <input id="_box-release-close" type="button" class="buttonPro orange" value="Unrelease"/>
            </div>
        </div>
    </div>

    <div id="_box-logout" class="_box-logout">
        <div class="server-check">
            <label id="_logout-text"></label>
        </div>
        
        <div class="timer-release-button">
            <input type="button" class="buttonPro orange _box-logout-close" value="Continue"/>
        </div>
    </div>

    <div class="_date_diff_box" id="box-server">
        <div class="server-check">
            <!-- <label>Server date and client date not match, please reconfigure your machine. <br />Server date is : <b><?php echo(date('l \, j F Y')); ?></b></label>-->
            <label>Please check your machine, today is  {{date('l \, j F Y')}} </b></label>
        </div>
            
        <div class="timer-release-button">
            <input id="box-close" type="button" class="buttonPro orange" value="Try again"/>
        </div>
    </div>

</div>