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

	on_click: () =>
		@app.info_window.setContent @info_content()
		@app.info_window.open @app.gmap, @marker

	info_content: () ->
		$ret = $ '<div>'
		$ret.html '<h2>' + @data.info + '</h2><p>Stuff stuff Stuff</p>'
		$container = $ '<div>'
		$container.css {width: '100%'}
		$prev = $ '<a>', {
			href: '#prev',
			title: 'Prev',
			html: '&laquo;Prev',
		}
		$next = $ '<a>', {
			href: '#next',
			title: 'Next',
			html: 'Next&raquo',
		}
		$more_info = $ '<a>', {
			href: '/truck/id/' + @data.id,
			title: 'Info',
			html: 'Info',
		}
		$().add($prev).add($next).add($more_info).css {
			display: 'block',
			width: '33%',
			float: 'left',
			textAlign: 'center',
		}
		$more_info.click (e) =>
			@app.open_truck_info @id-1
			false
		$prev.click (e) =>
			@app.open_truck @id-1
			false
		$next.click (e) =>
			@app.open_truck @id+1
			false
		$container.append $prev, $more_info, $next
		$ret.append $container
		$ret[0]

	clear: () ->
		@marker.setMap null
		@app = null

root = exports ? @
unless root.foodtruckapp
	root.foodtruckapp = {}
root.foodtruckapp.Truck = Truck
