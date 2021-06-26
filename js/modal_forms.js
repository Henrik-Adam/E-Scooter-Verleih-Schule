// Get the modal
var resForm = document.getElementById('reservationForm');

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
    if (event.target == resForm) {
        resForm.style.display = "none";
    }
}