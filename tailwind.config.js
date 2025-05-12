import preset from './vendor/filament/support/tailwind.config.preset'
import  materialTailwindPlugin  from "@material-tailwind/html";

export default {
    presets: [preset],
    content: [
        './app/Filament/**/*.php',
        './resources/views/**/*.blade.php',
        './vendor/filament/**/*.blade.php',
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
          colors: {
            primary: '#6200ee',
            secondary: '#03dac6',
          },
        },
      },
      plugins: [require('daisyui')],
      daisyui: {
        themes: [
          {
            material: {
              primary: '#6200ee',
              secondary: '#03dac6',
              accent: '#ff4081',
              neutral: '#2e2e2e',
              'base-100': '#ffffff',
              info: '#2196f3',
              success: '#4caf50',
              warning: '#ff9800',
              error: '#f44336',
            },
          },
        ],
      },
};