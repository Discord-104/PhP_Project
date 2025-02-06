// Funzione per validare l'email
function validaEmail(email) {
    let regexEmail = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
    return regexEmail.test(email);
}

// Funzione per validare il CAP (5 numeri)
function validaCAP(CAP) {
    let regexCAP = /^\d{5}$/;
    return regexCAP.test(CAP);
}

// Funzione per validare nome e cognome (solo lettere)
function validaNomeCognome(nomeCognome) {
    let regexLettere = /^[a-zA-ZàèéìòùÀÈÉÌÒÙ\s]+$/;
    return regexLettere.test(nomeCognome);
}

// Funzione per validare la password (minimo 8 caratteri)
function validaPassword(password) {
    return password.length >= 8;
}

// Funzione per la validazione del form
function validaForm(event) {
    let errorMessage = '';
    
    // Ottieni i valori dai campi del form
    let username = document.getElementById('username').value;
    let password = document.getElementById('password').value;
    let confermaPassword = document.getElementById('confermaPassword').value;
    let role = document.getElementById('role').value;
    let nome = document.getElementById('nome').value;
    let cognome = document.getElementById('cognome').value;
    let mail = document.getElementById('mail').value;
    let CAP = document.getElementById('CAP').value;
    let indirizzo = document.getElementById('indirizzo').value;

    // Controllo validità username
    if (username.trim() == '') {
        errorMessage += "L'username è obbligatorio.\n";
    }

    // Controllo validità email
    if (!validaEmail(mail)) {
        errorMessage += "L'indirizzo email non è valido.\n";
    }

    // Controllo validità CAP
    if (!validaCAP(CAP)) {
        errorMessage += "Il CAP deve contenere 5 numeri.\n";
    }

    // Controllo validità password
    if (!validaPassword(password)) {
        errorMessage += "La password deve essere lunga almeno 8 caratteri.\n";
    }

    // Controllo conferma password
    if (password != confermaPassword) {
        errorMessage += "Le password non coincidono.\n";
    }

    // Controllo validità nome
    if (!validaNomeCognome(nome)) {
        errorMessage += "Il nome deve contenere solo lettere.\n";
    }

    // Controllo validità cognome
    if (!validaNomeCognome(cognome)) {
        errorMessage += "Il cognome deve contenere solo lettere.\n";
    }

    // Controllo indirizzo
    if (indirizzo.trim() == '') {
        errorMessage += "L'indirizzo è obbligatorio.\n";
    }

    // Controllo ruolo
    if (role.trim() == '') {
        errorMessage += "Il ruolo è obbligatorio.\n";
    }

    // Se ci sono errori, impediamo l'invio del form
    if (errorMessage) {
        alert(errorMessage);
        event.preventDefault();  // Impedisce l'invio del form
        return false;
    }
    
    // Se non ci sono errori, il form verrà inviato normalmente
    return true;
}
