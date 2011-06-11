class Menu
	constructor: (@root, @app) ->
		console.log "Menu Initialized"
		@menu = $("ul", @root)
		@toggle = $("#menutoggle", @root)

		@toggle.click @toggle_menu
		$("a", @menu).click @on_click

	toggle_menu: (e) =>
		@menu.slideToggle()
		false

	on_click: (e) =>
		$link = $(e.target)
		action = $link.attr('href').split '#'
		@app.do_action(action[1])
		false

root = exports ? @
unless root.foodtruckapp
	root.foodtruckapp = {}
root.foodtruckapp.Menu = Menu
