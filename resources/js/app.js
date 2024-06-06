import './bootstrap';
import '~resources/scss/app.scss';
import * as bootstrap from 'bootstrap';
import.meta.glob([
    '../img/**'
]);

// --------------------------------------------INDEX CONFERMA ELIMINAZIONE------------------------------------------------
// far caricare la pagina e dopo di che..
document.addEventListener('DOMContentLoaded', function () {


    const deleteButtons = document.querySelectorAll('.js-delete-btn');

    deleteButtons.forEach(button => {
        button.addEventListener('click', function (event) {

            // prevenire l'invio predefinito del modulo
            event.preventDefault();
            // ottenere il modulo più vicino al bottone cliccato
            const form = button.closest('form');

            // ottenere il titolo del fumetto dall'attributo data-project-name
            const projectName = button.getAttribute('data-project-name');

            // mostrare il popup di conferma
            const confirmed = confirm(`Sei sicuro di voler eliminare "${projectName}"?`);

            // se l'utente conferma, invia il modulo
            // altrimenti, non fare nulla (azione di eliminazione annullata)
            if (confirmed) {
                form.submit();
            }
        });
    });

});
// -------------------------------------------/INDEX CONFERMA ELIMINAZIONE------------------------------------------------



// -------------------------------------------FAR COMPARIRE PER 4 SECONDI MESSAGGIO SESSIONE------------------------------
// messaggio che compare per 3 secondi con conferma eliminazione 
setTimeout(function () {
    let messageElement = document.querySelector('.mess-info');
    if (messageElement) {
        messageElement.classList.add('fade-out');
    }
}, 3000); //  3 secondi
// ------------------------------------------/FAR COMPARIRE PER 4 SECONDI MESSAGGIO SESSIONE------------------------------

// -------------------------------prova -elimanare piu elementi


// -------------------------------