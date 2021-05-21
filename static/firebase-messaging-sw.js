importScripts('https://www.gstatic.com/firebasejs/8.3.3/firebase-app.js')
importScripts('https://www.gstatic.com/firebasejs/8.3.3/firebase-messaging.js')

try {
  if (!firebase.apps.length) {
    firebase.initializeApp({
      apiKey: 'AIzaSyCiYflBpvnQKgJur5yzHrvHieO4MSDyrBU',
      authDomain: 'meatthesea-b7855.firebaseapp.com',
      databaseURL: 'https://meatthesea-b7855.firebaseio.com',
      projectId: 'meatthesea-b7855',
      storageBucket: 'meatthesea-b7855.appspot.com',
      messagingSenderId: '1062131230146',
      appId: '1:1062131230146:web:c9bd2373ac60aef503a25b',
      measurementId: 'G-9QVGTT3QWV'
    })
  }else {
    firebase.app(); // if already initialized, use that one
  }

  const messaging = firebase.messaging()

  // messaging.setBackgroundMessageHandler(function (payload) {
  //   const title = payload.data.username
  //   let iconPath = './img/icons/logo.png'

  //   const options = {
  //     body: payload.data.message,
  //     icon: iconPath
  //   }

  //   return self.ServiceWorkerRegistration.showNotification(title, options)

  // })

  self.addEventListener('notificationclick', function(event) {
    event.notification.close();
    event.waitUntil(clients.matchAll({
      type: "window"
    }).then(function(clientList) {
      for (var i = 0; i < clientList.length; i++) {
        var client = clientList[i];
        if (client.url == '/' && 'focus' in client)
          return client.focus();
      }
      if (clients.openWindow)
        return clients.openWindow('/');
    }));
  });

  messaging.onBackgroundMessage((payload) => {
    // Customize notification here
    const notificationTitle = payload.notification.title;
    const notificationOptions = {
      body: payload.notification.body,
      icon: './img/icons/logo.png'
    };
  
    self.registration.showNotification(notificationTitle,
      notificationOptions);
  });
}catch(error) {
  firebase.app()
}
