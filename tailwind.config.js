const defaultTheme = require('tailwindcss/defaultTheme');

module.exports = {
    purge: [
        './storage/framework/views/*.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {},
    },
    variants: {
        extend: {
            opacity: ['disabled'],
        },
    },

    plugins: [
        // require('@tailwindcss/forms'),
        // require('@tailwindcss/typography'),
        // require('@tailwindcss/aspect-ratio'),
    ],
};
