// Initialize Quill editor
function initQuill(selector, toolbarOptions = null) {
    const defaultToolbar = [
        ['bold', 'italic', 'underline', 'strike'],
        ['blockquote', 'code-block'],
        [{ 'header': 1 }, { 'header': 2 }],
        [{ 'list': 'ordered'}, { 'list': 'bullet' }],
        [{ 'script': 'sub'}, { 'script': 'super' }],
        [{ 'indent': '-1'}, { 'indent': '+1' }],
        [{ 'direction': 'rtl' }],
        [{ 'size': ['small', false, 'large', 'huge'] }],
        [{ 'header': [1, 2, 3, 4, 5, 6, false] }],
        [{ 'color': [] }, { 'background': [] }],
        [{ 'font': [] }],
        [{ 'align': [] }],
        ['clean'],
        ['link', 'image', 'video']
    ];

    const quill = new Quill(selector, {
        modules: {
            toolbar: toolbarOptions || defaultToolbar
        },
        theme: 'snow',
        placeholder: 'Tulis konten di sini...'
    });

    return quill;
}

// Handle form submission with Quill content
function setupQuillForm(formSelector, inputName = 'content') {
    const form = document.querySelector(formSelector);
    if (!form) return;
    
    form.addEventListener('submit', function(e) {
        const editor = this.querySelector('.ql-editor');
        if (editor) {
            const hiddenInput = document.createElement('input');
            hiddenInput.type = 'hidden';
            hiddenInput.name = inputName;
            hiddenInput.value = editor.innerHTML;
            this.appendChild(hiddenInput);
        }
    });
}
