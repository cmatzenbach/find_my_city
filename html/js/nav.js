
/* Registration/login Popup */
$("#navRegister").click(function() {

	var options = {
			url: "renderstration.php",
			title:'Login/Register',
			size: 'xl',
			subtitle: 'Login is required to add new events'
		};

	eModal.ajax(options);
});

/* Registration/login Popup */
$("#whatIsFindMyCity").click(function() {

	var options = {
			url: "https://findmy.city/about.php",
			title:'About FindMy.City',
			size: 'xl',
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