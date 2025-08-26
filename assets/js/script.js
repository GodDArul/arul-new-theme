/**
 * JavaScript untuk Fungsionalitas Tema Arul New Theme
 *
 * File ini berisi semua kode JavaScript kustom untuk tema kamu.
 *
 * @package Arul_New_Theme
 */

// Menunggu sampai DOM (Document Object Model) selesai dimuat.
// Ini memastikan semua elemen HTML sudah tersedia sebelum script mencoba mengaksesnya.
document.addEventListener('DOMContentLoaded', function() {

    // Mendapatkan elemen tombol menu toggle.
    // Kita menggunakan querySelector untuk mencari elemen dengan kelas 'menu-toggle'.
    const menuToggle = document.querySelector('.menu-toggle');

    // Mendapatkan elemen navigasi utama.
    // Ini adalah elemen <nav> yang akan kita tambahkan/hapus kelas 'toggled'.
    const mainNavigation = document.querySelector('.main-navigation');

    // Memeriksa apakah kedua elemen (tombol dan navigasi) ditemukan di halaman.
    // Ini penting untuk menghindari error jika elemen tidak ada.
    if (menuToggle && mainNavigation) {
        // Menambahkan event listener ke tombol menu toggle.
        // Ketika tombol diklik, fungsi anonim di dalamnya akan dijalankan.
        menuToggle.addEventListener('click', function() {
            // Mengganti (toggle) kelas 'toggled' pada elemen navigasi utama.
            // Jika kelas 'toggled' ada, akan dihapus. Jika tidak ada, akan ditambahkan.
            mainNavigation.classList.toggle('toggled');

            // Mengganti nilai atribut aria-expanded untuk aksesibilitas.
            // Jika menu terbuka (toggled), aria-expanded menjadi 'true', sebaliknya 'false'.
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', !isExpanded);
        });
    }
});

// Contact Form JavaScript
document.addEventListener('DOMContentLoaded', function() {
    const contactForm = document.getElementById('contact-form');
    const formMessages = document.getElementById('form-messages');
    
    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            
            // Clear previous messages
            formMessages.innerHTML = '';
            
            const formData = new FormData(this);
            formData.append('action', 'submit_contact_form');
            
            const submitBtn = this.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            
            // Loading state
            submitBtn.innerHTML = '<span>Mengirim...</span>';
            submitBtn.disabled = true;
            submitBtn.classList.add('loading');
            
            // Remove previous error classes
            const inputs = this.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.classList.remove('error');
                const errorMsg = input.parentNode.querySelector('.error-message');
                if (errorMsg) {
                    errorMsg.remove();
                }
            });
            
            fetch(ajax_object.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Show success message
                    formMessages.innerHTML = `
                        <div class="success-message">
                            ${data.data}
                        </div>
                    `;
                    
                    // Reset form
                    contactForm.reset();
                    
                    // Scroll to message
                    formMessages.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    
                } else {
                    // Show error message
                    formMessages.innerHTML = `
                        <div class="alert error">
                            ${data.data}
                        </div>
                    `;
                    
                    // Scroll to message
                    formMessages.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                formMessages.innerHTML = `
                    <div class="alert error">
                        Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.
                    </div>
                `;
            })
            .finally(() => {
                // Reset button
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                submitBtn.classList.remove('loading');
            });
        });
        
        // Form validation on input
        const requiredFields = contactForm.querySelectorAll('[required]');
        requiredFields.forEach(field => {
            field.addEventListener('blur', validateField);
            field.addEventListener('input', function() {
                if (this.classList.contains('error')) {
                    validateField.call(this);
                }
            });
        });
        
        // Email field specific validation
        const emailField = document.getElementById('contact-email');
        if (emailField) {
            emailField.addEventListener('blur', function() {
                if (this.value && !isValidEmail(this.value)) {
                    showFieldError(this, 'Format email tidak valid');
                } else if (this.value) {
                    removeFieldError(this);
                }
            });
        }
    }
    
    // Field validation function
    function validateField() {
        const field = this;
        const value = field.value.trim();
        
        if (field.hasAttribute('required') && !value) {
            showFieldError(field, 'Field ini wajib diisi');
            return false;
        } else {
            removeFieldError(field);
            return true;
        }
    }
    
    // Show field error
    function showFieldError(field, message) {
        field.classList.add('error');
        
        // Remove existing error message
        const existingError = field.parentNode.querySelector('.error-message');
        if (existingError) {
            existingError.remove();
        }
        
        // Add new error message
        const errorElement = document.createElement('span');
        errorElement.classList.add('error-message');
        errorElement.textContent = message;
        field.parentNode.appendChild(errorElement);
    }
    
    // Remove field error
    function removeFieldError(field) {
        field.classList.remove('error');
        const errorMsg = field.parentNode.querySelector('.error-message');
        if (errorMsg) {
            errorMsg.remove();
        }
    }
    
    // Email validation function
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
    
    // Form input animations
    const formInputs = document.querySelectorAll('.form-group input, .form-group textarea, .form-group select');
    formInputs.forEach(input => {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (this.value === '') {
                this.parentElement.classList.remove('focused');
            }
        });
        
        // Check if input has value on page load
        if (input.value !== '') {
            input.parentElement.classList.add('focused');
        }
    });
    
    // Smooth scroll for form messages
    function scrollToElement(element) {
        element.scrollIntoView({
            behavior: 'smooth',
            block: 'center'
        });
    }
    
    // Auto-hide success message after 5 seconds
    function autoHideMessage() {
        setTimeout(() => {
            const successMessage = document.querySelector('.success-message');
            if (successMessage) {
                successMessage.style.transition = 'opacity 0.5s ease';
                successMessage.style.opacity = '0';
                setTimeout(() => {
                    successMessage.remove();
                }, 500);
            }
        }, 5000);
    }
    
    // Call autoHideMessage when success message is shown
    const observer = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            if (mutation.type === 'childList') {
                const successMessage = document.querySelector('.success-message');
                if (successMessage) {
                    autoHideMessage();
                }
            }
        });
    });
    
    if (formMessages) {
        observer.observe(formMessages, {
            childList: true,
            subtree: true
        });
    }
});