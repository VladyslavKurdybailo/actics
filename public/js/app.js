// public/js/app.js

document.addEventListener('DOMContentLoaded', function() {
    const sidebar = document.getElementById('sidebar');
    const toggleBtn = document.getElementById('toggle-sidebar');
    const mainContent = document.querySelector('.main-content');

    // Початково згорнута панель
    sidebar.classList.add('collapsed');
    mainContent.classList.add('expanded');

    // Перемикаємо клас 'collapsed' при натисканні на кнопку
    toggleBtn.addEventListener('click', function() {
        sidebar.classList.toggle('collapsed');
        mainContent.classList.toggle('expanded');
    });
});
