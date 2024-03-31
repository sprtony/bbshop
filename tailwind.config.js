const defaultTheme = require("tailwindcss/defaultTheme");

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ["Inter var", ...defaultTheme.fontFamily.sans],
            },
        },
        container: {
            center: true,
        },
    },
    content: {
        relative: true,
        transform: (content) => content.replace(/taos:/g, ""),
        files: [
            "./app/**/*.php",
            "./packages/**/*.php",
            "./resources/**/*.html",
            "./resources/**/*.js",
            "./resources/**/*.jsx",
            "./resources/**/*.ts",
            "./resources/**/*.tsx",
            "./resources/**/*.php",
            "./resources/**/*.vue",
            "./resources/**/*.twig",
        ],
    },
    plugins: [
        require("@tailwindcss/forms"),
        require("@tailwindcss/typography"),
        require("taos/plugin"),
        require("tailwindcss-animated"),
    ],
    safelist: [
        "!duration-[0ms]",
        "!delay-[0ms]",
        'html.js :where([class*="taos:"]:not(.taos-init))',
    ],
};
