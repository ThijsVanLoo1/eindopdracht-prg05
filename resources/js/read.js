window.addEventListener('load', init);

function init() {
    const table = document.querySelector("table");

    table.addEventListener('click', switchElement);
}

function switchElement(e) {
    if (e.target.classList.contains("toggle-btn")) {
        let toggle = e.target;
        let id = toggle.getAttribute("data-id");

        // Toggle visueel
        toggle.classList.toggle("active");
        toggle.innerText = toggle.classList.contains("active") ? "Actief" : "Inactief";

        //Stuur POST verzoek naar Route met bijbehorend id
        fetch(`/reviews/${id}/toggle`, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]').content,
                "Accept": "application/json",
                "Content-Type": "application/json"
            }
        })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toggle.innerText = data.label;
                    toggle.classList.toggle("active", data.active);
                }
            })
            .catch(error => console.error("Fout bij opslaan:", error));
    }
}
