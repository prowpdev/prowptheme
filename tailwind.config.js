/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./*.php",
    "./template-parts/**/*.php",
    "./src/js/**/*.js",
    "./src/js/*.js",
    "./src/scss/*.{scss,css}",
    "./src/scss/**/*.{scss,css}"
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
