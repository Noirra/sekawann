document.addEventListener("DOMContentLoaded", function () {
    const preloader = document.querySelector(".preloader");
    const content = document.querySelector(".content");

    setTimeout(() => {
        preloader.style.opacity = "0";
        content.style.opacity = "1";
        content.style.display = "block";
    }, 2000);

    preloader.addEventListener("transitionend", function () {
        preloader.style.display = "none";
    });
});
