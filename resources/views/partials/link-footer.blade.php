<script>
    document.addEventListener('DOMContentLoaded', (event) => {
        function updateClock() {
            const clockElement = document.getElementById('heure_');
            const now = new Date();
            const hours = String(now.getHours()).padStart(2, '0');
            const minutes = String(now.getMinutes()).padStart(2, '0');
            const seconds = String(now.getSeconds()).padStart(2, '0');
            clockElement.textContent = `${hours}:${minutes}:${seconds}  ${now.getDate()}/${now.getMonth()}/${now.getFullYear()}`;
        }

        setInterval(updateClock, 1000);
        updateClock();
    });
</script>
<script src="{{ asset('cdn/js/app.bundle.js') }}"></script>
<script src="{{ asset("cdn/js/html5-qrcode.min.js.js") }}"></script>
