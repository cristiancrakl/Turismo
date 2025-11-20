// Dashboard Landing Page JavaScript

document.addEventListener("DOMContentLoaded", function () {
    // Mobile menu toggle
    const menuToggle = document.querySelector(".menu-toggle");
    const navbarNav = document.querySelector(".navbar-nav");

    if (menuToggle && navbarNav) {
        menuToggle.addEventListener("click", function () {
            navbarNav.classList.toggle("show");
        });
    }

    // Smooth scrolling for navigation links
    const navLinks = document.querySelectorAll(
        '.navbar-nav .nav-link[href^="#"]'
    );

    navLinks.forEach((link) => {
        link.addEventListener("click", function (e) {
            e.preventDefault();
            const targetId = this.getAttribute("href").substring(1);
            const targetElement = document.getElementById(targetId);

            if (targetElement) {
                targetElement.scrollIntoView({
                    behavior: "smooth",
                    block: "start",
                });
            }

            // Close mobile menu after clicking
            if (navbarNav.classList.contains("show")) {
                navbarNav.classList.remove("show");
            }
        });
    });

    // Add scroll effect to navbar
    const navbar = document.querySelector(".navbar-custom");
    let lastScrollTop = 0;

    window.addEventListener("scroll", function () {
        const scrollTop =
            window.pageYOffset || document.documentElement.scrollTop;

        if (scrollTop > lastScrollTop) {
            // Scrolling down
            navbar.style.transform = "translateY(-100%)";
        } else {
            // Scrolling up
            navbar.style.transform = "translateY(0)";
        }

        lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;

        // Add background color when scrolled
        if (scrollTop > 50) {
            navbar.style.backgroundColor = "rgba(255, 255, 255, 0.98)";
        } else {
            navbar.style.backgroundColor = "rgba(255, 255, 255, 0.95)";
        }
    });

    // Animate elements on scroll
    const observerOptions = {
        threshold: 0.1,
        rootMargin: "0px 0px -50px 0px",
    };

    const observer = new IntersectionObserver(function (entries) {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.style.opacity = "1";
                entry.target.style.transform = "translateY(0)";
            }
        });
    }, observerOptions);

    // Hero button hover effect
    const heroButton = document.querySelector(".btn-primary-custom");
    if (heroButton) {
        heroButton.addEventListener("mouseenter", function () {
            this.style.transform = "translateY(-2px) scale(1.05)";
        });

        heroButton.addEventListener("mouseleave", function () {
            this.style.transform = "translateY(0) scale(1)";
        });
    }

    // Hero background change on carousel image click
    const carouselImages = document.querySelectorAll(".carousel-container img");
    const heroBg = document.querySelector(".hero-bg");

    carouselImages.forEach((img) => {
        img.addEventListener("click", function () {
            const newBgUrl = this.getAttribute("data-bg");
            if (newBgUrl) {
                heroBg.style.backgroundImage = `linear-gradient(rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url('${newBgUrl}')`;
                // Add a temporary class for animation effect
                heroBg.classList.add("bg-changing");
                setTimeout(() => {
                    heroBg.classList.remove("bg-changing");
                }, 1000);
            }
        });
    });
});
