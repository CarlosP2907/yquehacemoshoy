document.addEventListener("DOMContentLoaded",function(){r(),l(),c(),d(),u(),f()});function r(){[].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]')).forEach(function(t){new bootstrap.Tooltip(t,{trigger:"hover focus",delay:{show:300,hide:100}})}),[].slice.call(document.querySelectorAll('[data-bs-toggle="popover"]')).forEach(function(t){new bootstrap.Popover(t,{trigger:"focus",html:!0})}),document.addEventListener("click",function(t){document.querySelectorAll(".dropdown-menu.show").forEach(function(o){if(!o.contains(t.target)&&!o.previousElementSibling.contains(t.target)){const n=bootstrap.Dropdown.getInstance(o.previousElementSibling);n&&n.hide()}})})}function l(){document.querySelectorAll('a[href^="#"]').forEach(s=>{s.addEventListener("click",function(i){i.preventDefault();const t=this.getAttribute("href");if(t==="#")return;const e=document.querySelector(t);if(e){const o=e.offsetTop-80;window.scrollTo({top:o,behavior:"smooth"}),history.pushState(null,null,t)}})})}function c(){document.querySelectorAll(".needs-validation").forEach(function(t){t.addEventListener("submit",function(o){if(!t.checkValidity()){o.preventDefault(),o.stopPropagation();const n=t.querySelector(":invalid");n&&(n.focus(),n.scrollIntoView({behavior:"smooth",block:"center"}))}t.classList.add("was-validated")},!1),t.querySelectorAll(".form-control").forEach(function(o){o.addEventListener("blur",function(){this.checkValidity()?(this.classList.remove("is-invalid"),this.classList.add("is-valid")):(this.classList.remove("is-valid"),this.classList.add("is-invalid"))}),o.addEventListener("input",function(){(this.classList.contains("is-invalid")||this.classList.contains("is-valid"))&&(this.checkValidity()?(this.classList.remove("is-invalid"),this.classList.add("is-valid")):(this.classList.remove("is-valid"),this.classList.add("is-invalid")))})})}),document.querySelectorAll(".form-floating .form-control").forEach(function(t){t.addEventListener("focus",function(){this.parentElement.classList.add("focused")}),t.addEventListener("blur",function(){this.value||this.parentElement.classList.remove("focused")})})}function d(){const s={threshold:.1,rootMargin:"0px 0px -100px 0px"},i=new IntersectionObserver(function(e){e.forEach(o=>{o.isIntersecting&&o.target.classList.add("animate-in")})},s);document.querySelectorAll(".card, .feature-card, .btn-group, .alert").forEach(e=>{e.classList.add("animate-on-scroll"),i.observe(e)})}function u(){document.querySelectorAll("form").forEach(t=>{t.addEventListener("submit",function(){const e=t.querySelector('button[type="submit"], input[type="submit"]');if(e&&!t.querySelector(":invalid")){e.disabled=!0;const o=e.textContent||e.value,n=e.dataset.loading||"Cargando...";e.tagName==="BUTTON"?e.innerHTML=`<span class="spinner-custom me-2"></span>${n}`:e.value=n,setTimeout(()=>{e.disabled=!1,e.tagName==="BUTTON"?e.textContent=o:e.value=o},1e4)}})}),document.querySelectorAll("[data-loading]").forEach(t=>{t.addEventListener("click",function(){if(!this.disabled){this.disabled=!0;const e=this.textContent,o=this.dataset.loading;this.innerHTML=`<span class="spinner-custom me-2"></span>${o}`,setTimeout(()=>{this.disabled=!1,this.textContent=e},3e3)}})})}function f(){new MutationObserver(function(i){i.forEach(function(t){t.addedNodes.forEach(function(e){e.nodeType===1&&e.querySelectorAll('[data-bs-toggle="tooltip"]').forEach(function(n){new bootstrap.Tooltip(n)})})})}).observe(document.body,{childList:!0,subtree:!0})}const a=document.createElement("style");a.textContent=`
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
`;document.head.appendChild(a);
