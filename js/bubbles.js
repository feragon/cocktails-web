function bubbles() {
	
	for(var i = 0; i < 30; i++) {
		
		var tailleRdm = Math.floor(Math.random() * (25)) + 5;
		var transpRdm = (Math.random() * (0.8) + 0.2).toFixed(2);
		var marginRdm = 20*i;
		var startRdm = (Math.random() * (3)).toFixed(2);
		var speedRdm = (Math.random() * (1) + 2).toFixed(2);
		
		$('#bubbles_box').append("<span style='width: "+tailleRdm+"px; height: "+tailleRdm+"px; background: rgba(0,150,136,"+transpRdm+"); margin-left: "+marginRdm+"px; animation: bubbles "+speedRdm+"s ease-in-out "+startRdm+"s infinite;'></span>");
	}
}

bubbles();