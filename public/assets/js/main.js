document.addEventListener("DOMContentLoaded", function() {
    const navItems = document.querySelector('.nav-items');
    const openNavBtn = document.querySelector('#open-nav-btn');
    const closeNavBtn = document.querySelector('#close-nav-btn');

    const sidebar = document.querySelector('aside');
    const showSidebarBtn = document.querySelector('#show-sidebar-btn');
    const hideSidebarBtn = document.querySelector('#hide-sidebar-btn');


    // ======== NAV RESPONSIVE============
    window.addEventListener('resize', function(){
        if(this.window.innerWidth > 1024)
        {
            navItems.style.display = 'flex';
            openNavBtn.style.display = 'none';
            closeNavBtn.style.display = 'none';

        }
        else 
        {
            navItems.style.display = 'none';
            openNavBtn.style.display = 'inline-block';
            closeNavBtn.style.display = 'none';
        }

        if(this.window.innerWidth > 600) {
            hideSidebarBtn.style.display = 'none';
            showSidebarBtn.style.display = 'none';
        }
        else {
            hideSidebarBtn.style.display = 'none';
            showSidebarBtn.style.display = 'inline-block';
        }
    });

    openNavBtn.addEventListener('click', function() {
        navItems.style.display = 'flex';
        openNavBtn.style.display = 'none';
        closeNavBtn.style.display = 'inline-block';
    });

    closeNavBtn.addEventListener('click', function() {
        navItems.style.display = 'none';
        openNavBtn.style.display = 'inline-block';
        closeNavBtn.style.display = 'none';
    });


    showSidebarBtn.addEventListener('click', function() {
        sidebar.style.left = '0';
        showSidebarBtn.style.display = 'none';
        hideSidebarBtn.style.display = 'inline-block';
    });

    hideSidebarBtn.addEventListener('click', function() {
        sidebar.style.left = '-100%';
        showSidebarBtn.style.display = 'inline-block';
        hideSidebarBtn.style.display = 'none';
    });
});