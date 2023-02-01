jQuery(document).ready(function ($) {
   $('.sf-menu a .menu-title-text').each(function () {
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


