import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";
import tailwindcss from "@tailwindcss/vite";

export default defineConfig({
    plugins: [
        tailwindcss(),
        laravel({
            input: [
                "resources/css/admin.css",
                "resources/css/blog.css",
                "resources/js/blog.js",
                "resources/js/auth.js",
                "resources/js/admin-dashboard.js",
            ],
            refresh: true,
        }),
    ],
});
