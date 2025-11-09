function showConfirm(evidence_id) {
    const modal = document.getElementById('confirmModal-' + evidence_id);
    if (!modal) return;
    modal.style.display = 'block';

    // close when clicking outside modal-content
    modal.addEventListener('click', function (e) {
        if (e.target === modal) {
            closeModal(evidence_id);
        }
    });

    // close on Escape
    function escHandler(e) {
        if (e.key === 'Escape') {
            closeModal(evidence_id);
            document.removeEventListener('keydown', escHandler);
        }
    }

    document.addEventListener('keydown', escHandler);
}

function closeModal(evidence_id) {
    const modal = document.getElementById('confirmModal-' + evidence_id);
    if (!modal) return;
    modal.style.display = 'none';
}