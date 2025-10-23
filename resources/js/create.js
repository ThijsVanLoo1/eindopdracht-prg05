window.addEventListener('load', init);

let inputs;

function init() {
    const select = document.getElementById('book_id');
    const createBookField = document.getElementById('createBookField');
    inputs = createBookField.querySelectorAll('input, textarea');

    if (!select || !createBookField) return;

    select.addEventListener('change', () => toggleNewBookFields(select, createBookField));
    toggleNewBookFields(select, createBookField);
}

function toggleNewBookFields(select, createBookField) {
    if (select.value === "") {
        showElement(createBookField);
    } else {
        hideElement(createBookField);
    }
}

function showElement(createBookField) {
    createBookField.style.display = 'block';
    inputs.forEach(input => input.disabled = false);
}

function hideElement(createBookField) {
    createBookField.style.display = 'none';
    inputs.forEach(input => input.disabled = true);
}
