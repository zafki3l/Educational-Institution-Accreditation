document.querySelectorAll("[data-toggle]").forEach(button => {
    button.addEventListener("click", () => {
        const target = document.getElementById(button.dataset.toggle);
        if (!target) return;

        target.classList.toggle("open");

        const icon = button.querySelector(".nav-toggle i");
        if (icon) icon.classList.toggle("rotate");
    });
});