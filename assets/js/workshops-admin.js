// Workshops Admin JavaScript
// Enhanced functionality for admin workshops management

document.addEventListener('DOMContentLoaded', function() {
    // View switching functionality
    const tableViewBtn = document.getElementById('table-view-btn');
    const gridViewBtn = document.getElementById('grid-view-btn');
    const tableView = document.getElementById('table-view');
    const gridView = document.getElementById('grid-view');

    // View toggle handlers
    if (tableViewBtn && gridViewBtn) {
        tableViewBtn.addEventListener('click', function() {
            switchToTableView();
        });

        gridViewBtn.addEventListener('click', function() {
            switchToGridView();
        });
    }

    function switchToTableView() {
        if (tableView && gridView) {
            tableView.classList.remove('hidden');
            gridView.classList.add('hidden');
            tableViewBtn.classList.add('bg-white', 'text-gray-900', 'shadow-sm');
            tableViewBtn.classList.remove('text-gray-600');
            gridViewBtn.classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
            gridViewBtn.classList.add('text-gray-600');
        }
    }

    function switchToGridView() {
        if (gridView && tableView) {
            gridView.classList.remove('hidden');
            tableView.classList.add('hidden');
            gridViewBtn.classList.add('bg-white', 'text-gray-900', 'shadow-sm');
            gridViewBtn.classList.remove('text-gray-600');
            tableViewBtn.classList.remove('bg-white', 'text-gray-900', 'shadow-sm');
            tableViewBtn.classList.add('text-gray-600');
        }
    }

    // Enhanced search and filtering
    const searchInput = document.getElementById('search-workshop');
    const statusFilter = document.getElementById('status-filter');
    const typeFilter = document.getElementById('type-filter');
    const tableRows = document.querySelectorAll('#table-view tbody tr');
    const gridCards = document.querySelectorAll('.workshop-card');

    function filterItems() {
        const searchTerm = searchInput.value.toLowerCase();
        const statusValue = statusFilter.value;
        const typeValue = typeFilter.value;

        // Filter table rows
        tableRows.forEach(row => {
            if (row.cells.length > 1) { // Skip empty state row
                const title = row.cells[0].textContent.toLowerCase();
                const type = row.cells[0].textContent.toLowerCase();
                const location = row.cells[2].textContent.toLowerCase();
                const status = row.cells[4].textContent.toLowerCase();

                const matchesSearch = title.includes(searchTerm) || type.includes(searchTerm) || location.includes(searchTerm);
                const matchesStatus = !statusValue || status.toLowerCase().includes(statusValue);
                const matchesType = !typeValue || type.includes(typeValue);

                if (matchesSearch && matchesStatus && matchesType) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            }
        });

        // Filter grid cards
        gridCards.forEach(card => {
            const title = card.dataset.title || '';
            const location = card.dataset.location || '';
            const status = card.dataset.status || '';
            const type = card.dataset.type || '';

            const matchesSearch = title.includes(searchTerm) || location.includes(searchTerm);
            const matchesStatus = !statusValue || status === statusValue;
            const matchesType = !typeValue || type === typeValue;

            if (matchesSearch && matchesStatus && matchesType) {
                card.style.display = '';
            } else {
                card.style.display = 'none';
            }
        });

        // Update empty state visibility
        updateEmptyStates();
    }

    function updateEmptyStates() {
        const visibleTableRows = Array.from(tableRows).filter(row => row.style.display !== 'none' && row.cells.length > 1);
        const visibleGridCards = Array.from(gridCards).filter(card => card.style.display !== 'none');

        // Handle table empty state
        const tableEmptyState = document.querySelector('#table-view .col-span-full');
        if (tableEmptyState) {
            tableEmptyState.style.display = visibleTableRows.length === 0 && tableRows.length > 0 ? '' : 'none';
        }

        // Handle grid empty state
        const gridEmptyState = document.querySelector('#grid-view .col-span-full');
        if (gridEmptyState) {
            gridEmptyState.style.display = visibleGridCards.length === 0 && gridCards.length > 0 ? '' : 'none';
        }
    }

    // Event listeners for filters
    if (searchInput) searchInput.addEventListener('input', filterItems);
    if (statusFilter) statusFilter.addEventListener('change', filterItems);
    if (typeFilter) typeFilter.addEventListener('change', filterItems);

    // Poster gallery modal functionality
    function initializePosterGallery() {
        const posterImages = document.querySelectorAll('.workshop-card img, #table-view img');

        posterImages.forEach(img => {
            img.addEventListener('click', function(e) {
                e.preventDefault();
                openPosterModal(this.src, this.alt);
            });
        });
    }

    function openPosterModal(src, alt) {
        // Create modal for poster gallery
        const modal = document.createElement('div');
        modal.className = 'fixed inset-0 z-50 flex items-center justify-center p-4 bg-black bg-opacity-75';
        modal.innerHTML = `
            <div class="relative max-w-4xl max-h-full flex items-center justify-center">
                <img src="${src}" alt="${alt}" class="max-w-full max-h-full object-contain rounded-lg"
                     onerror="this.onerror=null; this.style.display='none'; this.nextElementSibling.style.display='flex';">
                <div class="max-w-full max-h-full flex items-center justify-center" style="display: none;">
                    <div class="text-center text-white">
                        <i class="fas fa-chalkboard-teacher text-6xl mb-4"></i>
                        <p class="text-lg font-medium">Poster Error</p>
                    </div>
                </div>
                <button class="absolute top-4 right-4 text-white text-2xl hover:text-gray-300 bg-black bg-opacity-50 rounded-full w-10 h-10 flex items-center justify-center" onclick="this.closest('.fixed').remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        `;

        modal.addEventListener('click', function(e) {
            if (e.target === this) {
                this.remove();
            }
        });

        document.body.appendChild(modal);
    }

    // Initialize poster gallery
    initializePosterGallery();

    // Add loading animation for cards
    const cards = document.querySelectorAll('.workshop-card');
    cards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate-fade-in-up');
    });

    // Initialize view based on saved preference or default to table
    const savedView = localStorage.getItem('workshopAdminView') || 'table';
    if (savedView === 'grid') {
        switchToGridView();
    } else {
        switchToTableView();
    }

    // Save view preference
    if (tableViewBtn && gridViewBtn) {
        tableViewBtn.addEventListener('click', () => localStorage.setItem('workshopAdminView', 'table'));
        gridViewBtn.addEventListener('click', () => localStorage.setItem('workshopAdminView', 'grid'));
    }

    // Enhanced error handling for images
    document.querySelectorAll('img').forEach(img => {
        img.addEventListener('error', function() {
            this.style.display = 'none';
            const fallback = this.nextElementSibling;
            if (fallback && fallback.classList.contains('image-fallback')) {
                fallback.style.display = 'flex';
            }
        });
    });

    // Keyboard navigation for accessibility
    document.addEventListener('keydown', function(e) {
        // Close modal with Escape key
        if (e.key === 'Escape') {
            const modal = document.querySelector('.fixed.inset-0.z-50');
            if (modal) {
                modal.remove();
            }
        }
    });

    // Initialize tooltips for action buttons
    const actionButtons = document.querySelectorAll('.action-btn');
    actionButtons.forEach(button => {
        const title = button.getAttribute('title');
        if (title) {
            button.addEventListener('mouseenter', function() {
                // Tooltip functionality can be added here
            });
        }
    });
});

// Utility functions
function formatDateTime(datetime) {
    const date = new Date(datetime);
    return date.toLocaleString('id-ID', {
        day: '2-digit',
        month: 'short',
        year: 'numeric',
        hour: '2-digit',
        minute: '2-digit'
    });
}

function formatCurrency(amount) {
    return new Intl.NumberFormat('id-ID', {
        style: 'currency',
        currency: 'IDR'
    }).format(amount);
}

// Export functions for potential use by other scripts
window.WorkshopAdminUtils = {
    formatDateTime,
    formatCurrency,
    switchToTableView: () => {
        const tableViewBtn = document.getElementById('table-view-btn');
        if (tableViewBtn) tableViewBtn.click();
    },
    switchToGridView: () => {
        const gridViewBtn = document.getElementById('grid-view-btn');
        if (gridViewBtn) gridViewBtn.click();
    }
};
