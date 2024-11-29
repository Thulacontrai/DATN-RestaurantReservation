import './bootstrap';

window.Echo.channel('table')
    .listen('MessageSent', (e) => {
        const layoutTable = document.getElementById('layoutTable');
        layoutTable.innerHTML = e.tables.map(item => {
            if (selectedTableId != item.id) {
                return `
            <div class="table-card ${item.status}"
            data-table-id="${item.id}" data-status="${item.status}">
            <span class="table-number">Bàn ${item.table_number}</span>
            <span>
                 ${item.orders && item.orders.length > 0 ?
                        '<i class="fa-solid fa-id-card"></i> ' + item.orders.map(order => order.id).join(", ") :
                        ''}
            </span>
            </div>
            `;
            } else {
                return `
                <div class="table-card ${item.status}" style="background-color: rgb(0, 123, 255);"
     data-table-id="${item.id}" data-status="${item.status}">
    <span class="table-number" style="color:white">Bàn ${item.table_number}</span>
    <span style="color:white">
         ${item.orders && item.orders.length > 0 ?
                        '<i class="fa-solid fa-id-card"></i> ' + item.orders.map(order => order.id).join(", ") :
                        ''}
    </span>
</div>

                `;
            }
        }).join('');
    });
