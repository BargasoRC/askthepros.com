/* eslint-disable */
import firebase from 'firebase/app'
import 'firebase/messaging'
import CONFIG from 'src/config'

const firebaseConfig = CONFIG.firebaseConfig

self.addEventListener('notificationclick', function (event) {
  const url = event.currentTarget.location.origin
  event.waitUntil(
    clients.matchAll({ includeUncontrolled: true, type: 'window' }).then(windowClients => {
      // Check if there is already a window/tab open with the target URL
      for (var i = 0; i < windowClients.length; i++) {
        var client = windowClients[i];
        // If so, just focus it.
        if (client.url === url && 'focus' in client) {
          return client.focus();
        }
      }
      // If not, then open the target URL in a new window/tab.
      if (clients.openWindow) {
        return clients.openWindow(url);
      }
    })
  );
})

if (!firebase.apps.length) {
  firebase.initializeApp(firebaseConfig);
} else {
  firebase.app(); // if already initialized, use that one
}

const messaging = firebase.messaging()

export default {
  messaging: messaging
}
