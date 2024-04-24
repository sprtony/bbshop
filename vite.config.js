import { defineConfig, loadEnv } from "vite";

import laravel from "laravel-vite-plugin";
import { imagetools } from "vite-imagetools";
// import PluginCritical from "rollup-plugin-critical";

export default defineConfig(({ mode }) => {
    process.env = { ...process.env, ...loadEnv(mode, process.cwd()) };
    return {
        plugins: [
            laravel({
                input: [
                    "resources/css/app.css",
                    "resources/css/filament.css",
                    "resources/js/app.js",
                ],
                refresh: true,
            }),
            // imagetools(),

            // PluginCritical({
            //         criticalUrl: process.env.APP_URL,
            //         criticalBase: "./public",
            //         criticalPages: [{ uri: "", template: "index" }],
            //         criticalConfig: {},
            //
            //         apply: "build",
            //     }),
        ],
    };
});
