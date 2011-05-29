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

	this.truck_markers = [];

	/* Initialize Menu */
	this.menu = new foodtruckapp.menu_interface($("#mainmenu"), this);

	this.gmap = null;
	/* Initialize Google Maps */
	var $map_canvas = $("#map_canvas");
	if ($map_canvas){
		this.init_map($map_canvas[0]);
	}

	this.info_window = new google.maps.InfoWindow({
		content: "blah",
		maxWidth: 200
	});

	/* Initialize Api Interface */
	this.api_interface = new foodtruckapp.api_interface(this);
});

foodtruckapp.method('init_map', function(canvas){
	console.log("Map Initialized");
	var myOptions = {
		zoom: 10,
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

foodtruckapp.method('do_action', function(action){
	switch (action){
		case "find_all":
			var cb = function(data, app){
				app.mark_trucks(data);
			};
			this.api_interface.fetch('find_all', {}, cb);
			break;
		case "find_nearest":
			console.log("Not implemented yet");
			break;
		default:
			console.log("Not implemented yet");
			break;
	};
});

foodtruckapp.method('mark_trucks', function(trucks){
	$(this.truck_markers).each(function(i, v){
		v.setMap(null);
	});
	this.truck_markers = [];
	var that = this;
	var img = "images/truck.png";
	$(trucks).each(function(i, v){
		var t_latlng = new google.maps.LatLng(v.lat, v.lng);
		var truck = new google.maps.Marker({
			position: t_latlng,
			map: that.gmap,
			icon: img,
		});
		truck._data = v;
		that.truck_markers.push(truck);
		google.maps.event.addListener(truck, 'click', function(){
			that.truck_onclick(truck);
		});
	});
});

foodtruckapp.method('truck_onclick', function(truck){
	this.info_window.setContent(truck._data.info);
	this.info_window.open(this.gmap, truck);
});

foodtruckapp.menu_interface = function($mainmenu, app){
	var that = this;
	this.app = app;
	this.$menu = $("ul", $mainmenu);
	this.$toggle = $("#menutoggle", $mainmenu);
	this.$toggle.click(function(e){
		console.log("Menu Clicked");
		that.$menu.slideToggle();
		return false;
	});
	$("a", this.$menu).click(function(e){
		var $link = $(e.target);
		var action = $link.attr('href').split("#")[1];
		that.app.do_action(action);
		return false;
	});
};

foodtruckapp.api_interface = function(app){
	this.app = app;
	this.gateway = ''; //or 'http://domain/';
	this.endpoints = {
		'find_all':'api/trucks',
		'find_nearest':'api/truck/'
	};
};

foodtruckapp.api_interface.method('fetch', function(endpoint, args, cb){
	var url = this.gateway + this.endpoints[endpoint];
	if('id' in args){
		url += args['id'];
		args.splice('id', 1);
	};
	if(args.length){
		url += "?" + $.param(args);
	};
	console.log("Requesting: " + url);
	var that = this;
	$.ajax({
		url: url,
		dataType: 'json',
		success: function(data, textStatus, jqXHR){
			if (data.status != 'fail'){
				cb(data.data, that.app);
			}	
		}
	});
});

$(document).ready(function(){
	var fta = new foodtruckapp();
	fta.init();

	//let's add all trucks right now
	fta.do_action('find_all');
});

