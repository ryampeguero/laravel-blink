import "./bootstrap";
import { formToValidate } from "./validateedit";
import "~resources/scss/app.scss";
import.meta.glob(["../img/**"]);
import * as bootstrap from "bootstrap";
import { data } from "autoprefixer";



//PAYMENT

document.addEventListener('DOMContentLoaded', function () {
    // Quando il documento è completamente caricato, esegui questo codice
    // Step 1: Ottenere il token di autorizzazione da Laravel per Braintree
    fetch('http://127.0.0.1:8000/api/payment/token')
    .then(response => response.json())
    .then(data => {
        // Una volta ottenuto il token, crea l'interfaccia di pagamento con Braintree Drop-in
        braintree.dropin.create({
            authorization: data.token,
            container: '#dropin-container', // Dove inserire l'interfaccia di pagamento
            locale: 'it_IT',
        }, function (createErr, instance) {
            // Funzione di callback quando l'interfaccia di pagamento è stata creata con successo
            document.getElementById('pay').addEventListener('click', function(){
                console.log('click');
                    // Step 2: Gestire il click sul pulsante di pagamento
                    document.getElementById('amount').value = document.getElementById('sponsorship').value;
                    console.log(document.getElementById('amount').value);
                    // Ottenere l'importo selezionato dall'utente
                    const amount = document.getElementById('sponsorship').value;

                    // Step 3: Richiedere il metodo di pagamento a Braintree Drop-in
                    instance.requestPaymentMethod(function (err, payload) {
                        if (err) {
                            console.error('Error requesting payment method:', err);
                            return;
                        }

                        // Step 4: Effettuare la richiesta di pagamento a Laravel
                        fetch('http://127.0.0.1:8000/api/payment/checkout', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content') 
                            },
                            body: JSON.stringify({
                                payment_method_nonce: payload.nonce, // Nonce del metodo di pagamento da Braintree
                                amount: document.getElementById('amount').value // Importo da pagare
                            })
                        }).then(response => response.json()).then(data => {
                            // Step 5: Gestire la risposta dal server

                            if (data.success) {
                                alert('Pagamento avvenuto con successo!');
                            } else {
                                alert('Errore nel pagamento: ' + data.message);
                            }
                        });
                    });
                });
            });
        });
});





if (document.getElementsByClassName('ms_table')) {
    setAddEventListenerTable();
}


if (document.getElementById('lat')) {
    const latCoord = parseFloat(document.getElementById('lat').getAttribute('php-var'));
    const lonCoord = parseFloat(document.getElementById('lon').getAttribute('php-var'));

    setMap(latCoord, lonCoord);
}

//Create Validations
if (document.getElementById("form-create")) {
    const formSelect = document.getElementById("form-create");
    formToValidate(formSelect);

    const roomsContainer = document.querySelector('#rooms');
    const bathroomsContainer = document.querySelector('#bathrooms');
    console.log(bathroomsContainer);

    myInputNumber(roomsContainer);
    myInputNumber(bathroomsContainer);


    document.getElementById('search').addEventListener('click', function (event) {
        event.stopPropagation();
        event.preventDefault();
        setMap(formSelect['latitude'].value, formSelect['longitude'].value)
        formToValidate(formSelect)

    });

}


//Edit Validations
if (document.getElementById("form-edit")) {
    const formSelect = document.getElementById("form-edit");
    formToValidate(formSelect);

    const roomsContainer = document.querySelector('#rooms');
    const bathroomsContainer = document.querySelector('#bathrooms');
    console.log(bathroomsContainer);

    myInputNumber(roomsContainer);
    myInputNumber(bathroomsContainer);


    document.getElementById('search-btn').addEventListener('click', function (event) {
        event.stopPropagation();
        event.preventDefault();
        setMap(formSelect['latitude'].value, formSelect['longitude'].value)
        formToValidate(formSelect)
    });

}



function setAddEventListenerTable() {
    const test = document.querySelectorAll(".flat");
    console.log(test);
    const urlShow = "http://127.0.0.1:8000/admin/flats/"
    let curValue = "";

    test.forEach((curItem) => {

        curItem.addEventListener("click", () => {
            curValue = curItem.firstElementChild.value;
            document.location.href = `${urlShow}${curValue}`
        })
        // console.log(curItem);
    })
}



function myInputNumber(inputNumberContainer) {
    // console.log(inputNumber.querySelector('#input_value'));
    const inputValue = inputNumberContainer.querySelector('#input_value');
    const msValue = inputNumberContainer.querySelector('#ms_value');
    console.log(msValue);
    const minusBtn = inputNumberContainer.querySelector('#minus');
    const plusBtn = inputNumberContainer.querySelector('#plus');


    msValue.innerHTML = inputValue.value;

    minusBtn.addEventListener('click', (event) => {
        event.stopPropagation();
        event.preventDefault();
        if (inputValue.value != 0) {
            inputValue.value--;
        }
        msValue.innerHTML = inputValue.value;
    })

    plusBtn.addEventListener('click', (event) => {
        event.stopPropagation();
        event.preventDefault();

        if (inputValue.value < 100) {
            inputValue.value++;
        }
        msValue.innerHTML = inputValue.value;
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

let selectedIndex = -1;

document.getElementById('address').addEventListener('input', function () {

    const query = this.value;
    if (query.length > 2) {
        fetch(`https://api.tomtom.com/search/2/search/${query}.json?key=${apiKey}&typeahead=true&limit=5`)
            .then(response => response.json())
            .then(data => {
                const suggestions = document.getElementById('suggestions');
                suggestions.innerHTML = '';

                selectedIndex = -1;
                data.results.forEach(result => {
                    const li = document.createElement('li');
                    li.textContent = result.address.freeformAddress;
                    li.dataset.lat = result.position.lat;
                    li.dataset.lon = result.position.lon;

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

document.getElementById('address').addEventListener('keydown', function (event) {
    const suggestions = document.getElementById('suggestions');
    const items = suggestions.getElementsByTagName('li');
    if (items.length > 0) {
        if (event.key === 'ArrowDown') {
            selectedIndex = (selectedIndex + 1) % items.length;
            updateSelection(items);
            event.preventDefault(); // Previene lo scrolling della pagina
        } else if (event.key === 'ArrowUp') {
            selectedIndex = (selectedIndex - 1 + items.length) % items.length;
            updateSelection(items);
            event.preventDefault(); // Previene lo scrolling della pagina
        } else if (event.key === 'Enter' && selectedIndex > -1) {
            event.preventDefault(); // Previene il submit del form
            items[selectedIndex].click();
        }
    }
});

function updateSelection(items) {
    for (let i = 0; i < items.length; i++) {
        items[i].classList.remove('selected');
    }
    if (selectedIndex > -1) {
        items[selectedIndex].classList.add('selected');
    }
}





