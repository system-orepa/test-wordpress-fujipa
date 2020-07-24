// JavaScript Document
$(function(){
	initMap();
});     
        
function initMap() {
  var latlng = new google.maps.LatLng(34.856718, 137.240619);
  var myOptions = {
    zoom: 17,
    center: latlng,
    mapTypeId: google.maps.MapTypeId.ROADMAP,
    scrollwheel: false 
  };
  var map = new google.maps.Map(document.getElementById('map'), myOptions);

  var m_latlng1 = new google.maps.LatLng(34.856718, 137.240619);
  var marker1 = new google.maps.Marker({
    position: m_latlng1,
    map: map
  });
}