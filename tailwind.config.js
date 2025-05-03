const colors = require('tailwindcss/colors');

module.exports = {
  content: [
    "./**/*.php",
    "./assets/js/**/*.js"
  ],
  safelist: [
    'bg-primary',
    'text-primary',
    'hover:bg-primary',
    'bg-secondary',
    'text-secondary',
    'hover:bg-secondary'
  ],
  theme: {
    extend: {
      colors: {
        primary: '#593FFB',
        secondary: '#40DDB6',
        gray: colors.gray,
        slate: colors.slate,
        zinc: colors.zinc,
        neutral: colors.neutral,
        stone: colors.stone,
        red: colors.red,
        orange: colors.orange,
        amber: colors.amber,
        yellow: colors.yellow,
        lime: colors.lime,
        green: colors.green,
        emerald: colors.emerald,
        teal: colors.teal,
        cyan: colors.cyan,
        sky: colors.sky,
        blue: colors.blue,
        indigo: colors.indigo,
        violet: colors.violet,
        purple: colors.purple,
        fuchsia: colors.fuchsia,
        pink: colors.pink,
        rose: colors.rose,
      },
    },
  },
  plugins: [],
}
