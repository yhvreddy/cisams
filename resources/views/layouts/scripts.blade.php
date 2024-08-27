<script src="{{ url('assets/js/scripts.js') }}"></script>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    document.getElementById('navbar-toggle').addEventListener('click', function() {
        var menu = document.getElementById('navbar-menu');
        if (menu.classList.contains('show')) {
            menu.classList.remove('show');
        } else {
            menu.classList.add('show');
        }
    });
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const toggleButton = document.querySelector('.navbar-toggle');
        const dropdownMenu = document.querySelector('.dropdown-menu');

        toggleButton.addEventListener('click', () => {
            dropdownMenu.style.display = dropdownMenu.style.display === 'block' ? 'none' : 'block';
        });

        document.addEventListener('click', (event) => {
            if (!event.target.closest('.navbar-item')) {
                dropdownMenu.style.display = 'none';
            }
        });
    });
</script>

<script>
    document.getElementById('hamburger-menu').addEventListener('click', function() {
        var nav = document.getElementById('mobile-nav');
        nav.classList.toggle('active');
    });
</script>

<script>
    $(".refresh-cpatcha").click(function() {
        $.ajax({
            type: 'GET',
            url: "{{ route('generate.captcha') }}",
            xhrFields: {
                responseType: 'arraybuffer' // This ensures the response is treated as binary data
            },
            success: function(data) {
                const base64String = arrayBufferToBase64(data);
                $(".captcha span img").attr('src', 'data:image/png;base64,' + base64String);
            }
        });
    });

    // Helper function to convert ArrayBuffer to Base64 string
    function arrayBufferToBase64(buffer) {
        let binary = '';
        const bytes = new Uint8Array(buffer);
        const len = bytes.byteLength;

        for (let i = 0; i < len; i++) {
            binary += String.fromCharCode(bytes[i]);
        }

        return window.btoa(binary);
    }
</script>
