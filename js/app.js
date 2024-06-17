document.addEventListener("DOMContentLoaded", function() {
    const slides = document.querySelectorAll('.carousel .list .item');
    let currentSlide = 0;

    function resetAnimation() {
        slides.forEach(slide => {
            slide.style.animation = 'none';
            slide.offsetHeight; // Trigger reflow to reset animation
            slide.style.animation = null;
        });
    }

    function showSlide(index, direction) {
        resetAnimation(); // Reset animations to re-trigger them

        // Remove active, prev, and next classes from all slides
        slides.forEach((slide, idx) => {
            slide.classList.remove('active', 'prev', 'next');
            slide.style.opacity = '0'; // Hide all slides
        });

        // Activate the current slide
        const current = slides[index];
        current.classList.add('active');
        current.style.opacity = '1';
        current.style.animation = 'showContent 0.5s forwards';

        // Handle the previous and next slides for transition effect
        const prevIndex = index === 0 ? slides.length - 1 : index - 1;
        const nextIndex = (index + 1) % slides.length;

        const prev = slides[prevIndex];
        const next = slides[nextIndex];

        prev.classList.add('prev');
        next.classList.add('next');

        // Add direction class for animation
        if (direction === 'next') {
            current.style.transform = 'translateX(100%)';
            current.style.animation = 'showContent 0.5s forwards';
            prev.style.transform = 'translateX(-100%)';
        } else {
            current.style.transform = 'translateX(-100%)';
            current.style.animation = 'showContent 0.5s forwards';
            next.style.transform = 'translateX(100%)';
        }
    }

    document.getElementById('next').addEventListener('click', () => {
        currentSlide = (currentSlide + 1) % slides.length;
        showSlide(currentSlide, 'next');
    });

    document.getElementById('prev').addEventListener('click', () => {
        currentSlide = (currentSlide - 1 + slides.length) % slides.length;
        showSlide(currentSlide, 'prev');
    });

    // Initialize the carousel with the first slide
    showSlide(currentSlide, 'next');
});

document.addEventListener("DOMContentLoaded", function() {
    const slider = document.getElementById('slider');
    const sliderUl = slider.querySelector('ul');
    const slides = slider.querySelectorAll('ul li');
    const slideCount = slides.length;
    let slideWidth = slider.offsetWidth;

    function updateSlider() {
        slideWidth = slider.offsetWidth;
        sliderUl.style.width = slideCount * slideWidth + "px";
        slides.forEach(slide => {
            slide.style.width = slideWidth + "px";
        });
    }

    function moveLeft() {
        sliderUl.style.transition = "none";
        sliderUl.insertBefore(sliderUl.lastElementChild, sliderUl.firstElementChild);
        sliderUl.style.left = -slideWidth + "px";
        setTimeout(function() {
            sliderUl.style.transition = "left 0.4s ease-in-out";
            sliderUl.style.left = "0px";
        }, 50);
    }

    function moveRight() {
        sliderUl.style.transition = "left 0.4s ease-in-out";
        sliderUl.style.left = -slideWidth + "px";
        setTimeout(function() {
            sliderUl.style.transition = "none";
            sliderUl.appendChild(sliderUl.firstElementChild);
            sliderUl.style.left = "0px";
        }, 400);
    }

    document.querySelector('.control_next').addEventListener('click', moveRight);
    document.querySelector('.control_prev').addEventListener('click', moveLeft);

    window.addEventListener('resize', updateSlider);
    updateSlider();

    setInterval(moveRight, 4000); // Change image every 3 seconds
});
