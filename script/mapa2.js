"use strict"
const searchInput = document.querySelector(".search_input");
const searchBtn = document.querySelector(".search_btn");

let map, searchManager;

searchBtn.addEventListener("click", ()=>{
    geocodeQuery(searchInput.value);
});

function clicado(content){
    console.log(content);
}

function getMap(){


    const ifes = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478), {
        color: "green",
        subTitle: 'id_do_coiso',
        title: "Ifes Campus Serra",
        icon: "/ReciclaMais/imgs/silver_pin.svg"
    });
    //ifes.addEventListener('click', clicado);
    const jaymeDosSantosNeves = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.199232504534884, -40.227077110956316), {
        color: "red",
        title: "Hospital Jayme dos Santos Neves",
        icon: "/ReciclaMais/imgs/silver_pin.svg"
    });

    const cafeArrumado = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.19826402415827, -40.224856532079116), {
        color: "blue",
        title: "Café Arrumado",
        icon: "/ReciclaMais/imgs/silver_pin.svg"

    });

    const locais = [];
    locais.push(ifes)
    locais.push(jaymeDosSantosNeves);
    locais.push(cafeArrumado);

    /*for (let item in locaisProprios) {
        map.entities.push(locaisProprios[item]["pushpin"]);
    };*/

    /*
    var locaisProprios = {};
    

    var jaymeDosSantosNeves = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.199232504534884, -40.227077110956316), {
        color: "red",
        title: "Hospital Jayme dos Santos Neves",
        icon: "../imgs/icone-ponto-prata.png"
    });

    for (let item in locaisProprios) {
        map.entities.push(locaisProprios[item]["pushpin"]);
    }
    */
    map = new Microsoft.Maps.Map('#map', {
        // You need your key.
        center: new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478),
        zoom: 16,
        NavigationBarMode: "minified",
        navigationBarOrientation: "horizontal",
        credentials: 'Ak_PJnVWlG661PnFrGXTK6jXXiZz9b3Ocn4R5X9BXIhfGRcR7zSvm27_YE30YHHK',
    });
    for (let item of locais) {
        map.entities.push(item);
        //console.log(item);
    }
    Microsoft.Maps.Events.addHandler(ifes, 'click', function () { clicado(ifes['entity']); });
};
//Função que recentraliza o mapa
/*function geocodeQuery(query){
    map.setView({
        center: jaymeDosSantosNeves.getLocation()
    });
};*/


function geocodeQuery(query){
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
};


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