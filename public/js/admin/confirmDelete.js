function showConfirm(userId) {
    document.getElementById('confirmModal-' + userId).style.display = 'block';
}

function closeModal(userId) {
    document.getElementById('confirmModal-' + userId).style.display = 'none';
}