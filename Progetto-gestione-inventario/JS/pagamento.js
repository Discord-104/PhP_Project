function validaForm() {
    let numeroCarta = document.getElementById('numero_carta').value.trim();
    let cvv = document.getElementById('cvv').value.trim();
    let scadenza = document.getElementById('scadenza').value.trim();
    let errori = [];

    // Controllo campi vuoti
    if (!numeroCarta) {
        errori.push("Il campo 'Numero Carta' non può essere vuoto.");
    }
    if (!cvv) {
        errori.push("Il campo 'CVV' non può essere vuoto.");
    }
    if (!scadenza) {
        errori.push("Il campo 'Scadenza' non può essere vuoto.");
    }

    // Validazione numero carta
    if (numeroCarta && !/^\d{16}$/.test(numeroCarta)) {
        errori.push("Il numero di carta deve contenere esattamente 16 cifre.");
    } else if (numeroCarta && !validaLuhn(numeroCarta)) {
        errori.push("Il numero di carta non è valido.");
    }

    // Validazione CVV
    if (cvv && !/^\d{3}$/.test(cvv)) {
        errori.push("Il CVV deve contenere esattamente 3 cifre.");
    }

    // Validazione scadenza (data futura)
    if (scadenza) {
        let oggi = new Date();
        let dataScadenza = new Date(scadenza + "-01"); // Aggiunge il giorno 1 per creare un oggetto Date
        if (dataScadenza < oggi) {
            errori.push("La data di scadenza deve essere futura.");
        }
    }

    // Se ci sono errori, mostro un alert e blocco l'invio del modulo
    if (errori.length > 0) {
        alert(errori.join("\n"));
        return false;
    }

    return true; // Tutti i controlli sono passati
}

function validaLuhn(numero) {
    let somma = 0;
    let doppio = false;
    for (let i = numero.length - 1; i >= 0; i--) {
        let cifra = parseInt(numero[i], 10);
        if (doppio) {
            cifra *= 2;
            if (cifra > 9) {
                cifra -= 9;
            }
        }
        somma += cifra;
        doppio = !doppio;
    }
    return somma % 10 === 0;
}
