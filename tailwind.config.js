/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
    ],
    theme: {
        extend: {},
    },
    plugins: [require("@tailwindcss/forms"), require("daisyui")],
    daisyui: {
        themes: ["light", "dark", "cupcake", "bumblebee"], // pilih tema yang diinginkan
        darkTheme: "dark", // tema default untuk dark mode
        base: true, // apply background color dan foreground color untuk root element
        styled: true, // include daisyUI colors dan design decisions
        utils: true, // add responsive dan modifier utility classes
        logs: true, // show info tentang daisyUI version dan config
    },
};
