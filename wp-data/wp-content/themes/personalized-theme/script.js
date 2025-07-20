document.addEventListener("DOMContentLoaded", function () {
    const burgerBtn = document.getElementById("burger-btn");
    const closeBtn = document.getElementById("close-btn");
    const navMenu = document.getElementById("mobile-nav");

    if (burgerBtn && navMenu) {
        burgerBtn.addEventListener("click", function () {
            navMenu.classList.add("active");
        });
    }

    if (closeBtn && navMenu) {
        closeBtn.addEventListener("click", function () {
            navMenu.classList.remove("active");
        });
    }
});