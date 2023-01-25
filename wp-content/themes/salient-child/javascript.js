jQuery(document).ready(function ($) {

   $('#vendor-dropdown fieldset:nth-child(4) select').val('.zephyr-members');

   $('a').each(function () {
      var a = new RegExp('/' + window.location.host + '/');
      if (!a.test(this.href)) {
         $(this).addClass("external");
         $(this).click(function (event) {
            event.preventDefault();
            event.stopPropagation();
            window.open(this.href, '_blank');
         });
      }
   });
});