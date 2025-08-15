import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary-green': '#359744',
                'primary-green-dark': '#014220',
                'gray-text': '#374151',
                'error': '#ef4444',
                'success': '#10b981',
                'warning': '#f59e0b',
                'info': '#3b82f6',
                'glass-bg': 'rgba(255, 255, 255, 0.1)',
                'glass-border': 'rgba(255, 255, 255, 0.2)',
            },
        },
    },

    plugins: [forms],
};
