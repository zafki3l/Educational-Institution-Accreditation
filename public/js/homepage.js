// ============================================================================
// HOMEPAGE.JS - Homepage Interactions
// ============================================================================

document.addEventListener('DOMContentLoaded', function() {
    // Initialize toggle buttons
    initializeToggles();
    
    // Restore sidebar state
    restoreSidebarState();
});

/**
 * Initialize all toggle buttons
 */
function initializeToggles() {
    const toggleButtons = document.querySelectorAll('[data-toggle]');
    
    toggleButtons.forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            toggleNav(this);
            // Save state after toggle
            saveSidebarState();
        });
    });
    
    // Save state when clicking evidence links
    const evidenceLinks = document.querySelectorAll('a[href*="/evidences/"]');
    evidenceLinks.forEach(link => {
        link.addEventListener('click', function() {
            saveSidebarState();
        });
    });
}

/**
 * Toggle navigation item expand/collapse
 */
function toggleNav(button) {
    const targetId = button.getAttribute('data-toggle');
    const target = document.getElementById(targetId);
    
    if (!target) return;
    
    // Check current state
    const isExpanded = button.getAttribute('data-expanded') === 'true';
    
    // Toggle state
    if (isExpanded) {
        collapseNav(button, target);
    } else {
        expandNav(button, target);
    }
}

/**
 * Expand navigation
 */
function expandNav(button, target) {
    button.setAttribute('data-expanded', 'true');
    target.setAttribute('data-expanded', 'true');
}

/**
 * Collapse navigation
 */
function collapseNav(button, target) {
    button.setAttribute('data-expanded', 'false');
    target.setAttribute('data-expanded', 'false');
}

/**
 * Expand all standards (optional utility)
 */
function expandAll() {
    const buttons = document.querySelectorAll('[data-toggle]');
    buttons.forEach(button => {
        const target = document.getElementById(button.getAttribute('data-toggle'));
        if (target) {
            expandNav(button, target);
        }
    });
    saveSidebarState();
}

/**
 * Collapse all standards (optional utility)
 */
function collapseAll() {
    const buttons = document.querySelectorAll('[data-toggle]');
    buttons.forEach(button => {
        const target = document.getElementById(button.getAttribute('data-toggle'));
        if (target) {
            collapseNav(button, target);
        }
    });
    saveSidebarState();
}

/**
 * Save sidebar state to localStorage
 */
function saveSidebarState() {
    const state = {};
    const toggleButtons = document.querySelectorAll('[data-toggle]');
    
    toggleButtons.forEach(button => {
        const targetId = button.getAttribute('data-toggle');
        const isExpanded = button.getAttribute('data-expanded') === 'true';
        state[targetId] = isExpanded;
    });
    
    localStorage.setItem('sidebarState', JSON.stringify(state));
}

/**
 * Restore sidebar state from localStorage
 */
function restoreSidebarState() {
    const savedState = localStorage.getItem('sidebarState');
    
    if (!savedState) return;
    
    try {
        const state = JSON.parse(savedState);
        
        Object.keys(state).forEach(targetId => {
            const button = document.querySelector(`[data-toggle="${targetId}"]`);
            const target = document.getElementById(targetId);
            
            if (button && target) {
                if (state[targetId]) {
                    expandNav(button, target);
                } else {
                    collapseNav(button, target);
                }
            }
        });
    } catch (e) {
        console.error('Error restoring sidebar state:', e);
    }
}
