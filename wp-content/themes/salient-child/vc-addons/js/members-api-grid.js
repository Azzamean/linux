jQuery(document).ready(function ($) {

   var membersURLreplace = members_url.replace(/&amp;/g, '&');
   //alert(membersURLreplace);

   // GET DATA
   async function getdata() {
      //let url = await fetch('https://api-gw.platform.linuxfoundation.org/project-service/v1/public/projects/a092M00001KWzi6QAD/members');
      let url = await fetch(membersURLreplace);
      let data = await url.json();
      return data
   }

   // USE DATA
   getdata().then(data => {

      data.forEach((members, index) => {
         let membersLogo = `${members.Logo}`;
         let membersWebsite = `${members.Website}`;
         let img = document.createElement('img');
         img.className = 'membersLogo';
         img.src = membersLogo;
         img.onclick = function() {
            window.open('http://' + membersWebsite, '_blank');
         }
         if (membersLogo != "undefined" && img.naturalHeight !== 0) {
            $("#members-grid").append(img);
         }
      })
      $(".membersLogo").wrap("<div class='members-grid-item'></div>");
   });
});
