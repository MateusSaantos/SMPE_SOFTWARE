document.addEventListener('DOMContentLoaded', () => {
  // abre/fecha submenus
  document.querySelectorAll('.has-submenu').forEach(li => {
    const top = li.querySelector('.menu-item-top');
    if (top) {
      top.addEventListener('click', () => li.classList.toggle('active'));
    }
  });

  // hamburger (mobile)
  const btn = document.getElementById('menu-toggle');
  const menu = document.getElementById('sidebarMenu');
  if (btn && menu) {
    btn.addEventListener('click', () => menu.classList.toggle('show'));
  }
});
