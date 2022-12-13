/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
    "./app/Modules/**/Views/*.blade.php",
    "./app/Modules/**/Assets/**/*.js",
    "./app/Modules/**/Assets/**/*.vue",
  ],
  theme: {
    extend: {},
  },
  plugins: [],
}
