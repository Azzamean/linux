jQuery(document).ready(function ($) {


	// SEARCH AND FILTER SEARCH BUTTON
	$(".top-search-btn").click(function () {
		$("#search-filter-form-49666").submit();
	});

	let ftb = document.getElementById('sf-top-search-box');
	let stb = document.getElementById('sf-search-box');
	ftb.value = stb.value;

	$("#sf-top-search-box").keyup(function () {
		stb.value = ftb.value;
		if (event.keyCode === 13) {
			$("#search-filter-form-49666").submit();
		}

	});

	// SEARCH AND FILTER LOGIC ON TOP CATEGORIES
	let top_board = $("input[type='checkbox'][value='top-board']");
	let bottom_board = $("input[type='checkbox'][value='board']");
	let bottom_hardware = $("input[type='checkbox'][value='hardware']");
	let top_core = $("input[type='checkbox'][value='top-core']");
	let bottom_core = $("input[type='checkbox'][value='core']");
	let bottom_cores = $("input[type='checkbox'][value='cores']");
	let top_software = $("input[type='checkbox'][value='top-software']");
	let bottom_software = $("input[type='checkbox'][value='software']");
	let top_services = $("input[type='checkbox'][value='top-services']");
	let bottom_services = $("input[type='checkbox'][value='services']");
	let top_learning = $("input[type='checkbox'][value='top-learning']");
	let bottom_learning = $("input[type='checkbox'][value='learning']");

	top_board.on('change', function () {
		bottom_board.prop('checked', this.checked);
		bottom_hardware.prop('checked', this.checked);
		let hardware;
		hardware = document.querySelectorAll('.hardware');
		for (i = 0; i < hardware.length; i++) {
			if ((this.checked) == true) {
				$(hardware[i]).attr('style', 'display: block !important');
			} else {
				$(hardware[i]).attr('style', 'display: none !important');
				let hardware_checkboxes = document.querySelectorAll('.hardware input[type="checkbox"]');
				for (let i = 0; i < hardware_checkboxes.length; i++) {
					hardware_checkboxes[i].checked = false;
				}
			}
		}
		$("#search-filter-form-49666").submit();
	});

	top_core.on('change', function () {
		bottom_core.prop('checked', this.checked);
		bottom_cores.prop('checked', this.checked);
		let cores;
		cores = document.querySelectorAll('.cores');
		for (i = 0; i < cores.length; i++) {
			if ((this.checked) == true) {
				$(cores[i]).attr('style', 'display: block !important');
			} else {
				$(cores[i]).attr('style', 'display: none !important');
				let cores_checkboxes = document.querySelectorAll('.cores input[type="checkbox"]');
				for (let i = 0; i < cores_checkboxes.length; i++) {
					cores_checkboxes[i].checked = false;
				}
			}
		}
		$("#search-filter-form-49666").submit();
	});

	top_software.on('change', function () {
		bottom_software.prop('checked', this.checked);
		let software;
		software = document.querySelectorAll('.software');
		for (i = 0; i < software.length; i++) {
			if ((this.checked) == true) {
				$(software[i]).attr('style', 'display: block !important');
			} else {
				$(software[i]).attr('style', 'display: none !important');
				let software_checkboxes = document.querySelectorAll('.software input[type="checkbox"]');
				for (let i = 0; i < software_checkboxes.length; i++) {
					software_checkboxes[i].checked = false;
				}
			}
		}
		$("#search-filter-form-49666").submit();
	});

	top_services.on('change', function () {
		bottom_services.prop('checked', this.checked);
		let services;
		services = document.querySelectorAll('.services');
		for (i = 0; i < services.length; i++) {
			if ((this.checked) == true) {
				$(services[i]).attr('style', 'display: block !important');
			} else {
				$(services[i]).attr('style', 'display: none !important');
				let services_checkboxes = document.querySelectorAll('.services input[type="checkbox"]');
				for (let i = 0; i < services_checkboxes.length; i++) {
					services_checkboxes[i].checked = false;
				}
			}
		}
		$("#search-filter-form-49666").submit();
	});

	top_learning.on('change', function () {
		bottom_learning.prop('checked', this.checked);
		let learning;
		learning = document.querySelectorAll('.learning');
		for (i = 0; i < learning.length; i++) {
			if ((this.checked) == true) {
				$(learning[i]).attr('style', 'display: block !important');
			} else {
				$(learning[i]).attr('style', 'display: none !important');
				let learning_checkboxes = document.querySelectorAll('.learning input[type="checkbox"]');
				for (let i = 0; i < learning_checkboxes.length; i++) {
					learning_checkboxes[i].checked = false;
				}
			}
		}
		$("#search-filter-form-49666").submit();
	});


	// SEARCH AND FILTER LOGIC ON SIDE DISPLAY
	let filter_array = [];
	filter_array = document.body.getElementsByTagName("*");
	let filter_length = filter_array.length;

	for (let i = 0; i < filter_length; i++) {
		// HARDWARE
		if (
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_buswidth') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_power') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_memory_storage') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_connectivity') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_peripherals') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_video_display')

		) {
			//alert("FOUND : " + filter_array[i].getAttribute("data-sf-field-name"));
			filter_array[i].classList.add("hardware");
		}
		// CORES
		if (
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_riscv_compatible') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_profile') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_language') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_extension') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_core_type') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_user_spec') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_priv_spec')
		) {
			//alert("FOUND : " + filter_array[i].getAttribute("data-sf-field-name"));
			filter_array[i].classList.add("cores");
		}
		// SOFTWARE
		if (

			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_software_type')
		) {
			//alert("FOUND : " + filter_array[i].getAttribute("data-sf-field-name"));
			filter_array[i].classList.add("software");
		}
		// SERVICES
		if (

			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_service_type')
		) {
			//alert("FOUND : " + filter_array[i].getAttribute("data-sf-field-name"));
			filter_array[i].classList.add("services");
		}
		// LEARNING
		if (

			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_learn_type') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_learn_category') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_learn_level') ||
			(filter_array[i].getAttribute("data-sf-field-name") == '_sfm_exchange_learn_language')
		) {
			//alert("FOUND : " + filter_array[i].getAttribute("data-sf-field-name"));
			filter_array[i].classList.add("learning");
		}
	}


	// SEARCH AND FILTER LOGIC FOR MAKING SURE TOP AND BOTTOM SYNC ON PAGE RELOAD AND BACK BUTTON CLICKS
	if ($(top_board).is(':checked') || $(bottom_board).is(':checked') || $(bottom_hardware).is(':checked')     ) {
		$(top_board).prop("checked", true);
		let hardware;
		hardware = document.querySelectorAll('.hardware');
		for (i = 0; i < hardware.length; i++) {
			$(hardware[i]).attr('style', 'display: block !important');
		}
	}

	if ($(top_core).is(':checked') || $(bottom_core).is(':checked') || $(bottom_cores).is(':checked')) {
		$(top_core).prop("checked", true);
		let cores;
		cores = document.querySelectorAll('.cores');
		for (i = 0; i < cores.length; i++) {
			$(cores[i]).attr('style', 'display: block !important');
		}
	}

	if ($(top_software).is(':checked') || $(bottom_software).is(':checked')) {
		$(top_software).prop("checked", true);
		let software;
		software = document.querySelectorAll('.software');
		for (i = 0; i < software.length; i++) {
			$(software[i]).attr('style', 'display: block !important');
		}
	}

	if ($(top_services).is(':checked') || $(bottom_services).is(':checked')) {
		$(top_services).prop("checked", true);
		let services;
		services = document.querySelectorAll('.services');
		for (i = 0; i < services.length; i++) {
			$(services[i]).attr('style', 'display: block !important');
		}
	}
	if ($(top_learning).is(':checked') || $(bottom_learning).is(':checked')) {
		$(top_learning).prop("checked", true);
		let learning;
		learning = document.querySelectorAll('.learning');
		for (i = 0; i < learning.length; i++) {
			$(learning[i]).attr('style', 'display: block !important');
		}
	}

})