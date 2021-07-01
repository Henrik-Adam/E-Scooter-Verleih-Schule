var modalForm = document.getElementById('modalForm');

window.onclick = function(event) {
    if (event.target == modalForm) {
        modalForm.style.display = "none";
    }
}