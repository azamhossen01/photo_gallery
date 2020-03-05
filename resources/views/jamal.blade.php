<!doctype html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="en"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="en"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="en"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="en"> <!--<![endif]-->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <title>Barfiller jQuery Plugin | 9bit Studios</title>
	<link rel="stylesheet" href="{{asset('css/barfiller_progressbar.css')}}">
    <script src="http://code.jquery.com/jquery-1.9.1.min.js" type="text/javascript"></script>
</head>

<body>

<h1>Barfiller</h1>

	<p>A simple jQuery plugin that gives you percentage-based animated bar filling...</p>

	<div id="bar1" class="barfiller">
	    <div class="tipWrap">
		<span class="tip"></span>
	    </div>
	    <span class="fill" data-percentage="50"></span>
	</div>
	
	<div id="bar2" class="barfiller">
	    <div class="tipWrap">
		<span class="tip"></span>
	    </div>
	    <span class="fill" data-percentage="35"></span>
	</div>	
	
	<p>You can set different colors...</p>
	
	<div id="bar3" class="barfiller">
	    <div class="tipWrap">
		<span class="tip"></span>
	    </div>
	    <span class="fill" data-percentage="75"></span>
	</div>	

	<p>And you can set different durations....</p>
	
	<div id="bar4" class="barfiller">
	    <div class="tipWrap">
		<span class="tip"></span>
	    </div>
	    <span class="fill" data-percentage="95"></span>
	</div>	
	
	<p>Reanimates on browser/device resize too!</p>
	
</div>
 
<script src="{{asset('js/barfiller_progressbar.js')}}"></script>
<script type="text/javascript">

$(document).ready(function(){

	$('#bar1').barfiller();
	$('#bar2').barfiller();
	$('#bar3').barfiller({ barColor: '#fc6' });
	$('#bar4').barfiller({ barColor: '#900', duration: 3000 });
	
});

</script>

<!--[if lt IE 9 ]>
<![endif]-->

<!-- Prompt IE 6 users to install Chrome Frame. Remove this if you want to support IE 6.
     chromium.org/developers/how-tos/chrome-frame-getting-started -->
<!--[if lt IE 7 ]>
  <script src="//ajax.googleapis.com/ajax/libs/chrome-frame/1.0.3/CFInstall.min.js"></script>
  <script>window.attachEvent('onload',function(){CFInstall.check({mode:'overlay'})})</script>
<![endif]-->
  
</body>
</html>