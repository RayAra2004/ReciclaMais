"use strict"
const searchInput = document.querySelector(".search_input");
const searchBtn = document.querySelector(".search_btn");

let map, searchManager;

searchBtn.addEventListener("click", ()=>{
    map.entities.clear();
    geocodeQuery(searchInput.value);
});

function getMap(){
    var locIfes = new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478);
    var jaymeDosSantosNeves = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.199232504534884, -40.227077110956316), {
        color: "red",
        title: "Hospital Jayme dos Santos Neves",
        icon: "/ReciclaMais/imgs/icone-ponto-prata.png"
    });

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
        center: locIfes,
        zoom: 16,
        NavigationBarMode: "minified",
        navigationBarOrientation: "horizontal",
        credentials: 'Ak_PJnVWlG661PnFrGXTK6jXXiZz9b3Ocn4R5X9BXIhfGRcR7zSvm27_YE30YHHK',
    });
    /*for (let item in locaisProprios) {
        map.entities.push(locaisProprios[item]["pushpin"]);
    }*/
    map.entities.push(jaymeDosSantosNeves);
};

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