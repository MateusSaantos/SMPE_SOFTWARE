document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".has-submenu").forEach(item => {
        item.addEventListener("click", function () {
            this.classList.toggle("active");
        });
    });
});
