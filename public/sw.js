const CACHE_NAME = 'dono-offline-v1';
const URLS_TO_CACHE = [
  '/offline.html',
  '/images/dono_default.png',
  '/images/Game/Cactus.svg',
  '/images/Game/Tree.svg',
  '/images/Game/Bird.svg',
  '/images/Game/UFO.svg',
  'https://fonts.googleapis.com/css2?family=Jersey+20&display=swap'
];

self.addEventListener('install', (event) => {
  self.skipWaiting();
  event.waitUntil(
    caches.open(CACHE_NAME)
      .then((cache) => {
        return cache.addAll(URLS_TO_CACHE);
      })
  );
});

self.addEventListener('activate', (event) => {
  event.waitUntil(self.clients.claim());
});

self.addEventListener('fetch', (event) => {
  // Intercept navigation requests (HTML pages)
  if (event.request.mode === 'navigate') {
    event.respondWith(
      fetch(event.request).catch(() => {
        // Network failed (offline), return the offline game page
        return caches.match('/offline.html');
      })
    );
  } else {
    // For assets (images, etc.), try network, then fallback to cache
    event.respondWith(
      fetch(event.request).catch(() => {
        return caches.match(event.request);
      })
    );
  }
});
