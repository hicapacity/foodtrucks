class Api
	constructor: (@app) ->
		@gateway = ''
		@endpoints =
			find_all: 'api/trucks'
			find_nearest: 'api/truck/'

	fetch: (endpoint, args, cb) ->
		url = @gateway + @endpoints[endpoint]
		if 'id' in args
			url += args['id']
			args.splice('id', 1)
		if args.length
			url += "?" + $.params(args)
		console.log "Requesting: " + url
		on_success = (data, textSTatus, jqXHR) =>
			if data.status != 'fail'
				cb(data.data, @app)
		opts =
			url: url
			dataType: 'json'
			success: on_success
		$.ajax(opts)

