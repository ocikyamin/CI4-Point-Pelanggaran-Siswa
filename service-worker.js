const offlineMessageURL = './offline.html';

self.addEventListener('install', (event) => {
  event.waitUntil(
    caches.open('xx-pwa-yamin').then((cache) => {
      return cache.addAll([
        './public/assets/css/styles.min.css',
        offlineMessageURL // Menambahkan URL pesan offline ke dalam cache
      ]);
    })
  );
});

self.addEventListener('fetch', (event) => {
  event.respondWith(
    caches.match(event.request).then((response) => {
      return response || fetch(event.request).catch(() => {
        return caches.match(offlineMessageURL);
      });
    })
  );
});
