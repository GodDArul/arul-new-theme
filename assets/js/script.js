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
    // --- MENU TOGGLE ---
    const menuToggle = document.querySelector('.menu-toggle');
    const mainNavigation = document.querySelector('.main-navigation');
    if (menuToggle && mainNavigation) {
        menuToggle.addEventListener('click', function() {
            mainNavigation.classList.toggle('toggled');
            const isExpanded = menuToggle.getAttribute('aria-expanded') === 'true';
            menuToggle.setAttribute('aria-expanded', !isExpanded);
        });
    }

    // --- CONTACT FORM ---
    const contactForm = document.getElementById('contact-form');
    const formMessages = document.getElementById('form-messages');

    // Field validation helpers (global scope for reuse)
    function showFieldError(field, message) {
        field.classList.add('error');
        const existingError = field.parentNode.querySelector('.error-message');
        if (existingError) existingError.remove();
        const errorElement = document.createElement('span');
        errorElement.classList.add('error-message');
        errorElement.textContent = message;
        field.parentNode.appendChild(errorElement);
    }
    function removeFieldError(field) {
        field.classList.remove('error');
        const errorMsg = field.parentNode.querySelector('.error-message');
        if (errorMsg) errorMsg.remove();
    }
    function isValidEmail(email) {
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailRegex.test(email);
    }
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

    if (contactForm) {
        contactForm.addEventListener('submit', function(e) {
            e.preventDefault();
            formMessages.innerHTML = '';
            const formData = new FormData(this);
            formData.append('action', 'submit_contact_form');
            const submitBtn = this.querySelector('.btn-submit');
            const originalText = submitBtn.innerHTML;
            submitBtn.innerHTML = '<span>Mengirim...</span>';
            submitBtn.disabled = true;
            submitBtn.classList.add('loading');
            const inputs = this.querySelectorAll('input, textarea, select');
            inputs.forEach(input => {
                input.classList.remove('error');
                const errorMsg = input.parentNode.querySelector('.error-message');
                if (errorMsg) errorMsg.remove();
            });

            // Pastikan ajax_object tersedia
            if (!window.ajax_object || !window.ajax_object.ajax_url) {
                formMessages.innerHTML = '<div class="alert error">AJAX tidak tersedia.</div>';
                submitBtn.innerHTML = originalText;
                submitBtn.disabled = false;
                submitBtn.classList.remove('loading');
                return;
            }

            fetch(window.ajax_object.ajax_url, {
                method: 'POST',
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    formMessages.innerHTML = `<div class="success-message">${data.data}</div>`;
                    contactForm.reset();
                    formMessages.scrollIntoView({ behavior: 'smooth', block: 'center' });
                    autoHideMessage(); // langsung panggil, tidak perlu observer
                } else {
                    formMessages.innerHTML = `<div class="alert error">${data.data}</div>`;
                    formMessages.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            })
            .catch(error => {
                console.error('Error:', error);
                formMessages.innerHTML = `<div class="alert error">Terjadi kesalahan saat mengirim pesan. Silakan coba lagi.</div>`;
            })
            .finally(() => {
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
        if (input.value !== '') {
            input.parentElement.classList.add('focused');
        }
    });

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
});

// --- SERVICE MODAL ---
function showServiceDetails(deviceType) {
    let description = '';
    let icon = '';
    switch(deviceType) {
        case 'iPhone':
            description = 'Layanan perbaikan khusus untuk semua model iPhone dengan teknisi berpengalaman dan spare parts original Apple.';
            icon = '🍎';
            break;
        case 'Android':
            description = 'Perbaikan menyeluruh untuk berbagai merek smartphone Android seperti Samsung, Xiaomi, Oppo, Vivo, dan lainnya.';
            icon = '📱';
            break;
        case 'Tablet':
            description = 'Service tablet iPad dan Android tablet dengan penanganan khusus untuk layar besar dan komponen yang lebih kompleks.';
            icon = '📱';
            break;
        case 'Classic Phone':
            description = 'Perbaikan ponsel klasik/feature phone. Kami juga melayani handphone jadul yang sulit dicari spare partnya.';
            icon = '📞';
            break;
    }
    showServiceModal(deviceType, description, icon);
}

function showServiceModal(title, description, icon) {
    document.getElementById('modalTitle').textContent = title;
    document.getElementById('modalDescription').textContent = description;
    document.getElementById('modalIcon').textContent = icon;
    document.getElementById('serviceModal').style.display = 'block';
    setTimeout(function() {
        document.querySelector('.modal-content').classList.add('modal-show');
    }, 10);
}

function closeServiceModal() {
    const modalContent = document.querySelector('.modal-content');
    if (modalContent) {
        modalContent.classList.remove('modal-show');
        setTimeout(function() {
            document.getElementById('serviceModal').style.display = 'none';
        }, 300);
    }
}

// Tutup modal jika user klik di luar modal
document.addEventListener('click', function(event) {
    const modal = document.getElementById('serviceModal');
    if (modal && event.target === modal) {
        closeServiceModal();
    }
});

// Tutup modal dengan ESC key
document.addEventListener('keydown', function(event) {
    if (event.key === 'Escape') {
        closeServiceModal();
    }
});

// Inisialisasi ketika DOM loaded
document.addEventListener('DOMContentLoaded', function() {
    console.log('Service Modal JavaScript loaded');
});