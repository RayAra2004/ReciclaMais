function success(pos){
    console.log(pos)
    const latitude = (pos.coords.latitude)
    const longitude = (pos.coords.longitude)

    initMap(latitude, longitude)
}

function error(err){
    console.log(err)
}

navigator.geolocation.getCurrentPosition(success, error)

function initMap(latitude, longitude){
       
    let map = L.map('map').setView([latitude, longitude], 15);

    L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {}).addTo(map);

    const icon = L.icon({
        iconUrl: '../imgs/silver_pin.svg',
        iconSize: [38, 95],
        iconAnchor: [22, 94]
    })

    L.marker([-20.197888477561747, -40.2173035323762], {icon, title: "Teste 1"}).addTo(map)
        //.bindPopup('A pretty CSS3 popup.<br> Easily customizable.')
        .openPopup();
}
