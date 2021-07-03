
			function initialize() {
			    var mapOptions = {
			        zoom: 18,
			        center: new google.maps.LatLng(45.470884, 9.193385),
			        mapTypeId: google.maps.MapTypeId.ROADMAP,
			        styles: [
			            [{
			                opt_textColor: '#FFFFFF'
			            }]
			        ],
			        mapstyles: [{
			                stylers: [{
			                    saturation: -100
			                }, {
			                    lightness: 0
			                }, {
			                    hue: '#333333'
			                }]
			            }, {
			                featureType: 'landscape.man_made',
			                elementType: 'geometry',
			                stylers: [{
			                    hue: '#333333'
			                }, {
			                    saturation: -100
			                }, {
			                    invert_lightness: true
			                }, {
			                    gamma: 1.29
			                }, {
			                    lightness: 2
			                }, {
			                    visibility: 'on'
			                }]
			            },

			            {
			                featureType: 'road',
			                elementType: 'geometry.stroke',
			                stylers: [{
			                        color: '#666666'
			                    },

			                    {
			                        weight: 2
			                    }, {
			                        visibility: 'on'
			                    }
			                ]
			            }

			            , {
			                featureType: 'road',
			                elementType: 'geometry.fill',
			                stylers: [{
			                        color: '#000000'
			                    },

			                    {
			                        visibility: 'on'
			                    }
			                ]
			            },


			            {
			                featureType: 'landscape.natural',
			                elementType: 'geometry',
			                stylers: [{
			                        color: '#262626'
			                    },

			                    {
			                        lightness: -42
			                    }
			                ]
			            }, {
			                featureType: 'all',
			                elementType: 'labels.text.fill',
			                stylers: [{
			                    color: '#ffffff'
			                }]
			            }


			            , {
			                featureType: 'all',
			                elementType: 'labels.text.stroke',
			                stylers: [{
			                    color: '#000000'
			                }]
			            }

			            , {
			                featureType: 'all',
			                elementType: 'labels.icon',
			                stylers: [{
			                        hue: '#333333'
			                    },

			                    {
			                        invert_lightness: true
			                    },

			                ]
			            }

			        ]
			    };

			    var styledMap = new google.maps.StyledMapType(mapOptions.mapstyles, {
			        name: "Styled Map"
			    });
			    var map = new google.maps.Map(document.getElementById('map-canvas'), mapOptions);

			    var marker = new google.maps.Marker({
			        position: mapOptions.center,
			        map: map,
			        icon: {
			            url: '../img/mark.png',
			            size: new google.maps.Size(50, 50)
			        }
			    });

			    map.mapTypes.set('map_style', styledMap);
			    map.setMapTypeId('map_style');
			}

			function loadScript() {
			    var script = document.createElement('script');
			    script.type = 'text/javascript';
			    script.src = 'https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&' + 'callback=initialize';
			    document.body.appendChild(script);
			}


			window.onload = loadScript;
