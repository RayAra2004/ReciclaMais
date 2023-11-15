"use strict"
const searchInput = document.querySelector(".search_input");
const searchBtn = document.querySelector(".search_btn");
const Pontos = {
    "-20.197329691804068, -40.2170160437478": {
        title: "Ifes Campus Serra",
        icon: "/ReciclaMais/imgs/silver_pin.svg"
    },
    "-20.199232504534884, -40.227077110956316": {
        title: "Hospital Jayme dos Santos Neves",
        icon: "/ReciclaMais/imgs/silver_pin.svg"
    },
    "-20.19826402415827, -40.224856532079116": {
        title: "Café Arrumado",
        icon: "/ReciclaMais/imgs/silver_pin.svg"
    }
};

let map, searchManager;

searchBtn.addEventListener("click", ()=>{
    geocodeQuery(searchInput.value);
});

function clicado(content){
    console.log(content);
}

function getMap(){


    const ifes = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478), {
        title: "Ifes Campus Serra",
        icon: "/ReciclaMais/imgs/silver_pin.svg"
    });
    //ifes.addEventListener('click', clicado);
    const jaymeDosSantosNeves = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.199232504534884, -40.227077110956316), {
        title: "Hospital Jayme dos Santos Neves",
        icon: "/ReciclaMais/imgs/silver_pin.svg"
    });

    const cafeArrumado = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.19826402415827, -40.224856532079116), {
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
        center: new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478),
        zoom: 16,
        NavigationBarMode: "minified",
        navigationBarOrientation: "horizontal",
        credentials: 'Ak_PJnVWlG661PnFrGXTK6jXXiZz9b3Ocn4R5X9BXIhfGRcR7zSvm27_YE30YHHK',
    });
    for (let item of locais) {
        map.entities.push(item);
    }
    Microsoft.Maps.Events.addHandler(ifes, 'click', function () { clicado(ifes['entity']); });
};
//Função que recentraliza o mapa
function geocodeQuery(query){
    map.setView({
        center: jaymeDosSantosNeves.getLocation()
    });
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