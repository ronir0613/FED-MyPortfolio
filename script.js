document.addEventListener('DOMContentLoaded', function() {
    // Contact Form Submission
    const contactForm = document.querySelector('.contact-form');
    const feedbackMessage = document.createElement('p');

    contactForm.addEventListener('submit', function(event) {
        event.preventDefault();
        feedbackMessage.textContent = 'Thank you for your message!';
        feedbackMessage.style.color = 'green';
        contactForm.appendChild(feedbackMessage);
        contactForm.reset();
    });

    // Feedback Form Submission
    const feedbackForm = document.querySelector('.feedback-form');
    const feedbackFormMessage = document.createElement('p');

    feedbackForm.addEventListener('submit', function(event) {
        event.preventDefault();
        feedbackFormMessage.textContent = 'Thank you for your feedback!';
        feedbackFormMessage.style.color = 'green';
        feedbackForm.appendChild(feedbackFormMessage);
        feedbackForm.reset();
    });
});
