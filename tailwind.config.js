import defaultTheme from 'tailwindcss/defaultTheme';
import forms from '@tailwindcss/forms';

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        './resources/js/**/*.vue',
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: ['DM Sans', ...defaultTheme.fontFamily.sans],
                display: ['Syne', ...defaultTheme.fontFamily.sans],
                mono: ['JetBrains Mono', ...defaultTheme.fontFamily.mono],
            },
            colors: {
                vc: {
                    midnight: '#0A0E1A',
                    ink: '#121828',
                    surface: '#161C2D',
                    elevated: '#1C2438',
                    saffron: '#F5A623',
                    teal: '#2DD4BF',
                    violet: '#7C3AED',
                    parchment: '#F0EBE3',
                    muted: '#A8A29E',
                    subtle: '#6B7280',
                },
            },
        },
    },

    plugins: [forms],
};
