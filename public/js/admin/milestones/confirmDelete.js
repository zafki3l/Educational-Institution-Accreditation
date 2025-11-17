function showConfirm(milestoneId) {
    document.getElementById('confirmModal-' + milestoneId).style.display = 'block';
}

function closeModal(milestoneId) {
    document.getElementById('confirmModal-' + milestoneId).style.display = 'none';
}