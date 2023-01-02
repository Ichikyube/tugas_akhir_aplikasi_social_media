module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
  theme: {
    extend: {},
    aspectRatio: { // defaults to {}
        'none': 0,
        'square': [1, 1], // or 1 / 1, or simply 1
        '16/9': [16, 9],  // or 16 / 9
        '4/3': [4, 3],    // or 4 / 3
        '21/9': [21, 9],  // or 21 / 9
      },
  },
  variants: {
    aspectRatio: ['responsive'], // defaults to ['responsive']
  },
  plugins: [
    require('@tailwindcss/forms'),
    require('@tailwindcss/typography'),
    require('@tailwindcss/aspect-ratio'),
    require("daisyui")
  ]
}
