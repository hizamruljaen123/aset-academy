// Admin Assignments JavaScript
// File: assets/js/assignments-admin.js

function openModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.remove('hidden');
        modal.classList.add('flex');
    }
}

function closeModal(modalId) {
    const modal = document.getElementById(modalId);
    if (modal) {
        modal.classList.add('hidden');
        modal.classList.remove('flex');
    }
}

function openGradeModal(submissionId, currentGrade = '', currentFeedback = '') {
    document.getElementById('submission_id').value = submissionId;
    document.getElementById('grade_input').value = currentGrade;
    document.getElementById('feedback_input').value = currentFeedback;
    openModal('gradeModal');
}

function openDetailModal(studentName, content, grade, feedback, submittedAt, fileName, fileUrl) {
    document.getElementById('detailStudentName').innerText = studentName;
    document.getElementById('detailContent').innerText = content || 'Tidak ada konten teks.';
    document.getElementById('detailGrade').innerText = grade || 'Belum dinilai';
    document.getElementById('detailFeedback').innerText = feedback || 'Tidak ada feedback.';
    document.getElementById('detailSubmittedAt').innerText = submittedAt;
    
    const fileLink = document.getElementById('detailFileLink');
    if (fileName && fileUrl) {
        fileLink.href = fileUrl;
        fileLink.innerText = fileName;
        fileLink.parentElement.classList.remove('hidden');
    } else {
        fileLink.parentElement.classList.add('hidden');
    }
    
    openModal('viewDetailModal');
}

document.addEventListener('DOMContentLoaded', () => {
    const gradeForm = document.getElementById('gradeForm');
    if (gradeForm) {
        gradeForm.addEventListener('submit', async function(e) {
            e.preventDefault();

            const submissionId = document.getElementById('submission_id').value;
            const grade = document.getElementById('grade_input').value;
            const feedback = document.getElementById('feedback_input').value;
            const url = this.action; // Get URL from form action attribute

            const formData = new FormData();
            formData.append('submission_id', submissionId);
            formData.append('grade', grade);
            formData.append('feedback', feedback);

            try {
                const response = await fetch(url, {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();

                if (result.success) {
                    // Update UI dynamically
                    const row = document.querySelector(`tr[data-submission-id='${submissionId}']`);
                    if (row) {
                        row.querySelector('.submission-grade').innerText = parseFloat(grade).toFixed(1);
                        const statusCell = row.querySelector('.submission-status');
                        statusCell.innerHTML = `<span class="bg-green-100 text-green-800 px-2 py-1 rounded-full text-xs">Sudah Dinilai</span>`;
                    }
                    closeModal('gradeModal');
                    alert('Penilaian berhasil disimpan!'); // Or a more subtle notification
                } else {
                    alert('Gagal menyimpan penilaian: ' + result.message);
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Terjadi kesalahan saat mengirim data.');
            }
        });
    }
});
