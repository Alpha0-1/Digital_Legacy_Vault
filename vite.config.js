import { defineConfig } from 'vite';
import vue from '@vitejs/plugin-vue';
import eslint from 'vite-plugin-eslint';

export default defineConfig({
  plugins: [
    vue(),
    eslint({
      cache: false,
      include: ['src/**/*.js', 'src/**/*.vue', 'src/**/*.ts'],
      eslintCliOptions: {
        cache: false,
      }
    }),
  ],
  build: {
    outDir: 'public/build',
    assetsDir: 'assets',
    emptyOutDir: true,
  },
  server: {
    host: '0.0.0.0',
    port: 3000,
    hmr: {
      host: 'localhost',
      port: 3000,
    },
  },
  optimizeDeps: {
    include: ['axios', 'dayjs'],
  },
});
