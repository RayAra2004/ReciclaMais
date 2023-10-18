const menuLateral = document.getElementById("menuLateral");
var ultimoPushpinClicado = null




/*funcao que calcula o tamanho do mapa com base no tamanho da tela*/
function calculaTamanhoMapa(mapa) {
    const posicaoYMapa = mapa.offsetTop;
    var alturaPagina = window.innerHeight;
    mapa.style.height = `${alturaPagina - posicaoYMapa}px`;
    //mapa.style.width = `${document.querySelector("header").clientWidth}px`
    mapa.style.width = `80vw`
}

var map = null;



/*esta funcao carrega o mapa*/
function loadMapScenario() {
    const mapa = document.getElementById("mapa");
    calculaTamanhoMapa(mapa)
    var locIfes = new Microsoft.Maps.Location(-20.197329691804068, -40.2170160437478);
    /*cria um objeto de mapa da microsoft e adiciona a div que ira conter o mapa*/
    if (window.innerWidth <= 540) {
        map = new Microsoft.Maps.Map(document.getElementById("mapa"), {
            center: locIfes,
            zoom: 16,
            NavigationBarMode: "minified",
            navigationBarOrientation: "vertical",
            showMapTypeSelector: false,
            showLocateMeButton: true,
        });
    }
    //se a tela for maior que 540px inicializa o mapa com outras configuracoes
    else {
        map = new Microsoft.Maps.Map(document.getElementById("mapa"), {
            center: locIfes,
            zoom: 16,
            NavigationBarMode: "minified",
            navigationBarOrientation: "horizontal"
        });
    }

    //inicializa um objeto que ira armazenar os locais que nos cadastramos
    var locaisProprios = {}

    //carrega o modulo de autosugestao do bing map
            

    //criando os pins do mapa 
    var ifes = new Microsoft.Maps.Pushpin(locIfes, {
        color: "green",
        title: "Ifes Campus Serra",
        icon: "../imgs/icone-ponto-prata.png"
    });

    var jaymeDosSantosNeves = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.199232504534884, -40.227077110956316), {
        color: "red",
        title: "Hospital Jayme dos Santos Neves",
        icon: "../imgs/icone-ponto-prata.png"
    });

    var cafeArrumado = new Microsoft.Maps.Pushpin(new Microsoft.Maps.Location(-20.19826402415827, -40.224856532079116), {
        color: "blue",
        title: "Café Arrumado",
        icon: "../imgs/icone-ponto-prata.png"

    })
    //fim dos pins

    //adiconando os pins no objeto de locais proprios
    locaisProprios[1] = {
        "nome": "Ifes campus Serra",
        "pushpin": ifes,
        "imagem": "../img/ifesPerfil.jpg"
    };
    locaisProprios[2] = {
        "nome": "Jayme dos Santos Neves",
        "pushpin": jaymeDosSantosNeves,
        "imagem": "../img/jaymePerfil.jpg"
    };

    locaisProprios[3] = {
        "nome": "Café Arrumado",
        "pushpin": cafeArrumado,
        "imagem": "../img/cafeArrumadoPerfil.jpg"
    }

    //adicionano evento de mapa nos pins

    //adiciona um evento que faz os pins sumirem quando o zoom ficar muito pequeno
    Microsoft.Maps.Events.addHandler(map, 'viewchangeend', function (e) {
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
    });
}

//funcao que roda quando o usuario clica enter no input sem escolher uma sugestao


/*adiciona o evento de resize para a janela, assim o tamanho do mapa sera recalculado toda vez*/
window.addEventListener("resize", (e) => {
    calculaTamanhoMapa(document.getElementById("mapa"));
})
