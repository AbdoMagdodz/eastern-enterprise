function validateNumbers(inputElement) {
    inputElement.value = inputElement.value.replace(/[^\d()\-]/g, '');
}
