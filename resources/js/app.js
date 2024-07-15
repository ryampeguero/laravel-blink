import "./bootstrap";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";

// const test = document.querySelectorAll(".test");
// const urlShow = "http://127.0.0.1:8000/admin/flats/"
// let curValue = "";

// test.forEach((curItem)=>{

//     curValue = curItem.firstElementChild.value;
//     console.log(curValue);

//     curItem.addEventListener("click", ()=>{

//         document.location.href = `${urlShow}${curValue}`
//     } )
//     console.log(curItem);
// })


var url = new URL('https://api.tomtom.com/search/2/structuredGeocode.json')

var params = {
    key: 'bKZHQIbuOQ0b5IXmQXQ2FTUOUR3u0a26',
    streetName: 'Via IV Novembre',
    streetNumber: '35',
    postalCode: '38023',
    countryCode: 'IT',
    municipality:'Cles',
    limit: '1',
}
url.search = new URLSearchParams(params).toString(); //Creating GET url with params for XMLHttpRequest

let data = "";
var xhttp = new XMLHttpRequest();
xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
        data = JSON.parse(this.responseText);
        console.log(data.results);
        console.log(data.results[0].position);
        var map = tt.map({
            key: 'bKZHQIbuOQ0b5IXmQXQ2FTUOUR3u0a26',
            container: 'map',
            center: data.results[0].position,
            zoom: 15
        });
    }
};
xhttp.open("GET", url, true);
xhttp.send();
