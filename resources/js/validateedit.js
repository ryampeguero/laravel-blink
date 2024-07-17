document.addEventListener('DOMContentLoaded', function() {
    const formSelect = document.getElementById("form-edit");
    if (formSelect) {
        formSelect.addEventListener('submit', (e) => {
            e.preventDefault();
            if (validateFormEdit(formSelect)) {
                formSelect.submit();
            }
        });
    }
});
function validateFormEdit(form) {
    let valid = true;

    function addInvalidFeedback(field, message) {
        field.classList.add('is-invalid');
        if (!field.parentElement.querySelector('.invalid-feedback')) {
            field.parentElement.innerHTML += `<div class="invalid-feedback">${message}</div>`;
        }
    }

    function removeInvalidFeedback(field) {
        field.classList.remove('is-invalid');
        if (field.parentElement.querySelector('.invalid-feedback')) {
            field.parentElement.querySelector('.invalid-feedback').remove();
        }
    }

    let nameField = form['name'];
    if (!nameField.value) {
        addInvalidFeedback(nameField, 'Il campo nome non può essere vuoto!');
        valid = false;
    }else {
        removeInvalidFeedback(nameField);
    }

    let slugField = form['slug'];
    if (!slugField.value) {
        addInvalidFeedback(slugField, 'Il campo slug non può essere vuoto!');
        valid = false;
    } else {
        removeInvalidFeedback(slugField);
    }

    let roomsField = form['rooms'];
    let roomsValue = parseInt(roomsField.value, 10);
    if (!roomsField.value) {
        addInvalidFeedback(roomsField, 'Il campo stanze non può essere vuoto!');
        valid = false;
    } else if (isNaN(roomsValue) || roomsValue <= 0) {
        addInvalidFeedback(roomsField, 'Il campo stanze deve essere un numero intero maggiore di zero!');
        valid = false;
    } else {
        removeInvalidFeedback(roomsField);
    }

    let bathroomsField = form['bathrooms'];
    let bathroomsValue = parseInt(bathroomsField.value, 10);
    if (!bathroomsField.value) {
        addInvalidFeedback(bathroomsField, 'Il campo bagni non può essere vuoto!');
        valid = false;
    } else if (isNaN(bathroomsValue) || bathroomsValue <= 0) {
        addInvalidFeedback(bathroomsField, 'Il campo bagni deve essere un numero intero maggiore di zero!');
        valid = false;
    } else {
        removeInvalidFeedback(bathroomsField);
    }

    let bedsField = form['beds'];
    let bedsValue = parseInt(bedsField.value, 10);
    if (!bedsField.value) {
        addInvalidFeedback(bedsField, 'Il campo letti non può essere vuoto!');
        valid = false;
    } else if (isNaN(bedsValue) || bedsValue <= 0) {
        addInvalidFeedback(bedsField, 'Il campo letti deve essere un numero intero maggiore di zero!');
        valid = false;
    } else {
        removeInvalidFeedback(bedsField);
    }

    let addressField = form['address'];
    if (!addressField.value) {
        addInvalidFeedback(addressField, 'Il campo indirizzo non può essere vuoto!');
        valid = false;
    } else {
        removeInvalidFeedback(addressField);
    }

    let squareMetersField = form['square_meters'];
    let squareMetersValue = parseInt(squareMetersField.value, 10);
    if (!squareMetersField.value) {
        addInvalidFeedback(squareMetersField, 'Il campo metri quadrati non può essere vuoto!');
        valid = false;
    } else if (isNaN(squareMetersValue) || squareMetersValue <= 0) {
        addInvalidFeedback(squareMetersField, 'Il campo metri quadrati deve essere un numero intero maggiore di zero!');
        valid = false;
    } else {
        removeInvalidFeedback(squareMetersField);
    }

    let visibleField = form['visible'];
    if (!visibleField.value) {
        addInvalidFeedback(visibleField, 'Il campo visibilità deve essere selezionato!');
        valid = false;
    } else {
        removeInvalidFeedback(visibleField);
    }

    return valid;
}
