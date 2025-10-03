document.addEventListener('DOMContentLoaded', function() {
    const page = document.querySelector('.transition-opacity');
    if (page) page.classList.add('opacity-100');

    // Add intersection observer for scroll animations
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -50px 0px'
    };

    const observer = new IntersectionObserver((entries) => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-fade-in-up');
            }
        });
    }, observerOptions);

    // Observe all major sections
    document.querySelectorAll('.bg-white\\/90, .bg-white\\/80').forEach(section => {
        observer.observe(section);
    });

    // Add loading animation for stats cards
    const statsCards = document.querySelectorAll('[class*="group bg-white"]');
    statsCards.forEach((card, index) => {
        card.style.animationDelay = `${index * 0.1}s`;
        card.classList.add('animate-fade-in-up');
    });

    const modal = document.getElementById('parts-modal');
    const modalTitle = document.getElementById('modal-title');
    const modalBody = document.getElementById('modal-body');

    // Enhanced parts viewing function
    window.viewParts = function(partsData, judul) {
        const parts = partsData;
            
            modalTitle.textContent = 'Lampiran untuk: ' + judul;
            
            if (parts.length > 0) {
                let content = '<div class="space-y-3">';
                parts.forEach(part => {
                    let icon = '';
                    let color = '';
                    switch(part.part_type) {
                        case 'video': 
                            icon = 'fa-video';
                            color = 'bg-red-100 text-red-600';
                            break;
                        case 'image': 
                            icon = 'fa-image';
                            color = 'bg-blue-100 text-blue-600';
                            break;
                        case 'pdf': 
                            icon = 'fa-file-pdf';
                            color = 'bg-purple-100 text-purple-600';
                            break;
                        case 'link': 
                            icon = 'fa-link';
                            color = 'bg-green-100 text-green-600';
                            break;
                    }
                    
                    content += `
                        <div class="flex items-center p-3 rounded-lg ${color} bg-opacity-50">
                            <i class="fas ${icon} mr-3 text-lg"></i>
                            <div>
                                <h4 class="font-medium">${part.part_title}</h4>
                                <p class="text-xs text-gray-500">${part.part_type}</p>
                            </div>
                        </div>
                    `;
                });
                content += '</div>';
                modalBody.innerHTML = content;
            } else {
                modalBody.innerHTML = '<p class="text-center text-gray-500 py-8">Tidak ada lampiran untuk materi ini.</p>';
            }
            
            modal.classList.remove('hidden');
            document.body.style.overflow = 'hidden';
        }

    function closeModal() {
        const modal = document.getElementById('parts-modal');
        modal.classList.add('hidden');
        document.body.style.overflow = '';
    }

    window.closeModal = closeModal;
});
