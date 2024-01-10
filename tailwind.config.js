/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
        './storage/framework/views/*.php',
        './resources/views/**/*.blade.php',
        // './resources/views/'
        "./node_modules/flowbite/**/*.js",
    ],
    theme: {
        extend: {
            colors: {
                primary: {
                    "50": "#fee2e2",
                    "100": "#fecaca",
                    "200": "#fca5a5",
                    "300": "#f87171",
                    "400": "#ef4444",
                    "500": "#dc2626",
                    "600": "#b91c1c",
                    "700": "#991b1b",
                    "800": "#7f1d1d",
                    "900": "#701c1c",
                },
            },
        },
    },
    plugins: [
        require('flowbite/plugin')
    ],
};
