const CACHE_NAME = 'tamaraw-v1';

// Files na i-cache para offline
const STATIC_ASSETS = [
  '/',
  '/manifest.json',
  '/logo.png',
  '/logo2.png',
];

// Install — i-cache ang static assets
self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open(CACHE_NAME).then((cache) => cache.addAll(STATIC_ASSETS))
  );
  self.skipWaiting();
});

// Activate — i-delete ang lumang cache
self.addEventListener('activate', (event) => {
  event.waitUntil(
    caches.keys().then((keys) =>
      Promise.all(
        keys.filter((key) => key !== CACHE_NAME).map((key) => caches.delete(key))
      )
    )
  );
  self.clients.claim();
});

// Fetch — network first, fallback sa cache
self.addEventListener('fetch', (event) => {
  // Skip non-GET at chrome-extension requests
  if (event.request.method !== 'GET') return;
  if (!event.request.url.startsWith('http')) return;

  event.respondWith(
    fetch(event.request)
      .then((response) => {
        // I-cache ang fresh response
        const clone = response.clone();
        caches.open(CACHE_NAME).then((cache) => cache.put(event.request, clone));
        return response;
      })
      .catch(() => {
        // Offline — kuha sa cache
        return caches.match(event.request);
      })
  );
});