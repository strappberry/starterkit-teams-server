import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    darkMode: 'class',

    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['Figtree', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'primary': {
                    '50': '#ebf1ff',
                    '100': '#dbe5ff',
                    '200': '#beceff',
                    '300': '#96adff',
                    '400': '#6d80ff',
                    '500': '#4b54ff',
                    '600': '#322bff',
                    '700': '#291fe3',
                    '800': '#221db6',
                    '900': '#1d1c7d',
                    '950': '#151353',
                },
                'strappberry': {
                    '50': '#fef2f2',
                    '100': '#fde6e6',
                    '200': '#fad1d2',
                    '300': '#f6abac',
                    '400': '#f17b7f',
                    '500': '#e64a54',
                    '600': '#d22c3e',
                    '700': '#b11f33',
                    '800': '#941d31',
                    '900': '#7f1c2f',
                    '950': '#470a14',
                }
            },
        },
    },

    plugins: [forms, typography],
};
