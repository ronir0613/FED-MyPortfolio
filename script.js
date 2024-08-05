
document.addEventListener('DOMContentLoaded', function() {
    const socialLinks = document.querySelectorAll('.social-links a');

    socialLinks.forEach(link => {
        link.addEventListener('mouseover', function() {
            const tooltip = document.createElement('span');
            tooltip.className = 'tooltip';
            tooltip.innerText = this.getAttribute('href').replace('https://www.', '').replace('.com/yourprofile', '');
            this.appendChild(tooltip);
        });

        link.addEventListener('mouseout', function() {
            const tooltip = this.querySelector('.tooltip');
            if (tooltip) {
                tooltip.remove();
            }
        });
    });
});

//for handling star rating
document.addEventListener('DOMContentLoaded', function() {
    const ratingInputs = document.querySelectorAll('.rating input[type="radio"]');
    let lastChecked = null;

    ratingInputs.forEach(input => {
        input.addEventListener('click', function() {
            if (lastChecked === this) {
                this.checked = false;
                lastChecked = document.getElementById('star0');
            } else {
                lastChecked = this;
            }
        });
    });

    const form = document.querySelector('.feedback-form');
    form.addEventListener('submit', function() {
        if (!Array.from(ratingInputs).some(input => input.checked && input.value !== '0')) {
            document.getElementById('star0').checked = true;
        }
    });
});



