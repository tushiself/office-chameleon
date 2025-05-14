<script src="{{ asset('admin-assets/js/jquery-3.7.1.min.js') }}"></script>
<script src="{{ asset('admin-assets/datatables/dataTables.min.js') }}"></script>
<script src="{{ asset('admin-assets/datatables/dataTables.responsive.js') }}"></script>
<script src="{{ asset('admin-assets/datatables/responsive.dataTables.js') }}"></script>
<script src="{{ asset('admin-assets/js/theme.js') }}"></script>
<script>
    $('.table-index').DataTable({
        responsive: true,
        paging: false,
        ordering: false,
        info: false,
        searching: false
    });

    // Show the first tab and hide the rest
    document.querySelector('#tabs-nav li:first-child').classList.add('active');
    document.querySelectorAll('.tab-content').forEach(function(content, index) {
        content.style.display = index === 0 ? 'block' : 'none';
    });

    // Click function for tab switching
    document.querySelectorAll('#tabs-nav li').forEach(function(tab) {
        tab.addEventListener('click', function(e) {
            e.preventDefault();

            // Remove 'active' from all tabs
            document.querySelectorAll('#tabs-nav li').forEach(function(t) {
                t.classList.remove('active');
            });

            // Add 'active' to the clicked tab
            this.classList.add('active');

            // Hide all tab contents
            document.querySelectorAll('.tab-content').forEach(function(content) {
                content.style.display = 'none';
            });

            // Show the active tab content
            const anchor = this.querySelector('a');
            if (anchor) {
                const activeTab = document.querySelector(anchor.getAttribute('href'));
                if (activeTab) {
                    activeTab.style.display = 'block';
                    activeTab.style.opacity = 0;
                    let opacity = 0;
                    const fade = setInterval(function() {
                        if (opacity >= 1) clearInterval(fade);
                        opacity += 0.1;
                        activeTab.style.opacity = opacity;
                    }, 30); // approximate fade-in
                }
            }
        });
    });
</script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="{{ asset('admin-assets/js/custom.calendar.js') }}"></script>

@yield('custom-js')
