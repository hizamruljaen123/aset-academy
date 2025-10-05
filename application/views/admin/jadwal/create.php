<div class="p-4 sm:p-6 lg:p-8">
    <!-- Header -->
    <div class="bg-gradient-to-r from-blue-500 to-indigo-500 text-white rounded-2xl p-6 mb-8 shadow-lg">
        <div class="flex justify-between items-center">
            <div>
                <h1 class="text-3xl font-bold">Tambah Jadwal Kelas</h1>
                <p class="text-sm opacity-90 mt-1">Pilih guru terlebih dahulu untuk melihat kelas yang tersedia</p>
            </div>
            <a href="<?= site_url('admin/jadwal'); ?>" class="inline-flex items-center px-4 py-2 bg-white text-indigo-600 font-bold rounded-lg shadow-md hover:bg-gray-100 transition-colors">
                <i class="fas fa-arrow-left mr-2"></i>
                Kembali
            </a>
        </div>
    </div>

    <!-- Content -->
    <div class="space-y-6">
        <div class="bg-white rounded-2xl shadow-md p-6">
            <form action="<?= site_url('admin/jadwal/store'); ?>" method="post" class="space-y-6" id="jadwalForm">
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <label for="guru_id" class="block text-sm font-medium text-gray-700 mb-1">Guru <span class="text-red-500">*</span></label>
                    <select name="guru_id" id="guru_id" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Guru</option>
                        <?php foreach ($guru as $g): ?>
                            <option value="<?= $g->id; ?>"><?= $g->nama_lengkap; ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label for="kelas_id" class="block text-sm font-medium text-gray-700 mb-1">Kelas <span class="text-red-500">*</span></label>
                    <select name="kelas_id" id="kelas_id" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required disabled>
                        <option value="">Pilih Guru Terlebih Dahulu</option>
                    </select>
                </div>
            </div>

            <div>
                <label for="judul_pertemuan" class="block text-sm font-medium text-gray-700 mb-1">Judul Pertemuan</label>
                <input type="text" name="judul_pertemuan" id="judul_pertemuan" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <div>
                    <label for="pertemuan_ke" class="block text-sm font-medium text-gray-700 mb-1">Pertemuan Ke</label>
                    <input type="number" name="pertemuan_ke" id="pertemuan_ke" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="tanggal_pertemuan" class="block text-sm font-medium text-gray-700 mb-1">Tanggal</label>
                    <input type="date" name="tanggal_pertemuan" id="tanggal_pertemuan" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="waktu_mulai" class="block text-sm font-medium text-gray-700 mb-1">Waktu Mulai</label>
                    <input type="time" name="waktu_mulai" id="waktu_mulai" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
                <div>
                    <label for="waktu_selesai" class="block text-sm font-medium text-gray-700 mb-1">Waktu Selesai</label>
                    <input type="time" name="waktu_selesai" id="waktu_selesai" class="w-full bg-gray-50 border border-gray-300 rounded-lg shadow-sm px-4 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                </div>
            </div>

            <div class="flex justify-end pt-4">
                <button type="submit" class="inline-flex items-center px-6 py-3 bg-indigo-600 hover:bg-indigo-700 text-white font-bold rounded-lg shadow-md transition-colors" id="submitBtn" disabled>
                    <i class="fas fa-save mr-2"></i>
                    Simpan Jadwal
                </button>
            </div>
            </form>
        </div>

        <div class="bg-white rounded-2xl shadow-md p-6">
            <h2 class="text-2xl font-bold text-gray-800">Kalender Jadwal</h2>
            <p class="text-sm text-gray-600 mt-2">Klik tanggal pada kalender untuk mengisi form secara otomatis. Klik acara yang sudah ada untuk menyalin jadwal.</p>
            <div id="selectedDateDisplay" class="mt-4 text-sm font-semibold text-indigo-600 hidden"></div>
            <div id="calendar" class="mt-4"></div>
            
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const guruSelect = document.getElementById('guru_id');
    const kelasSelect = document.getElementById('kelas_id');
    const submitBtn = document.getElementById('submitBtn');
    const calendarEl = document.getElementById('calendar');
    const tanggalInput = document.getElementById('tanggal_pertemuan');
    const waktuMulaiInput = document.getElementById('waktu_mulai');
    const waktuSelesaiInput = document.getElementById('waktu_selesai');
    const selectedDateDisplay = document.getElementById('selectedDateDisplay');
    const colorCache = new Map();

    function hashString(str) {
        let hash = 0;
        for (let i = 0; i < str.length; i += 1) {
            hash = (hash << 5) - hash + str.charCodeAt(i);
            hash |= 0;
        }
        return Math.abs(hash);
    }

    function hslToHex(h, s, l) {
        const hue = h / 360;
        const sat = s / 100;
        const light = l / 100;

        const hueToRgb = (p, q, t) => {
            let tempT = t;
            if (tempT < 0) tempT += 1;
            if (tempT > 1) tempT -= 1;
            if (tempT < 1 / 6) return p + (q - p) * 6 * tempT;
            if (tempT < 1 / 2) return q;
            if (tempT < 2 / 3) return p + (q - p) * (2 / 3 - tempT) * 6;
            return p;
        };

        let r;
        let g;
        let b;

        if (sat === 0) {
            r = g = b = light;
        } else {
            const q = light < 0.5 ? light * (1 + sat) : light + sat - light * sat;
            const p = 2 * light - q;
            r = hueToRgb(p, q, hue + 1 / 3);
            g = hueToRgb(p, q, hue);
            b = hueToRgb(p, q, hue - 1 / 3);
        }

        const toHex = (x) => {
            const hex = Math.round(x * 255).toString(16);
            return hex.length === 1 ? `0${hex}` : hex;
        };

        return `#${toHex(r)}${toHex(g)}${toHex(b)}`;
    }

    function getColorForClass(classKey) {
        const key = classKey || 'default';
        if (colorCache.has(key)) {
            return colorCache.get(key);
        }

        const hash = hashString(String(key));
        const hue = hash % 360;
        const saturation = 65;
        const lightness = 55;
        const colorHex = hslToHex(hue, saturation, lightness);
        colorCache.set(key, colorHex);
        return colorHex;
    }

    function hexToRgb(hex) {
        const sanitized = hex.replace('#', '');
        const bigint = parseInt(sanitized, 16);
        return {
            r: (bigint >> 16) & 255,
            g: (bigint >> 8) & 255,
            b: bigint & 255
        };
    }

    function getTextColorForBackground(backgroundHex) {
        const { r, g, b } = hexToRgb(backgroundHex);
        const luminance = (0.299 * r + 0.587 * g + 0.114 * b) / 255;
        return luminance > 0.6 ? '#111827' : '#ffffff';
    }

    function formatDateLabel(dateStr) {
        if (!dateStr) {
            return '';
        }
        const parts = dateStr.split('-').map(Number);
        if (parts.length !== 3 || parts.some(isNaN)) {
            return dateStr;
        }
        const [year, month, day] = parts;
        const date = new Date(year, month - 1, day);
        return date.toLocaleDateString('id-ID', {
            weekday: 'long',
            year: 'numeric',
            month: 'long',
            day: 'numeric'
        });
    }

    function updateSelectedDateDisplay(dateStr, eventTitle = null) {
        if (!selectedDateDisplay) {
            return;
        }

        if (!dateStr) {
            selectedDateDisplay.classList.add('hidden');
            selectedDateDisplay.textContent = '';
            return;
        }

        const formattedLabel = formatDateLabel(dateStr);
        selectedDateDisplay.textContent = eventTitle
            ? `${formattedLabel} • ${eventTitle}`
            : `Tanggal dipilih: ${formattedLabel}`;
        selectedDateDisplay.classList.remove('hidden');
    }

    function formatTimeForInput(timeStr) {
        if (!timeStr) {
            return '';
        }
        return timeStr.substring(0, 5);
    }

    if (calendarEl) {
        if (window.FullCalendar && typeof FullCalendar.Calendar === 'function') {
            const calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                height: 'auto',
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                selectable: true,
                events: '<?= site_url('admin/jadwal/get_events') ?>',
                eventDidMount(info) {
                    if (!info.el) {
                        return;
                    }

                    const classKey = info.event.extendedProps.classId
                        || `${info.event.extendedProps.classType || ''}-${info.event.title}`
                        || info.event.title;
                    const label = info.event.extendedProps.className || info.event.title;
                    const backgroundColor = getColorForClass(classKey);
                    const textColor = getTextColorForBackground(backgroundColor);

                    info.el.style.backgroundColor = backgroundColor;
                    info.el.style.borderColor = backgroundColor;
                    info.el.style.color = textColor;
                    info.el.style.whiteSpace = 'normal';
                    info.el.style.display = 'block';
                    info.el.style.lineHeight = '1.25';
                    info.el.style.fontSize = '0.85rem';

                    const titleEl = info.el.querySelector('.fc-event-title, .fc-event-title-container, .fc-event-title span');
                    if (titleEl) {
                        titleEl.style.whiteSpace = 'normal';
                        titleEl.style.wordBreak = 'break-word';
                        titleEl.style.color = textColor;
                    }

                    const timeEl = info.el.querySelector('.fc-event-time');
                    if (timeEl) {
                        timeEl.style.color = textColor;
                    }
                },
                dateClick(info) {
                    if (tanggalInput) {
                        tanggalInput.value = info.dateStr;
                        tanggalInput.dispatchEvent(new Event('change'));
                        updateSelectedDateDisplay(info.dateStr);
                    }
                    if (selectedDateDisplay) {
                        selectedDateDisplay.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
                    }
                    document.getElementById('jadwalForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
                },
                eventClick(info) {
                    info.jsEvent.preventDefault();

                    const startParts = info.event.startStr ? info.event.startStr.split('T') : [];
                    const endParts = info.event.endStr ? info.event.endStr.split('T') : [];

                    if (startParts.length) {
                        const [datePart, timePart] = startParts;
                        if (tanggalInput && datePart) {
                            tanggalInput.value = datePart;
                            tanggalInput.dispatchEvent(new Event('change'));
                            updateSelectedDateDisplay(datePart, info.event.title);
                        }
                        if (waktuMulaiInput && timePart) {
                            waktuMulaiInput.value = formatTimeForInput(timePart);
                            waktuMulaiInput.dispatchEvent(new Event('change'));
                        }
                    }

                    if (endParts.length) {
                        const [, endTimePart] = endParts;
                        if (waktuSelesaiInput && endTimePart) {
                            waktuSelesaiInput.value = formatTimeForInput(endTimePart);
                            waktuSelesaiInput.dispatchEvent(new Event('change'));
                        }
                    }

                    document.getElementById('jadwalForm').scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });

            calendar.render();
        } else {
            calendarEl.innerHTML = '<p class="text-sm text-red-500">Kalender gagal dimuat. Pastikan skrip FullCalendar tersedia.</p>';
        }
    }

    // Enable/disable form submission based on selections
    function checkFormValidity() {
        const guruSelected = guruSelect.value !== '';
        const kelasSelected = kelasSelect.value !== '';

        if (guruSelected && kelasSelected) {
            submitBtn.disabled = false;
            submitBtn.classList.remove('opacity-50', 'cursor-not-allowed');
        } else {
            submitBtn.disabled = true;
            submitBtn.classList.add('opacity-50', 'cursor-not-allowed');
        }
    }

    // Load classes when teacher is selected
    guruSelect.addEventListener('change', function() {
        const teacherId = this.value;

        if (teacherId) {
            // Show loading state
            kelasSelect.innerHTML = '<option value="">Memuat kelas...</option>';
            kelasSelect.disabled = true;

            // Fetch classes via AJAX
            fetch('<?= site_url("admin/jadwal/get_classes_by_teacher?teacher_id="); ?>' + teacherId)
                .then(response => response.json())
                .then(data => {
                    if (data.error) {
                        kelasSelect.innerHTML = '<option value="">Error: ' + data.error + '</option>';
                    } else {
                        kelasSelect.innerHTML = data.options;
                        kelasSelect.disabled = false;
                    }
                    checkFormValidity();
                })
                .catch(error => {
                    console.error('Error:', error);
                    kelasSelect.innerHTML = '<option value="">Error loading classes</option>';
                    kelasSelect.disabled = false;
                });
        } else {
            // Reset class selection when no teacher is selected
            kelasSelect.innerHTML = '<option value="">Pilih Guru Terlebih Dahulu</option>';
            kelasSelect.disabled = true;
            checkFormValidity();
        }
    });

    // Check form validity when class selection changes
    kelasSelect.addEventListener('change', checkFormValidity);

    // Initial form validity check
    checkFormValidity();
});
</script>
