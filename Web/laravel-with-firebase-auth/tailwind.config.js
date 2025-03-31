/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
    ],
    theme: {
      extend: {
        fontFamily: {
          space: ["Space Grotesk", "sans-serif"], // Tambahkan font baru
        },
      },
    },
    plugins: [],
  };
  