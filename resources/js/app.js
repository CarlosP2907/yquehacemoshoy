/* ==================================================
   MODERN INTERACTIVE ENHANCEMENTS
   ================================================== */

document.addEventListener('DOMContentLoaded', function() {
    
    // Initialize Bootstrap components
    initBootstrapComponents();
    
    // Enhanced smooth scrolling
    initSmoothScrolling();
    
    // Form enhancements
    initFormEnhancements();
    
    // Add scroll animations
    initScrollAnimations();
    
    // Add loading states
    initLoadingStates();
    
    // Enhanced tooltips and popovers
    initTooltipsAndPopovers();
    
});

/* ==================================================
   BOOTSTRAP COMPONENTS INITIALIZATION
   ================================================== */

function initBootstrapComponents() {
    // Initialize tooltips with better positioning
    const tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    tooltipTriggerList.forEach(function(tooltipTriggerEl) {
        new bootstrap.Tooltip(tooltipTriggerEl, {
            trigger: 'hover focus',
            delay: { show: 300, hide: 100 }
        });
    });

    // Initialize popovers with auto-close
    const popoverTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]'));
    popoverTriggerList.forEach(function(popoverTriggerEl) {
        new bootstrap.Popover(popoverTriggerEl, {
            trigger: 'focus',
            html: true
        });
    });

    // Auto-close dropdowns when clicking outside
    document.addEventListener('click', function(e) {
        const dropdowns = document.querySelectorAll('.dropdown-menu.show');
        dropdowns.forEach(function(dropdown) {
            if (!dropdown.contains(e.target) && !dropdown.previousElementSibling.contains(e.target)) {
                const dropdownInstance = bootstrap.Dropdown.getInstance(dropdown.previousElementSibling);
                if (dropdownInstance) dropdownInstance.hide();
            }
        });
    });
}

/* ==================================================
   ENHANCED SMOOTH SCROLLING
   ================================================== */

function initSmoothScrolling() {
    // Enhanced smooth scrolling for anchor links
    document.querySelectorAll('a[href^="#"]').forEach(anchor => {
        anchor.addEventListener('click', function (e) {
            e.preventDefault();
            
            const targetId = this.getAttribute('href');
            if (targetId === '#') return;
            
            const targetElement = document.querySelector(targetId);
            if (targetElement) {
                const offsetTop = targetElement.offsetTop - 80; // Account for fixed navbar
                
                window.scrollTo({
                    top: offsetTop,
                    behavior: 'smooth'
                });
                
                // Update URL without jumping
                history.pushState(null, null, targetId);
            }
        });
    });
}

/* ==================================================
   FORM ENHANCEMENTS
   ================================================== */

function initFormEnhancements() {
    // Enhanced form validation with better UX
    const forms = document.querySelectorAll('.needs-validation');
    forms.forEach(function(form) {
        form.addEventListener('submit', function(event) {
            if (!form.checkValidity()) {
                event.preventDefault();
                event.stopPropagation();
                
                // Focus on first invalid field
                const firstInvalidField = form.querySelector(':invalid');
                if (firstInvalidField) {
                    firstInvalidField.focus();
                    firstInvalidField.scrollIntoView({ behavior: 'smooth', block: 'center' });
                }
            }
            
            form.classList.add('was-validated');
        }, false);
        
        // Real-time validation feedback
        const inputs = form.querySelectorAll('.form-control');
        inputs.forEach(function(input) {
            input.addEventListener('blur', function() {
                if (this.checkValidity()) {
                    this.classList.remove('is-invalid');
                    this.classList.add('is-valid');
                } else {
                    this.classList.remove('is-valid');
                    this.classList.add('is-invalid');
                }
            });
            
            input.addEventListener('input', function() {
                if (this.classList.contains('is-invalid') || this.classList.contains('is-valid')) {
                    if (this.checkValidity()) {
                        this.classList.remove('is-invalid');
                        this.classList.add('is-valid');
                    } else {
                        this.classList.remove('is-valid');
                        this.classList.add('is-invalid');
                    }
                }
            });
        });
    });

    // Floating label animation improvements
    const floatingInputs = document.querySelectorAll('.form-floating .form-control');
    floatingInputs.forEach(function(input) {
        input.addEventListener('focus', function() {
            this.parentElement.classList.add('focused');
        });
        
        input.addEventListener('blur', function() {
            if (!this.value) {
                this.parentElement.classList.remove('focused');
            }
        });
    });
}

/* ==================================================
   SCROLL ANIMATIONS
   ================================================== */

function initScrollAnimations() {
    const observerOptions = {
        threshold: 0.1,
        rootMargin: '0px 0px -100px 0px'
    };

    const observer = new IntersectionObserver(function(entries) {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add('animate-in');
            }
        });
    }, observerOptions);

    // Observe elements that should animate on scroll
    const animatedElements = document.querySelectorAll('.card, .feature-card, .btn-group, .alert');
    animatedElements.forEach(el => {
        el.classList.add('animate-on-scroll');
        observer.observe(el);
    });
}

/* ==================================================
   LOADING STATES
   ================================================== */

function initLoadingStates() {
    // Add loading state to forms
    const forms = document.querySelectorAll('form');
    forms.forEach(form => {
        form.addEventListener('submit', function() {
            const submitBtn = form.querySelector('button[type="submit"], input[type="submit"]');
            if (submitBtn && !form.querySelector(':invalid')) {
                submitBtn.disabled = true;
                
                const originalText = submitBtn.textContent || submitBtn.value;
                const loadingText = submitBtn.dataset.loading || 'Cargando...';
                
                if (submitBtn.tagName === 'BUTTON') {
                    submitBtn.innerHTML = `<span class="spinner-custom me-2"></span>${loadingText}`;
                } else {
                    submitBtn.value = loadingText;
                }
                
                // Reset after 10 seconds as fallback
                setTimeout(() => {
                    submitBtn.disabled = false;
                    if (submitBtn.tagName === 'BUTTON') {
                        submitBtn.textContent = originalText;
                    } else {
                        submitBtn.value = originalText;
                    }
                }, 10000);
            }
        });
    });
    
    // Add loading state to buttons with data-loading attribute
    const loadingButtons = document.querySelectorAll('[data-loading]');
    loadingButtons.forEach(btn => {
        btn.addEventListener('click', function() {
            if (!this.disabled) {
                this.disabled = true;
                const originalText = this.textContent;
                const loadingText = this.dataset.loading;
                this.innerHTML = `<span class="spinner-custom me-2"></span>${loadingText}`;
                
                setTimeout(() => {
                    this.disabled = false;
                    this.textContent = originalText;
                }, 3000);
            }
        });
    });
}

/* ==================================================
   ENHANCED TOOLTIPS AND POPOVERS
   ================================================== */

function initTooltipsAndPopovers() {
    // Auto-initialize tooltips on dynamically added elements
    const tooltipObserver = new MutationObserver(function(mutations) {
        mutations.forEach(function(mutation) {
            mutation.addedNodes.forEach(function(node) {
                if (node.nodeType === 1) { // Element node
                    const tooltipElements = node.querySelectorAll('[data-bs-toggle="tooltip"]');
                    tooltipElements.forEach(function(element) {
                        new bootstrap.Tooltip(element);
                    });
                }
            });
        });
    });
    
    tooltipObserver.observe(document.body, {
        childList: true,
        subtree: true
    });
}

/* ==================================================
   USER TYPE TOGGLE (Registration Form)
   ================================================== */

function toggleUserType(type) {
    const userFields = document.getElementById('user-fields');
    const companyFields = document.getElementById('company-fields');
    const userRadio = document.querySelector('input[value="user"]');
    const companyRadio = document.querySelector('input[value="company"]');
    
    // Add smooth transitions
    if (userFields) userFields.style.transition = 'all 0.3s ease';
    if (companyFields) companyFields.style.transition = 'all 0.3s ease';
    
    if (type === 'user') {
        if (userFields) {
            userFields.style.display = 'block';
            userFields.style.opacity = '1';
        }
        if (companyFields) {
            companyFields.style.opacity = '0';
            setTimeout(() => {
                companyFields.style.display = 'none';
            }, 300);
        }
        
        // Clear company fields
        const companyInputs = ['company_location', 'company_phone', 'website', 'description'];
        companyInputs.forEach(id => {
            const field = document.getElementById(id);
            if (field) field.value = '';
        });
        
        // Update radio card styling
        if (userRadio) userRadio.closest('.radio-card').classList.add('checked');
        if (companyRadio) companyRadio.closest('.radio-card').classList.remove('checked');
        
    } else {
        if (companyFields) {
            companyFields.style.display = 'block';
            companyFields.style.opacity = '1';
        }
        if (userFields) {
            userFields.style.opacity = '0';
            setTimeout(() => {
                userFields.style.display = 'none';
            }, 300);
        }
        
        // Clear user fields
        const userInputs = ['location', 'phone'];
        userInputs.forEach(id => {
            const field = document.getElementById(id);
            if (field) field.value = '';
        });
        
        // Update radio card styling
        if (companyRadio) companyRadio.closest('.radio-card').classList.add('checked');
        if (userRadio) userRadio.closest('.radio-card').classList.remove('checked');
    }
    
    // Trigger form validation update
    const form = document.querySelector('.needs-validation');
    if (form) {
        form.classList.remove('was-validated');
    }
}

/* ==================================================
   UTILITY FUNCTIONS
   ================================================== */

// Debounce function for performance
function debounce(func, wait) {
    let timeout;
    return function executedFunction(...args) {
        const later = () => {
            clearTimeout(timeout);
            func(...args);
        };
        clearTimeout(timeout);
        timeout = setTimeout(later, wait);
    };
}

// Add CSS classes for scroll animations
const style = document.createElement('style');
style.textContent = `
    .animate-on-scroll {
        opacity: 0;
        transform: translateY(20px);
        transition: all 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }
    
    .animate-in {
        opacity: 1;
        transform: translateY(0);
    }
    
    .radio-card {
        cursor: pointer;
        transition: all 0.3s ease;
        border: 2px solid transparent;
    }
    
    .radio-card:hover {
        border-color: var(--bs-primary);
        background-color: rgba(53, 151, 68, 0.05);
    }
    
    .radio-card.checked {
        border-color: var(--bs-primary);
        background-color: rgba(53, 151, 68, 0.1);
        box-shadow: 0 0 0 2px rgba(53, 151, 68, 0.25);
    }
`;
document.head.appendChild(style);