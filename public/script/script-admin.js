// password
function togglePasswordVisibility() {
    // Ambil elemen checkbox dan input password
    const showPasswordCheckbox = document.getElementById("show-password");
    const passwordInput = document.getElementById("password");

    // Tambahkan event listener pada checkbox
    showPasswordCheckbox.addEventListener("change", function () {
        if (this.checked) {
            // Jika checkbox di centang, ubah tipe input menjadi text
            passwordInput.type = "text";
        } else {
            // Jika checkbox tidak di centang, ubah tipe input kembali menjadi password
            passwordInput.type = "password";
        }
    });
}

const dropdowns = document.querySelectorAll(".dropdown-admin, .dropdown-uji-kelayakan");

dropdowns.forEach((dropdown) => {
    const select = dropdown.querySelector(".select-admin, .select-uji-kelayakan");
    const caret = dropdown.querySelector(".fa-caret-down");
    const menu = dropdown.querySelector(".menu-admin, .menu-uji-kelayakan");
    const options = dropdown.querySelectorAll(".menu-admin li, .menu-uji-kelayakan li");
    const selected = dropdown.querySelector(".selected, .selected-uji-kelayakan");
    const accountSettings = document.querySelector(".box-admin-akun");

    const loadSelectedOption = () => {
        const savedOption = localStorage.getItem(dropdown.classList.contains("dropdown-admin") ? "selectedOption" : "selectedUjiKelayakanOption");
        if (savedOption) {
            selected.innerText = savedOption;
            options.forEach((option) => {
                if (option.innerText === savedOption) {
                    option.classList.add("active");
                } else {
                    option.classList.remove("active");
                }
            });
        }
    };

    loadSelectedOption();

    select.addEventListener("click", () => {
        select.classList.toggle("select-admin-clicked");
        caret.classList.toggle("fa-caret-down-rotate");
        menu.classList.toggle(dropdown.classList.contains("dropdown-admin") ? "menu-admin-open" : "menu-uji-kelayakan-open");

        accountSettings.style.marginTop = menu.classList.contains("menu-admin-open") || menu.classList.contains("menu-uji-kelayakan-open")
            ? `${menu.offsetHeight}px`
            : "0";
    });

    options.forEach((option) => {
        option.addEventListener("click", () => {
            selected.innerText = option.innerText;
            localStorage.setItem(dropdown.classList.contains("dropdown-admin") ? "selectedOption" : "selectedUjiKelayakanOption", option.innerText);

            select.classList.remove("select-admin-clicked");
            caret.classList.remove("fa-caret-down-rotate");
            menu.classList.remove(dropdown.classList.contains("dropdown-admin") ? "menu-admin-open" : "menu-uji-kelayakan-open");

            accountSettings.style.marginTop = "0";

            options.forEach((opt) => {
                opt.classList.remove("active");
            });
            option.classList.add("active");
        });
    });
});

const menusToReset = [
    document.querySelector(".box-admin"),
    document.querySelector(".box-admin-akun"),
];

menusToReset.forEach((menu) => {
    menu.addEventListener("click", () => {
        localStorage.setItem("selectedOption", "Pakta Integritas");
        localStorage.setItem("selectedUjiKelayakanOption", "Uji Kelayakan");
    });
});


document.addEventListener("DOMContentLoaded", function () {
    const noWhatsappInput = document.getElementById("no_whatsapp");
    if (noWhatsappInput) {
        noWhatsappInput.addEventListener("input", function (e) {
            if (this.value.startsWith("0")) {
                this.value = this.value.substring(1);
            }
        });

        document.querySelector("form").addEventListener("submit", function (e) {
            if (!noWhatsappInput.value.match(/^\d{8,14}$/)) {
                alert(
                    "Nomor WhatsApp harus terdiri dari 8 hingga 14 digit dan tidak boleh diawali dengan angka 0."
                );
                e.preventDefault();
            }
        });
    }
});

//delete
function confirmDelete(itemId) {
    Swal.fire({
        title: "Apa kamu yakin?",
        text: "Data ini tidak dapat dikembalikan",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus ini!",
        cancelButtonText: "Tidak, batalkan!",
    }).then((result) => {
        if (result.isConfirmed) {
            document.getElementById("delete-form-" + itemId).submit();
            Swal.fire({
                title: "Terhapus!",
                text: "Data kamu berhasil terhapus.",
                icon: "success",
            });
        }
    });
}

function confirmDelete(adminId) {
    Swal.fire({
        title: "Apa kamu yakin?",
        text: "Akun ini tidak dapat dikembalikan",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, hapus ini!",
        cancelButtonText: "Tidak, batalkan!",
    }).then((result) => {
        if (result.isConfirmed) {
            // Jika pengguna mengonfirmasi, kirim form untuk penghapusan data
            document.getElementById("delete-form-" + adminId).submit();
            Swal.fire({
                title: "Terhapus!",
                text: "Akun kamu berhasil terhapus.",
                icon: "success",
            });
        }
    });
}

//logout
document.getElementById("logout-btn").addEventListener("click", function (e) {
    e.preventDefault(); // Mencegah form logout langsung terkirim

    Swal.fire({
        title: "Apa kamu yakin?",
        text: "Anda akan keluar dari akun!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#28a745",
        cancelButtonColor: "#d33",
        confirmButtonText: "Ya, logout!",
        cancelButtonText: "Tidak, batalkan!",
    }).then((result) => {
        if (result.isConfirmed) {
            // Kirim form logout jika user mengkonfirmasi logout
            document.getElementById("logout-form").submit();

            // Optional: Menampilkan notifikasi logout berhasil
            Swal.fire({
                title: "Logout berhasil!",
                text: "Anda telah keluar dari akun.",
                icon: "success",
            });
        }
    });
});

function toggleForm() {
    var form = document.getElementById("userForm");
    var button = document.getElementById("toggleFormBtn");

    if (form.style.display === "none") {
        form.style.display = "block";
        button.textContent = "Minimize Form";

        // Reset form ke kondisi default (untuk tambah user baru)
        document.getElementById("addUserForm").action = "/admin/store";
        document.getElementById("methodField").value = "POST"; // Default POST method
        document.getElementById("userId").value = ""; // Reset user ID
        document.getElementById("name").value = ""; // Reset name field
        document.getElementById("email").value = ""; // Reset email field
        document.getElementById("password").value = ""; // Reset password field
        document.querySelector(
            'form#addUserForm button[type="submit"]'
        ).textContent = "Simpan";

        // Ubah judul form menjadi "Tambah Admin Baru"
        document.getElementById("formTitle").textContent = "Tambah Admin Baru";

        // Sembunyikan hint password
        document.getElementById("passwordHint").style.display = "none";
    } else {
        form.style.display = "none";
        button.textContent = "Tambah User Baru";
    }
}

// JavaScript untuk toggle visibility password
document.addEventListener("DOMContentLoaded", function () {
    // Pastikan semua elemen sudah ter-load sebelum menjalankan script
    const togglePasswordButton = document.getElementById("togglePassword");
    const passwordInput = document.getElementById("password");

    if (togglePasswordButton && passwordInput) {
        togglePasswordButton.addEventListener("click", function () {
            const icon = this; // Mengambil ikon mata (fa-eye/fa-eye-slash)

            // Toggle tipe input antara password dan text
            if (passwordInput.type === "password") {
                passwordInput.type = "text"; // Tampilkan password
                icon.classList.remove("fa-eye-slash"); // Ubah ikon ke mata terbuka
                icon.classList.add("fa-eye");
            } else {
                passwordInput.type = "password"; // Sembunyikan password
                icon.classList.remove("fa-eye"); // Ubah ikon ke mata tertutup
                icon.classList.add("fa-eye-slash");
            }
        });
    }
});

function editAdmin(id, name, email) {
    // Tampilkan form
    toggleForm();

    // Ubah nilai form untuk edit
    document.getElementById("name").value = name;
    document.getElementById("email").value = email;
    document.getElementById("userId").value = id;

    // Ganti method menjadi PUT untuk update
    document.getElementById("methodField").value = "PUT";

    // Ubah URL action menjadi URL update
    document.getElementById("addUserForm").action = "/admin/update/" + id;

    // Ubah button text
    document.querySelector(
        'form#addUserForm button[type="submit"]'
    ).textContent = "Perbarui";

    // Ubah judul form menjadi "Edit Akun Admin"
    document.getElementById("formTitle").textContent = "Edit Akun Admin";

    // Tampilkan hint password
    document.getElementById("passwordHint").style.display = "block";
}

// dropdown logout
function toggleDropdown() {
    const dropdownContent = document.getElementById("dropdownContent");
    const caretIcon = document.getElementById("caretIcon");

    // Tampilkan atau sembunyikan dropdown dan ubah ikon
    if (dropdownContent.style.display === "block") {
        dropdownContent.style.display = "none";
        caretIcon.classList.remove("rotate-icon"); // Kembalikan ikon ke posisi semula
    } else {
        dropdownContent.style.display = "block";
        caretIcon.classList.add("rotate-icon"); // Putar ikon saat dropdown dibuka
    }
}

// Tutup dropdown ketika klik di luar area dropdown
document.addEventListener("click", function (event) {
    const dropdownContent = document.getElementById("dropdownContent");
    const adminDropdown = document.getElementById("adminDropdown");
    const caretIcon = document.getElementById("caretIcon");

    if (
        !adminDropdown.contains(event.target) &&
        !dropdownContent.contains(event.target)
    ) {
        dropdownContent.style.display = "none";
        caretIcon.classList.remove("rotate-icon"); // Kembalikan ikon ke posisi semula jika dropdown tertutup
    }
});

document.addEventListener("DOMContentLoaded", function () {
    // Initialize all charts
    initPaktaIntegritasChart();
    initUjiKelayakanChart();
    initLaporSpgChart();
    initLaporK3Chart();
    initFkpChart();
});

// Utility function to setup year dropdown
function setupYearDropdown(dropdownId) {
    const currentYear = new Date().getFullYear();
    const dropdown = document.getElementById(dropdownId);
    if (dropdown) {
        for (let year = currentYear; year >= currentYear - 10; year--) {
            let option = document.createElement("option");
            option.value = year;
            option.textContent = year;
            dropdown.appendChild(option);
        }
    }
}

// Common chart options
const commonChartOptions = {
    responsive: true,
    maintainAspectRatio: false,
    scales: {
        x: {
            grid: { display: false },
            ticks: {
                font: { size: 12 },
                padding: 15,
            },
        },
        y: { beginAtZero: true },
    },
    plugins: {
        legend: {
            display: true,
            labels: { font: { size: 14 } },
        },
        tooltip: {
            backgroundColor: "rgba(0, 0, 0, 0.7)",
            titleColor: "#fff",
            bodyColor: "#fff",
            borderColor: "#fff",
            borderWidth: 1,
        },
    },
};

// Common labels for months
const monthLabels = [
    "Januari", "Februari", "Maret", "April", "Mei", "Juni",
    "Juli", "Agustus", "September", "Oktober", "November", "Desember"
];

// Pakta Integritas Chart
function initPaktaIntegritasChart() {
    const chartCanvas = document.getElementById("suratMasukChart");
    if (!chartCanvas) return;

    const ctx = chartCanvas.getContext("2d");
    const paktaChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: monthLabels,
            datasets: [{
                label: "Jumlah Surat Masuk",
                data: monthlyData,
                backgroundColor: "rgba(54, 162, 235, 0.2)",
                borderColor: "rgba(54, 162, 235, 1)",
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: "#8DC741",
                pointBorderColor: "rgba(54, 162, 235, 1)",
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 7,
                pointHitRadius: 10,
            }],
        },
        options: commonChartOptions
    });

    setupYearDropdown("filterTahun");

    // Update chart based on filters
    window.updateChart = function() {
        const selectedCategory = document.getElementById("filterSurat").value;
        const selectedYear = document.getElementById("filterTahun").value;

        fetch(`/admin/api/getDataSurat?year=${selectedYear}&category=${selectedCategory}`)
            .then(response => response.json())
            .then(data => {
                paktaChart.data.datasets[0].data = data.monthlyData;
                paktaChart.update();
            })
            .catch(error => console.error("Error fetching data:", error));
    };
}

// Uji Kelayakan Chart
function initUjiKelayakanChart() {
    const chartCanvas = document.getElementById("ujiKelayakanChart");
    if (!chartCanvas) return;

    const ctx = chartCanvas.getContext("2d");
    const ujiKelayakanChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: monthLabels,
            datasets: [{
                label: "Jumlah Pengguna Jasa",
                data: monthlyDataStudiKelayakan,
                backgroundColor: "rgba(255, 159, 64, 0.2)",
                borderColor: "rgba(255, 159, 64, 1)",
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: "#8DC741",
                pointBorderColor: "rgba(255, 159, 64, 1)",
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 7,
                pointHitRadius: 10,
            }, {
                label: "Jumlah Penyedia Jasa",
                data: monthlyDataPenyediaJasa,
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: "#8DC741",
                pointBorderColor: "rgba(75, 192, 192, 1)",
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 7,
                pointHitRadius: 10,
            }],
        },
        options: commonChartOptions
    });

    setupYearDropdown("filterTahunUjiKelayakan");

    window.updateUjiKelayakanChart = function() {
        const selectedYear = document.getElementById("filterTahunUjiKelayakan").value;
        
        fetch(`/admin/api/getDataSurat?year=${selectedYear}`)
            .then(response => response.json())
            .then(data => {
                ujiKelayakanChart.data.datasets[0].data = data.monthlyDataPenyediaJasa;
                ujiKelayakanChart.update();
            })
            .catch(error => console.error("Error fetching data:", error));
    };
}

// Laporan SPG Chart
function initLaporSpgChart() {
    const chartCanvas = document.getElementById("laporSpgChart");
    if (!chartCanvas) return;

    const ctx = chartCanvas.getContext("2d");
    const laporSpgChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: monthLabels,
            datasets: [{
                label: "Jumlah Laporan SPG",
                data: monthlyDataLaporSpg,
                backgroundColor: "rgba(255, 99, 132, 0.2)",
                borderColor: "rgba(255, 99, 132, 1)",
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: "#8DC741",
                pointBorderColor: "rgba(255, 99, 132, 1)",
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 7,
                pointHitRadius: 10,
            }],
        },
        options: commonChartOptions
    });

    setupYearDropdown("filterTahunSpg");

    window.updateLaporSpgChart = function() {
        const selectedYear = document.getElementById("filterTahunSpg").value;
        
        fetch(`/admin/api/getDataSurat?year=${selectedYear}`)
            .then(response => response.json())
            .then(data => {
                laporSpgChart.data.datasets[0].data = data.monthlyDataLaporSpg;
                laporSpgChart.update();
            })
            .catch(error => console.error("Error fetching data:", error));
    };
}

// Laporan K3 Chart
function initLaporK3Chart() {
    const chartCanvas = document.getElementById("laporK3Chart");
    if (!chartCanvas) return;

    const ctx = chartCanvas.getContext("2d");
    const laporK3Chart = new Chart(ctx, {
        type: "line",
        data: {
            labels: monthLabels,
            datasets: [{
                label: "Jumlah Laporan K3",
                data: monthlyDataLaporK3,
                backgroundColor: "rgba(153, 102, 255, 0.2)",
                borderColor: "rgba(153, 102, 255, 1)",
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: "#8DC741",
                pointBorderColor: "rgba(153, 102, 255, 1)",
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 7,
                pointHitRadius: 10,
            }],
        },
        options: commonChartOptions
    });

    setupYearDropdown("filterTahunK3");

    window.updateLaporK3Chart = function() {
        const selectedYear = document.getElementById("filterTahunK3").value;
        
        fetch(`/admin/api/getDataSurat?year=${selectedYear}`)
            .then(response => response.json())
            .then(data => {
                laporK3Chart.data.datasets[0].data = data.monthlyDataLaporK3;
                laporK3Chart.update();
            })
            .catch(error => console.error("Error fetching data:", error));
    };
}

// Laporan FKP
function initFkpChart() {
    const chartCanvas = document.getElementById("fkpChart");
    if (!chartCanvas) return;

    const ctx = chartCanvas.getContext("2d");
    const fkpChart = new Chart(ctx, {
        type: "line",
        data: {
            labels: monthLabels,
            datasets: [{
                label: "Jumlah Laporan FKP",
                data: monthlyDataFkp,
                backgroundColor: "rgba(75, 192, 192, 0.2)",
                borderColor: "rgba(75, 192, 192, 1)",
                borderWidth: 3,
                fill: true,
                tension: 0.4,
                pointBackgroundColor: "#8DC741",
                pointBorderColor: "rgba(75, 192, 192, 1)",
                pointBorderWidth: 2,
                pointRadius: 4,
                pointHoverRadius: 7,
                pointHitRadius: 10,
            }],
        },
        options: commonChartOptions
    });

    setupYearDropdown("filterTahunFkp");

    window.updateFkpChart = function() {
        const selectedYear = document.getElementById("filterTahunFkp").value;
        
        fetch(`/admin/api/getDataSurat?year=${selectedYear}`)
            .then(response => response.json())
            .then(data => {
                fkpChart.data.datasets[0].data = data.monthlyDataFkp;
                fkpChart.update();
            })
            .catch(error => console.error("Error fetching data:", error));
    };
}