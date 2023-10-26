"use strict"
const searchInput = document.querySelector(".search_input");
const searchBtn = document.querySelector(".search_btn");

let map, searchManager;

searchBtn.addEventListener("click", ()=>{
    map.entities.clear();
    geocodeQuery(searchInput.value);
});

function clicado(content){
    console.log(content);
}

function getMap(){
    const locIfes = new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478);


    const ifes = new Microsoft.Maps.Pushpin(locIfes, {
        color: "green",
        title: "Ifes Campus Serra",
        icon: "/ReciclaMais/imgs/silver_pin.svg"
    });
    console.log(ifes);
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

    const locaisProprios = {};

    locaisProprios[1] = {
        "nome": "Ifes campus Serra",
        "pushpin": ifes,
        "imagem": "/ReciclaMais/imgs/arvores.png"
    };
    locaisProprios[2] = {
        "nome": "Jayme dos Santos Neves",
        "pushpin": jaymeDosSantosNeves,
        "imagem": "/ReciclaMais/imgs/arvores.png"
    };

    locaisProprios[3] = {
        "nome": "Café Arrumado",
        "pushpin": cafeArrumado,
        "imagem": "/ReciclaMais/imgs/arvores.png"
    };

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
        center: locIfes,
        zoom: 16,
        NavigationBarMode: "minified",
        navigationBarOrientation: "horizontal",
        credentials: 'Ak_PJnVWlG661PnFrGXTK6jXXiZz9b3Ocn4R5X9BXIhfGRcR7zSvm27_YE30YHHK',
    });
    for (let item in locaisProprios) {
        map.entities.push(locaisProprios[item]["pushpin"]);
    }
    Microsoft.Maps.Events.addHandler(ifes, 'click', function () { clicado(ifes.getAnchor()); });
    /*map.entities.push(jaymeDosSantosNeves);
    map.entities.push(cafeArrumado);
    map.entities.push(ifes);*/
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