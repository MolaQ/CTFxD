import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php', // TA LINIA JEST KLUCZOWA
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'ctf-red': {
                    'DEFAULT': '#880000',
                    '50': '#f2e6e6', '100': '#e6cccc', '200': '#d9b3b3', '300': '#cc9999',
                    '400': '#bf8080', '500': '#b36666', '600': '#a64d4d', '700': '#993333',
                    '800': '#8c1a1a', '900': '#800000', '950': '#400000'
                }
            },
        },
    },

    plugins: [forms],
};
