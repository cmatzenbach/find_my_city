/* Registration/login Popup */
$(".navRegister").click(function() {

	var options = {
			url: "renderstration.php",
			title:'Login/Register',
			size: 'xl',
			subtitle: 'Login is required to add new events, attend an event, etc.'
		};
	eModal.ajax(options);

});

/* Registration/login Popup */
$("#whatIsFindMyCity").click(function() {

	var options = {
			url: "https://findmy.city/about.php",
			title:'About FindMy.City',
			size: 'md',
			subtitle: ''
		};

	eModal.ajax(options);
});

/* Logout Button */
// http://stackoverflow.com/questions/25260446/php-log-out-with-ajax-call
$("#logout_btn").click(function() {
            $.ajax({
                url: 'logout.php',
                success: function(data){
                    window.location.href = data;
                }
            });
});


/* Create Event Button */
$("#createNewEvent").click(function() {
		newurl = 'https://findmy.city/new_event.php?map=pkr';	
    	window.location.href = newurl;
});

/* Create Event Button */
$(".navbar-brand").click(function() {
		newurl = 'https://findmy.city/';	
    	window.location.href = newurl;
});

/* Terms of Service */
$(".toslink").click(function() {
	var options = {
			url: "https://findmy.city/terms.php",
			title:'TERMS OF USE',
			size: 'xl',
			subtitle: 'and privacy policy'
		};
	eModal.ajax(options);
});

/* Edit Profile Button */
$("#editProfile").click(function() {
		newurl = 'https://findmy.city/edit_profile.php';	
    	window.location.href = newurl;
});

/* Filter Event MOdal */
$("#filterEvents").click(function() {
	var options = {
			url: "https://findmy.city/filter_events.php",
			title:'Filter Events',
			size: 'l',
			subtitle: 'Let\'s cut to the chase already'
		};
	eModal.ajax(options);
});

/* Event Info Modal */
function eventInfoModal(num) {

	var newurl = "https://findmy.city/eventinfo.php?e_id=" + num;

	var options = {
			url: newurl,
			title: 'Event Info',
			size: 'xl',
			subtitle: ''
		};

	eModal.ajax(options);
}

/* Forgot Password Form */
$("#forgot-password").click(function() {
	console.log("firing");
		newurl = 'https://findmy.city/forgot_password.php';	
    	window.location.href = newurl;
});