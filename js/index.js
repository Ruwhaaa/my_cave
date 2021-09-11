const burger = document.querySelector("#burger");
const menuMobile = document.querySelector("nav");

burger.addEventListener("click", () => {
    menuMobile.classList.toggle("show");
});