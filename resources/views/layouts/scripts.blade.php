<script src="{{ url('assets/js/scripts.js') }}"></script>

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
