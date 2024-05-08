<!-- Pnotify css -->
<link href="assets/plugins/pnotify/css/pnotify.custom.min.css" rel="stylesheet">
<link href="assets/css/pages/pnotify.css" rel="stylesheet">
<!-- Pnotify Js -->
<script src="assets/plugins/pnotify/js/pnotify.custom.min.js">
</script>
<script type="text/javascript">
$(function() {
  if (count_notify) {
    var notice = new PNotify({
        title: 'Bạn có ' + count_notify + ' Chưa đọc !',
        text: '<p>Bạn có muốn xem thông báo này?</p>',
        hide: false,
        type: 'warning',
        confirm: {
            confirm: true,
            buttons: [
                {
                    text: 'Có',
                    addClass: 'btn btn-sm btn-primary'
                },
                {
                    text: 'Không',
                    addClass: 'btn btn-sm btn-link'
                }
            ]
        },
        buttons: {
            closer: false,
            sticker: false
        },
        history: {
            history: false
        }
    })
  }
    notice.get().on('pnotify.confirm', function() {
        window.location.href = "thong-bao";
    })
    notice.get().on('pnotify.cancel', function() {
    });
});
</script>
</body>
</html>
