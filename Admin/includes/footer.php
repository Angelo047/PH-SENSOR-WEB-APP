<footer class="main-footer">
      <strong>Copyright &copy; 2023-2024</strong>
      All rights reserved.
      <div class="float-right d-none d-sm-inline-block">
      </div>
    </footer>
  </div>
</section>
</div>

</div>
<!-- ./wrapper -->


<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- JavaScript function to toggle dark mode -->

<script>
  const darkModeButton = document.getElementById('darkModeButton');
  const body = document.body;

  darkModeButton.addEventListener('click', () => {
    body.classList.toggle('dark-mode');
  });
</script>


<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-app.js"></script>
<script src="https://www.gstatic.com/firebasejs/8.6.5/firebase-database.js"></script>


<script>
  var firebaseConfig = {
    apiKey: "AIzaSyBCe1DGEf01SvWTwuBGCuhFKiHVuwMmf5I",
    authDomain: "php-firebase-9b785.firebaseapp.com",
    databaseURL: "https://php-firebase-9b785-default-rtdb.firebaseio.com",
    projectId: "php-firebase-9b785",
    storageBucket: "php-firebase-9b785.appspot.com",
    messagingSenderId: "954656030016",
    appId: "1:954656030016:web:69edbdbcab24f8508ccea5",
    measurementId: "G-TVV3ZFYSCR"
  };

  firebase.initializeApp(firebaseConfig);

  var notificationsRef = firebase.database().ref('notifications');

  var latestNotifications = [];

  notificationsRef.on('child_added', function(snapshot) {
    var notification = snapshot.val();

    if (!notification.isRead) {
      // Update the notification count only for unread notifications
      var notificationCount = parseInt($('#notification-count').text());
      $('#notification-count').text(notificationCount + 1);
    }

    // Only add unread notifications to the latestNotifications array
    if (!notification.isRead) {
      latestNotifications.unshift({ id: snapshot.key, ...notification });
      latestNotifications = latestNotifications.slice(0, 5);
    }

    $('#notifications-list').empty();

    for (var i = 0; i < latestNotifications.length; i++) {
      var notificationItem = latestNotifications[i];
      $('#notifications-list').append(
        '<a href="#" class="dropdown-item" data-notification-id="' + notificationItem.id + '">' +
        '<div class="callout callout-success">' +
        '<div class="media">' +
        '<img src="' + notificationItem.plant_photo + '" alt="User Avatar" class="img-size-50 mr-3 img-circle">' +
        '<div class="media-body">' +
        '<h3 class="dropdown-item-title">' +
        '<strong>' + notificationItem.plant_name + '</strong><br>' +
        '<p class="text-sm text-muted">' + notificationItem.message + '</p>' +
        '<p class="text-sm text-muted">' + notificationItem.current_date + '</p>' +
        '</div>' +
        '</div>' +
        '</div>' +
        '</a>' +
        '<div class="dropdown-divider"></div>'
      );
    }

    $('#notifications-count').text('(' + latestNotifications.length + ')');
  });

  // Add click event to mark all notifications as read
  $('#notification-bell').on('click', function() {
    // Mark all unread notifications as read in the Firebase Realtime Database
    notificationsRef.once('value', function(snapshot) {
      snapshot.forEach(function(childSnapshot) {
        var notificationId = childSnapshot.key;
        var notification = childSnapshot.val();

        if (!notification.isRead) {
          notificationsRef.child(notificationId).update({
            isRead: 1
          });
        }
      });
    });

    // Reset the notification count
    $('#notification-count').text('0');
  });
</script>



</body>
</html>
