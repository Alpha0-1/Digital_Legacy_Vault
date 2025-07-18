module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/js/**/*.js",
    "./resources/js/**/*.vue",
    "./app/Http/Livewire/**/*.php"
  ],
  theme: {
    extend: {
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
      },
      colors: {
        primary: {
          light: '#66B2FF',
          DEFAULT: '#007FFF',
          dark: '#0059B2',
        },
        legacy: {
          red: '#FF4B5C',
          green: '#4CAF50',
          blue: '#2196F3',
          yellow: '#FFC107'
        }
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio')
  ],
}
