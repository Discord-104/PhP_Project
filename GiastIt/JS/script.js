document.addEventListener('DOMContentLoaded', function() {
    document.getElementById('metodoPagamento').addEventListener('change', function() {
        let datiCartaContainer = document.getElementById('datiCartaContainer');
        datiCartaContainer.innerHTML = ''; // Pulisce il contenitore

        if (this.value == 'carta') {
            let inputCodice = document.createElement('input');
            inputCodice.type = 'text';
            inputCodice.name = 'codice';
            inputCodice.placeholder = 'Codice Carta';
            inputCodice.required = true;

            let inputScadenza = document.createElement('input');
            inputScadenza.type = 'text';
            inputScadenza.name = 'scadenza';
            inputScadenza.placeholder = 'Data Scadenza (MM/AA)';
            inputScadenza.required = true;

            let inputCVV = document.createElement('input');
            inputCVV.type = 'text';
            inputCVV.name = 'cvv';
            inputCVV.placeholder = 'CVV';
            inputCVV.required = true;

            datiCartaContainer.appendChild(inputCodice);
            datiCartaContainer.appendChild(inputScadenza);
            datiCartaContainer.appendChild(inputCVV);
        }
    });
});