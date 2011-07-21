class Main
	constructor: () ->
		console.log "Food Truck App Initialized"
		@opts =
			default_latlng: new google.maps.LatLng(21.466, -157.9833)
			gmap_dom_id: "#map_canvas"

		@gmap = null
		@trucks = []
		@user_marker = null
		@geo_cb = null
		@info_window = null

		$map_canvas = $(@opts['gmap_dom_id'])
		if $map_canvas
			@init_map $map_canvas[0]

		info_opts =
			content: "blah"
			maxWidth: 200
		@info_window = new google.maps.InfoWindow info_opts


		@api_interface = new foodtruckapp.Api @

	init_map: (canvas) ->
		console.log "Map Initialized"
		my_opts =
			zoom: 13
			center: @opts['default_latlng']
			mapTypeId: google.maps.MapTypeId.ROADMAP
			disableDefaultUI: true
			zoomControl: true
			zoomControlOptions:
				position: google.maps.ControlPosition.LEFT_BOTTOM
				style: google.maps.ZoomControlStyle.SMALL
		@gmap = new google.maps.Map canvas, my_opts

		geo_cb = false
		if navigator.geolocation
			console.log "Trying W3C Geolocation"
			geo_cb = navigator.geolocation
		else if google.gears
			console.log "Trying Google Gears Geolocation"
			geo = google.gears.factor.create 'beta.geolocation'
			geo_cb = geo
		else
			console.log "No Geolocation, Sad PANDA"
		if geo_cb
			@init_user_marker geo_cb

	init_user_marker: (geo_cb) ->
		opts =
			position: @opts['default_latlng']
			map: @gmap
			visible: false
			animation: google.maps.Animation.DROP
		@user_marker = new google.maps.Marker opts
		@geo_cb = geo_cb
		@geo_cb.getCurrentPosition @on_position, @on_position_failed

	on_position: (position) =>
		console.log "geo_cb success!"
		loc = new google.maps.LatLng position.coords.latitude, position.coords.longitude
		@user_marker.setPosition loc
		@user_marker.setVisible true
		@gmap.setCenter loc

	on_position_failed: =>
		console.log "geo_cb failed"

	do_action: (action) =>
		switch action
			when "find_all"
				cb = (data, app) ->
					app.mark_trucks(data)
				@api_interface.fetch 'find_all', {}, cb
			when "find_nearest"
				console.log "Not implemented yet"
			else
				console.log "Not implemented yet"

	mark_trucks: (trucks) ->
		console.log "Marking Trucks"
		console.log trucks
		$('#trucks_open_count').html(trucks.length)
		document.title = "Streetgrindz " + trucks.length + " Trucks"
		google.maps.event.clearListeners @gmap, 'click'
		_ = (v.clear() for v in @trucks)	
		@trucks = (new foodtruckapp.Truck(i, v, @) for v, i in trucks)

	open_truck: (i) ->
		if i < 0
			i = @trucks.length - 1
		else if i > @trucks.length - 1
			i = 0
		google.maps.event.trigger @trucks[i].marker, 'click'

root = exports ? @
unless root.foodtruckapp
	root.foodtruckapp = {}
root.foodtruckapp.Main = Main

Init = () ->
	app = new foodtruckapp.Main()
	app.do_action 'find_all'
	$.fixedToolbars.setTouchToggleEnabled false;

$(document).ready ->
	Init()
