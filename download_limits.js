jQuery(document).ready(function() {
  jQuery(document).on('click', '#downloadSizeBox a, a#downloadSwitchLink',  function(e) {
    jQuery.alert({
      useBootstrap: false,
      theme: 'supervan',
      title: str_confirmTitle,
      content: str_confirmContent,
    });
    e.preventDefault();
  });
});