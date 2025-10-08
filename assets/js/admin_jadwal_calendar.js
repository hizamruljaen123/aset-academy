document.addEventListener('DOMContentLoaded', () => {
    const searchInput = document.getElementById('searchInput');
    const jadwalTable = document.getElementById('jadwalTable');
    const calendarEl = document.getElementById('calendar');
    const calendarView = document.getElementById('calendar-view');
    const siteBase = (typeof window.siteUrl === 'string' ? window.siteUrl : '').replace(/\/+$/, '/') || '/';
    const eventsUrl = siteBase + 'admin/jadwal/get_events';
    const updateUrl = siteBase + 'admin/jadwal/update_event_timing';
    let calendar;
    const colorCache = new Map();
    const classLabels = new Map();

    function hashString(str) {
        let hash = 0;
        for (let i = 0; i < str.length; i += 1) {
            hash = (hash << 5) - hash + str.charCodeAt(i);
            hash |= 0; // Convert to 32bit integer
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
            r = g = b = light; // achromatic
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

    function getColorForClass(classKey, label) {
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

        if (label) {
            classLabels.set(key, label);
        }

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

    function initSearch() {
        if (!searchInput || !jadwalTable) {
            return;
        }
        const rows = jadwalTable.getElementsByTagName('tr');
        searchInput.addEventListener('keyup', () => {
            const filter = searchInput.value.toLowerCase();
            for (let i = 1; i < rows.length; i += 1) {
                const cells = rows[i].getElementsByTagName('td');
                let found = false;
                for (let j = 0; j < cells.length; j += 1) {
                    if (cells[j].innerText.toLowerCase().includes(filter)) {
                        found = true;
                        break;
                    }
                }
                rows[i].style.display = found ? '' : 'none';
            }
        });
    }

    function updateTableRow(event) {
        const row = document.querySelector(`[data-event-id="${event.id}"]`);
        if (!row) {
            return;
        }

        const dateCell = row.querySelector('[data-field="date"]');
        const timeCell = row.querySelector('[data-field="time"]');

        if (dateCell && event.start) {
            const eventDate = event.start;
            const formattedDate = eventDate.toLocaleDateString('id-ID', {
                day: '2-digit',
                month: 'short',
                year: 'numeric'
            });
            dateCell.textContent = formattedDate;
        }

        if (timeCell && event.start) {
            const startTime = event.start.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
            const endTime = event.end
                ? event.end.toLocaleTimeString('id-ID', { hour: '2-digit', minute: '2-digit' })
                : '';
            timeCell.textContent = endTime ? `${startTime} - ${endTime}` : startTime;
        }

        // Optional: keep table ordering by date/time if needed
        if (event.start) {
            row.setAttribute('data-start-timestamp', event.start.getTime());
        }
    }

    function postTimingUpdate(event) {
        const payload = new URLSearchParams({
            id: event.id,
            start: event.start ? event.start.toISOString() : '',
            end: event.end ? event.end.toISOString() : ''
        });

        return fetch(updateUrl, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
            },
            body: payload.toString()
        })
            .then(async (response) => {
                if (!response.ok) {
                    const text = await response.text();
                    throw new Error(text || 'Gagal memperbarui jadwal.');
                }
                return response.json();
            })
            .then((json) => {
                if (!json || json.status !== 'success') {
                    throw new Error((json && json.message) || 'Gagal memperbarui jadwal.');
                }
                updateTableRow(event);
            });
    }

    function initCalendar() {
        if (!calendarEl || typeof FullCalendar === 'undefined' || !FullCalendar.Calendar) {
            if (calendarEl) {
                calendarEl.innerHTML = '<p class="text-sm text-red-500">Kalender gagal dimuat. Pastikan skrip FullCalendar tersedia.</p>';
            }
            return;
        }

        calendar = new FullCalendar.Calendar(calendarEl, {
            initialView: 'dayGridMonth',
            height: 'auto',
            headerToolbar: {
                left: 'prev,next today',
                center: 'title',
                right: 'dayGridMonth,timeGridWeek,timeGridDay'
            },
            events(info, successCallback, failureCallback) {
                fetch(eventsUrl)
                    .then((response) => {
                        if (!response.ok) {
                            throw new Error('Gagal memuat jadwal.');
                        }
                        return response.json();
                    })
                    .then((data) => {
                        if (Array.isArray(data)) {
                            data.forEach((event) => {
                                const classKey = event.extendedProps && (event.extendedProps.classId || `${event.extendedProps.classType || ''}-${event.title}` || event.title);
                                const className = event.extendedProps && event.extendedProps.className ? event.extendedProps.className : event.title;
                                if (classKey && className) {
                                    classLabels.set(String(classKey), className);
                                }
                            });
                            renderLegend();
                        }
                        successCallback(data || []);
                    })
                    .catch((error) => {
                        console.error('Load events error:', error);
                        failureCallback(error);
                    });
            },
            selectable: true,
            editable: true,
            droppable: false,
            eventDurationEditable: true,
            eventDrop(info) {
                postTimingUpdate(info.event).catch((error) => {
                    console.error('Update gagal:', error);
                    info.revert();
                    alert(error.message || 'Gagal memperbarui jadwal.');
                });
            },
            eventResize(info) {
                postTimingUpdate(info.event).catch((error) => {
                    console.error('Update gagal:', error);
                    info.revert();
                    alert(error.message || 'Gagal memperbarui jadwal.');
                });
            },
            dateClick(info) {
                const createButton = document.querySelector('a[href$="admin/jadwal/create"]').cloneNode(true);
                createButton.classList.add('hidden'); // placeholder to ensure cloning does not affect layout
                console.log('Tanggal dipilih:', info.dateStr);
            },
            eventDidMount(info) {
                if (info.el) {
                    const classKey = info.event.extendedProps.classId
                        || `${info.event.extendedProps.classType || ''}-${info.event.title}`
                        || info.event.title;
                    const label = info.event.extendedProps.className || info.event.title;
                    if (classKey && label) {
                        classLabels.set(String(classKey), label);
                    }
                    const backgroundColor = getColorForClass(classKey, label);
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

                    renderLegend();
                }
            }
        });

        calendar.render();

        renderLegend();
    }

    function renderLegend() {
        const legendContainer = document.getElementById('calendarLegendItems');
        if (!legendContainer) {
            return;
        }

        legendContainer.innerHTML = '';

        const entries = Array.from(classLabels.entries());
        if (!entries.length) {
            legendContainer.innerHTML = '<p class="text-sm text-gray-500">Legend akan muncul setelah jadwal dimuat.</p>';
            return;
        }

        const fragment = document.createDocumentFragment();

        entries.sort((a, b) => a[1].localeCompare(b[1], 'id-ID'));

        entries.forEach(([key, label]) => {
            const color = getColorForClass(key, label);
            const textColor = getTextColorForBackground(color);
            const item = document.createElement('div');
            item.className = 'flex items-center space-x-3 p-3 rounded-lg border border-gray-200 shadow-sm';

            const swatch = document.createElement('span');
            swatch.className = 'flex-shrink-0 w-8 h-8 rounded-md border';
            swatch.style.backgroundColor = color;
            swatch.style.borderColor = color;

            const labelEl = document.createElement('span');
            labelEl.className = 'text-sm font-medium';
            labelEl.textContent = label;
            labelEl.style.color = '#111827';

            const contrastBadge = document.createElement('span');
            contrastBadge.className = 'px-2 py-1 text-xs rounded-full';
            contrastBadge.textContent = getTextColorForBackground(color) === '#ffffff' ? 'Teks putih' : 'Teks hitam';
            contrastBadge.style.backgroundColor = color;
            contrastBadge.style.color = textColor;

            item.appendChild(swatch);
            item.appendChild(labelEl);
            item.appendChild(contrastBadge);
            fragment.appendChild(item);
        });

        legendContainer.appendChild(fragment);
    }

    function observeCalendarVisibility() {
        if (!calendarView) {
            return;
        }

        const observer = new MutationObserver(() => {
            if (!calendarView.classList.contains('hidden')) {
                if (!calendar) {
                    initCalendar();
                } else {
                    calendar.updateSize();
                }
            }
        });

        observer.observe(calendarView, { attributes: true, attributeFilter: ['class'] });
    }

    initSearch();

    if (calendarView && !calendarView.classList.contains('hidden')) {
        initCalendar();
    } else {
        observeCalendarVisibility();
    }
});
