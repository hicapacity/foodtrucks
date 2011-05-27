/* From Javascript the Good Parts */
Function.prototype.method = function (name, func) {
	this.prototype[name] = func;
	return this;
};

var foodtruckapp = function(){};

foodtruckapp.method('init', function(){
	console.log("Food Truck App Initialized");
	var that = this;

	this.defaultLatLng = new google.maps.LatLng(21.466, -157.9833);
	/* Initialize Menu */
	this.$menu = $("#mainmenu ul");
	this.$menutoggle = $("#mainmenu #menutoggle");
	this.$menutoggle.click(function(e){
		console.log("Menu Clicked");
		that.$menu.slideToggle();
		return false;
	});

	/* Initialize Google Maps */
	var $map_canvas = $("#map_canvas");
	if ($map_canvas){
		this.init_map($map_canvas[0]);
	}
});

foodtruckapp.method('init_map', function(canvas){
	console.log("Map Initialized");
	var myOptions = {
		zoom: 8,
		center: this.defaultLatLng,
		mapTypeId: google.maps.MapTypeId.ROADMAP,
		disableDefaultUI: true,
		zoomControl: true,
		zoomControlOptions: {
			position: google.maps.ControlPosition.LEFT_BOTTOM,
			style: google.maps.ZoomControlStyle.SMALL
		},
		__: true
	};
	this.gmap = new google.maps.Map(canvas, myOptions);

	var initialLocation = this.defaultLatLng;
	var browserSupportFlag;
	// Try W3C Geolocation (Preferred)
	if(navigator.geolocation) {
		console.log("Trying W3C Geolocation");
		browserSupportFlag = true;
		navigator.geolocation.getCurrentPosition(function(position) {
			initialLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
		}, function() {
		});
	// Try Google Gears Geolocation
	} else if (google.gears) {
		console.log("Trying Google Gears Geolocation");
		browserSupportFlag = true;
		var geo = google.gears.factory.create('beta.geolocation');
		geo.getCurrentPosition(function(position) {
			initialLocation = new google.maps.LatLng(position.latitude,position.longitude);
		}, function() {
		});
	// Browser doesn't support Geolocation
	} else {
		console.log("No Geolocation, Sad Panda");
		browserSupportFlag = false;
	}
	this.gmap.setCenter(initialLocation);
	if (browserSupportFlag){
		this.user_marker = new google.maps.Marker({
			position: initialLocation,
			map: this.gmap
		});
	}
});

$(document).ready(function(){
	var fta = new foodtruckapp();
	fta.init();
});

