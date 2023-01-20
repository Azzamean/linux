jQuery(document).ready(function($) {

// GET DATA
async function getdata() {
   //let url = await fetch('https://api-gw.platform.linuxfoundation.org/project-service/v1/public/projects/a092M00001KWzi6QAD/members');
   let url = await fetch(members_url);
   let data = await url.json();
   return data
}

// USE DATA
getdata().then(data => {

   data.forEach((members, index) => {
      let membersLogo = `${members.Logo}`;
      let membersWebsite = `${members.Website}`;
      let membersMembership = `${members.Membership.Name}`;
      let img = document.createElement('img');
      img.src = membersLogo;
      img.onclick = function () {
         window.open('http://' + membersWebsite, '_blank');
      }
      if (membersLogo != "undefined") {
         $("#slider").append(img);
      }
   })

   $('.slider.right').slick({
      infinite: false,
      slidesToShow: 1,
      slidesToScroll: 1,
      swipeToSlide: false,
      draggable: false,
      arrows: false,
      autoplay: true,
      appendArrows: false,
      autoplaySpeed: 0,
      cssEase: "linear",
      centerMode: true,
      variableWidth: true,
      lazyLoad: "ondemand",
      pauseOnHover: false,
      pauseOnFocus: false,
      speed: 4500
   });

});

});
