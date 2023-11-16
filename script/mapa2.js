"use strict"
const searchInput = document.querySelector(".search_input");
const searchBtn = document.querySelector(".search_btn");
//const divtot = document.getElementById("divtot");
const divzada = document.getElementById("divzada");
const text1 = document.getElementById("text1");
const imgPonto = document.getElementById("imgPonto");
const btnClose = document.getElementById("btnClose");
btnClose.addEventListener("click", ()=>{
    divzada.style.display = "none";
    divtot.style.display = "none";
});
/*divzada.addEventListener("click", ()=>{
    console.log("oi")
});*/

const Pontos = {
    "-20.197329691804068, -40.2170160437478": {
        title: "Ifes Campus Serra",
        icon: "/ReciclaMais/imgs/silver_pin.svg",
        img: "/ReciclaMais/imgs/arvores_home.jpg"
    },
    "-20.199232504534884, -40.227077110956316":{
        title: "Hospital Jayme dos Santos Neves",
        icon: "/ReciclaMais/imgs/silver_pin.svg",
        img: "/ReciclaMais/imgs/simbolo-de-reciclagem.png"
    },
    "-20.19826402415827, -40.224856532079116":{
        title: "Café Arrumado",
        icon: "/ReciclaMais/imgs/silver_pin.svg",
        img: "/ReciclaMais/imgs/logoMA.png"
    }};

let map, searchManager;

searchBtn.addEventListener("click", ()=>{
    geocodeQuery(searchInput.value);
});

function clicado(content,Pontos){
    let location = content.getLocation().latitude + ", "+ content.getLocation().longitude;
    console.log(location);
    console.log(Pontos[location]);
    //divtot.style.display = "block";
    divzada.style.display = "block";
    text1.textContent = Pontos[location]["title"]
    imgPonto.setAttribute('src',Pontos[location]["img"])
}

function getMap(){
    map = new Microsoft.Maps.Map('#map', {
        center: new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478),
        zoom: 16,
        NavigationBarMode: "minified",
        navigationBarOrientation: "horizontal",
        credentials: 'Ak_PJnVWlG661PnFrGXTK6jXXiZz9b3Ocn4R5X9BXIhfGRcR7zSvm27_YE30YHHK',
    });

    const Pontos = {
        "-20.197329691804068, -40.2170160437478": {
            title: "Ifes Campus Serra",
            icon: "/ReciclaMais/imgs/silver_pin.svg",
            img: "/ReciclaMais/imgs/arvores_home.jpg"
        },
        "-20.199232504534884, -40.227077110956316":{
            title: "Hospital Jayme dos Santos Neves",
            icon: "/ReciclaMais/imgs/silver_pin.svg",
            img: "/ReciclaMais/imgs/simbolo-de-reciclagem.png"
        },
        "-20.19826402415827, -40.224856532079116":{
            title: "Café Arrumado",
            icon: "/ReciclaMais/imgs/silver_pin.svg",
            img: "/ReciclaMais/imgs/logoMA.png"
        }};

    for (const key in Pontos) {
        const value = Pontos[key];
        // Process the key and value
        const coordenadas = key.split(",");
        const latitude = parseFloat(coordenadas[0]);
        const longitude = parseFloat(coordenadas[1]);
        
        const pushpin = new Microsoft.Maps.Pushpin(
          new Microsoft.Maps.Location(latitude, longitude),{
            title: value.title,
            icon: value.icon
          }
        );
        
        map.entities.push(pushpin);
      
        // Adiciona o evento de clique
        Microsoft.Maps.Events.addHandler(pushpin, 'click', function () {clicado(pushpin,Pontos);});
    }
};
//Função que recentraliza o mapa
function geocodeQuery(query){
    map.setView({
        center: {latitude: -20.199232504534884, longitude: -40.227077110956316, altitude: 0, altitudeReference: -1}
    });
};


/*function geocodeQuery(query){
    if (!searchManager) {
        Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
            searchManager = new Microsoft.Maps.Search.SearchManager(map);
            geocodeQuery(query);
        });
    } else {
        let searchRequest = {
            where: query,
            callback: function (r) {
                if (r && r.results && r.results.length > 0) {
                    var pin = new Microsoft.Maps.Pushpin(r.results[0].location);
                    map.entities.push(pin);
                  map.setView({ bounds: r.results[0].bestView });
                };
            },
            errorCallback: function (e) {
                alert("No results found.");
            }
        };
        searchManager.geocode(searchRequest);
    };
};*/


/*Microsoft.Maps.Events.addHandler(map, 'viewchangeend', function (e) {
    if (map.getZoom() < 16) {
        for (let item in locaisProprios) {
            map.entities.pop(locaisProprios[item]["pushpin"]);
        }
    }
    else {
        for (let item in locaisProprios) {
            map.entities.push(locaisProprios[item]["pushpin"]);
        }
    }
});*/