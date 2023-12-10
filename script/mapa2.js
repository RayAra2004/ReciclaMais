"use strict"
const searchInput = document.querySelector(".search_input");
const searchBtn = document.querySelector(".search_btn");
const divzada = document.getElementById("divzada");
const ponto_title = document.getElementById("ponto_title");
const imgPonto = document.getElementById("imgPonto");
const btnClose = document.getElementById("btnClose");
const link_rota = document.getElementById("link_rota");
const ponto_endereco = document.getElementById("ponto_endereco");
const btnClosedFilter = document.getElementById("closedFilter");
const btnOpenedFilter = document.getElementById("openedFilter");
const buttons = document.querySelectorAll(".filterClassButton");
const ponto_telefone = document.getElementById("ponto_telefone");
const link_ponto = document.getElementById("link_ponto");

btnClose.addEventListener("click", ()=>{
    divzada.style.display = "none";
    btnClosedFilter.style.display = "block";
    btnOpenedFilter.style.display = "none";
    searchInput.style.display = "block";
    searchBtn.style.display = "block";

});
for (const button of buttons) {
button.addEventListener("click", (event) => {
    filterByClass(event.target.textContent);
    divzada.style.display = "none";
    btnClosedFilter.style.display = "block";
    btnOpenedFilter.style.display = "none";
    searchInput.style.display = "block";
    searchBtn.style.display = "block";
});
}
btnClosedFilter.addEventListener("click", ()=>{
    btnClosedFilter.style.display = "none";
    btnOpenedFilter.style.display = "block";
    searchInput.style.display = "none";
    searchBtn.style.display = "none";
});
/*btnOpenedFilter.addEventListener("click", ()=>{
    btnClosedFilter.style.display = "block";
    btnOpenedFilter.style.display = "none";
    searchInput.style.display = "block";
    searchBtn.style.display = "block";
});*/

//função para filtar o mapa

function filterByClass(classToFilter) {
    console.log(classToFilter);
    divzada.style.display = "none";
    map.entities.clear();

        for (const key in Pontos) {
            const value = Pontos[key];
            if(!(value["materiais_reciclados"].includes(classToFilter))){
                continue
            };
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
    


const listPontos = document.getElementById("listPntos");
const Pontos = JSON.parse(listPontos.textContent);




/*const Pontos = {
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
    }
};*/

let map, searchManager;

searchBtn.addEventListener("click", ()=>{
    pesquisa(searchInput.value);
});


window.onload = function (){
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

function clicado(content,Pontos){
    btnClosedFilter.style.display = "none";
    btnOpenedFilter.style.display = "none";
    searchInput.style.display = "none";
    searchBtn.style.display = "none";
    let location = content.getLocation().latitude + ","+ content.getLocation().longitude;
    /*
    <a href="https://www.google.com/maps/place/<?php echo $endereco["latitude"];?>, <?php echo $endereco["longitude"];?>" target="_blank">
        <button>TRAGETÓRIA ATÉ O PONTO</button>
    </a>
    */
    //divtot.style.display = "block";
    divzada.style.display = "block";
    ponto_title.textContent = Pontos[location]["title"];
    //navigator.geolocation.getCurrentPosition((a)=>{myposition = (a.coords.latitude.toString()+",+"+a.coords.longitude.toString());});
    //console.log(myposition);
    let lat = location.split(",")[0],long = location.split(",")[1];
    navigator.geolocation.getCurrentPosition(
        (a)=>{
            link_rota.setAttribute('href',"https://www.google.com/maps/dir/"+a.coords.latitude.toString()+",+"+a.coords.longitude.toString()+"/"+lat+",+"+long)
            },
        link_rota.setAttribute('href',"https://www.google.com/maps/place/"+lat+","+long)
    );

    ponto_endereco.textContent = new String(Pontos[location]["tipo_logradouro"][0]).toUpperCase()
    +new String(Pontos[location]["tipo_logradouro"]).slice(1)
    +" " +Pontos[location]["logradouro"]+", "+Pontos[location]["numero"]
    +" - "+Pontos[location]["bairro"]+", "+Pontos[location]["cidade"]+" - "
    +Pontos[location]["estado"]+", "+Pontos[location]["cep"];
    imgPonto.setAttribute('src',Pontos[location]["img"]);
    ponto_telefone.textContent = new String(Pontos[location]["telefone"]);
    //link_rota.setAttribute('href',"https://www.google.com/maps/dir/-20.197329691804068,+-40.2170160437478/"+lat+",+"+long);
}

function getMap(){
    navigator.geolocation.getCurrentPosition(
        (a)=>{
            let latPessoa = a.coords.latitude.toString();
            let longPessoa = a.coords.longitude.toString();
            map = new Microsoft.Maps.Map('#map', {
                center: new Microsoft.Maps.Location(latPessoa, longPessoa),
                zoom: 16,
                NavigationBarMode: "default",
                navigationBarOrientation: "horizontal",
                credentials: 'Ak_PJnVWlG661PnFrGXTK6jXXiZz9b3Ocn4R5X9BXIhfGRcR7zSvm27_YE30YHHK',
            });
            }
    );


    

    /*const Pontos = {
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
        }};*/
};

function fillMap(Pontos){
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
}

//Função que recentraliza o mapa
function pesquisa(query){
    /*map.setView({
        center: {latitude: -20.199232504534884, longitude: -40.227077110956316, altitude: 0, altitudeReference: -1}
    });*/
    map.entities.clear();
};


/*function pesquisa(query){
    if (!searchManager) {
        Microsoft.Maps.loadModule('Microsoft.Maps.Search', function () {
            searchManager = new Microsoft.Maps.Search.SearchManager(map);
            pesquisa(query);
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