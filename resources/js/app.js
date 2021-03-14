require('./bootstrap');

const toggleSidebar = document.querySelector('#sidebarCollapse');
const sidebar = document.querySelector('#sidebar');

toggleSidebar.addEventListener('click', () => {
   if (sidebar.classList.contains('inactive')) {
       sidebar.classList.remove('inactive');
   } else {
       sidebar.classList.add('inactive');
   }
});