/* Hacking this file:
 * Everything lives in the foodtruckapp. namespace.
 * Please don't pollute the global scope.
 * The only thing bad I do is add to the Function prototype,
 * but that's recommended by Crockford. So there.
 */

/* From Javascript the Good Parts */
Function.prototype.method = function (name, func) {
	this.prototype[name] = func;
	return this;
};

/* This is our main namespace */
var foodtruckapp = function(){};

foodtruckapp.method('init', function(){
	/* Initialize the foodtruck client app */
	console.log("Food Truck App Initialized");
	var that = this; // <3 js closures (joke)

	// App options
	this.opts = {};
	this.opts['default_latlng'] = new google.maps.LatLng(21.466, -157.9833);
	this.opts['gmap_dom_id'] = "#map_canvas";
	this.opts['menu_dom_id'] = "#mainmenu";

	// Sub-modules
	this.menu = null; // Object controlling menu
	this.gmap = null; // google.map
	this.trucks = []; // list of foodtruckapp.Trucks
	this.user_marker = null; // google.map.Marker for user location
	this.geo_cb = null; // Callback to fetch user geo location
	this.info_window = null; // google.map.InfoWindow for truck popup

	/* Initialize Menu */
	this.menu = new foodtruckapp.MenuInterface(this.opts['menu_dom_id'], this);

	/* Initialize Google Maps */
	var $map_canvas = $(this.opts['gmap_dom_id']);
	if ($map_canvas){
		this.init_map($map_canvas[0]);
	}

	/* Initialize InfoWindow */
	this.info_window = new google.maps.InfoWindow({
		content: "blah",
		maxWidth: 200
	});

	/* Initialize Api Interface */
	this.api_interface = new foodtruckapp.ApiInterface(this);
});

foodtruckapp.method('init_map', function(canvas){
	/* Initialize google map and store it in this.gmap */
	console.log("Map Initialized");
	var myOptions = {
		zoom: 10,
		center: this.opts['default_latlng'],
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
	this.gmap.setCenter(this.opts['default_latlng']);
	var that = this;

	var geo_cb;
	if(navigator.geolocation) {
		console.log("Trying W3C Geolocation");
		geo_cb = navigator.geolocation;
	} else if (google.gears) {
		console.log("Trying Google Gears Geolocation");
		var geo = google.gears.factory.create('beta.geolocation');
		geo_cb = geo;
	} else {
		console.log("No Geolocation, Sad Panda");
	}
	if (geo_cb){
		this.init_user_marker(geo_cb);
	}
});

foodtruckapp.method('init_user_marker', function(geo_cb){
	var that = this;
	this.user_marker = new google.maps.Marker({
		position: this.defaultLatLng,
		map: this.gmap,
		visible: false,
		animation: google.maps.Animation.DROP
	});
	this.geo_cb = geo_cb;
	this.geo_cb.getCurrentPosition(function(position) {
			console.log("geo_cb success!");
			var loc = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
			that.user_marker.setPosition(loc);
			that.user_marker.setVisible(true);
			that.gmap.setCenter(loc);
		}, function() {
			console.log("geo_cb failed?");
		}
	);
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

foodtruckapp.method('open_truck', function(i){
	/* Find truck via internal id and open it */
	if (i < 0){
		i = this.trucks.length - 1;
	}else if (i > this.trucks.length - 1){
		i = 0;
	}
	google.maps.event.trigger(this.trucks[i].marker, 'click');
});

foodtruckapp.method('mark_trucks', function(trucks){
	var that = this;
	google.maps.event.clearListeners(this.gmap, 'click'); // WARNING, if we use any other
	                                                      // click listeners we'll have to
	                                                      // do this properly
	$(this.trucks).each(function(i, v){
		v.clear();
	});
	this.trucks = [];
	$(trucks).each(function(i, v){
		that.trucks.push(new foodtruckapp.Truck(i, v, that));
	});
});

foodtruckapp.MenuInterface = function($mainmenu, app){
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

foodtruckapp.ApiInterface = function(app){
	this.app = app;
	this.gateway = ''; //or 'http://domain/';
	this.endpoints = {
		'find_all':'api/trucks',
		'find_nearest':'api/truck/'
	};
};

foodtruckapp.ApiInterface.method('fetch', function(endpoint, args, cb){
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

foodtruckapp.Truck = function(i, spec, app){
	this.id = i;
	this.app = app;
	this.data = spec;
	this.marker = null;
	this.init();
};

foodtruckapp.Truck.method('init', function(){
	var that = this;
	var t_latlng = new google.maps.LatLng(this.data.lat, this.data.lng);
	this.marker = new google.maps.Marker({
		position: t_latlng,
		map: this.app.gmap,
		icon: this.get_icon(),
		animation: google.maps.Animation.DROP
	});
	google.maps.event.addListener(this.marker, 'click', function(){
		that.onclick();
	});
});

foodtruckapp.Truck.method('get_icon', function(){
	var img = "images/truck.png";
	return img;
});

foodtruckapp.Truck.method('onclick', function(){
	var app = this.app;
	app.info_window.setContent(this.info_content());
	app.info_window.open(app.gmap, this.marker);
});

foodtruckapp.Truck.method('info_content', function(){
	var that = this;
	var $ret = $('<div>');
	$ret.html(this.data.info);
	var $container = $('<div>');
	$container.css({
		'width': '100%'
	});
	var $prev = $('<a>', {
		href: '#prev',
		title: 'Prev',
		html: '&laquo;Prev'
	});
	var $next = $('<a>', {
		href: '#next',
		title: 'Next',
		html: 'Next&raquo;'
	});
	var $more_info = $('<a>', {
		href: '#more',
		title: 'Info',
		html: 'Info'
	});
	$().add($prev).add($next).add($more_info).css({
		'display': 'block',
		'width': '33%',
		'float': 'left',
		'text-align': 'center'
	});
	$more_info.click(function(e){
		that.app.open_truck_info(that.id-1);
		return false;
	});
	$prev.click(function(e){
		that.app.open_truck(that.id-1);	
		return false;
	});
	$next.click(function(e){
		that.app.open_truck(that.id+1);	
		return false;
	});
	$container.append($prev, $more_info, $next);
	$ret.append($container);
	return $ret[0];
});

foodtruckapp.Truck.method('clear', function(){
	/* Remove marker and clear references */
	this.marker.setMap(null);
	this.app = null;
});

$(document).ready(function(){
	var fta = new foodtruckapp();
	fta.init();

	//let's add all trucks right now
	fta.do_action('find_all');
});

