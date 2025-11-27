import { defineConfig } from "vite";
import laravel from "laravel-vite-plugin";

export default defineConfig({
    // Use relative paths so built assets work under tunneled temporary domains
    // and so Blade doesn't receive absolute `http://localhost:...` URLs.
    base: "./",
    plugins: [
        laravel({
            input: ["resources/sass/app.scss", "resources/js/app.js"],
            refresh: true,
        }),
    ],
    server: {
        // allow access from network (useful if you forward ports or use a tunnel)
        host: true,
        port: 5173,
        // If you want the dev server to return a specific origin (tunnel URL),
        // set the env var VITE_DEV_ORIGIN to that URL (e.g. https://xyz.localhost.run)
        // and Vite will use it when composing HMR / client URLs.
        origin: process.env.VITE_DEV_ORIGIN || undefined,
        hmr: {
            // When exposing via a tunnel that supports websockets, you may need
            // to set host to the tunnel host and protocol to 'wss'. Use env vars.
            host: process.env.VITE_HMR_HOST || undefined,
            protocol: process.env.VITE_HMR_PROTOCOL || undefined,
            clientPort: process.env.VITE_HMR_CLIENT_PORT
                ? Number(process.env.VITE_HMR_CLIENT_PORT)
                : undefined,
        },
    },
});
