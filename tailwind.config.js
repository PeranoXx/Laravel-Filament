const colors = require('tailwindcss/colors')

module.exports = {
    content: ['./vendor/ralphjsmit/tall-interactive/resources/views/**/*.blade.php','./resources/**/*.blade.php', './vendor/filament/**/*.blade.php'],
    theme: {
        extend: {
            colors: {
                danger: colors.rose,
                primary: colors.blue,
                success: colors.green,
                warning: colors.yellow,
            },
        },
    },
    plugins: [
        require('@tailwindcss/forms'),
        require('@tailwindcss/typography'),
    ],
}
