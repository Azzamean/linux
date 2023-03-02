jQuery(document).ready(function ($) {

   // GET DATA FOR HOSTED PROJECTS
   async function getHostedProjectData() {
	  //let hostedProjectURL = await fetch('https://landscape.openmainframeproject.org/api/items?project=hosted');
      let hostedProjectURL = await fetch(hosted_projects_url);
	   
	  
      let hostedProjectData = await hostedProjectURL.json();
      return hostedProjectData
   }

   // GET DATA FOR ALL ITEMS
   async function getItemsData() {projects_items_url
      let itemsURL = await fetch(projects_items_url);
      let itemsData = await itemsURL.json();
      return itemsData
   }

   // USE DATA
   getHostedProjectData().then(hostedProjectData => {
      getItemsData().then(itemsData => {
         itemsData.forEach((items, index) => {
            let itemsID = items.id;
            let itemsHomePage = items.homepage_url;
            hostedProjectData.forEach((members, index) => {
               $.each(members.items, function (logo, value) {
                  let projectsLogo = value.logo;
                  let projectsID = value.id;
                  if (itemsID === projectsID) {
                     var projectImg = $('<img>');
                     projectImg.attr('src', projectsLogo);
                     var projectLink = $('<a>');
                     projectLink.attr('href', itemsHomePage);
                     projectLink.attr('target', '_blank');
                     projectImg.appendTo(projectLink);
                     projectLink.appendTo('#slider');
                  }
               });
            })
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
});


//for (let logo of members.items) {
//	let membersLogo = logo.logo;
//	let img = document.createElement('img');
//	img.src = membersLogo;
//	$("#slider").append(img);
//}