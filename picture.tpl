{combine_script id='jquery.confirm' load='footer' require='jquery' path='plugins/download_limits/vendor/jquery-confirm.min.js'}
{combine_css path="plugins/download_limits/vendor/jquery-confirm.min.css"}

{combine_script id='download_limits' load='footer' require='jquery' path='plugins/download_limits/download_limits.js'}

{footer_script}
var str_confirmTitle = "{'Download limit reached'|translate}";
var str_confirmContent = "{'You have reached the limit, try again tomorrow'|translate}";
{/footer_script}