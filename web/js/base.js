(function() {
  var Api, Init, Main, Menu, Truck, root;
  var __indexOf = Array.prototype.indexOf || function(item) {
    for (var i = 0, l = this.length; i < l; i++) {
      if (this[i] === item) return i;
    }
    return -1;
  }, __bind = function(fn, me){ return function(){ return fn.apply(me, arguments); }; };
  Api = (function() {
    function Api(app) {
      this.app = app;
      this.gateway = '';
      this.endpoints = {
        find_all: 'api/trucks',
        find_nearest: 'api/truck/'
      };
    }
    Api.prototype.fetch = function(endpoint, args, cb) {
      var on_success, opts, url;
      url = this.gateway + this.endpoints[endpoint];
      if (__indexOf.call(args, 'id') >= 0) {
        url += args['id'];
        args.splice('id', 1);
      }
      if (args.length) {
        url += "?" + $.params(args);
      }
      console.log("Requesting: " + url);
      on_success = __bind(function(data, textSTatus, jqXHR) {
        if (data.status !== 'fail') {
          return cb(data.data, this.app);
        }
      }, this);
      opts = {
        url: url,
        dataType: 'json',
        success: on_success
      };
      return $.ajax(opts);
    };
    return Api;
  })();
  root = typeof exports !== "undefined" && exports !== null ? exports : this;
  Main = (function() {
    function Main() {
      this.do_action = __bind(this.do_action, this);
      this.on_position_failed = __bind(this.on_position_failed, this);
      this.on_position = __bind(this.on_position, this);      var $map_canvas, info_opts;
      console.log("Food Truck App Initialized");
      this.opts = {
        default_latlng: new google.maps.LatLng(21.466, -157.9833),
        gmap_dom_id: "#map_canvas",
        menu_dom_id: "#mainmenu"
      };
      this.menu = null;
      this.gmap = null;
      this.trucks = [];
      this.user_marker = null;
      this.geo_cb = null;
      this.info_window = null;
      this.menu = new Menu(this.opts['menu_dom_id'], this);
      $map_canvas = $(this.opts['gmap_dom_id']);
      if ($map_canvas) {
        this.init_map($map_canvas[0]);
      }
      info_opts = {
        content: "blah",
        maxWidth: 200
      };
      this.info_window = new google.maps.InfoWindow(info_opts);
      this.api_interface = new Api(this);
    }
    Main.prototype.init_map = function(canvas) {
      var geo, geo_cb, my_opts;
      console.log("Map Initialized");
      my_opts = {
        zoom: 10,
        center: this.opts['default_latlng'],
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        disableDefaultUI: true,
        zoomControl: true,
        zoomControlOptions: {
          position: google.maps.ControlPosition.LEFT_BOTTOM,
          style: google.maps.ZoomControlStyle.SMALL
        }
      };
      this.gmap = new google.maps.Map(canvas, my_opts);
      geo_cb = false;
      if (navigator.geolocation) {
        console.log("Trying W3C Geolocation");
        geo_cb = navigator.geolocation;
      } else if (google.gears) {
        console.log("Trying Google Gears Geolocation");
        geo = google.gears.factor.create('beta.geolocation');
        geo_cb = geo;
      } else {
        console.log("No Geolocation, Sad PANDA");
      }
      if (geo_cb) {
        return this.init_user_marker(geo_cb);
      }
    };
    Main.prototype.init_user_marker = function(geo_cb) {
      var opts;
      opts = {
        position: this.opts['default_latlng'],
        map: this.gmap,
        visible: false,
        animation: google.maps.Animation.DROP
      };
      this.user_marker = new google.maps.Marker(opts);
      this.geo_cb = geo_cb;
      return this.geo_cb.getCurrentPosition(this.on_position, this.on_position_failed);
    };
    Main.prototype.on_position = function(position) {
      var loc;
      console.log("geo_cb success!");
      loc = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
      this.user_marker.setPosition(loc);
      this.user_marker.setVisible(true);
      return this.gmap.setCenter(loc);
    };
    Main.prototype.on_position_failed = function() {
      return console.log("geo_cb failed");
    };
    Main.prototype.do_action = function(action) {
      var cb;
      switch (action) {
        case "find_all":
          cb = function(data, app) {
            return app.mark_trucks(data);
          };
          return this.api_interface.fetch('find_all', {}, cb);
        case "find_nearest":
          return console.log("Not implemented yet");
        default:
          return console.log("Not implemented yet");
      }
    };
    Main.prototype.mark_trucks = function(trucks) {
      var i, v, _;
      console.log("Marking Trucks");
      console.log(trucks);
      google.maps.event.clearListeners(this.gmap, 'click');
      _ = (function() {
        var _i, _len, _ref, _results;
        _ref = this.trucks;
        _results = [];
        for (_i = 0, _len = _ref.length; _i < _len; _i++) {
          v = _ref[_i];
          _results.push(v.clear());
        }
        return _results;
      }).call(this);
      return this.trucks = (function() {
        var _len, _results;
        _results = [];
        for (i = 0, _len = trucks.length; i < _len; i++) {
          v = trucks[i];
          _results.push(new Truck(i, v, this));
        }
        return _results;
      }).call(this);
    };
    Main.prototype.open_truck = function(i) {
      if (i < 0) {
        i = this.trucks.length - 1;
      } else if (i > this.trucks.length - 1) {
        i = 0;
      }
      return google.maps.event.trigger(this.trucks[i].marker, 'click');
    };
    return Main;
  })();
  root.foodtruckapp = Main;
  Init = function() {
    var app;
    app = new Main();
    return app.do_action('find_all');
  };
  $(document).ready(function() {
    return Init();
  });
  Menu = (function() {
    function Menu(root, app) {
      this.root = root;
      this.app = app;
      this.on_click = __bind(this.on_click, this);
      this.toggle_menu = __bind(this.toggle_menu, this);
      this.menu = $("ul", this.root);
      this.toggle = $("#menutoggle", this.root);
      this.toggle.click(this.toggle_menu);
      $("a", this.menu).click(this.on_click);
    }
    Menu.prototype.toggle_menu = function(e) {
      this.menu.slideToggle();
      return false;
    };
    Menu.prototype.on_click = function(e) {
      var $link, action;
      $link = $(e.target);
      action = $link.attr('href').split('#');
      this.app.do_action(action[1]);
      return false;
    };
    return Menu;
  })();
  Truck = (function() {
    function Truck(id, data, app) {
      this.id = id;
      this.data = data;
      this.app = app;
      this.on_click = __bind(this.on_click, this);
      this.marker = null;
      this.init();
    }
    Truck.prototype.init = function() {
      var opts;
      opts = {
        position: new google.maps.LatLng(this.data.lat, this.data.lng),
        map: this.app.gmap,
        icon: this.get_icon(),
        animation: google.maps.Animation.DROP
      };
      this.marker = new google.maps.Marker(opts);
      return google.maps.event.addListener(this.marker, 'click', this.on_click);
    };
    Truck.prototype.get_icon = function() {
      return "images/truck.png";
    };
    Truck.prototype.on_click = function() {
      this.app.info_window.setContent(this.info_content());
      return this.app.info_window.open(this.app.gmap, this.marker);
    };
    Truck.prototype.info_content = function() {
      var $container, $more_info, $next, $prev, $ret;
      $ret = $('<div>');
      $ret.html('<h2>' + this.data.info + '</h2><p>Stuff stuff Stuff</p>');
      $container = $('<div>');
      $container.css({
        width: '100%'
      });
      $prev = $('<a>', {
        href: '#prev',
        title: 'Prev',
        html: '&laquo;Prev'
      });
      $next = $('<a>', {
        href: '#next',
        title: 'Next',
        html: 'Next&raquo'
      });
      $more_info = $('<a>', {
        href: '#more',
        title: 'Info',
        html: 'Info'
      });
      $().add($prev).add($next).add($more_info).css({
        display: 'block',
        width: '33%',
        float: 'left',
        textAlign: 'center'
      });
      $more_info.click(__bind(function(e) {
        this.app.open_truck_info(this.id - 1);
        return false;
      }, this));
      $prev.click(__bind(function(e) {
        this.app.open_truck(this.id - 1);
        return false;
      }, this));
      $next.click(__bind(function(e) {
        this.app.open_truck(this.id + 1);
        return false;
      }, this));
      $container.append($prev, $more_info, $next);
      $ret.append($container);
      return $ret[0];
    };
    Truck.prototype.clear = function() {
      this.marker.setMap(null);
      return this.app = null;
    };
    return Truck;
  })();
}).call(this);
