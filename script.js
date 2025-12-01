
   // Mobile Menu Toggle

const menuButton = document.getElementById("menu-button");
const navLinks = document.querySelector(".nav-links");

if (menuButton && navLinks) {
    menuButton.addEventListener("click", () => {
        navLinks.classList.toggle("open");
        menuButton.innerHTML = navLinks.classList.contains("open") ? "✕" : "☰";
    });

    /* Close menu after clicking a link */
    document.querySelectorAll(".nav-links a").forEach(link => {
        link.addEventListener("click", () => {
            if (navLinks.classList.contains("open")) {
                navLinks.classList.remove("open");
                menuButton.innerHTML = "☰";
            }
        });
    });
}


   // Contact Form Validation

const form = document.getElementById("contact-form-id");
const messageDiv = document.getElementById("form-message");

if (form) {
    form.addEventListener("submit", (event) => {
        event.preventDefault();

        const name = document.getElementById("name").value.trim();
        const email = document.getElementById("email").value.trim();
        const msg = document.getElementById("message").value.trim();

        if (!name || !email || !msg) {
            messageDiv.textContent = "Please fill all fields.";
            messageDiv.style.color = "red";
            return;
        }

        messageDiv.textContent = "Thank you! Your message has been sent.";
        messageDiv.style.color = "green";

        form.reset();
    });
}
   // Smooth Scrolling
document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener("click", function (event) {
        event.preventDefault();

        const target = document.querySelector(this.getAttribute("href"));
        if (target) {
            target.scrollIntoView({
                behavior: "smooth"
            });
        }
    });
});
