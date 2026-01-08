import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'selector',
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.js',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter', ...defaultTheme.fontFamily.sans],
                display: ['Outfit', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                primary: {
                    50: '#fff1f2',
                    100: '#ffe4e6',
                    500: '#ad2831',
                    600: '#800e13',
                    700: '#640d14',
                },
                secondary: {
                    50: '#fdf2f2',
                    100: '#fce7e7',
                    500: '#9f1239',
                    600: '#881337',
                    800: '#38040e',
                    900: '#250902',
                    950: '#1a0601',
                },
            }
        },
    },

    plugins: [forms],
};
