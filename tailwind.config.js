import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';
import typography from '@tailwindcss/typography';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './vendor/laravel/jetstream/**/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
    ],

    theme: {
        extend: {
            fontFamily: {
                raleway: ['raleway', ...defaultTheme.fontFamily.sans],
                anek: ['anek-malayalam', ...defaultTheme.fontFamily.sans],
            },
            colors: {
                'light-gray': '#F0F0F0',
                'light-orange': '#f1af83',
                'card-orange': '#ecccb7',
            },
            spacing: {
                '110': '110rem',
                'slider-image': '42rem',
            },
        },
    },

    plugins: [forms, typography],
};
