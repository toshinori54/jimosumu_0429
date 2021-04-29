var geocoder;
var map;
function initialize() {
    geocoder = new google.maps.Geocoder();
    var latlng = new google.maps.LatLng(33.845731, 130.751619);
    var opts = {
        zoom: 16,
        center: latlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map
        (document.getElementById("map_canvas"), opts);
}

function codeAddress() {
    var address = document.getElementById("address").value;
    if (geocoder) {
        geocoder.geocode({ 'address': address, 'region': 'jp' },
            function (results, status) {
                if (status == google.maps.GeocoderStatus.OK) {
                    map.setCenter(results[0].geometry.location);

                    // ピンと緯度経度取得
                    var bounds = new google.maps.LatLngBounds();
                    //for文を使って候補検索を変数ｒ使って複数個探しているが、
                    // ｒのままだと繰返し緯度経度が更新されている状態なのでｒ=０で固定
                    // for (var r in results) {

                    if (results[0].geometry) {
                        var latlng = results[0].geometry.location;
                        bounds.extend(latlng);
                        new google.maps.Marker({
                            position: latlng, map: map
                        });

                        document.getElementById('id_ido').innerHTML = latlng.lat();
                        document.getElementById('id_keido').innerHTML = latlng.lng();

                    }
                    // }
                    //map.fitBounds(bounds);
                } else {
                    alert("Geocode 取得に失敗しました reason: "
                        + status);
                }
            });
    }
}