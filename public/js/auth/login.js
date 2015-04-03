;(function($)
{
  $(document).ready(function()
  {
    var localEmail = localStorage.getItem('dave.user.email');

    if(localEmail !== null && localEmail !== '')
    {
      $('#email').val(localEmail);
      $('#password').focus();
    } else {
      $('#email').focus();
    }

  });
})(window.jQuery);