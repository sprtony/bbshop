import { defineConfig } from "vite";

import laravel from "laravel-vite-plugin";
// import PluginCritical from "rollup-plugin-critical";

export default defineConfig({
    plugins: [
        laravel({
            input: ["resources/css/app.css", "resources/js/app.js"],
            refresh: true,
        }),

        // PluginCritical({
        //     criticalUrl: "https://nystudio107.com/",
        //     criticalBase: "./",
        //     criticalPages: [{ uri: "", template: "index" }],
        //     criticalConfig: {},
        // }),
    ],
});
