
var placeSearch, autocomplete;

var componentForm = {
  street_number: 'short_name',
  route: 'long_name',
  locality: 'long_name',
  administrative_area_level_1: 'short_name',
  postal_code: 'short_name',
  country: 'long_name'
};

function initAutocomplete() {


  // Create the autocomplete object, restricting the search predictions to
  // geographical location types.

  var options = {
    types: ['geocode'],
    componentRestrictions: {country: 'au'}
    };
   
  autocomplete = new google.maps.places.Autocomplete(
  document.getElementById('address'), options);

  //alert("here");

  // Avoid paying for data that you don't need by restricting the set of
  // place fields that are returned to just the address components.
  autocomplete.setFields(['address_component']);

  // When the user selects an address from the drop-down, populate the
  // address fields in the form.
  autocomplete.addListener('place_changed', fillInAddress);
}


function fillInAddress() {
  // Get the place details from the autocomplete object.
  var place = autocomplete.getPlace();

  for (var component in componentForm) {
    document.getElementById(component).value = '';
    document.getElementById(component).disabled = false;
  }

  // Get each component of the address from the place details,
  // and then fill-in the corresponding field on the form.
  for (var i = 0; i < place.address_components.length; i++) {
    var addressType = place.address_components[i].types[0];


    if (componentForm[addressType]) {
      var val = place.address_components[i][componentForm[addressType]];

      // alert(addressType + " : " + val);
      document.getElementById(addressType).value = val;

      if(addressType == "postal_code")
      {
        address_str = document.getElementById('address').value;
        if(address_str.indexOf(val) != -1){
        }else{
          document.getElementById('address').value = document.getElementById('address').value + ", " + val;
        }
      }
    }
  }

  if(!place.geometry)
  {
    return;
  }else{
    document.getElementById('hidden_lat').value = place.geometry.location.lat();
    document.getElementById('hidden_long').value = place.geometry.location.lng();
  }
}

// Bias the autocomplete object to the user's geographical location,
// as supplied by the browser's 'navigator.geolocation' object.
function geolocate() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {

      var latitude = position.coords.latitude;
      var longitude = position.coords.longitude;
       //alert(latitude);
      // alert(longitude);

      var geolocation = {
        lat: latitude,
        lng: longitude
      };

      document.getElementById('hidden_lat').value = latitude;
      document.getElementById('hidden_long').value = longitude;

      var circle = new google.maps.Circle(
          {center: geolocation, radius: position.coords.accuracy});
      autocomplete.setBounds(circle.getBounds());
    });
  }
}