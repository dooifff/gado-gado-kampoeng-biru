/** @type {import('tailwindcss').Config} */
export default {
    content: [
        './resources/**/*.blade.php',
        './resources/**/*.js',
        './resources/**/*.vue',
    ],
    theme: {
        extend: {
            fontFamily: {
                display: ['"Playfair Display"', 'Georgia', 'serif'],
                sans: ['"Plus Jakarta Sans"', 'ui-sans-serif', 'system-ui', 'sans-serif'],
            },
            colors: {
                navy: {
                    50: '#f2f6fb',
                    100: '#e0eaf5',
                    200: '#c3d6ec',
                    300: '#97b8dc',
                    400: '#6394c6',
                    500: '#3f76b0',
                    600: '#2d5d94',
                    700: '#254b78',
                    800: '#214163',
                    900: '#16293e',
                    950: '#0d1b2b',
                },
                cream: {
                    50: '#fbf9f4',
                    100: '#f6efe2',
                    200: '#ece0c8',
                    300: '#ddc9a3',
                },
                accent: {
                    300: '#f6c67c',
                    400: '#efae4e',
                    500: '#e89633',
                    600: '#d27c1d',
                    700: '#ad6118',
                },
                leaf: {
                    400: '#8fae6e',
                    500: '#6d9450',
                    600: '#54783d',
                },
            },
            boxShadow: {
                soft: '0 10px 30px -12px rgba(13, 27, 43, 0.18)',
                card: '0 6px 24px -8px rgba(13, 27, 43, 0.12)',
            },
            keyframes: {
                'fade-up': {
                    '0%': { opacity: '0', transform: 'translateY(24px)' },
                    '100%': { opacity: '1', transform: 'translateY(0)' },
                },
                'fade-in': {
                    '0%': { opacity: '0' },
                    '100%': { opacity: '1' },
                },
                float: {
                    '0%, 100%': { transform: 'translateY(0)' },
                    '50%': { transform: 'translateY(-12px)' },
                },
            },
            animation: {
                'fade-up': 'fade-up 0.7s cubic-bezier(0.22, 1, 0.36, 1) both',
                'fade-in': 'fade-in 0.8s ease-out both',
                float: 'float 6s ease-in-out infinite',
            },
        },
    },
    plugins: [],
};