// Permissions Management JavaScript
document.addEventListener('DOMContentLoaded', function() {
    // Fade in animation for permissions page
    const permissionsPage = document.querySelector('.transition-opacity');
    if (permissionsPage) {
        permissionsPage.classList.add('opacity-100');
    }

    // Add smooth scrolling for better UX
    const container = document.querySelector('.permissions-container');
    if (container) {
        container.style.scrollBehavior = 'smooth';
    }

    // Tab switching functionality
    const tabButtons = document.querySelectorAll('.tab-button');
    const tabContents = document.querySelectorAll('.tab-content');

    // Function to activate a specific tab
    function activateTab(tabName) {
        // Update button styles
        tabButtons.forEach(btn => {
            const isActive = btn.getAttribute('data-tab') === tabName;
            btn.classList.toggle('active', isActive);
            btn.classList.toggle('border-blue-500', isActive);
            btn.classList.toggle('text-blue-600', isActive);
            btn.classList.toggle('border-transparent', !isActive);
            btn.classList.toggle('text-gray-500', !isActive);
            btn.classList.toggle('hover:text-gray-700', !isActive);
            btn.classList.toggle('hover:border-gray-300', !isActive);
        });

        // Update content visibility
        tabContents.forEach(content => {
            const isContentActive = content.id === tabName + '-content';
            content.classList.toggle('hidden', !isContentActive);
            content.classList.toggle('active', isContentActive);
        });
    }

    // Add click event listeners to tab buttons
    tabButtons.forEach(button => {
        button.addEventListener('click', () => {
            const tabName = button.getAttribute('data-tab');
            activateTab(tabName);
        });
    });

    // Activate default tab on load
    if (tabButtons.length > 0) {
        const activeTab = document.querySelector('.tab-button.active');
        const defaultTab = activeTab ? activeTab.getAttribute('data-tab') : tabButtons[0].getAttribute('data-tab');
        activateTab(defaultTab);
    }

    // Initialize search and filter functionality
    const searchInput = document.getElementById('search');
    const roleFilter = document.getElementById('role_filter');
    const statusFilter = document.getElementById('status_filter');
    const matrixBody = document.getElementById('matrix-body');
    const permissionsBody = document.getElementById('permissions-body');

    function filterPermissions() {
        const searchTerm = searchInput.value.toLowerCase();
        const selectedRole = roleFilter.value.toLowerCase();
        const selectedStatus = statusFilter.value;

        // Filter Matrix Table - search within visible modules only
        const matrixRows = document.querySelectorAll('.permission-row');
        matrixRows.forEach(row => {
            const action = row.querySelector('.action-cell').textContent.toLowerCase();
            const searchMatch = action.includes(searchTerm);
            row.style.display = searchMatch ? '' : 'none';
        });

        // Filter Detailed Permissions Table
        const detailRows = permissionsBody.querySelectorAll('.permission-detail-row');
        detailRows.forEach(row => {
            const module = row.querySelector('.module-detail-cell').textContent.toLowerCase();
            const action = row.querySelector('.action-detail-cell').textContent.toLowerCase();
            const role = row.querySelector('.role-cell').textContent.toLowerCase();
            const status = row.querySelector('.status-cell').textContent.toLowerCase();

            const roleMatch = !selectedRole || role.includes(selectedRole.replace('_', ' '));
            const statusMatch = !selectedStatus || status === selectedStatus;
            const searchMatch = module.includes(searchTerm) || action.includes(searchTerm) || role.includes(searchTerm);

            const showRow = searchMatch && roleMatch && statusMatch;
            row.style.display = showRow ? '' : 'none';
        });
    }

    // Add event listeners
    if (searchInput && roleFilter && statusFilter) {
        searchInput.addEventListener('input', filterPermissions);
        roleFilter.addEventListener('change', filterPermissions);
        statusFilter.addEventListener('change', filterPermissions);

        // Clear search on ESC key
        searchInput.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                this.value = '';
                filterPermissions();
            }
        });
    }

    // Add loading animation for actions
    const actionLinks = document.querySelectorAll('a[onclick*="confirm"]');
    actionLinks.forEach(link => {
        link.addEventListener('click', function(e) {
            const confirmText = this.getAttribute('onclick');
            if (confirmText) {
                const match = confirmText.match(/confirm\('([^']+)'\)/);
                if (match && !confirm(match[1])) {
                    e.preventDefault();
                    return false;
                }
            }

            // Add loading state
            this.innerHTML = '<i class="fas fa-spinner fa-spin"></i>';
            this.style.pointerEvents = 'none';
        });
    });

    // Add fade-in animation for table rows
    const tableRows = document.querySelectorAll('.permission-row, .permission-detail-row');
    tableRows.forEach((row, index) => {
        row.style.opacity = '0';
        row.style.transform = 'translateY(10px)';

        setTimeout(() => {
            row.style.transition = 'all 0.3s ease-out';
            row.style.opacity = '1';
            row.style.transform = 'translateY(0)';
        }, index * 50);
    });

    // Add tooltip for better UX
    const tooltipElements = document.querySelectorAll('[title]');
    tooltipElements.forEach(element => {
        element.addEventListener('mouseenter', function(e) {
            // Create tooltip
            const tooltip = document.createElement('div');
            tooltip.className = 'fixed z-50 px-2 py-1 text-xs text-white bg-gray-900 rounded shadow-lg pointer-events-none';
            tooltip.textContent = this.getAttribute('title');
            document.body.appendChild(tooltip);

            // Position tooltip
            const rect = this.getBoundingClientRect();
            tooltip.style.left = rect.left + (rect.width / 2) - (tooltip.offsetWidth / 2) + 'px';
            tooltip.style.top = rect.top - tooltip.offsetHeight - 5 + 'px';

            this.addEventListener('mouseleave', function() {
                tooltip.remove();
            });
        });
    });
}); // This closes the DOMContentLoaded listener

// Module toggle functionality (global function for onclick handlers)
function toggleModule(moduleName) {
    const moduleContent = document.getElementById('module-' + moduleName);
    const toggleIcon = document.getElementById('icon-' + moduleName);

    if (moduleContent && toggleIcon) {
        const isHidden = moduleContent.style.display === 'none' || moduleContent.style.display === '';

        if (isHidden) {
            moduleContent.style.display = 'block';
            toggleIcon.classList.remove('fa-chevron-down');
            toggleIcon.classList.add('fa-chevron-up');
        } else {
            moduleContent.style.display = 'none';
            toggleIcon.classList.remove('fa-chevron-up');
            toggleIcon.classList.add('fa-chevron-down');
        }
    }
}

// Make toggleModule globally accessible
window.toggleModule = toggleModule;