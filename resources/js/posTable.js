import './bootstrap';

window.Echo.channel('table')
    .listen('MessageSent', (e) => {
        const layoutTable = document.getElementById('layoutTable');
        layoutTable.innerHTML = e.tables.map(item => {
            return `
            <div class="table-card ${item.status}"
            data-table-id="${item.id}" data-status="${item.status}">
            <span class="table-number">Bàn ${item.table_number}</span>
            <i class="material-icons text-${item.status == 'Available' ? 'success' : 'danger'}"
            style="font-size: 35px;padding-top: 50%;">
            ${item.status == 'Available' ? 'event_seat' : 'local_dining'}</i>
            </div>
            `;
        }).join('');
    });
