/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
    ],
    theme: {
        container: {
            padding: {
                DEFAULT: "1rem",
                sm: "4rem",
                lg: "6rem",
                xl: "8rem",
                "2xl": "10rem",
            },
        },
        extend: {},
    },
    plugins: [],
};
