@extends('layouts.ekkaNoMenu')

@section('content')
<section class="ec-page-content ec-vendor-uploads ec-user-account section-space-p">
    <div class="container">
        <div class="row">
            <!-- Sidebar Area Start -->
            <div class="ec-shop-leftside ec-vendor-sidebar col-lg-3 col-md-12">
                <div class="ec-sidebar-wrap">
                    <!-- Sidebar Category Block -->
                    <div class="ec-sidebar-block">
                        <div class="ec-vendor-block">
                            <!-- <div class="ec-vendor-block-bg"></div>
                            <div class="ec-vendor-block-detail">
                                <img class="v-img" src="{{asset('ekka')}}/images/user/1.jpg" alt="vendor image">
                                <h5>Mariana Johns</h5>
                            </div> -->
                            <div class="ec-vendor-block-items">
                                <ul class="">
                                    <li class=""><a href="user-profile.html">User Profile</a></li>
                                    @if(count($childList) > 0)
                                    <li class=""><a href="{{url('manageChild')}}">Manage Child</a></li>
                                    @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="ec-shop-rightside col-lg-9 col-md-12">
                <div class="ec-vendor-dashboard-card ec-vendor-setting-card">
                    <div class="ec-vendor-card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="ec-vendor-block-profile">
                                    <div style="align-items: flex-end">
                                        <a href="javasript:void(0)" class="btn btn-primary" data-link-action="editmodal" title="Add Child" data-bs-toggle="modal" data-bs-target="#edit_modal">Add Child</a>
                                    </div>
                                    @forEach($childList as $child)
                                        <div class="row">
                                            <h2>{{$child->fname.' '.$child->lname}}</h2>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
                                                    <h5>First Name :</h5>
                                                    <h6>{{$child->fname}}</h6>
                                                </div>
                                            </div>
                                            <div class="col-md-6 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-email space-bottom-30">
                                                    <h5>Last Name :</h5>
                                                    <h6>{{$child->lname}} </h6>
                                                </div>
                                            </div>
                                            <div class="col-md-12 col-sm-12">
                                                <div class="ec-vendor-detail-block ec-vendor-block-contact space-bottom-30">
                                                    <h5>Grade :</h5>
                                                    <h6>{{$child->birthdate}}</h6>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<div class="modal fade" id="edit_modal" tabindex="-1" role="dialog">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-body">
                <div class="row">
                    <div class="">
                        <form class="row" action="{{route('addChild')}}" enctype="multipart/form-data" method="POST">
                            @csrf
                            @method('PUT')
                                <div class="ec-vendor-upload-detail">
                                    <div class="col-md-12 space-t-15">
                                        <label class="form-label">First name</label>
                                        <input type="text" name="fname"  class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Last name</label>
                                        <input type="text" name="lname"  class="form-control">
                                    </div>
                                    <div class="col-md-12">
                                        <label class="form-label">Birthdate</label>
                                        <input type="date" name="birthdate" class="form-control">
                                    </div>
                                    <br>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary">Add</button>
                                        <a href="#" class="btn btn-lg btn-secondary qty_close" data-bs-dismiss="modal"
                                            aria-label="Close">Close</a>
                                    </div>
                                </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
<script>
    "use strict";

    function initMap() {
        const map = new google.maps.Map(document.getElementById("map"), {
        center: { lat: 40.749933, lng: -73.98633 },
        zoom: 13,
        mapTypeControl: false,
        });
        const card = document.getElementById("pac-card");
        const input = document.getElementById("pac-input");
        const newAddress = document.getElementById("newAddress");
        const newLocation = document.getElementById("newLocation");
        const biasInputElement = document.getElementById("use-location-bias");
        const strictBoundsInputElement =
        document.getElementById("use-strict-bounds");
        const options = {
        fields: ["formatted_address", "geometry", "name"],
        strictBounds: false,
        types: ["establishment"],
        };

        map.controls[google.maps.ControlPosition.TOP_LEFT].push(card);

        const autocomplete = new google.maps.places.Autocomplete(
        input,
        options
        );

        // Bind the map's bounds (viewport) property to the autocomplete object,
        // so that the autocomplete requests use the current map bounds for the
        // bounds option in the request.
        autocomplete.bindTo("bounds", map);

        const infowindow = new google.maps.InfoWindow();
        const infowindowContent = document.getElementById("infowindow-content");

        infowindow.setContent(infowindowContent);

        const marker = new google.maps.Marker({
        map,
        anchorPoint: new google.maps.Point(0, -29),
        });

        autocomplete.addListener("place_changed", () => {
        infowindow.close();
        marker.setVisible(false);

        const place = autocomplete.getPlace();

        if (!place.geometry || !place.geometry.location) {
            // User entered the name of a Place that was not suggested and
            // pressed the Enter key, or the Place Details request failed.
            window.alert(
            "No details available for input: '" + place.name + "'"
            );
            return;
        }

        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(17);
        }

        // alert(place.geometry.location);
        newAddress.value = place.formatted_address;
        newLocation.value = place.geometry.location;

        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
        infowindowContent.children["place-name"].textContent = place.name;
        infowindowContent.children["place-address"].textContent =
            place.formatted_address;
        infowindow.open(map, marker);
        });

        // Sets a listener on a radio button to change the filter type on Places
        // Autocomplete.
        function setupClickListener(id, types) {
        const radioButton = document.getElementById(id);

        radioButton.addEventListener("click", () => {
            autocomplete.setTypes(types);
            input.value = "";
        });
        }

        setupClickListener("changetype-all", []);
        setupClickListener("changetype-address", ["address"]);
        setupClickListener("changetype-establishment", ["establishment"]);
        setupClickListener("changetype-geocode", ["geocode"]);
        setupClickListener("changetype-cities", ["(cities)"]);
        setupClickListener("changetype-regions", ["(regions)"]);
        biasInputElement.addEventListener("change", () => {
        if (biasInputElement.checked) {
            autocomplete.bindTo("bounds", map);
        } else {
            // User wants to turn off location bias, so three things need to happen:
            // 1. Unbind from map
            // 2. Reset the bounds to whole world
            // 3. Uncheck the strict bounds checkbox UI (which also disables strict bounds)
            autocomplete.unbind("bounds");
            autocomplete.setBounds({
            east: 180,
            west: -180,
            north: 90,
            south: -90,
            });
            strictBoundsInputElement.checked = biasInputElement.checked;
        }

        input.value = "";
        });
        strictBoundsInputElement.addEventListener("change", () => {
            autocomplete.setOptions({
                strictBounds: strictBoundsInputElement.checked,
            });
            if (strictBoundsInputElement.checked) {
                biasInputElement.checked = strictBoundsInputElement.checked;
                autocomplete.bindTo("bounds", map);
            }

            input.value = "";
        });
    }
</script>
<style>
   map {
  height: 100%;
}

/* 
  * Optional: Makes the sample page fill the window. 
  */
html,
body {
  height: 100%;
  margin: 0;
  padding: 0;
}

#description {
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
}

#infowindow-content .title {
  font-weight: bold;
}

#infowindow-content {
  display: none;
}

#map #infowindow-content {
  display: inline;
}

.pac-card {
  background-color: #fff;
  border: 0;
  border-radius: 2px;
  box-shadow: 0 1px 4px -1px rgba(0, 0, 0, 0.3);
  margin: 10px;
  padding: 0 0.5em;
  font: 400 18px Roboto, Arial, sans-serif;
  overflow: hidden;
  font-family: Roboto;
  padding: 0;
}

#pac-container {
  padding-bottom: 12px;
  margin-right: 12px;
}

.pac-controls {
  display: inline-block;
  padding: 5px 11px;
}

.pac-controls label {
  font-family: Roboto;
  font-size: 13px;
  font-weight: 300;
}

#pac-input {
  background-color: #fff;
  font-family: Roboto;
  font-size: 15px;
  font-weight: 300;
  margin-left: 12px;
  padding: 0 11px 0 13px;
  text-overflow: ellipsis;
  width: 400px;
}

#pac-input:focus {
  border-color: #4d90fe;
}

#title {
  color: #fff;
  background-color: #4d90fe;
  font-size: 25px;
  font-weight: 500;
  padding: 6px 12px;
}
</style>