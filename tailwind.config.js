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
        },
      },
    },
    plugins: [],
  }
  