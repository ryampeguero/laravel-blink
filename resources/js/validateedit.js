export { formToValidate };

function formToValidate(formSelect) {
    document.addEventListener('DOMContentLoaded', function () {
        if (formSelect) {
            const formElement = document.getElementById(formSelect);
            if (formElement) {
                formElement.addEventListener('submit', (e) => {
                    e.preventDefault();
                    console.log('sono qui');
                    if (validateForm(formElement)) {
                        formElement.submit();
                    }
                });
            } else {
                console.error(`Form con ID "${formSelect}" non trovato.`);
            }
        } else {
            console.error('Nessun ID di modulo specificato.');
        }
    });
}

function validateForm(form) {
    switch (form.id) {
        case 'loginForm':
            return validateLoginForm(form);
        case 'registerForm':
            return validateRegisterForm(form);
        case 'form-edit':
        case 'form-create':
            return validateFormEdit(form);
        default:
            console.error('ID del modulo non riconosciuto.');
            return false;
    }
}

function validateLoginForm(form) {
    let valid = true;

    function addInvalidFeedback(field, message) {
        const errorDiv = document.createElement('div');
        errorDiv.classList.add('invalid-feedback');
        errorDiv.innerHTML = message;
        field.classList.add('is-invalid');
        if (!field.parentElement.querySelector('.invalid-feedback')) {
            field.parentElement.append(errorDiv);
        }
    }

    function removeInvalidFeedback(field) {
        field.classList.remove('is-invalid');
        const errorDiv = field.parentElement.querySelector('.invalid-feedback');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    let emailField = form['email'];
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailField.value) {
        addInvalidFeedback(emailField, 'Il campo email non può essere vuoto!');
        valid = false;
    } else if (!emailPattern.test(emailField.value)) {
        addInvalidFeedback(emailField, 'Inserisci un indirizzo email valido!');
        valid = false;
    } else {
        removeInvalidFeedback(emailField);
    }

    let passwordField = form['password'];
    if (!passwordField.value) {
        addInvalidFeedback(passwordField, 'Il campo password non può essere vuoto!');
        valid = false;
    } else {
        removeInvalidFeedback(passwordField);
    }

    return valid;
}

function validateRegisterForm(form) {
    let valid = true;

    function addInvalidFeedback(field, message) {
        const errorDiv = document.createElement('div');
        errorDiv.classList.add('invalid-feedback');
        errorDiv.innerHTML = message;
        field.classList.add('is-invalid');
        if (!field.parentElement.querySelector('.invalid-feedback')) {
            field.parentElement.append(errorDiv);
        }
    }

    function removeInvalidFeedback(field) {
        field.classList.remove('is-invalid');
        const errorDiv = field.parentElement.querySelector('.invalid-feedback');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    let nameField = form['name'];
    if (!nameField.value) {
        addInvalidFeedback(nameField, 'Il campo nome non può essere vuoto!');
        valid = false;
    } else {
        removeInvalidFeedback(nameField);
    }

    let emailField = form['email'];
    const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
    if (!emailField.value) {
        addInvalidFeedback(emailField, 'Il campo email non può essere vuoto!');
        valid = false;
    } else if (!emailPattern.test(emailField.value)) {
        addInvalidFeedback(emailField, 'Inserisci un indirizzo email valido!');
        valid = false;
    } else {
        removeInvalidFeedback(emailField);
    }

    let passwordField = form['password'];
    if (!passwordField.value) {
        addInvalidFeedback(passwordField, 'Il campo password non può essere vuoto!');
        valid = false;
    } else {
        removeInvalidFeedback(passwordField);
    }

    let passwordConfirmField = form['password_confirmation'];
    if (!passwordConfirmField.value) {
        addInvalidFeedback(passwordConfirmField, 'Il campo conferma password non può essere vuoto!');
        valid = false;
    } else if (passwordField.value !== passwordConfirmField.value) {
        addInvalidFeedback(passwordConfirmField, 'Le password non corrispondono!');
        valid = false;
    } else {
        removeInvalidFeedback(passwordConfirmField);
    }

    return valid;
}

function validateFormEdit(form) {
    let valid = true;

    function addInvalidFeedback(field, message) {
        const errorDiv = document.createElement('div');
        errorDiv.classList.add('invalid-feedback');
        errorDiv.innerHTML = message;
        field.classList.add('is-invalid');
        if (!field.parentElement.querySelector('.invalid-feedback')) {
            field.parentElement.append(errorDiv);
        }
    }

    function removeInvalidFeedback(field) {
        field.classList.remove('is-invalid');
        const errorDiv = field.parentElement.querySelector('.invalid-feedback');
        if (errorDiv) {
            errorDiv.remove();
        }
    }

    let nameField = form['name'];
    if (!nameField.value) {
        addInvalidFeedback(nameField, 'Il campo nome non può essere vuoto!');
        valid = false;
    } else {
        removeInvalidFeedback(nameField);
    }

    if (form['slug']) {
        let slugField = form['slug'];
        if (!slugField.value) {
            addInvalidFeedback(slugField, 'Il campo slug non può essere vuoto!');
            valid = false;
        } else {
            removeInvalidFeedback(slugField);
        }
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

formToValidate('loginForm');
formToValidate('registerForm');
formToValidate('form-edit');
formToValidate('form-create');
