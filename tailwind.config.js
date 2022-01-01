const defaultTheme = require('tailwindcss/defaultTheme')

module.exports = {
  purge: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.vue',
  ],
  darkMode: false, // or 'media' or 'class'
  theme: {
    screens: {
      'xs': '360px',
      ...defaultTheme.screens,
    },
    extend: {
      backgroundImage: {
        'home-page': "url('/images/deliveries.svg')",
        'about-page': "url('/images/about.svg')",
        'contact-page': "url('/images/contact.svg')",       
      }
    },
  },
  variants: {
    extend: {
      fontSize: ['hover'],
      backgroundColor: ['checked'],
      borderColor: ['checked'],
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
