class Truck
	constructor: (@id, @data, @app) ->
		@marker = null
		@init()

	init: () ->
		opts =
			position: new google.maps.LatLng(@data.lat, @data.lng)
			map: @app.gmap
			icon: @get_icon()
			animation: google.maps.Animation.DROP
		@marker = new google.maps.Marker(opts)
		google.maps.event.addListener @marker, 'click', @on_click

	get_icon: () ->
		"images/truck.png"

	on_click: () ->
		@app.info_window.setContent @info_content()
		@app.info_window.open @app.gmap, @marker

	info_content: () ->
		"blah"
