import { defineConfig } from "vite";

import laravel from "laravel-vite-plugin";
// import PluginCritical from "rollup-plugin-critical";

export default defineConfig({
    plugins: [
        laravel({
            input: [
                "resources/css/app.css",
                "resources/css/filament.css",
                "resources/js/app.js",
            ],
            refresh: true,
        }),

        // PluginCritical({
        //     criticalUrl: process.env.APP_URL,
        //     criticalBase: "./public",
        //     criticalPages: [{ uri: "", template: "index" }],
        //     criticalConfig: {},
        //
        //     apply: "build",
        // }),
    ],
});
