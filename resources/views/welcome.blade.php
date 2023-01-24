<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Restaurant Google Map API</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link href="https://fonts.googleapis.com/css2?family=Sarabun:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800&display=swap" rel="stylesheet">

        <!-- Styles -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
        <!-- CSS -->
        <style>
            body {
                font-family: 'Sarabun', sans-serif;
            }
            .container-fluid , .row {
                padding-right : 0;
                padding-left : 0;
            }
            .col-sm-12 {
                margin-right : 0px;
                margin-left : 0px;
                padding-right : 0;
                padding-left : 0;
            }
            #map {
                height: 700px;
                width: 100%;
            }
            #pac-input {
                margin-top: 60px;
                margin-left : -160px;
                text-overflow: ellipsis;
                width: 85%;
            }
            li{
                cursor: pointer;
            }
        </style>
    </head>
        
    <body  >
        <div class="container-fluid text-center">
            <div class="row">
                {{-- START - tab แสดง map --}}
                <div class="form-group col-sm-12">    
                    <div class="col-sm-12" id="inputWrapper">
                        <input id="pac-input" class="form-control" type="text" placeholder="กรอกชื่อสถานที่ ที่ต้องการค้นหาร้านอาหารใกล้ๆสถานที่นั้นๆ">
                        <div id="map"></div>
                    </div>
                    <div class="card border-success mt-1 ms-5 me-4">
                        <div class="card-header bg-transparent border-success"><h2>ผลการค้นหา</h2></div>
                        <div class="card-body text-success text-start" id="places">
                        </div>
                        <div class="card-footer bg-transparent border-success"><button type="button" class="btn btn-success" id="more">กดโหลดข้อมูลเพิ่มเติม</button></div>
                    </div>
                </div>
                {{-- END - tab แสดง map --}}
                {{-- START - tab แสดง Carousel Slides --}}
                <div class="col-sm-12">
                    <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="false">
                        <div class="carousel-indicators">
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
                        </div>
                        <div class="carousel-inner" >
                            <div class="carousel-item active">
                                <img src="/1.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Restaurant Google Map API</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="/2.png" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Restaurant Google Map API</h5>
                                </div>
                            </div>
                            <div class="carousel-item">
                                <img src="/bg-map2.jpg" class="d-block w-100" alt="...">
                                <div class="carousel-caption d-none d-md-block">
                                    <h5>Restaurant Google Map API</h5>
                                </div>
                            </div>
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>
                    </div>
                </div>
                {{-- END - tab แสดง Carousel Slides --}}
            </div>
        </div>
    </body>

    <!-- Script -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.min.js" integrity="sha384-cuYeSxntonz0PPNlHhBs68uyIAVpIIOZZ5JqeqvYYIcEL727kskC66kF92t6Xl2V" crossorigin="anonymous"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB6PRsXrRZ7USwt7WuQV4hMaNhkdS3nc0k&libraries=places"
         async defer></script>
    <script type="text/javascript">
        // This example requires the Places library. Include the libraries=places
        // parameter when you first load the API. For example:
        // <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_API_KEY&libraries=places">
        $( document ).ready(function() {
            // alert(localStorage.getItem("lat"));
            // alert(localStorage.getItem("lng"));
            if(localStorage.getItem("lat")){
                initMap(parseFloat(localStorage.getItem("lat")),parseFloat(localStorage.getItem("lng")));
            }else{
                initMap(13.827768187155309,100.52896139818492);
            }
        });
        function initMap(vlat,vlng) {
            // Create the map.
            const pyrmont = { lat: vlat, lng: vlng };
            const map = new google.maps.Map(document.getElementById("map"), {
                center: pyrmont,
                zoom: 17,
                mapId: "roadmap",
            });

            // Create the search box and link it to the UI element.
            var input = document.getElementById('pac-input');
            var searchBox = new google.maps.places.SearchBox(input);
            map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);

            // Create the places service.
            const service = new google.maps.places.PlacesService(map);
            let getNextPage;
            const moreButton = document.getElementById("more");

            moreButton.onclick = function () {
                moreButton.disabled = true;
                if (getNextPage) {
                getNextPage();
                }
            };

            // Perform a nearby search.
            service.nearbySearch(
                { location: pyrmont, radius: 500, type: "restaurant" },
                (results, status, pagination) => {
                if (status !== "OK" || !results) return;

                addPlaces(results, map);
                moreButton.disabled = !pagination || !pagination.hasNextPage;
                if (pagination && pagination.hasNextPage) {
                    getNextPage = () => {
                    // Note: nextPage will call the same handler function as the initial call
                    pagination.nextPage();
                    };
                }
                }
            );

            // more details for that place.
            var markers = [];
            searchBox.addListener('places_changed', function() {
                var places = searchBox.getPlaces();
                if (places.length == 0) {
                    return;
                }
                // Clear out the old markers.
                markers.forEach(function(marker) {
                    marker.setMap(null);
                });
                markers = [];
                // For each place, get the icon, name and location.
                var bounds = new google.maps.LatLngBounds();
                places.forEach(function(place) {
                    if (!place.geometry) {
                        console.log("Returned place contains no geometry");
                        return;
                    }
                    var icon = {
                        size: new google.maps.Size(71, 71),
                        origin: new google.maps.Point(0, 0),
                        anchor: new google.maps.Point(17, 34),
                        scaledSize: new google.maps.Size(25, 25)
                    };
                    if (place.geometry.viewport) {
                    // Only geocodes have viewport.
                    bounds.union(place.geometry.viewport);
                    } else {
                    bounds.extend(place.geometry.location);
                    }
                });
                map.fitBounds(bounds);
                var ne = bounds.getNorthEast();
                // $('#places').html('');
                // initMap(ne.lat(),ne.lng());
                localStorage.setItem("lat", ne.lat());
                localStorage.setItem("lng", ne.lng());
                setTimeout(function(){
                    location.reload();
                }, 500);
            });
            
        }

        // แสงสถานที่
        function addPlaces(places, map) {
            const placesList = document.getElementById("places");
            for (const place of places) {
                if (place.geometry && place.geometry.location) {
                const image = {
                    url: place.icon,
                    size: new google.maps.Size(71, 71),
                    origin: new google.maps.Point(0, 0),
                    anchor: new google.maps.Point(17, 34),
                    scaledSize: new google.maps.Size(25, 25),
                };

                new google.maps.Marker({
                    map,
                    icon: image,
                    title: place.name,
                    position: place.geometry.location,
                });

                const li = document.createElement("li");

                li.textContent = place.name+' ที่ตั้ง : '+place.vicinity;
                placesList.appendChild(li);
                    li.addEventListener("click", () => {
                        map.setCenter(place.geometry.location);
                    });
                }
                console.log(place);
            }
        }
        window.initMap = initMap;

        
    </script>
    
</html>
