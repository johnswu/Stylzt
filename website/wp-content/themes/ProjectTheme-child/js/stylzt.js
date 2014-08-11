function toggleSubNav(navID) {
	jQuery("#" + navID).slideToggle();
	if (jQuery("#" + navID + "Caret").hasClass("fa-caret-right")) {
		jQuery("#" + navID + "Caret").removeClass("fa-caret-right");
		jQuery("#" + navID + "Caret").addClass("fa-caret-down");
	} else {
		jQuery("#" + navID + "Caret").removeClass("fa-caret-down");
		jQuery("#" + navID + "Caret").addClass("fa-caret-right");
	}
}