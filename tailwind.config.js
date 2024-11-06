// tailwind.config.js
module.exports = {
  mode: 'jit',  // Enable JIT mode
  content: [
    './view/**/*.php',
    './public/**/*.php',
    './*.php',
  ],
  theme: {
    extend: {},
  },
  plugins: [],
};
