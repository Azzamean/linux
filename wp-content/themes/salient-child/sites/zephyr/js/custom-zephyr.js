(function ($) {
	$(window).load(function () {
		var application = getParameterByName('application');
		if (application) {
			$.featherlight($('#' + application));
		}
	});

	$container = $('#vendor-parent, #resource-parent');
	$filterSelect = $('#filter-select, #filter-select-level');

	if ($container.length) {
		var containerEl = $('#vendor-parent, #resource-parent');
		var initialFilter = '';
		var hash = window.location.hash.replace(/^#/g, '');
		var split_hash = hash.split('&');
		if (hash) {
			split_hash.map(sh => {
				$('#' + sh).attr('selected', 'selected');
				initialFilter += '.' + sh
			});
		} else {
			initialFilter = 'all';
		}

		// console.log(initialFilter);
		var mixer = mixitup(containerEl, {
			load: {
				filter: initialFilter
			},
			callbacks: {
				onMixStart: function (state, futureState) {
					$('#vendor-filter-error').addClass('hidden');
				},
				onMixFail: function (state) {
					$('#vendor-filter-error').removeClass('hidden');
				}
			},
			multifilter: {
				enable: true // enable the multifilter extension for the mixer
			}
		});

		$filterSelect.on('change', function () {
			$container.mixItUp('filter', this.value);
		});
	}
})(jQuery);

function getParameterByName(name, url) {
	if (!url) url = window.location.href;
	name = name.replace(/[\[\]]/g, "\\$&");
	var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
		results = regex.exec(url);
	if (!results) return null;
	if (!results[2]) return '';
	return decodeURIComponent(results[2].replace(/\+/g, " "));
}


/* DISPLAY NONE FOR THE DEFAULT LOAD ON ZEPHYR MEMBERS */
window.onload = (event) => {
	const nodeList = document.querySelectorAll(".non-members");
	for (let i = 0; i < nodeList.length; i++) {
		nodeList[i].style.display = "none";
	}
};


jQuery(document).ready(function ($) {
	$("#vendor-dropdown fieldset:nth-of-type(4) select").on('change', function () {
		const nodeList = document.querySelectorAll(".non-members");
		for (let i = 0; i < nodeList.length; i++) {
			if ($(this).val() == '.non-members') {
				nodeList[i].style.display = "block";
			}
			if ($(this).val() == '.zephyr-members') {
				nodeList[i].style.display = "none";
			}
			// DISPLAY FOR ALL
			if ($(this).val() == '') {
				nodeList[i].style.display = "block";
			}
		}
	});
});