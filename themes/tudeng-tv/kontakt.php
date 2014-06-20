<?php
/*
Template Name: Kontakt
*/
get_header(); ?>

<script src="http://maps.googleapis.com/maps/api/js?key=AIzaSyDY0kkJiTPVd2U7aTOAwhc9ySH6oHxOIYM&sensor=false">
</script>

<script>
	var myCenter=new google.maps.LatLng(59.4394, 24.7718);

	function initialize()
	{
		var mapProp = {
			center:myCenter,
			zoom:17,
			mapTypeId:google.maps.MapTypeId.ROADMAP
		};

		var map=new google.maps.Map(document.getElementById("googleMap"),mapProp);

		var marker=new google.maps.Marker({
			position:myCenter,
		});

		marker.setMap(map);
	}

	google.maps.event.addDomListener(window, 'load', initialize);
</script>


	<hr>				
		<div id="contact_text"> 
			<p>Tudeng TV on mittetulundusühing, mille eesmärgiks on televisiooni kaudu noorte harimine ja neile info edastamine. 
			Meie kanalit näeb internetis, sest just see on noortele kõige mugavam variant. 
			Kuigi meie stuudiod asuvad Balti Filmi- ja Meediakoolis, oleme üle-Eestiline organisatsioon.</p>
			<br>
			<p>Kui sul on meile küsimusi, tahad meiega koostööd teha, tahad meie meeskonnaga liituda või 
			on sul mõni eriti lahe idee, võid meiega julhesti ühendust võtta - <b>info@tudeng.tv<b></p>
		</div>
		<div id="contact_map_intro">
			Leida võib meid siit :D
		</div>	
		<div id="googleMap" style="width: 100%;"></div>						


<?php get_footer(); ?>	