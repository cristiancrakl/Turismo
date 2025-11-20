// Auth page animations
document.addEventListener("DOMContentLoaded", function () {
    // Elements
    const card = document.querySelector(".card");
    const userIcon = document.querySelector(".user-icon");
    const inputs = document.querySelectorAll(".input-group input");
    const button = document.querySelector(".btn-primary");
    const socialButtons = document.querySelectorAll(".social-auth-links .btn");

    // Card entrance animation
    if (card) {
        card.style.opacity = "0";
        card.style.transform = "translateY(30px) scale(0.95)";

        setTimeout(() => {
            card.style.transition =
                "all 0.8s cubic-bezier(0.25, 0.46, 0.45, 0.94)";
            card.style.opacity = "1";
            card.style.transform = "translateY(0) scale(1)";
        }, 100);
    }

    // User icon animation
    if (userIcon) {
        userIcon.style.opacity = "0";
        userIcon.style.transform = "scale(0.8) rotate(-10deg)";

        setTimeout(() => {
            userIcon.style.transition =
                "all 0.6s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
            userIcon.style.opacity = "1";
            userIcon.style.transform = "scale(1) rotate(0deg)";
        }, 300);
    }

    // Input focus animations
    inputs.forEach((input, index) => {
        input.addEventListener("focus", function () {
            this.parentElement.style.transform = "translateY(-2px)";
            this.parentElement.style.boxShadow =
                "0 5px 15px rgba(102, 126, 234, 0.2)";
        });

        input.addEventListener("blur", function () {
            this.parentElement.style.transform = "translateY(0)";
            this.parentElement.style.boxShadow = "none";
        });

        // Staggered entrance
        input.style.opacity = "0";
        input.style.transform = "translateX(-20px)";

        setTimeout(() => {
            input.style.transition = "all 0.5s ease";
            input.style.opacity = "1";
            input.style.transform = "translateX(0)";
        }, 500 + index * 100);
    });

    // Button hover and click animations
    if (button) {
        button.style.opacity = "0";
        button.style.transform = "translateY(20px)";

        setTimeout(() => {
            button.style.transition = "all 0.5s ease";
            button.style.opacity = "1";
            button.style.transform = "translateY(0)";
        }, 800);

        button.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-3px) scale(1.02)";
            this.style.boxShadow = "0 10px 30px rgba(102, 126, 234, 0.5)";
        });

        button.addEventListener("mouseleave", function () {
            this.style.transform = "translateY(0) scale(1)";
            this.style.boxShadow = "0 4px 15px rgba(102, 126, 234, 0.4)";
        });

        button.addEventListener("click", function (e) {
            // Ripple effect
            const ripple = document.createElement("div");
            ripple.style.position = "absolute";
            ripple.style.borderRadius = "50%";
            ripple.style.background = "rgba(255, 255, 255, 0.6)";
            ripple.style.transform = "scale(0)";
            ripple.style.animation = "ripple 0.6s linear";
            ripple.style.left = e.offsetX - 10 + "px";
            ripple.style.top = e.offsetY - 10 + "px";
            ripple.style.width = "20px";
            ripple.style.height = "20px";

            this.style.position = "relative";
            this.appendChild(ripple);

            setTimeout(() => {
                ripple.remove();
            }, 600);
        });
    }

    // Social buttons animations
    socialButtons.forEach((btn, index) => {
        btn.style.opacity = "0";
        btn.style.transform = "scale(0.8) translateY(20px)";

        setTimeout(() => {
            btn.style.transition =
                "all 0.4s cubic-bezier(0.68, -0.55, 0.265, 1.55)";
            btn.style.opacity = "1";
            btn.style.transform = "scale(1) translateY(0)";
        }, 1000 + index * 100);

        btn.addEventListener("mouseenter", function () {
            this.style.transform = "scale(1.1) translateY(-2px)";
        });

        btn.addEventListener("mouseleave", function () {
            this.style.transform = "scale(1) translateY(0)";
        });
    });

    // Background floating animation
    const body = document.body;
    let angle = 0;

    function animateBackground() {
        angle += 0.5;
        const x = Math.sin((angle * Math.PI) / 180) * 20;
        const y = Math.cos((angle * Math.PI) / 180) * 20;

        body.style.backgroundPosition = `${x}px ${y}px`;
        requestAnimationFrame(animateBackground);
    }

    animateBackground();

    // Add ripple animation keyframes dynamically
    const style = document.createElement("style");
    style.textContent = `
        @keyframes ripple {
            to {
                transform: scale(4);
                opacity: 0;
            }
        }
    `;
    document.head.appendChild(style);
});

// Password visibility toggle (optional enhancement)
function togglePassword(inputId) {
    const input = document.getElementById(inputId);
    const type =
        input.getAttribute("type") === "password" ? "text" : "password";
    input.setAttribute("type", type);
}
