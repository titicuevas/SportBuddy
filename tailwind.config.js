import defaultTheme from "tailwindcss/defaultTheme";
import forms from "@tailwindcss/forms";

/** @type {import('tailwindcss').Config} */
export default {
    content: [
        "./vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php",
        "./storage/framework/views/*.php",
        "./resources/views/**/*.blade.php",
        "./resources/**/*.blade.php",
        "./resources/**/*.js",
        "./resources/**/*.vue",
        "./node_modules/flowbite/**/*.js",
    ],

    theme: {
        extend: {
            fontFamily: {
                sans: [
                    "Helvetica Now",
                    "KnuckleheadSlab",
                    "Figtree",
                    ...defaultTheme.fontFamily.sans,
                ],
            },
            fontSize: {
                xs: "0.75rem", // Extra pequeño
                sm: "0.875rem", // Pequeño
                base: "1rem", // Tamaño por defecto
                lg: "1.125rem", // Grande
                xl: "1.25rem", // Extra grande
                "2xl": "1.5rem", // 2 veces grande
                "3xl": "1.875rem", // 3 veces grande
                "4xl": "2.25rem", // 4 veces grande
                "5xl": "3rem", // 5 veces grande
                "6xl": "4rem", // 6 veces grande
            },
        },
    },

    plugins: [forms, require("flowbite/plugin")],
};
