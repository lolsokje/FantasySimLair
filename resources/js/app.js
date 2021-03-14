require('./bootstrap');

const toggleSidebar = document.querySelector('#sidebarCollapse');
const sidebar = document.querySelector('#sidebar');

toggleSidebar.addEventListener('click', () => {
   if (sidebar.classList.contains('active')) {
       sidebar.classList.remove('active');
   } else {
       sidebar.classList.add('active');
   }
});