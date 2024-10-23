document.addEventListener('DOMContentLoaded', function() {
    const treeviewMenus = document.querySelectorAll('.has-treeview > a');

    treeviewMenus.forEach(function(menu) {
        menu.addEventListener('click', function(e) {
            e.preventDefault();
            const parentLi = this.parentNode;
            const submenu = parentLi.querySelector('.nav-treeview');
            const icon = this.querySelector('.fas.fa-angle-left');

            // Menüleri açıp kapatma
            if (submenu.style.display === 'block') {
                submenu.style.display = 'none';
                icon.style.transform = 'rotate(0deg)';
            } else {
                submenu.style.display = 'block';
                icon.style.transform = 'rotate(-90deg)';
            }
            parentLi.classList.toggle('menu-open');
        });
    });
});
