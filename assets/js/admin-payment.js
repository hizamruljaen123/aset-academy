// Define base URL - use the correct project path
const base_url = window.location.origin + '/aset-academy/';

// Force cache refresh
console.log('Admin Payment JS loaded with base_url:', base_url);

// Payment Verification - Modal Controller

document.addEventListener('DOMContentLoaded', function() {
    try {
        // Initialize payment data
        const paymentsDataElement = document.getElementById('paymentsData');
        if (!paymentsDataElement) throw new Error('Payments data element not found');
        
        const paymentsData = JSON.parse(paymentsDataElement.textContent);
        
        // Modal configuration
        const modalConfig = ['detail', 'verify', 'reject'].map(name => ({
            name,
            element: document.getElementById(`${name}Modal`),
            closeBtn: document.querySelector(`#${name}Modal [data-close-modal]`)
        })).filter(m => m.element);

        // Initialize modals
        modalConfig.forEach(modal => {
            if (modal.closeBtn) {
                modal.closeBtn.addEventListener('click', () => {
                    modal.element.classList.add('hidden');
                });
            }
        });

        // Global modal functions
        window.hideModal = function(modalName) {
            const modal = modalConfig.find(m => m.name === modalName);
            if (modal) modal.element.classList.add('hidden');
        };

        // Modal functions
        function showDetailModal(paymentId) {
            const payment = paymentsData.find(p => p.id == paymentId);
            if (!payment) return;
            
            // Populate modal
            document.getElementById('detailStudent').textContent = payment.user_name;
            document.getElementById('detailClass').textContent = payment.class_name;
            document.getElementById('detailAmount').textContent = 'Rp ' + payment.amount.toLocaleString('id-ID');
            document.getElementById('detailMethod').textContent = payment.payment_method;
            document.getElementById('detailDate').textContent = new Date(payment.created_at).toLocaleDateString('id-ID');
            
            const statusMap = {'Pending':'Menunggu','Verified':'Terverifikasi','Rejected':'Ditolak'};
            document.getElementById('detailStatus').textContent = statusMap[payment.status] || payment.status;
            
            const proofImg = document.getElementById('detailProof');
            if (payment.payment_proof) {
                proofImg.src = base_url + 'uploads/payments/' + payment.payment_proof;
                proofImg.classList.remove('hidden');
            } else {
                proofImg.classList.add('hidden');
            }
            
            const modal = modalConfig.find(m => m.name === 'detail');
            if (modal) modal.element.classList.remove('hidden');
        }

        function showVerifyModal(paymentId) {
            document.getElementById('verifyForm').action = base_url + 'payment/admin_process_verify/' + paymentId;
            document.getElementById('verify_payment_id').value = paymentId;
            const modal = modalConfig.find(m => m.name === 'verify');
            if (modal) modal.element.classList.remove('hidden');
        }

        function showRejectModal(paymentId) {
            document.getElementById('rejectForm').action = base_url + 'payment/admin_process_verify/' + paymentId;
            document.getElementById('reject_payment_id').value = paymentId;
            const modal = modalConfig.find(m => m.name === 'reject');
            if (modal) modal.element.classList.remove('hidden');
        }

        // Global exports
        window.showDetailModal = showDetailModal;
        window.showVerifyModal = showVerifyModal;
        window.showRejectModal = showRejectModal;

    } catch (error) {
        console.error('Payment modal initialization error:', error);
    }
});
