import "./bootstrap";
import "./validateedit"
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";

if (document.getElementsByClassName('ms_table')) {
    setAddEventListenerTable();
}


if (document.getElementById('lat')) {
    const latCoord = parseFloat(document.getElementById('lat').getAttribute('php-var'));
    const lonCoord = parseFloat(document.getElementById('lon').getAttribute('php-var'));

    setMap(latCoord, lonCoord);
}

if (document.getElementById('form-create')) {
    const formSelect = document.getElementById('form-create');

    formSelect.addEventListener('submit', (e)=>{
        e.preventDefault();
        const streetName = document.getElementById('streetNumber').value;

        console.log(streetName);

        // formSelect.submit();
    });
}

if (document.getElementById('form-create')) {
    const formSelect = document.getElementById('form-create');


    formSelect.addEventListener('submit', (e) => {
        console.log(formSelect['name'].parentElement);
        e.preventDefault();
        if (validateForm(formSelect)) {
            formSelect.submit();
        }


    });
}


//Normal functions
function validateForm(formSelect) {


    checkString(formSelect['name']);
    checkString(formSelect['address']);


    if (!formSelect['rooms'].value) {
        console.log('eccomi');
        formSelect['rooms'].classList.add('is-invalid');
        formSelect['rooms'].parentElement.innerHTML += `<div class="invalid-feedback">Il campo non può essere vuoto!</div>`;
    }


    return false;
}


function checkString(inputCheck) {

    console.log(!inputCheck.value);
    if (!inputCheck.value) {
        // console.log(inputCheck.classList.contains('is-invalid'));
        if (!inputCheck.classList.contains('is-invalid')){
            inputCheck.classList.add('is-invalid')
        }
        if (!inputCheck.parentElement.querySelector('.invalid-feedback')) {
            inputCheck.parentElement.innerHTML += `<div class="invalid-feedback">Il campo non può essere vuoto!</div>`;
        } else {
            inputCheck.parentElement.querySelector('.invalid-feedback').remove();
        }
    } else {
        // console.log("Non è più vuoto", !isNaN(inputCheck.value));
        inputCheck.classList.remove('is-invalid');
        const prova = inputCheck.parentElement.querySelector('.invalid-feedback');
        // console.log(prova);
    }


}

function setAddEventListenerTable() {
    const test = document.querySelectorAll(".test");
    const urlShow = "http://127.0.0.1:8000/admin/flats/"
    let curValue = "";

    test.forEach((curItem) => {

        curItem.addEventListener("click", () => {
            curValue = curItem.firstElementChild.value;
            // console.log(curItem);

            document.location.href = `${urlShow}${curValue}`
        })
        // console.log(curItem);
    })

}

// Functions for TomTomAPI


function setMap(latCoord, lonCoord) {

    const position = {
        lat: latCoord,
        lon: lonCoord
    }

    var map = tt.map({//Setting coordinates to map in View
        key: 'bKZHQIbuOQ0b5IXmQXQ2FTUOUR3u0a26',
        container: 'map',
        center: position,
        zoom: 15
    });

    var marker = new tt.Marker().setLngLat(position).addTo(map)
    return map;
}


function getLocation(addressParam) {

    var url = new URL('https://api.tomtom.com/search/2/structuredGeocode.json')

    var params = {
        key: 'bKZHQIbuOQ0b5IXmQXQ2FTUOUR3u0a26',
        streetName: 'Via IV Novembre',
        streetNumber: '35',
        postalCode: '38023',
        countryCode: 'IT',
        municipality: 'Cles',
        limit: '1',
    }
    url.search = new URLSearchParams(params).toString(); //Creating GET url with params for XMLHttpRequest

    let data = "";
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            data = JSON.parse(this.responseText);// Getting request Response and parsing it to JSON

            console.log(data.results);
            console.log(data.results[0].position, typeof (data.results[0].position));

            var map = tt.map({//Setting coordinates to map in View
                key: 'bKZHQIbuOQ0b5IXmQXQ2FTUOUR3u0a26',
                container: 'map',
                center: data.results[0].position,
                zoom: 15
            });
        }
    };
    xhttp.open("GET", url, true); //Launch request
    xhttp.send();

    return data.results[0].position;
}


// autocomplete search-box

const apiKey = 'bKZHQIbuOQ0b5IXmQXQ2FTUOUR3u0a26';

document.getElementById('address').addEventListener('keyup' , function() {
    const query = this.value;
            if (query.length > 2) {
                fetch(`https://api.tomtom.com/search/2/search/${query}.json?key=${apiKey}&typeahead=true&limit=5`)
                    .then(response => response.json())
                    .then(data => {
                        const suggestions = document.getElementById('suggestions');
                        suggestions.innerHTML = '';
                        data.results.forEach(result => {
                            const li = document.createElement('li');
                            li.textContent = result.address.freeformAddress;

                            // console.log(result.position);

                            li.addEventListener('click', () => {
                                document.getElementById('address').value = result.address.freeformAddress;
                                document.getElementById('latitude').value = result.position.lat;
                                document.getElementById('longitude').value = result.position.lon;
                                suggestions.innerHTML = '';
                            });
                            suggestions.appendChild(li);
                        });
                    })
                    .catch(error => console.error('Errore:', error));
            } else {
                document.getElementById('suggestions').innerHTML = '';
            }
});




