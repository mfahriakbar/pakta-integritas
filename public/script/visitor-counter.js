function updateVisitorStats() {
    console.log('Updating visitor stats...');
    fetch('/visitors/record', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
    })       
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            document.getElementById('totalVisitors').textContent = data.stats.total.toLocaleString();
            document.getElementById('todayVisitors').textContent = data.stats.today.toLocaleString();
            document.getElementById('yesterdayVisitors').textContent = data.stats.yesterday.toLocaleString();
        }
    })
    .catch(error => {
        console.error('Error:', error);
        // Jika gagal, tetap tampilkan 0
        document.getElementById('totalVisitors').textContent = '0';
        document.getElementById('todayVisitors').textContent = '0';
        document.getElementById('yesterdayVisitors').textContent = '0';
    });
}

// Update stats ketika halaman dimuat
document.addEventListener('DOMContentLoaded', updateVisitorStats);