const defaultTheme = require('tailwindcss/defaultTheme');
const colors = require('tailwindcss/colors')

module.exports = {
    theme: {
        extend: {
            fontFamily: {
                sans: ['Inter var', ...defaultTheme.fontFamily.sans],
            },
        },
    },
    variants: {
        extend: {
            backgroundColor: ['active'],
            colors: {
                green: colors.emerald,
                yellow: colors.amber,
                purple: colors.violet,
            }
        }

    },
    purge: {
        content: [
            './app/**/*.php',
            './resources/**/*.html',
            './resources/**/*.js',
            './resources/**/*.jsx',
            './resources/**/*.ts',
            './resources/**/*.tsx',
            './resources/**/*.php',
            './resources/**/*.vue',
            './resources/**/*.twig',
            './vendor/rappasoft/laravel-livewire-tables/resources/views/tailwind/**/*.blade.php',
        ],
        options: {
            defaultExtractor: (content) => content.match(/[\w-/.:]+(?<!:)/g) || [],
            whitelistPatterns: [/-active$/, /-enter$/, /-leave-to$/, /show$/],
        },
    },
    plugins: [
        require("@tailwindcss/forms")({
            strategy: 'class',
        }),
        require('@tailwindcss/typography'),
    ],
};
