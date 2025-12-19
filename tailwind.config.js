/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {
      colors: {
        'primary-color': '#FF6B00',
        'secondary-color': '#00A3E0',
        'dark-color': '#000000',
        'grey-color-tone-one': '#333333',
        'grey-color-tone-two': '#666666',
        'grey-color-tone-three': '#999999',
        primary: {
          DEFAULT: '#FF6B00',
          dark: '#e55f00',
          light: '#ff8533',
        },
        secondary: {
          DEFAULT: '#00A3E0',
          dark: '#0082b3',
        },
      },
      fontFamily: {
        sans: ['Inter', 'sans-serif'],
        'inter': ['Inter', 'sans-serif'],
        'poppins': ['Poppins', 'sans-serif'],
      },
    },
  },
  plugins: [],
}
