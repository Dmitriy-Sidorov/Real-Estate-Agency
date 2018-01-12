var idCaptcha1, idCaptcha2, idCaptcha3, idCaptcha4, idCaptcha5, idCaptcha6, idCaptcha7, idCaptcha8;
	var onloadReCaptchaInvisible = function() {
		/*presentation*/
		idCaptcha1 = grecaptcha.render('recaptcha1', {
			"sitekey": "6LcgPiYUAAAAAL9x5gf2rqipE66X6RIY6xzXTQUc",
			"callback": "onSubmitReCaptcha1",
			"size": "invisible"
		});
		/*callback*/
		idCaptcha2 = grecaptcha.render('recaptcha2', {
			"sitekey": "6LcgPiYUAAAAAL9x5gf2rqipE66X6RIY6xzXTQUc",
			"callback": "onSubmitReCaptcha2",
			"size": "invisible"
		});
		/*wanna ask*/
		idCaptcha3 = grecaptcha.render('recaptcha3', {
			"sitekey": "6LcgPiYUAAAAAL9x5gf2rqipE66X6RIY6xzXTQUc",
			"callback": "onSubmitReCaptcha3",
			"size": "invisible"
		});
		/*your price*/
		idCaptcha4 = grecaptcha.render('recaptcha4', {
			"sitekey": "6LcgPiYUAAAAAL9x5gf2rqipE66X6RIY6xzXTQUc",
			"callback": "onSubmitReCaptcha4",
			"size": "invisible"
		});
		/*agent*/
		idCaptcha5 = grecaptcha.render('recaptcha5', {
			"sitekey": "6LcgPiYUAAAAAL9x5gf2rqipE66X6RIY6xzXTQUc",
			"callback": "onSubmitReCaptcha5",
			"size": "invisible"
		});
		/*na prosmotr*/
		idCaptcha6 = grecaptcha.render('recaptcha6', {
			"sitekey": "6LcgPiYUAAAAAL9x5gf2rqipE66X6RIY6xzXTQUc",
			"callback": "onSubmitReCaptcha6",
			"size": "invisible"
		});
		/*ipoteka*/
		idCaptcha7 = grecaptcha.render('recaptcha7', {
			"sitekey": "6LcgPiYUAAAAAL9x5gf2rqipE66X6RIY6xzXTQUc",
			"callback": "onSubmitReCaptcha7",
			"size": "invisible"
		});
		/*consult*/
		idCaptcha8 = grecaptcha.render('recaptcha8', {
			"sitekey": "6LcgPiYUAAAAAL9x5gf2rqipE66X6RIY6xzXTQUc",
			"callback": "onSubmitReCaptcha8",
			"size": "invisible"
		});
	};
	function onSubmitReCaptcha1(token) {
		var idForm = 'presentationform';
		sendForm(document.getElementById(idForm), '/wp-content/themes/real-spaces/mail/checkCaptchaPresentation.php', idCaptcha1);
	}
	function onSubmitReCaptcha2(token) {
		var idForm = 'callbackform';
		sendForm(document.getElementById(idForm), '/wp-content/themes/real-spaces/mail/checkCaptchaCallback.php', idCaptcha2);
	}
	function onSubmitReCaptcha3(token) {
		var idForm = 'wannaaskform';
		sendForm(document.getElementById(idForm), '/wp-content/themes/real-spaces/mail/checkCaptchaWannaAsk.php', idCaptcha3);
	}
	function onSubmitReCaptcha4(token) {
		var idForm = 'yourpriceform';
		sendForm(document.getElementById(idForm), '/wp-content/themes/real-spaces/mail/checkCaptchaYourPrice.php', idCaptcha4);
	}
	function onSubmitReCaptcha5(token) {
		var idForm = 'agentcontactform';
		sendForm(document.getElementById(idForm), '/wp-content/themes/real-spaces/mail/checkCaptchaAgent.php', idCaptcha5);
	}
	function onSubmitReCaptcha6(token) {
		var idForm = 'naprosmotrform';
		sendForm(document.getElementById(idForm), '/wp-content/themes/real-spaces/mail/checkCaptchaNaProsmotr.php', idCaptcha6);
	}
	function onSubmitReCaptcha7(token) {
		var idForm = 'ipotekaform';
		sendForm(document.getElementById(idForm), '/wp-content/themes/real-spaces/mail/checkCaptchaIpoteka.php', idCaptcha7);
	}
	function onSubmitReCaptcha8(token) {
		var idForm = 'consultForm';
		sendForm(document.getElementById(idForm), '/wp-content/themes/real-spaces/mail/checkCaptchaConsult.php', idCaptcha8);
	}
	var prepareDataForm = function(feedbackForm, captchaID) {
			// создаём экземпляр объекта FormData
			var formData = new FormData(feedbackForm);
			// добавим ответ invisible reCaptcha
			formData.append('g-recaptcha-response', grecaptcha.getResponse(captchaID));
			return formData;
		}
	
	// отправка формы через AJAX
	var sendForm = function(feedbackForm, url, captchaID) {
		jQuery.ajax({
			type: "POST",
			url: url,
			data: prepareDataForm(feedbackForm, captchaID),
			contentType: false,
			processData: false,
			cache: false,
			success: function(data) {
				var data = JSON.parse(data);
				if (captchaID === 0) {
							jQuery('.presentationform').html("");
							document.getElementById('npf_message1').innerHTML = data.text;
							jQuery('#npf_message1').slideDown('slow');
                            jQuery('.presentationform img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
							jQuery('.presentationform #submit').removeAttr('disabled');
							setTimeout(function() {
								jQuery("#presentationModal .inverted").click();
							}, 2000);
				}
				if(captchaID == 1) {
						jQuery('.callbackForm').html("");
							document.getElementById('cfm_message').innerHTML = data.text;
							jQuery('#cfm_message').slideDown('slow');
                            jQuery('.callbackForm img.loader').fadeOut('slow', function () {
                                jQuery(this).remove()
                            });
							jQuery('.callbackForm #submit').removeAttr('disabled');
							setTimeout(function() {
								jQuery("#callbackmodal .inverted").click();
							}, 2000);
							
								jQuery('.callbackForm').slideUp('slow');
								try {
									yaCounter38924025.reachGoal("SEND-CALLBACK");
									console.log("Reach goal SEND-CALLBACK");
								}
								catch(e) {
									console.log("Error reach goal SEND-CALLBACK");
								}
								
								if (location.pathname === '/zhk-lesnaya-melodiya-2') {
									try {
										yaCounter38924025.reachGoal("SEND-CALLBACK-LM2");
										console.log("Reach goal SEND-CALLBACK-LM2");
									}
									catch(e) {
										console.log("Error reach goal SEND-CALLBACK-LM2");
									}
								}
								
								if (location.pathname === '/zhk-na-krasina-46') {
									try {
										yaCounter38924025.reachGoal("SEND-CALLBACK-K46");
										console.log("Reach goal SEND-CALLBACK-K46");
									}
									catch(e) {
										console.log("Error reach goal SEND-CALLBACK-K46");
									}
								}
								
								if (location.pathname === '/novostroyka-na-bulvar-guseva-56') {
									try {
										yaCounter38924025.reachGoal("SEND-CALLBACK-G56");
										console.log("Reach goal SEND-CALLBACK-G56");
									}
									catch(e) {
										console.log("Error reach goal SEND-CALLBACK-G56");
									}
								}
								
								if (location.pathname === '/zhk-novyiy-gorod') {
									try {
										yaCounter38924025.reachGoal("SEND-CALLBACK-NG");
										console.log("Reach goal SEND-CALLBACK-NG");
									}
									catch(e) {
										console.log("Error reach goal SEND-CALLBACK-NG");
									}
								}
	
				}
				if(captchaID == 2) {
							jQuery('.wannaaskForm').html("");
							document.getElementById('waf_message').innerHTML = data.text;
							jQuery('#waf_message').slideDown('slow');
                            jQuery('.wannaaskForm img.loader').fadeOut('slow', function () {
                                jQuery(this).remove()
                            });
							jQuery('.wannaaskForm #submit').removeAttr('disabled');
							setTimeout(function() {
								jQuery("#wannaaskmodal .inverted").click();
							}, 2000);

								jQuery('.wannaaskForm').slideUp('slow');
								
								if (location.pathname === '/zhk-lesnaya-melodiya-2') {
									try {
										yaCounter38924025.reachGoal("SEND-WANNAASK-LM2");
										console.log("Reach goal SEND-WANNAASK-LM2");
									}
									catch(e) {
										console.log("Error reach goal SEND-WANNAASK-LM2");
									}
								}
								
								if (location.pathname === '/zhk-na-krasina-46') {
									try {
										yaCounter38924025.reachGoal("SEND-WANNAASK-K46");
										console.log("Reach goal SEND-WANNAASK-K46");
									}
									catch(e) {
										console.log("Error reach goal SEND-WANNAASK-K46");
									}
								}
								
								if (location.pathname === '/novostroyka-na-bulvar-guseva-56') {
									try {
										yaCounter38924025.reachGoal("SEND-WANNAASK-G56");
										console.log("Reach goal SEND-WANNAASK-G56");
									}
									catch(e) {
										console.log("Error reach goal SEND-WANNAASK-G56");
									}
								}
								
								if (location.pathname === '/zhk-novyiy-gorod') {
									try {
										yaCounter38924025.reachGoal("SEND-WANNAASK-NG");
										console.log("Reach goal SEND-WANNAASK-NG");
									}
									catch(e) {
										console.log("Error reach goal SEND-WANNAASK-NG");
									}
								}

				}
				if(captchaID == 3) {
							jQuery('.your-price-form').html("");
							document.getElementById('ypf_message').innerHTML = data.text;
							jQuery('#ypf_message').slideDown('slow');
                            jQuery('.your-price-form img.loader').fadeOut('slow', function () {
                                jQuery(this).remove()
                            });
							jQuery('.your-price-form #submit').removeAttr('disabled');
							setTimeout(function() {
								jQuery("#yourPriceModal .inverted").click();
							}, 2000);
								jQuery('.your-price-form').slideUp('slow');
								try {
									yaCounter38924025.reachGoal("SEND-YOUR-PRICE");
									console.log("Reach goal SEND-YOUR-PRICE");
								}
								catch(e) {
									console.log("Error reach goal SEND-YOUR-PRICE");
								}
				
				}
				if(captchaID == 4) {
					jQuery('.agent-contact-form').html("");
					document.getElementById('message').innerHTML = data.text;
						jQuery('#message').slideDown('slow');
						jQuery('.agent-contact-form img.loader').fadeOut('slow',function () {
								jQuery(this).remove()
						});
						jQuery('.agent-contact-form #submit').removeAttr('disabled');
						jQuery('.agent-contact-form').slideUp('slow');
						setTimeout(function() {
								jQuery("#agentmodal .inverted").click();
							}, 2000);
				}
				if (captchaID == 5) {
					jQuery('.na-prosmotr-form').html("");
					document.getElementById('npf_message').innerHTML = data.text;
							jQuery('#npf_message').slideDown('slow');
                            jQuery('.na-prosmotr-form img.loader').fadeOut('slow', function () {
                                jQuery(this).remove()
                            });
							jQuery('.na-prosmotr-form #submit').removeAttr('disabled');
							setTimeout(function() {
								jQuery("#naProsmotrModal .inverted").click();
							}, 2000);
							
								jQuery('.na-prosmotr-form').slideUp('slow');
								try {
									yaCounter38924025.reachGoal("SEND-NA-PROSMOTR");
									console.log("Reach goal SEND-NA-PROSMOTR");
								}
								catch(e) {
									console.log("Error reach goal SEND-NA-PROSMOTR");
								}
								
								if (location.pathname === '/zhk-lesnaya-melodiya-2') {
									try {
										yaCounter38924025.reachGoal("SEND-PROSMOTR-LM2");
										console.log("Reach goal SEND-PROSMOTR-LM2");
									}
									catch(e) {
										console.log("Error reach goal SEND-PROSMOTR-LM2");
									}
								}
								
								if (location.pathname === '/zhk-na-krasina-46') {
									try {
										yaCounter38924025.reachGoal("SEND-PROSMOTR-K46");
										console.log("Reach goal SEND-PROSMOTR-K46");
									}
									catch(e) {
										console.log("Error reach goal SEND-PROSMOTR-K46");
									}
								}
								
								if (location.pathname === '/novostroyka-na-bulvar-guseva-56') {
									try {
										yaCounter38924025.reachGoal("SEND-PROSMOTR-G56");
										console.log("Reach goal SEND-PROSMOTR-G56");
									}
									catch(e) {
										console.log("Error reach goal SEND-PROSMOTR-G56");
									}
								}
								
								if (location.pathname === '/zhk-novyiy-gorod') {
									try {
										yaCounter38924025.reachGoal("SEND-PROSMOTR-NG");
										console.log("Reach goal SEND-PROSMOTR-NG");
									}
									catch(e) {
										console.log("Error reach goal SEND-PROSMOTR-NG");
									}
								}
							
				}
				if(captchaID == 6) {
					jQuery('.ipotekaForm').html("");
					document.getElementById('if_message').innerHTML = data.text;
							jQuery('#if_message').slideDown('slow');
                            jQuery('.ipotekaForm img.loader').fadeOut('slow', function () {
                                jQuery(this).remove()
                            });
							jQuery('.ipotekaForm #submit').removeAttr('disabled');
							setTimeout(function() {
								jQuery("#ipotekamodal .inverted").click();
							}, 2000);
							
								jQuery('.ipotekaForm').slideUp('slow');
								
								if (location.pathname === '/zhk-lesnaya-melodiya-2') {
									try {
										yaCounter38924025.reachGoal("SEND-IPOTEKA-LM2");
										console.log("Reach goal SEND-IPOTEKA-LM2");
									}
									catch(e) {
										console.log("Error reach goal SEND-IPOTEKA-LM2");
									}
								}
								
								if (location.pathname === '/zhk-na-krasina-46') {
									try {
										yaCounter38924025.reachGoal("SEND-IPOTEKA-K46");
										console.log("Reach goal SEND-IPOTEKA-K46");
									}
									catch(e) {
										console.log("Error reach goal SEND-IPOTEKA-K46");
									}
								}
								
								if (location.pathname === '/novostroyka-na-bulvar-guseva-56') {
									try {
										yaCounter38924025.reachGoal("SEND-IPOTEKA-G56");
										console.log("Reach goal SEND-IPOTEKA-G56");
									}
									catch(e) {
										console.log("Error reach goal SEND-IPOTEKA-G56");
									}
								}
								
								if (location.pathname === '/zhk-novyiy-gorod') {
									try {
										yaCounter38924025.reachGoal("SEND-IPOTEKA-NG");
										console.log("Reach goal SEND-IPOTEKA-NG");
									}
									catch(e) {
										console.log("Error reach goal SEND-IPOTEKA-NG");
									}
								}
							
				}
				if (captchaID == 7) {
					jQuery('.consultForm').html("");
					document.getElementById('cofm_message').innerHTML = data.text;
							jQuery('#cofm_message').slideDown('slow');
                            jQuery('.consultForm img.loader').fadeOut('slow', function () {
                                jQuery(this).remove()
                            });
							jQuery('.consultForm #submit').removeAttr('disabled');
							setTimeout(function() {
								jQuery("#consultModal .inverted").click();
							}, 2000);
							
								jQuery('.consultForm').slideUp('slow');
								try {
										yaCounter38924025.reachGoal("SEND_CONSULT");
										console.log("Reach goal SEND_CONSULT");
									}
									catch(e) {
										console.log("Error reach goal SEND_CONSULT");
									}
				}
			},
			error: function(request) {
				alert(request);
				//$(feedbackForm).find('.error').text('Произошла ошибка ' + request.responseText + ' при отправке данных.');
			}
		});
	};

jQuery(function ($) {
	$("a[data-target='#consultModal']").click(function(){
		try {
			yaCounter38924025.reachGoal("CLICK_CONSULT");
			console.log("Reach goal CLICK_CONSULT");
		}
		catch(e) {
			console.log("Error reach goal CLICK_CONSULT");
		}
	});
	
	
	console.log("were " + $.cookie('form'));
	if($.cookie('form') != 1) {
		setTimeout(function() {
			$("#presentationModalBtn").click();
		}, 30000);
		$.cookie('form', 1, { path: '/' });
		console.log("set " +$.cookie('form'));	
	}
	$(".consultForm #phone").mask("+7 (999) 999-99-99");
	$(".agent-contact-form #phone").mask("+7 (999) 999-99-99");
	$(".callback-form #phone").mask("+7 (999) 999-99-99");
	$(".callbackForm #phone").mask("+7 (999) 999-99-99");
	$(".ipotekaForm #phone").mask("+7 (999) 999-99-99");
	$(".wannaaskForm #phone").mask("+7 (999) 999-99-99");
	$(".your-price-form #phone").mask("+7 (999) 999-99-99");
	$(".na-prosmotr-form #phone").mask("+7 (999) 999-99-99");
	$(".presentationform #phone").mask("+7 (999) 999-99-99");
	 $(".owl-carousel.bannerCarousel").owlCarousel({
			loop:true,
			margin:10,
			nav:false,
			dots: false,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1000:{
					items:1
				}
			},
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:false
		});
		$(".owl-carousel.mainCarousel").owlCarousel({
			loop:true,
			margin:10,
			nav:false,
			dots: false,
			responsive:{
				0:{
					items:1
				},
				600:{
					items:1
				},
				1000:{
					items:1
				}
			},
			autoplay:true,
			autoplayTimeout:3000,
			autoplayHoverPause:false
		});
		
	$("header .btn-callback").on("click", function() {
		try {
			yaCounter38924025.reachGoal("OPEN-CALLBACK");
			console.log("Reach goal OPEN-CALLBACK");
		}
		catch(e) {
			console.log("Error reach goal OPEN-CALLBACK");
		}		
	});
	
	$(".a--yourPriceModal").on("click", function() {
		try {
			yaCounter38924025.reachGoal("OPEN-YOUR-PRICE");
			console.log("Reach goal OPEN-YOUR-PRICE");
		}
		catch(e) {
			console.log("Error reach goal OPEN-YOUR-PRICE");
		}		
	});
	
	$(".a--naProsmotr").on("click", function() {
		try {
			yaCounter38924025.reachGoal("OPEN-NA-PROSMOTR");
			console.log("Reach goal OPEN-NA-PROSMOTR");
		}
		catch(e) {
			console.log("Error reach goal OPEN-NA-PROSMOTR");
		}		
	});
	/* =================================================
     CALLBACK Form Validations
     ================================================== */
   
        /*$('.callbackForm').each(function () {
            var formInstance = $(this);
            formInstance.submit(function () {

                var action = $(this).attr('action');

                $("#cfm_message").slideUp(750, function () {
                    $('#cfm_message').hide();

                    $('.callbackForm #submit')
                        .after('<img src="' + $('#image_path').val() + 'images/assets/ajax-loader.gif" class="loader" />')
                        .attr('disabled', 'disabled');
					
                    $.post(action, {
                            name: $('.callbackForm #name').val(),
                            phone: $('.callbackForm #phone').val()
                        },
                        function (data) {
							document.getElementById('cfm_message').innerHTML = data;
							$('#cfm_message').slideDown('slow');
                            $('.callbackForm img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
							$('.callbackForm #submit').removeAttr('disabled');
							if (data.match('success') != null) 
							{
								$('.callbackForm').slideUp('slow');
								try {
									yaCounter38924025.reachGoal("SEND-CALLBACK");
									console.log("Reach goal SEND-CALLBACK");
								}
								catch(e) {
									console.log("Error reach goal SEND-CALLBACK");
								}
								
								if (location.pathname === '/zhk-lesnaya-melodiya-2') {
									try {
										yaCounter38924025.reachGoal("SEND-CALLBACK-LM2");
										console.log("Reach goal SEND-CALLBACK-LM2");
									}
									catch(e) {
										console.log("Error reach goal SEND-CALLBACK-LM2");
									}
								}
								
								if (location.pathname === '/zhk-na-krasina-46') {
									try {
										yaCounter38924025.reachGoal("SEND-CALLBACK-K46");
										console.log("Reach goal SEND-CALLBACK-K46");
									}
									catch(e) {
										console.log("Error reach goal SEND-CALLBACK-K46");
									}
								}
								
								if (location.pathname === '/novostroyka-na-bulvar-guseva-56') {
									try {
										yaCounter38924025.reachGoal("SEND-CALLBACK-G56");
										console.log("Reach goal SEND-CALLBACK-G56");
									}
									catch(e) {
										console.log("Error reach goal SEND-CALLBACK-G56");
									}
								}
								
								if (location.pathname === '/zhk-novyiy-gorod') {
									try {
										yaCounter38924025.reachGoal("SEND-CALLBACK-NG");
										console.log("Reach goal SEND-CALLBACK-NG");
									}
									catch(e) {
										console.log("Error reach goal SEND-CALLBACK-NG");
									}
								}
								
							}
							
                        }
                    );
                });
                return false;
            });
        });*/
				$('#callbackform').submit(function(event) {
					// отменим отправку форму на сервер
					event.preventDefault();
					// вызываем invisible reCaptcha      
					grecaptcha.execute(idCaptcha2);
					
				});
				
				
		/* ==================================================
     Agent Form Validations
     ================================================== */
				$('#agentcontactform').submit(function(event) {
					// отменим отправку форму на сервер
					event.preventDefault();
					// вызываем invisible reCaptcha      
					grecaptcha.execute(idCaptcha5);
					
				});
				
		/* ==================================================
     Consult Form Validations
     ================================================== */
				$('#consultForm').submit(function(event) {
					// отменим отправку форму на сервер
					event.preventDefault();
					// вызываем invisible reCaptcha      
					grecaptcha.execute(idCaptcha8);
					
				});
		
		/* ==================================================
     Your Price Form Validations
     ================================================== */
   
        /*$('.your-price-form').each(function () {
            var formInstance = $(this);
            formInstance.submit(function () {

                var action = $(this).attr('action');

                $("#ypf_message").slideUp(750, function () {
                    $('#ypf_message').hide();

                    $('.your-price-form #submit')
                        .after('<img src="' + $('#image_path').val() + 'images/assets/ajax-loader.gif" class="loader" />')
                        .attr('disabled', 'disabled');
					
                    $.post(action, {
                           name: $('.your-price-form #name').val(),
                           phone: $('.your-price-form #phone').val(),
                           price: $('.your-price-form #price').val(),
                            comments: $('.your-price-form #comments').val(),
                            //agent_email: $('#agent_email').val(),
                            pagelink: $('.your-price-form #pagelink').val(),
                            subject: $('.your-price-form #subject').val(),
                        },
                        function (data) {
							document.getElementById('ypf_message').innerHTML = data;
							$('#ypf_message').slideDown('slow');
                            $('.your-price-form img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
							$('.your-price-form #submit').removeAttr('disabled');
							if (data.match('success') != null) 
							{
								$('.your-price-form').slideUp('slow');
								try {
									yaCounter38924025.reachGoal("SEND-YOUR-PRICE");
									console.log("Reach goal SEND-YOUR-PRICE");
								}
								catch(e) {
									console.log("Error reach goal SEND-YOUR-PRICE");
								}
							}
							
                        }
                    );
                });
                return false;
            });
        });*/
				$('#yourpriceform').submit(function(event) {
					// отменим отправку форму на сервер
					event.preventDefault();
					// вызываем invisible reCaptcha      
					grecaptcha.execute(idCaptcha4);
					
				});
		
		
			/* ==================================================
     Na Prosmotr Form Validations
     ================================================== */
   
       /* $('.na-prosmotr-form').each(function () {
            var formInstance = $(this);
            formInstance.submit(function () {

                var action = $(this).attr('action');

                $("#npf_message").slideUp(750, function () {
                    $('#npf_message').hide();

                    $('.na-prosmotr-form #submit')
                        .after('<img src="' + $('#image_path').val() + 'images/assets/ajax-loader.gif" class="loader" />')
                        .attr('disabled', 'disabled');
					
                    $.post(action, {
                           name: $('.na-prosmotr-form #name').val(),
                           phone: $('.na-prosmotr-form #phone').val(),
                            comments: $('.na-prosmotr-form #comments').val(),
                            //agent_email: $('#agent_email').val(),
                            pagelink: $('.na-prosmotr-form #pagelink').val(),
                            subject: $('.na-prosmotr-form #subject').val(),
                        },
                        function (data) {
							document.getElementById('npf_message').innerHTML = data;
							$('#npf_message').slideDown('slow');
                            $('.na-prosmotr-form img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
							$('.na-prosmotr-form #submit').removeAttr('disabled');
							if (data.match('success') != null) 
							{
								$('.na-prosmotr-form').slideUp('slow');
								try {
									yaCounter38924025.reachGoal("SEND-NA-PROSMOTR");
									console.log("Reach goal SEND-NA-PROSMOTR");
								}
								catch(e) {
									console.log("Error reach goal SEND-NA-PROSMOTR");
								}
								
								if (location.pathname === '/zhk-lesnaya-melodiya-2') {
									try {
										yaCounter38924025.reachGoal("SEND-PROSMOTR-LM2");
										console.log("Reach goal SEND-PROSMOTR-LM2");
									}
									catch(e) {
										console.log("Error reach goal SEND-PROSMOTR-LM2");
									}
								}
								
								if (location.pathname === '/zhk-na-krasina-46') {
									try {
										yaCounter38924025.reachGoal("SEND-PROSMOTR-K46");
										console.log("Reach goal SEND-PROSMOTR-K46");
									}
									catch(e) {
										console.log("Error reach goal SEND-PROSMOTR-K46");
									}
								}
								
								if (location.pathname === '/novostroyka-na-bulvar-guseva-56') {
									try {
										yaCounter38924025.reachGoal("SEND-PROSMOTR-G56");
										console.log("Reach goal SEND-PROSMOTR-G56");
									}
									catch(e) {
										console.log("Error reach goal SEND-PROSMOTR-G56");
									}
								}
								
								if (location.pathname === '/zhk-novyiy-gorod') {
									try {
										yaCounter38924025.reachGoal("SEND-PROSMOTR-NG");
										console.log("Reach goal SEND-PROSMOTR-NG");
									}
									catch(e) {
										console.log("Error reach goal SEND-PROSMOTR-NG");
									}
								}
							}
							
                        }
                    );
                });
                return false;
            });
        });*/
				$('#naprosmotrform').submit(function(event) {
					// отменим отправку форму на сервер
					event.preventDefault();
					// вызываем invisible reCaptcha      
					grecaptcha.execute(idCaptcha6);
					
				});
				
	/* =================================================
     IPOTEKA Form Validations
     ================================================== */
   
        /*$('.ipotekaForm').each(function () {
            var formInstance = $(this);
            formInstance.submit(function () {

                var action = $(this).attr('action');

                $("#if_message").slideUp(750, function () {
                    $('#if_message').hide();

                    $('.ipotekaForm #submit')
                        .after('<img src="' + $('#image_path').val() + 'images/assets/ajax-loader.gif" class="loader" />')
                        .attr('disabled', 'disabled');
					
                    $.post(action, {
                            name: $('.ipotekaForm #name').val(),
                            phone: $('.ipotekaForm #phone').val(),
                            page: $('.ipotekaForm #ifPageUrl').val()
                        },
                        function (data) {
							document.getElementById('if_message').innerHTML = data;
							$('#if_message').slideDown('slow');
                            $('.ipotekaForm img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
							$('.ipotekaForm #submit').removeAttr('disabled');
							if (data.match('success') != null) 
							{
								$('.ipotekaForm').slideUp('slow');
								
								if (location.pathname === '/zhk-lesnaya-melodiya-2') {
									try {
										yaCounter38924025.reachGoal("SEND-IPOTEKA-LM2");
										console.log("Reach goal SEND-IPOTEKA-LM2");
									}
									catch(e) {
										console.log("Error reach goal SEND-IPOTEKA-LM2");
									}
								}
								
								if (location.pathname === '/zhk-na-krasina-46') {
									try {
										yaCounter38924025.reachGoal("SEND-IPOTEKA-K46");
										console.log("Reach goal SEND-IPOTEKA-K46");
									}
									catch(e) {
										console.log("Error reach goal SEND-IPOTEKA-K46");
									}
								}
								
								if (location.pathname === '/novostroyka-na-bulvar-guseva-56') {
									try {
										yaCounter38924025.reachGoal("SEND-IPOTEKA-G56");
										console.log("Reach goal SEND-IPOTEKA-G56");
									}
									catch(e) {
										console.log("Error reach goal SEND-IPOTEKA-G56");
									}
								}
								
								if (location.pathname === '/zhk-novyiy-gorod') {
									try {
										yaCounter38924025.reachGoal("SEND-IPOTEKA-NG");
										console.log("Reach goal SEND-IPOTEKA-NG");
									}
									catch(e) {
										console.log("Error reach goal SEND-IPOTEKA-NG");
									}
								}
							}
							
                        }
                    );
                });
                return false;
            });
        });*/
				
				$('#ipotekaform').submit(function(event) {
					// отменим отправку форму на сервер
					event.preventDefault();
					// вызываем invisible reCaptcha      
					grecaptcha.execute(idCaptcha7);
					
				});
		
		/* =================================================
     WANNA ASK Form Validations
     ================================================== */
   
        /*$('.wannaaskForm').each(function () {
            var formInstance = $(this);
            formInstance.submit(function () {

                var action = $(this).attr('action');

                $("#waf_message").slideUp(750, function () {
                    $('#waf_message').hide();

                    $('.wannaaskForm #submit')
                        .after('<img src="' + $('#image_path').val() + 'images/assets/ajax-loader.gif" class="loader" />')
                        .attr('disabled', 'disabled');
					
                    $.post(action, {
                            name: $('.wannaaskForm #name').val(),
                            phone: $('.wannaaskForm #phone').val(),
                            question: $('.wannaaskForm #wafQuestion').val(),
                            page: $('.wannaaskForm #wafPageUrl').val()
                        },
                        function (data) {
							document.getElementById('waf_message').innerHTML = data;
							$('#waf_message').slideDown('slow');
                            $('.wannaaskForm img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
							$('.wannaaskForm #submit').removeAttr('disabled');
							if (data.match('success') != null) 
							{
								$('.wannaaskForm').slideUp('slow');
								
								if (location.pathname === '/zhk-lesnaya-melodiya-2') {
									try {
										yaCounter38924025.reachGoal("SEND-WANNAASK-LM2");
										console.log("Reach goal SEND-WANNAASK-LM2");
									}
									catch(e) {
										console.log("Error reach goal SEND-WANNAASK-LM2");
									}
								}
								
								if (location.pathname === '/zhk-na-krasina-46') {
									try {
										yaCounter38924025.reachGoal("SEND-WANNAASK-K46");
										console.log("Reach goal SEND-WANNAASK-K46");
									}
									catch(e) {
										console.log("Error reach goal SEND-WANNAASK-K46");
									}
								}
								
								if (location.pathname === '/novostroyka-na-bulvar-guseva-56') {
									try {
										yaCounter38924025.reachGoal("SEND-WANNAASK-G56");
										console.log("Reach goal SEND-WANNAASK-G56");
									}
									catch(e) {
										console.log("Error reach goal SEND-WANNAASK-G56");
									}
								}
								
								if (location.pathname === '/zhk-novyiy-gorod') {
									try {
										yaCounter38924025.reachGoal("SEND-WANNAASK-NG");
										console.log("Reach goal SEND-WANNAASK-NG");
									}
									catch(e) {
										console.log("Error reach goal SEND-WANNAASK-NG");
									}
								}
							}
							
                        }
                    );
                });
                return false;
            });
        });*/
				$('#wannaaskform').submit(function(event) {
					// отменим отправку форму на сервер
					event.preventDefault();
					// вызываем invisible reCaptcha      
					grecaptcha.execute(idCaptcha3);
					
				});
				
				
				/* ==================================================
    presentation Form Validations
     ================================================== */
   
       /* $('.presentationform').each(function () {
            var formInstance = $(this);
            formInstance.submit(function () {

                var action = $(this).attr('action');

                $("#npf_message1").slideUp(750, function () {
                    $('#npf_message1').hide();

                    $('.presentationform #submit')
                        .after('<img src="' + $('#image_path').val() + 'images/assets/ajax-loader.gif" class="loader" />')
                        .attr('disabled', 'disabled');
					
                    $.post(action, {
                           phone: $('.presentationform #phone').val(),
                        },
                        function (data) {
													$('.presentationform').html("");
							document.getElementById('npf_message1').innerHTML = data;
							$('#npf_message1').slideDown('slow');
                            $('.presentationform img.loader').fadeOut('slow', function () {
                                $(this).remove()
                            });
							$('.presentationform #submit').removeAttr('disabled');
							setTimeout(function() {
								$("#presentationModal .inverted").click();
							}, 2000);
							
                        }
                    );
                });
                return false;
            });
        });*/
				$('#presentationform').submit(function(event) {
					// отменим отправку форму на сервер
					event.preventDefault();
					// вызываем invisible reCaptcha      
					grecaptcha.execute(idCaptcha1);
					
				});
				
	$(".lending-page p a[href='/katalog-novostroek']").click(function() {
		if (location.pathname === '/zhk-lesnaya-melodiya-2') {
			try {
				yaCounter38924025.reachGoal("CLICK-KATNOV-LM2");
				console.log("Reach goal CLICK-KATNOV-LM2");
			}
			catch(e) {
				console.log("Error reach goal CLICK-KATNOV-LM2");
			}
		}
		
		if (location.pathname === '/zhk-na-krasina-46') {
			try {
				yaCounter38924025.reachGoal("CLICK-KATNOV-K46");
				console.log("Reach goal CLICK-KATNOV-K46");
			}
			catch(e) {
				console.log("Error reach goal CLICK-KATNOV-K46");
			}
		}
		
		if (location.pathname === '/novostroyka-na-bulvar-guseva-56') {
			try {
				yaCounter38924025.reachGoal("CLICK-KATNOV-G56");
				console.log("Reach goal CLICK-KATNOV-G56");
			}
			catch(e) {
				console.log("Error reach goal CLICK-KATNOV-G56");
			}
		}
		
		if (location.pathname === '/zhk-novyiy-gorod') {
			try {
				yaCounter38924025.reachGoal("CLICK-KATNOV-NG");
				console.log("Reach goal CLICK-KATNOV-NG");
			}
			catch(e) {
				console.log("Error reach goal CLICK-KATNOV-NG");
			}
		}
	});
	
	
		$(".nav-lending #menu-main-menu li a").click(function() {
		if (location.pathname === '/zhk-lesnaya-melodiya-2') {
			try {
				yaCounter38924025.reachGoal("CLICK-NAV-LM2");
				console.log("Reach goal CLICK-NAV-LM2");
			}
			catch(e) {
				console.log("Error reach goal CLICK-NAV-LM2");
			}
		}
		
		if (location.pathname === '/zhk-na-krasina-46') {
			try {
				yaCounter38924025.reachGoal("CLICK-NAV-K46");
				console.log("Reach goal CLICK-NAV-K46");
			}
			catch(e) {
				console.log("Error reach goal CLICK-NAV-K46");
			}
		}
		
		if (location.pathname === '/novostroyka-na-bulvar-guseva-56') {
			try {
				yaCounter38924025.reachGoal("CLICK-NAV-G56");
				console.log("Reach goal CLICK-NAV-G56");
			}
			catch(e) {
				console.log("Error reach goal CLICK-NAV-G56");
			}
		}
		
		if (location.pathname === '/zhk-novyiy-gorod') {
			try {
				yaCounter38924025.reachGoal("CLICK-NAV-NG");
				console.log("Reach goal CLICK-NAV-NG");
			}
			catch(e) {
				console.log("Error reach goal CLICK-NAV-NG");
			}
		}
	});

	$(".agentPhoneHover").on("click", function(){
		$(this).hide();
		$(".agentPhone").show();
		try {
				yaCounter38924025.reachGoal("CLICK_AGENT_PHONE");
				console.log("Reach goal CLICK_AGENT_PHONE");
			}
			catch(e) {
				console.log("Error reach goal CLICK_AGENT_PHONE");
			}
		
	});
});
