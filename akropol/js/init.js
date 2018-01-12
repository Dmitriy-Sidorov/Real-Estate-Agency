function SingleYandexMap() {

  var $isObject = 0;
  var $isContact = 0;
  if(jQuery('.single-property .property_price').length > 0)
    $isObject = 1;
  else
    $isContact = 1;
  var myMap;
  // функция - собиралка карты и фигни
  var properties = [];
  if ($isObject) {
    // if (urlajax.is_property == 1) {
    properties.push({
      title: jQuery('.single-property').find('.property_address').text(),
      price: jQuery('.single-property').find('.property_price').html(),
      lat: jQuery('.single-property').find('.latitude').text(),
      lng: jQuery('.single-property').find('.longitude').text(),
      thumb: jQuery('.single-property').find('.property_image_map').text(),
      url: jQuery('.single-property').find('.property_url').text(),
      icon: jQuery('.single-property').find('.property_image_url').text()
    });
  } else {
    if ($isContact) {
      // if (urlajax.is_contact == 1) {
      properties.push({
        title: jQuery('.property_container').find('.property_address').text(),
        lat: jQuery('.property_container').find('.latitude').text(),
        lng: jQuery('.property_container').find('.longitude').text(),
        icon: jQuery('.property_container').find('.property_image_url').text()
      });
    }
    else {
      properties.push({
        lat: '10',
        lng: '10',
      });
    }
  }

  var property_zoom;
  if (0) {
    // if (urlajax.is_property == 1 || urlajax.is_contact == 1) {
    property_zoom = parseInt(jQuery('.property_zoom_level').attr('id'));
  }
  else {
    property_zoom = 15;
  }
  myMap = new ymaps.Map("onemap", { // создаем и присваиваем глобальной переменной карту и суем её в див с id="map"
    center: [properties[0].lat, properties[0].lng], // ну тут центр
    behaviors: ['default', 'scrollZoom'], // скроллинг колесом
    zoom: property_zoom // тут масштаб
  });
  myMap.controls // добавим всяких кнопок, в скобках их позиции в блоке
    .add('zoomControl', {left: 5, top: 5}) //Масштаб
    .add('typeSelector') //Список типов карты
  //.add('mapTools', { left: 35, top: 5 }) // Стандартный набор кнопок
  //.add('searchControl'); // Строка с поиском


  var ymarkers = new Array();
  for (var i = 0; i < properties.length; i++) {


    ymarkers[i] = new ymaps.Placemark(
      [properties[i].lat, properties[i].lng],
      {}, {
        iconLayout: 'default#image',
        iconImageHref: properties[i].icon,
        iconImageSize: [20, 30]
      }
    );
    myMap.geoObjects.add(ymarkers[i]);
  }


}
function SingleMap() {
  var properties = [];
  if (urlajax.is_property == 1) {
    properties.push({
      title: jQuery('.single-property').find('.property_address').text(),
      price: jQuery('.single-property').find('.property_price').html(),
      lat: jQuery('.single-property').find('.latitude').text(),
      lng: jQuery('.single-property').find('.longitude').text(),
      thumb: jQuery('.single-property').find('.property_image_map').text(),
      url: jQuery('.single-property').find('.property_url').text(),
      icon: jQuery('.single-property').find('.property_image_url').text()
    });
  } else {
    if (urlajax.is_contact == 1) {
      properties.push({
        title: jQuery('.property_container').find('.property_address').text(),
        lat: jQuery('.property_container').find('.latitude').text(),
        lng: jQuery('.property_container').find('.longitude').text(),
        icon: jQuery('.property_container').find('.property_image_url').text()
      });
    }
    else {
      properties.push({
        lat: '10',
        lng: '10',
      });
    }
  }
  var property_zoom;
  if (urlajax.is_property == 1 || urlajax.is_contact == 1) {
    property_zoom = parseInt(jQuery('.property_zoom_level').attr('id'));
  }
  else {
    property_zoom = 4;
  }
  var mapOptions = {
    zoom: property_zoom,
    center: new google.maps.LatLng(properties[0].lat, properties[0].lng),
    scrollwheel: false
  }
  var map = new google.maps.Map(document.getElementById("onemap"), mapOptions);
  var markers = new Array();
  var info_windows = new Array();
  for (var i = 0; i < properties.length; i++) {
    markers[i] = new google.maps.Marker({
      position: map.getCenter(),
      map: map,
      icon: properties[i].icon,
      title: properties[i].title,
      animation: google.maps.Animation.DROP
    });
    /*if (urlajax.is_contact == 1) {
     info_windows[i] = new google.maps.InfoWindow({
     content: '<div class="map-property">' +
     '<h4 class="property-title">' + properties[i].title + '</h4>' +
     '</div>'
     });
     } else {
     info_windows[i] = new google.maps.InfoWindow({
     content: '<div class="map-property">' +
     '<h4 class="property-title"><a class="title-link" href="' + properties[i].url + '">' + properties[i].title + '</a></h4>' +
     '<a class="property-featured-image" href="' + properties[i].url + '"><img class="property-thumb" src="' + properties[i].thumb + '" alt="' + properties[i].title + '"/></a>' +
     '<p><span class="price">' + properties[i].price + '</span></p>' +
     '<a class="btn btn-primary btn-sm" href="' + properties[i].url + '">Details</a>' +
     '</div>'
     });
     }*/
    attachInfoWindowToMarker(map, markers[i], info_windows[i]);
  }
  /* function to attach infowindow with marker */
  function attachInfoWindowToMarker(map, marker, infoWindow) {
    google.maps.event.addListener(marker, 'click', function () {
      infoWindow.open(map, marker);
    });
  }
}

function PropertiesMap() {
  var properties = [];
  jQuery('ul#property_grid_holder li').each(function (i) {
    properties.push({
      title: jQuery(this).find('.property_address').text(),
      price: jQuery(this).find('.property_price').html(),
      lat: jQuery(this).find('.latitude').text(),
      lng: jQuery(this).find('.longitude').text(),
      thumb: jQuery(this).find('.property_image_map').text(),
      url: jQuery(this).find('.property_url').text(),
      icon: jQuery(this).find('.property_image_url').text()
    });
  });
  var mapOptions = {
    zoom: 12,
    scrollwheel: false
  }
  var map = new google.maps.Map(document.getElementById("gmap"), mapOptions);
  var bounds = new google.maps.LatLngBounds();
  var markers = new Array();
  var info_windows = new Array();
  for (var i = 0; i < properties.length; i++) {
    markers[i] = new google.maps.Marker({
      position: new google.maps.LatLng(properties[i].lat, properties[i].lng),
      map: map,
      icon: properties[i].icon,
      title: properties[i].title,
      animation: google.maps.Animation.DROP
    });
    bounds.extend(markers[i].getPosition());
    info_windows[i] = new google.maps.InfoWindow({
      content: '<div class="map-property">' +
      '<h4 class="property-title"><a class="title-link" href="' + properties[i].url + '">' + properties[i].title + '</a></h4>' +
      '<a href="' + properties[i].url + '"><img class="property-thumb" src="' + properties[i].thumb + '" alt="' + properties[i].title + '"/></a>' +
      '<p><span class="price">' + properties[i].price + '</span></p>' +
      '<a class="btn btn-primary btn-sm" href="' + properties[i].url + '">Подробнее</a>' +
      '</div>'
    });
    attachInfoWindowToMarker(map, markers[i], info_windows[i]);
  }
  map.fitBounds(bounds);
  /* function to attach infowindow with marker */
  function attachInfoWindowToMarker(map, marker, infoWindow) {
    google.maps.event.addListener(marker, 'click', function () {
      infoWindow.open(map, marker);
    });
  }
}
jQuery(window).load(function () {
  //google.maps.event.addDomListener(window, 'load', SingleMap());
  if(jQuery("#onemap").length > 0 || jQuery("#gmap").length > 0) {
    ymaps.ready(SingleYandexMap());
    google.maps.event.addDomListener(window, 'load', PropertiesMap());
  }
});
function mapOn() {
  jQuery("#gmap").removeClass('hover');
  jQuery("#gmap").html('');
  google.maps.event.addDomListener(window, 'load', PropertiesMap());
  google.maps.event.addDomListener(window, 'load', SingleMap());
}

