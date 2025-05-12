document.addEventListener('DOMContentLoaded', function() {
    // Optional: Add any client-side validations or interactions
    const forms = document.querySelectorAll('form');
    
    forms.forEach(form => {
        form.addEventListener('submit', function(e) {
            const name = form.querySelector('input[name="name"]');
            const email = form.querySelector('input[name="email"]');
            const phone = form.querySelector('input[name="phone"]');
            
            let isValid = true;
            
            // Basic client-side validation
            if (name && name.value.trim() === '') {
                isValid = false;
                alert('Name cannot be empty');
            }
            
            if (email && (!email.value.includes('@') || email.value.trim() === '')) {
                isValid = false;
                alert('Please enter a valid email');
            }
            
            if (phone && phone.value.trim() === '') {
                isValid = false;
                alert('Phone cannot be empty');
            }
            
            if (!isValid) {
                e.preventDefault();
            }
        });
    });
});