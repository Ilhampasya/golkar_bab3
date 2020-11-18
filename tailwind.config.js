module.exports = {
  important: true,
  theme: {
    extend: {
      colors: {
        cyan: '#9cdbff',
        primary: '#FFCC00',
        secondary: '#38a169',
        dark: '#18191a',
        'semi-dark': '#242526',
        'dark-gray': '#3a3b3c',
      },
      screens: {
        'portrait': {'raw': '(orientation: portrait)'},
      },
      margin: {
        '96': '24rem',
        '128': '32rem',
      },
    }
  },
  variants: {
    opacity: ['responsive', 'hover']
  }
}