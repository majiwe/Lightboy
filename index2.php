<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">

<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<meta name="viewport" content="width=320; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;">
    <link rel="apple-touch-icon" href="apple-touch-icon.png">
    <script type="text/javascript" src="jquery-1.5.1.min.js"></script>
<meta name="apple-mobile-web-app-capable" content="yes">


	<title>LightBOY</title>
	
	<style type="text/css" media="screen">
		body {
			font-family: Helvetica, Arial, sans-serif;
			background-color: #000;
			color: #CCC;
		}
	
	
		#status {
			text-align: center;
			font-size: 18px;
		}
	#wrapper {
		margin: 10px;
		height: 648px;
		width: 980px;
		border: medium dotted #FFF;
}
    #ledlayout {
		display:inline-block;
		margin: 10px;
		height: 100%;
		width: 400px;
}
    #steuerungslayout {
		position: relative;
		display:inline-block;
		margin: 20px;
		width: 400px;
	}
	
    .row-led, .matrix-led, .single-led, .ttt-led {
		margin: 5px;
		padding: 5px;
		height: 60px;
		width:235px;
		border-radius: 15px;
		border: 2px solid #666;
		color: #666;
		font-weight: bold;
		display: inline-block;
	}

	.matrix-led {
		height: 228px;
		width:235px;
	}
    .single-led {
		height: 60px;
		width: 60px;
	}
    .ttt-led {
	  height: 40px;
	  width: 40px;
	  padding: 15px;
	  font-size: 18px;
	text-align: center;
    }
	
	.chosen {
		border: 2px solid #FFF;
		color: #FFF;
	}
	
	#tabs .selected { display:inline-block; }
	#tabs {
	position: relative;
	left:330px;
	top:10px;
	height: 250px;
	width:350px;

	font-size:12px;
}
	#tab-nav {
	position: absolute;
	left:50px;
	top:25px;
	height: 75px;
	font-size:12px;
}
	#submit-command, .player-panel{
	position: absolute;
	left:700px;
	top:50px;
	height: 250px;
	width:250px;
	font-size:14px;
	font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
	text-align:center;
}
.player-panel {
	background-color: #000;
	overflow:hidden;
	display: inline-block;
}
.player-panel div{
	display:inline-block;
	margin:10px;
	text-align:center;
}

	.tabs-bottom { position: relative; } 
	.tabs-panel { 
		position: absolute;
		top:0px;
		left:0px;
		height: 270px; 
		width:270px;
		display: none;
		overflow: hidden; 
	} 
	ul {
		list-style-type:none;
		margin:0px;
		padding: 0px;
		font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
		font-size: 14px;
	}
	li {
		display:block;
		margin: 5px;
		margin-left:20px;
	}
	li a, .submitbuttons{ 
		display:block; 
		color: #666;
		padding: 5px 15px 5px 15px;
		text-decoration:none;
		font-weight: bold;
		background-color:#111111;
		border-radius: 10px;
		border: 6px double #666;
		border-radius: 10px;
		text-align:center;
		font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
		font-size: 14px;
	}
#player_color {	display: none; }
	.submitbuttons {
		display:block; 
		color: #CCC;
		padding: 5px;
		padding-left:0px;
		text-decoration:none;
		font-weight: bold;
		background-color:#666;
		border: 6px double #000;
		border-radius: 5px;
		text-align:center;
		margin-bottom: 15px;
		height: 190px;
	}
	.submitbutton_small{
		display:inline-block;
		width: 125px;
		height:60px;
		color: #CCC;
		padding: 10px;
		text-decoration:none;
		font-weight: bold;
		background-color:#666;
		border-radius: 10px;
		border: 6px double #000;
		border-radius: 10px;
		text-align:center;
		margin-bottom: 15px;
		font-family:"Trebuchet MS", Arial, Helvetica, sans-serif;
		font-size: 14px;
	}
	.submitbutton_small .selected{
		border: 6px double #FFF;
	}
	.selected a{ 
		display:block; 
		color: #999;		
		background-color:#FFF;
		text-decoration:none;
		font-weight: bold;
		border-color:#999;
	}
	#colorchart {
		border: 1px solid white;
		padding: 5px;
		margin-top: 10px;
	}
	#colorchart td {
		height:20px;
		width:35px;
	}
	#pickerlayout {
		position:relative;
		top:20px;
		left:7px;
	}
    </style>

	
	<script type="text/javascript" charset="utf-8">
<!--//		
		function setcolor(){
			var color = ""; 
			var setmode =  $(".selected").index();
			if (setmode == 0) {
				color += "xx";
				$(".single-led").each(function(){ color+= ($(this).attr('rel')); }); }
			else if (setmode == 1) {
				color += "yy";
				$("#tabs-"+(setmode+1)+" .row-led").each(function(){ color+= ($(this).attr('rel')); }); }
			 else if (setmode == 2)  {
				color += "zz";
				$(".matrix-led").each(function(){ color+= ($(this).attr('rel')); }); }
			else if (setmode == 3) {
				color += "zf";
				$("#tabs-"+(setmode+1)+" .row-led").each(function(){ color+= ($(this).attr('rel')) }); }
			else if (setmode == 4)  {
				color += "ttt";
				$(".ttt-led").each(function(){ color+= ($(this).attr('rel')); }); }
				
			$.ajax({
				   	url: "serial.php",
					cache: false,
					data: {color: color},
					success: function(data){ $('#status').text('LED-Farben wurden gesetzt'); }
				   });
		}
									
													
		$(document).ready(function(){
			$('#submit').click(function(){ //Add an onClick event to the submit button
				set_singlecolor($('#l').val(), $('#color').val());
				return false; //Supresses the page reload
			});
			
		setbinds();		
		
	});

var won_games = 0;
var lost_games = 0;
var tie_games = 0;
var save_sm=0;

function setbinds() {

$( "#choose_type a" ).bind('click',	function () { 
			var target_id = $("#choose_type li").index($(this).parent('li'));
			$( "#choose_type li" ).removeClass('selected').eq(target_id).addClass('selected');
			$(".tabs-panel").removeClass('selected').eq(target_id).addClass('selected');
			$(".chosen").removeClass('chosen');
			if(target_id == 4){set_tictactoe(); $('#player_color').show();}
			else { $('#player_color').hide(); }

			$( "#colorchart td" ).bind('click',	function () { 
			var col = $(this).attr("bgcolor");
			$(".chosen").css("background-color",col)
			.removeClass('chosen').attr("rel",col); 
		});
				
		  });
		$( ".single-led" ).bind('click',	function () { 
			if($(this).hasClass('chosen')) { $(this).removeClass('chosen');
			} else { $(this).addClass('chosen'); }
		});
		$( ".row-led" ).bind('click',	function () { 
			if($(this).hasClass('chosen')) { $(this).removeClass('chosen');
			} else { $(this).addClass('chosen'); }
		});
		$( ".matrix-led" ).bind('click',	function () { 
			if($(this).hasClass('chosen')) { $(this).removeClass('chosen');
			} else { $(this).addClass('chosen'); }
		});
		$( "#colorchart td" ).bind('click',	function () { 
			var col = $(this).attr("bgcolor");
			$(".chosen").css("background-color",col)
			.removeClass('chosen').attr("rel",col); 
		});
		$( "#setcolor" ).bind('click', function() { setcolor(); });
		$( "#cm_reset" ).bind('click', function() { reset(); });
		$( "#cm_def" ).bind('click', function() {
				$.ajax({
				   	url: "serial.php",
					cache: false,
					data: {def: "set"},
					success: function(data){ $('#status').text('Defaultwerte wurden ausgeschaltet'); }
				   });
		});		
		$( "#cm_select" ).bind('click', function() {										 
				$.ajax({
				   	url: "serial.php",
					cache: false,
					data: {showmode: ($(".selected").index() +1)},
					success: function(data){ $('#status').text('Anzeigemodus wurde gewählt'); }
				   });
		});
		$( "#cm_switch" ).bind('click', function() {
										 
				$.ajax({
				   	url: "serial.php",
					cache: false,
					data: {showmode: save_sm },
					success: function(data){ 

			if (save_sm == 0) {
						save_sm = $(".selected").index() +1;
						$('#status').text('Lampe aus'); 
			}else {
						save_sm = 0;
						$('#status').text('Lampe an'); 
			} }
					
					  
				   });
		});




}
		
function set_tictactoe() {
computer = true;
$("#player1").html("0");
$("#player2").html("0");
$("#player1").attr('rel', "").css("background-color", "");
$("#player2").attr('rel', "").css("background-color", "");	
$.ajax({
	url: "serial.php",
	cache: false,
	data: {showmode: 5},
	success: function(data){ $('#status').text('Lets play TicTacToe'); }
});
setcolor();

$( "#spielablauf").html("Spieler 1 wählen Sie Ihre Farbe: "); 
$( "#colorchart td" ).bind('click',	function () { 
	if (Spieler == 0) { 
		var s1 = $(this).attr("bgcolor"); 
		$("#player1").attr('rel', s1).css("background-color", s1);
		Spieler++;
		$( "#spielablauf").html( "Spieler 2 wählen Sie Ihre Farbe: ");
	
		if( computer == true) {
			var s2 = "#FF0000";
			$("#player2").attr('rel', s2).css("background-color", s2);
			Spieler = 0; 
			$( "#colorchart td" ).unbind();
		 	$( "#spielablauf").html("Möge das Spiel beginnen!");
		}
	} else if(computer == false){
		if( $(this).attr("bgcolor") == $("#player1").attr('rel')){
			$( "#spielablauf").html("Bitte wählen Sie eine andere Farbe!");
		} else { 
			var s2 = $(this).attr("bgcolor"); 
			$("#player2").attr('rel', s2).css("background-color", s2);
			Spieler = 0; 
			$( "#colorchart td" ).unbind();
		  $( "#spielablauf").html("Möge das Spiel beginnen!");
		}
	}
	$( ".ttt-led" ).bind('click',	function () { 
		playerChoice($('#player1'), $(this).attr('rev'));
	});
});
}
<!-- Begin
	var pause = 0;
	var all = 0;
	var a = 0;
	var b = 0;
	var c = 0;
	var d = 0;
	var e = 0;
	var f = 0;
	var g = 0;
	var h = 0;
	var i = 0;
	var temp="";
	var ok = 0;
	var cf = 0;
	var choice=9;
	var aRandomNumber = 0;
	var comp = 0; 
	var t = 0;
	
	var Spieler = 0;

function help() {
	$( "#spielablauf").html("Willkommen zu Tic-Tac-Toe!  Du bist Spieler1 und der Computer Spieler2. Klicke auf das Quadrat für die LED, welche du mit deiner Farbe einfärben willst. Belegte Felder können nicht überschrieben werden. Der erste mit drei in einer Reihe gewinnt!")
}

function find_winning_row() {
	var sp = 1;
	while ( (sp < 3) && (all==0) ){
		if ((a==sp)&&(b==sp)&&(c==sp)) all=sp;
		if ((a==sp)&&(d==sp)&&(g==sp)) all=sp;
		if ((a==sp)&&(e==sp)&&(i==sp)) all=sp;
		if ((b==sp)&&(e==sp)&&(h==sp)) all=sp;
		if ((d==sp)&&(e==sp)&&(f==sp)) all=sp;
		if ((g==sp)&&(h==sp)&&(i==sp)) all=sp;
		if ((c==sp)&&(f==sp)&&(i==sp)) all=sp;
		if ((g==sp)&&(e==sp)&&(c==sp)) all=sp;
		sp++;
	}
	if ((a != 0)&&(b != 0)&&(c != 0)&&(d != 0)&&(e != 0)&&(f != 0)&&(g != 0)&&(h != 0)&&(i != 0)&&(all == 0)) all = 3;
} 

function find_empty_spot() {
	
	if ( ((b == c)&&(a == 0)&&(temp=="")) || ((d == g)&&(a == 0)&&(temp=="")) || ((e == i)&&(a == 0)&&(temp=="")) ) temp="A";
	if ( ((a == c)&&(b == 0)&&(temp=="")) || ((h == e)&&(b == 0)&&(temp=="")) ) temp="B";
	if ( ((a == b)&&(c == 0)&&(temp=="")) || ((i == f)&&(c == 0)&&(temp=="")) || ((g == e)&&(c == 0)&&(temp=="")) ) temp="C";
	if ( ((a == g)&&(d == 0)&&(temp=="")) || ((e == f)&&(d == 0)&&(temp=="")) ) temp="D";
	if ( ((a == i)&&(e == 0)&&(temp=="")) || ((b == h)&&(e == 0)&&(temp=="")) || ((d == e)&&(f == 0)&&(temp=="")) || ((g == c)&&(e == 0)&&(temp=="")) ) temp="E";
	if ( ((d == e)&&(f == 0)&&(temp=="")) || ((c == i)&&(f == 0)&&(temp=="")) ) temp="F";
	if ( ((a == d)&&(g == 0)&&(temp=="")) || ((h == i)&&(g == 0)&&(temp=="")) || ((e == c)&&(g == 0)&&(temp=="")) ) temp="G";
	if ( ((b == e)&&(h == 0)&&(temp=="")) || ((g == i)&&(h == 0)&&(temp=="")) ) temp="H";
	if ( ((a == e)&&(i == 0)&&(temp=="")) || ((g == h)&&(i == 0)&&(temp=="")) || ((c == f)&&(i == 0)&&(temp=="")) ) temp="I";
}

function clear_score() {
	$("#player1").html("0");
	$("#player2").html("0");
	$("#tie").html("0");
}

function check_chosen_spot() {
	if ((temp=="A")&&(a==0)) {
		ok=1;
		a = (cf+1);
	} else if ((temp=="B")&&(b==0)) {
		ok=1;
		b = (cf+1);
	} else if ((temp=="C")&&(c==0)) {
		ok=1;
		c = (cf+1);
	} else if ((temp=="D")&&(d==0)) {
		ok=1;
		d = (cf+1);
	} else if ((temp=="E")&&(e==0)) {
		ok=1;
		e = (cf+1);
	} else if ((temp=="F")&&(f==0)) {
		ok=1
		f = (cf+1);
	} else if ((temp=="G")&&(g==0)) {
		ok=1
		g = (cf+1);
	} else if ((temp=="H")&&(h==0)) {
		ok=1;
		h = (cf+1);
	} else if ((temp=="I")&&(i==0)) {
		ok=1;
		i = (cf+1);
	}
}

function playerChoice($p, chName) {
	pause = 0;
	
	if (all!=0) { ended(); }
	else {
		cf = 0;
		ok = 0;
		temp = chName;
		check_chosen_spot();
		if (ok==1) {
			$('.ttt-led[rev="'+temp+'"]').attr('rel', $p.attr('rel')).css("background-color", $p.attr('rel'));
			setcolor();
		} else if (ok==0){ taken(); }
		process();
		if(computer == true){
			if ((all==0)&&(pause==0)) { computerChoice(); }
		}
	   }
}

function taken() {
	$( "#spielablauf").html("Feld belegt.  Bitte wähle ein anderes.")
	pause=1;
}

function computerChoice() {
	temp="";
	ok = 0;
	cf = 1;
	find_empty_spot();
	check_chosen_spot();
	
	while(ok==0) {
		aRandomNumber=Math.random()
		comp=Math.round((choice-1)*aRandomNumber)+1;
		if (comp==1) temp="A";
		else if (comp==2) temp="B";
		else if (comp==3) temp="C";
		else if (comp==4) temp="D";
		else if (comp==5) temp="E";
		else if (comp==6) temp="F";
		else if (comp==7) temp="G";
		else if (comp==8) temp="H";
		else if (comp==9) temp="I";
		check_chosen_spot();
	}
	
	$('.ttt-led[rev="'+temp+'"]').attr('rel', $("#player2").attr('rel')).css("background-color", $("#player2").attr('rel'));
	process();

	if (all==0) { setcolor(); }
}

function ended() {
	$( "#spielablauf").html("Das Spiel ist zu Ende.")
}

function process() {
	find_winning_row();
	
	if (all==1){ 		$( "#spielablauf").html("Player 1 gewinnt"); won_games++; $player = $('#player1');}
	else if (all==2){ 	$( "#spielablauf").html("Player 2 gewinnt"); lost_games++; $player = $('#player2'); }
	else if (all==3){ 	$( "#spielablauf").html("We tied."); tie_games++; }

	if (all!=0) {
		if(all<3){
			$('#tabs-5 .ttt-led').attr('rel', $player.attr('rel')).css("background-color", $player.attr('rel'))
			setcolor(); 
		}
		$("#player1").html(won_games);
		$("#player2").html(lost_games);
   }
   
}

function playAgain() {
	if (all==0) {
		if(confirm("This will restart the game and clear all the current scores. OK?")) reset();
	} else { 
		reset(); 
	}
}

function reset() {
	all = 0;
	a = 0;
	b = 0;
	c = 0;
	d = 0;
	e = 0;
	f = 0;
	g = 0;
	h = 0;
	i = 0;
	temp="";
	ok = 0;
	cf = 0;
	choice=9;
	aRandomNumber = 0;
	comp = 0; 
	Spieler = 0;

	$("#tabs-5 .ttt-led").attr('rel', "#000000").css("background-color", "#000000");	
	if (t==0) { 
		t=2; computerChoice();
	}
	setcolor();
	t--;
}

//-->	</script>
	
</head>

<body>
	

<div id="wrapper">
<div id="tabs">
	<div id="tabs-1" class="tabs-panel selected">
                <div id="led0" class="single-led" rel="#000000">LED 1</div>
                <div id="led1" class="single-led" rel="#000000">LED 2</div>
                <div id="led2" class="single-led" rel="#000000">LED 3</div><br />
            	<div id="led3" class="single-led" rel="#000000">LED 4</div>
                <div id="led4" class="single-led" rel="#000000">LED 5</div>
                <div id="led5" class="single-led" rel="#000000">LED 6</div><br />
                <div id="led6" class="single-led" rel="#000000">LED 7</div>
                <div id="led7" class="single-led" rel="#000000">LED 8</div>
                <div id="led8" class="single-led" rel="#000000">LED 9</div>
	</div>
	<div id="tabs-2" class="tabs-panel">
        	<div id="led_row0" class="row-led" rel="#000000">LED Row 1</div><br />
            <div id="led_row1" class="row-led" rel="#000000">LED Row 2</div><br />
            <div id="led_row2" class="row-led" rel="#000000">LED Row 3</div>
	</div>
	<div id="tabs-3" class="tabs-panel">
			<div id="led_matrix0" class="matrix-led" rel="#000000">Matrix 1</div>
	</div>
    <div id="tabs-4" class="tabs-panel">
		    <div id="fade_start" class="row-led" rel="#000000">Fade: Start-Color</div><br />
            <div id="fade_end" class="row-led" rel="#000000">Fade: End-Color</div><br />
	</div>
    <div id="tabs-5" class="tabs-panel">
    	        <div id="led0" class="ttt-led" rel="#000000" rev="A">TTT 1</div>
                <div id="led1" class="ttt-led" rel="#000000" rev="B">TTT 2</div>
                <div id="led2" class="ttt-led" rel="#000000" rev="C">TTT 3</div><br />
            	<div id="led3" class="ttt-led" rel="#000000" rev="D">TTT 4</div>
                <div id="led4" class="ttt-led" rel="#000000" rev="E">TTT 5</div>
                <div id="led5" class="ttt-led" rel="#000000" rev="F">TTT 6</div><br />
                <div id="led6" class="ttt-led" rel="#000000" rev="G">TTT 7</div>
                <div id="led7" class="ttt-led" rel="#000000" rev="H">TTT 8</div>
                <div id="led8" class="ttt-led" rel="#000000" rev="I">TTT 9</div>

	</div>
</div>

 <div id="tab-nav">
    <ul id="choose_type">
    W&auml;hle Farbe f&uuml;r<br />
		<li class="selected"><a href="#tabs-1">einzelne LED</a></li>
		<li><a href="#tabs-2">einzelne LED-Reihen</a></li>
		<li><a href="#tabs-3">ganze Matrix</a></li>
        <li><a href="#tabs-4">eigener Color Fade</a></li>
        <li><a href="#tabs-4">Tic-Tac-Toe</a></li>
	</ul>
</div>
 <div id="submit-command">
     <ul class="submitbuttons" >
		<li ><a  href="#" id="cm_select" >Modus wechseln</a></li>
		<li ><a href="#" id="setcolor">Farbe übertragen</a></li>
		<li class="small"><a href="#" id="cm_def">Standardwerte</a></li>
        <li  class="small"><a href="#" id="cm_switch">Licht an/aus</a></li>
	</ul>
 </div>
 <div id="player_color" class="player-panel">
         
        <ul class="submitbuttons" style="height:50px;">
			<li ><a id="cm_reset" >Spiel reset</a></li>
        </ul>
        <span id="spielablauf">  </span><br/>
        <div class="p_wrapper">
        <div id="player1" class="ttt-led" rel="#000000"></div><br />Player 1</div>
        <div class="p_wrapper">
        <div id="player2" class="ttt-led" rel="#000000"></div><br />Player 2</div><br/>
      	

</div>
<div id="pickerlayout"> <strong>Choose your Color:</strong>
    <table border="0" cellpadding="0" cellspacing="3" id="colorchart">
 <tbody>
 <tr><td bgcolor="#F8E0E0"></td><td bgcolor="#F8E6E0"></td><td bgcolor="#F8ECE0"></td><td bgcolor="#F7F2E0"></td><td bgcolor="#F7F8E0"></td><td bgcolor="#F1F8E0"></td><td bgcolor="#ECF8E0"></td><td bgcolor="#E6F8E0"></td><td bgcolor="#E0F8E0"></td><td bgcolor="#E0F8E6"></td><td bgcolor="#E0F8EC"></td><td bgcolor="#E0F8F1"></td><td bgcolor="#E0F8F7"></td><td bgcolor="#E0F2F7"></td><td bgcolor="#E0ECF8"></td><td bgcolor="#E0E6F8"></td><td bgcolor="#E0E0F8"></td><td bgcolor="#E6E0F8"></td><td bgcolor="#ECE0F8"></td><td bgcolor="#F2E0F7"></td><td bgcolor="#F8E0F7"></td><td bgcolor="#F8E0F1"></td><td bgcolor="#F8E0EC"></td><td bgcolor="#F8E0E6"></td><td bgcolor="#FFFFFF"></td></tr>
 <tr><td bgcolor="#F6CECE"></td><td bgcolor="#F6D8CE"></td><td bgcolor="#F6E3CE"></td><td bgcolor="#F5ECCE"></td><td bgcolor="#F5F6CE"></td><td bgcolor="#ECF6CE"></td><td bgcolor="#E3F6CE"></td><td bgcolor="#D8F6CE"></td><td bgcolor="#CEF6CE"></td><td bgcolor="#CEF6D8"></td><td bgcolor="#CEF6E3"></td><td bgcolor="#CEF6EC"></td><td bgcolor="#CEF6F5"></td><td bgcolor="#CEECF5"></td><td bgcolor="#CEE3F6"></td><td bgcolor="#CED8F6"></td><td bgcolor="#CECEF6"></td><td bgcolor="#D8CEF6"></td><td bgcolor="#E3CEF6"></td><td bgcolor="#ECCEF5"></td><td bgcolor="#F6CEF5"></td><td bgcolor="#F6CEEC"></td><td bgcolor="#F6CEE3"></td><td bgcolor="#F6CED8"></td><td bgcolor="#F2F2F2"></td></tr>
 <tr><td bgcolor="#F5A9A9"></td><td bgcolor="#F5BCA9"></td><td bgcolor="#F5D0A9"></td><td bgcolor="#F3E2A9"></td><td bgcolor="#F2F5A9"></td><td bgcolor="#E1F5A9"></td><td bgcolor="#D0F5A9"></td><td bgcolor="#BCF5A9"></td><td bgcolor="#A9F5A9"></td><td bgcolor="#A9F5BC"></td><td bgcolor="#A9F5D0"></td><td bgcolor="#A9F5E1"></td><td bgcolor="#A9F5F2"></td><td bgcolor="#A9E2F3"></td><td bgcolor="#A9D0F5"></td><td bgcolor="#A9BCF5"></td><td bgcolor="#A9A9F5"></td><td bgcolor="#BCA9F5"></td><td bgcolor="#D0A9F5"></td><td bgcolor="#E2A9F3"></td><td bgcolor="#F5A9F2"></td><td bgcolor="#F5A9E1"></td><td bgcolor="#F5A9D0"></td><td bgcolor="#F5A9BC"></td><td bgcolor="#E6E6E6"></td></tr>
 <tr><td bgcolor="#F78181"></td><td bgcolor="#F79F81"></td><td bgcolor="#F7BE81"></td><td bgcolor="#F5DA81"></td><td bgcolor="#F3F781"></td><td bgcolor="#D8F781"></td><td bgcolor="#BEF781"></td><td bgcolor="#9FF781"></td><td bgcolor="#81F781"></td><td bgcolor="#81F79F"></td><td bgcolor="#81F7BE"></td><td bgcolor="#81F7D8"></td><td bgcolor="#81F7F3"></td><td bgcolor="#81DAF5"></td><td bgcolor="#81BEF7"></td><td bgcolor="#819FF7"></td><td bgcolor="#8181F7"></td><td bgcolor="#9F81F7"></td><td bgcolor="#BE81F7"></td><td bgcolor="#DA81F5"></td><td bgcolor="#F781F3"></td><td bgcolor="#F781D8"></td><td bgcolor="#F781BE"></td><td bgcolor="#F7819F"></td><td bgcolor="#D8D8D8"></td></tr>
 <tr><td bgcolor="#FA5858"></td><td bgcolor="#FA8258"></td><td bgcolor="#FAAC58"></td><td bgcolor="#F7D358"></td><td bgcolor="#F4FA58"></td><td bgcolor="#D0FA58"></td><td bgcolor="#ACFA58"></td><td bgcolor="#82FA58"></td><td bgcolor="#58FA58"></td><td bgcolor="#58FA82"></td><td bgcolor="#58FAAC"></td><td bgcolor="#58FAD0"></td><td bgcolor="#58FAF4"></td><td bgcolor="#58D3F7"></td><td bgcolor="#58ACFA"></td><td bgcolor="#5882FA"></td><td bgcolor="#5858FA"></td><td bgcolor="#8258FA"></td><td bgcolor="#AC58FA"></td><td bgcolor="#D358F7"></td><td bgcolor="#FA58F4"></td><td bgcolor="#FA58D0"></td><td bgcolor="#FA58AC"></td><td bgcolor="#FA5882"></td><td bgcolor="#BDBDBD"></td></tr>
 <tr><td bgcolor="#FE2E2E"></td><td bgcolor="#FE642E"></td><td bgcolor="#FE9A2E"></td><td bgcolor="#FACC2E"></td><td bgcolor="#F7FE2E"></td><td bgcolor="#C8FE2E"></td><td bgcolor="#9AFE2E"></td><td bgcolor="#64FE2E"></td><td bgcolor="#2EFE2E"></td><td bgcolor="#2EFE64"></td><td bgcolor="#2EFE9A"></td><td bgcolor="#2EFEC8"></td><td bgcolor="#2EFEF7"></td><td bgcolor="#2ECCFA"></td><td bgcolor="#2E9AFE"></td><td bgcolor="#2E64FE"></td><td bgcolor="#2E2EFE"></td><td bgcolor="#642EFE"></td><td bgcolor="#9A2EFE"></td><td bgcolor="#CC2EFA"></td><td bgcolor="#FE2EF7"></td><td bgcolor="#FE2EC8"></td><td bgcolor="#FE2E9A"></td><td bgcolor="#FE2E64"></td><td bgcolor="#A4A4A4"></td></tr>
 <tr><td bgcolor="#FF0000"></td><td bgcolor="#FF4000"></td><td bgcolor="#FF8000"></td><td bgcolor="#FFBF00"></td><td bgcolor="#FFFF00"></td><td bgcolor="#BFFF00"></td><td bgcolor="#80FF00"></td><td bgcolor="#40FF00"></td><td bgcolor="#00FF00"></td><td bgcolor="#00FF40"></td><td bgcolor="#00FF80"></td><td bgcolor="#00FFBF"></td><td bgcolor="#00FFFF"></td><td bgcolor="#00BFFF"></td><td bgcolor="#0080FF"></td><td bgcolor="#0040FF"></td><td bgcolor="#0000FF"></td><td bgcolor="#4000FF"></td><td bgcolor="#8000FF"></td><td bgcolor="#BF00FF"></td><td bgcolor="#FF00FF"></td><td bgcolor="#FF00BF"></td><td bgcolor="#FF0080"></td><td bgcolor="#FF0040"></td><td bgcolor="#848484"></td></tr>
 <tr><td bgcolor="#DF0101"></td><td bgcolor="#DF3A01"></td><td bgcolor="#DF7401"></td><td bgcolor="#DBA901"></td><td bgcolor="#D7DF01"></td><td bgcolor="#A5DF00"></td><td bgcolor="#74DF00"></td><td bgcolor="#3ADF00"></td><td bgcolor="#01DF01"></td><td bgcolor="#01DF3A"></td><td bgcolor="#01DF74"></td><td bgcolor="#01DFA5"></td><td bgcolor="#01DFD7"></td><td bgcolor="#01A9DB"></td><td bgcolor="#0174DF"></td><td bgcolor="#013ADF"></td><td bgcolor="#0101DF"></td><td bgcolor="#3A01DF"></td><td bgcolor="#7401DF"></td><td bgcolor="#A901DB"></td><td bgcolor="#DF01D7"></td><td bgcolor="#DF01A5"></td><td bgcolor="#DF0174"></td><td bgcolor="#DF013A"></td><td bgcolor="#6E6E6E"></td></tr>
 <tr><td bgcolor="#B40404"></td><td bgcolor="#B43104"></td><td bgcolor="#B45F04"></td><td bgcolor="#B18904"></td><td bgcolor="#AEB404"></td><td bgcolor="#86B404"></td><td bgcolor="#5FB404"></td><td bgcolor="#31B404"></td><td bgcolor="#04B404"></td><td bgcolor="#04B431"></td><td bgcolor="#04B45F"></td><td bgcolor="#04B486"></td><td bgcolor="#04B4AE"></td><td bgcolor="#0489B1"></td><td bgcolor="#045FB4"></td><td bgcolor="#0431B4"></td><td bgcolor="#0404B4"></td><td bgcolor="#3104B4"></td><td bgcolor="#5F04B4"></td><td bgcolor="#8904B1"></td><td bgcolor="#B404AE"></td><td bgcolor="#B40486"></td><td bgcolor="#B4045F"></td><td bgcolor="#B40431"></td><td bgcolor="#585858"></td></tr>
 <tr><td bgcolor="#8A0808"></td><td bgcolor="#8A2908"></td><td bgcolor="#8A4B08"></td><td bgcolor="#886A08"></td><td bgcolor="#868A08"></td><td bgcolor="#688A08"></td><td bgcolor="#4B8A08"></td><td bgcolor="#298A08"></td><td bgcolor="#088A08"></td><td bgcolor="#088A29"></td><td bgcolor="#088A4B"></td><td bgcolor="#088A68"></td><td bgcolor="#088A85"></td><td bgcolor="#086A87"></td><td bgcolor="#084B8A"></td><td bgcolor="#08298A"></td><td bgcolor="#08088A"></td><td bgcolor="#29088A"></td><td bgcolor="#4B088A"></td><td bgcolor="#6A0888"></td><td bgcolor="#8A0886"></td><td bgcolor="#8A0868"></td><td bgcolor="#8A084B"></td><td bgcolor="#8A0829"></td><td bgcolor="#424242"></td></tr>
 <tr><td bgcolor="#610B0B"></td><td bgcolor="#61210B"></td><td bgcolor="#61380B"></td><td bgcolor="#5F4C0B"></td><td bgcolor="#5E610B"></td><td bgcolor="#4B610B"></td><td bgcolor="#38610B"></td><td bgcolor="#21610B"></td><td bgcolor="#0B610B"></td><td bgcolor="#0B6121"></td><td bgcolor="#0B6138"></td><td bgcolor="#0B614B"></td><td bgcolor="#0B615E"></td><td bgcolor="#0B4C5F"></td><td bgcolor="#0B3861"></td><td bgcolor="#0B2161"></td><td bgcolor="#0B0B61"></td><td bgcolor="#210B61"></td><td bgcolor="#380B61"></td><td bgcolor="#4C0B5F"></td><td bgcolor="#610B5E"></td><td bgcolor="#610B4B"></td><td bgcolor="#610B38"></td><td bgcolor="#610B21"></td><td bgcolor="#2E2E2E"></td></tr>
 <tr><td bgcolor="#3B0B0B"></td><td bgcolor="#3B170B"></td><td bgcolor="#3B240B"></td><td bgcolor="#3A2F0B"></td><td bgcolor="#393B0B"></td><td bgcolor="#2E3B0B"></td><td bgcolor="#243B0B"></td><td bgcolor="#173B0B"></td><td bgcolor="#0B3B0B"></td><td bgcolor="#0B3B17"></td><td bgcolor="#0B3B24"></td><td bgcolor="#0B3B2E"></td><td bgcolor="#0B3B39"></td><td bgcolor="#0B2F3A"></td><td bgcolor="#0B243B"></td><td bgcolor="#0B173B"></td><td bgcolor="#0B0B3B"></td><td bgcolor="#170B3B"></td><td bgcolor="#240B3B"></td><td bgcolor="#2F0B3A"></td><td bgcolor="#3B0B39"></td><td bgcolor="#3B0B2E"></td><td bgcolor="#3B0B24"></td><td bgcolor="#3B0B17"></td><td bgcolor="#1C1C1C"></td></tr>
 <tr><td bgcolor="#2A0A0A"></td><td bgcolor="#2A120A"></td><td bgcolor="#2A1B0A"></td><td bgcolor="#29220A"></td><td bgcolor="#292A0A"></td><td bgcolor="#222A0A"></td><td bgcolor="#1B2A0A"></td><td bgcolor="#122A0A"></td><td bgcolor="#0A2A0A"></td><td bgcolor="#0A2A12"></td><td bgcolor="#0A2A1B"></td><td bgcolor="#0A2A22"></td><td bgcolor="#0A2A29"></td><td bgcolor="#0A2229"></td><td bgcolor="#0A1B2A"></td><td bgcolor="#0A122A"></td><td bgcolor="#0A0A2A"></td><td bgcolor="#120A2A"></td><td bgcolor="#1B0A2A"></td><td bgcolor="#220A29"></td><td bgcolor="#2A0A29"></td><td bgcolor="#2A0A22"></td><td bgcolor="#2A0A1B"></td><td bgcolor="#2A0A12"></td><td bgcolor="#000000"></td></tr>
 
</tbody></table>
<div id="status"></div>
 </div>
 
</div>

  




</body>
</html>
