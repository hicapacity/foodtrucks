`function mysqlTimeStampToDate(timestamp) {
    //function parses mysql datetime string and returns javascript Date object
    //input has to be in this format: 2007-06-05 15:26:02
    var regex=/^([0-9]{2,4})-([0-1][0-9])-([0-3][0-9]) (?:([0-2][0-9]):([0-5][0-9]):([0-5][0-9]))?$/;
    var parts=timestamp.replace(regex,"$1 $2 $3 $4 $5 $6").split(' ');
    return new Date(Date.UTC(parts[0],parts[1]-1,parts[2],parts[3],parts[4],parts[5]));
  }
`
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
		"images/StreetgrindzMapLogo.png"

	on_click: () =>
		@app.info_window.setContent @info_content()
		@app.info_window.open @app.gmap, @marker
		@app.gmap.panTo @marker.getPosition()

	info_content: () ->
		@offset = 10
		@truck_open = mysqlTimeStampToDate @data.start
		@truck_close = mysqlTimeStampToDate @data.end

		if @truck_open.getHours() > 12
			@truck_open.setHours(@truck_open.getHours() - 12)
			@truck_open_ampm = "PM"
		else
			@truck_open_ampm = "AM"

		if @truck_close.getHours() > 12
                        @truck_close.setHours(@truck_close.getHours() - 12)
                        @truck_close_ampm = "PM"
                else
                        @truck_close_ampm = "AM"

		if @truck_open.getMinutes() == 0
			@truck_open_mins = "00"
		else
			@truck_open_mins = @truck_open.getMinutes()
		
		if @truck_close.getMinutes() == 0
                        @truck_close_mins = "00"
                else
                        @truck_close_mins = @truck_close.getMinutes()
                

		@truck_open_time = @truck_open.getHours() + ":" + @truck_open_mins + " " + @truck_open_ampm
		@truck_close_time = @truck_close.getHours() + ":" + @truck_close_mins + " " + @truck_close_ampm
		$icon = $ '<img>', {
            src: @data.icon_url,     
        }
		$ret = $ '<div>'

		#$ret.html '<img style="float: left; margin: 0px 10px 0 0px;" width="48" height="48" src="' + @data.icon_url + '"/>' + @data.name + '<br/><a href="http://twitter.com/' + @data.twitter_username + '">' + @data.twitter_username + '</a><p>Hours: ' + @truck_open_time + ' - ' + @truck_close_time + '</p><p id="data_info">' + data_info + '</p>'
		$truck_picture = $ '<img>', {
			width: 48,
			height: 48,
			src: @data.icon_url
		}
		$truck_picture.css {
			float: 'left',
			margin: '0px 10px 0 0px'
		}

		$ret.append $truck_picture
		$truck_meta = @data.name + '<br/><a href="http://twitter.com/' + @data.twitter_username + '">' + @data.twitter_username + '</a><p>Hours: ' + @truck_open_time + ' - ' + @truck_close_time + '</p>'
		$ret.append $truck_meta
		
		$data_info_split = @data.info.trim().split(' ')

		if ($data_info_split.length > 15)
			$data_info = @data.info.trim().split(' ').slice(0, 15).join(' ')
		else 
			$data_info = @data.info

		$truck_info = $ '<p>', {
			html: $data_info
		}

		$info_more = $ '<a>', {
			href: '#',
			title: 'More',
			html: 'More'	
		}
		$info_more.click (e) => 
			$truck_info.text @data.info
			google.maps.event.trigger(@app.info_window, 'content_changed');
			false

		if ($data_info_split.length > 15)
			$truck_info.append('...<br/>')
			$truck_info.append $info_more

		$ret.append $truck_info

		$container = $ '<div>'
		$container.css {width: '100%'}
		$menu_link = $ '<a>', {
			href: @data.menu_url,
			title: 'Menu',
			html: 'Menu'
		}
		$menu_link.click (e) =>
			@app.open_truck_info @id-1
			false
		$container.append $menu_link
		$ret.append $container
		$ret[0]

	clear: () ->
		@marker.setMap null
		@app = null

root = exports ? @
unless root.foodtruckapp
	root.foodtruckapp = {}
root.foodtruckapp.Truck = Truck
