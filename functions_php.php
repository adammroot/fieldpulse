<?php
//require "vendor/autoload.php";
//use GuzzleHttp\Client;
function divi_child_theme_setup() {
    if ( ! class_exists('ET_Builder_Module') ) {
        return;
    }

    get_template_part( 'includes/builder/module/Testimonial' );

    $cfwpm = new Custom_ET_Builder_Module_Testimonial();

    remove_shortcode( 'et_pb_testimonial' );
    
    add_shortcode( 'et_pb_testimonial', array($cfwpm, '_shortcode_callback') );
    
}

add_action( 'wp', 'divi_child_theme_setup', 9999 );
function include_font_awesome() {
    wp_enqueue_style( 'load-fa', 'https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css' );
    wp_enqueue_style( 'jquery-ui', '//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css' );
    wp_enqueue_script( 'jqueryui-slider', 'https://code.jquery.com/ui/1.12.1/jquery-ui.js', array('jquery') );
}
add_action( 'wp_enqueue_scripts', 'include_font_awesome' );

function enque_custom_scripts() {
    ?>
    <script>
    var utm_source = getParameterByName('utm_source'); 
    var utm_medium = getParameterByName('utm_medium'); 
    var utm_campaign = getParameterByName('utm_campaign'); 
    var utm_term = getParameterByName('utm_term');
    var utm_content = getParameterByName('utm_content');
    var gclid = getParameterByName('gclid');
    var ref = getParameterByName('ref');

    if (utm_source) {
    setCookie('fieldpulse_utm_source', utm_source, 14);
    }

    if (utm_medium) {
    setCookie('fieldpulse_utm_medium', utm_medium, 14);
    }

    if (utm_campaign) {
    setCookie('fieldpulse_utm_campaign', utm_campaign, 14);
    }

    if (utm_term) {
    setCookie('fieldpulse_utm_term', utm_term, 14);
    }

    if (utm_content) {
    setCookie('fieldpulse_utm_content', utm_content, 14);
    }

    if (gclid) {
    setCookie('fieldpulse_gclid', gclid, 14);
    }

    if (ref) {
    setCookie('ref', ref, 14);
    }

    var referer = getCookie('fieldpulse_referer');

    if(!referer && document.referrer && document.referrer.length) {
    setCookie('fieldpulse_referer', document.referrer, 14);
    }

    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays * 24 * 60 * 60 * 1000));
        var expires = "expires="+d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }

    function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
    }

    function getParameterByName(name, url) {
        if (!url) url = window.location.href;
        name = name.replace(/[\[\]]/g, "\\$&");
        var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
            results = regex.exec(url);
        if (!results) return null;
        if (!results[2]) return '';
        return decodeURIComponent(results[2].replace(/\+/g, " "));
    }
    </script>

	<script>

	var $jq = jQuery.noConflict();
	$jq(document).ready(function() {

		// 1. read url parameter
		// 2. set parameter value to message
		// 3. get last day of current month
		// 4. insert message and display notification
	var promoCode = getParameterByName('promo');
	if(promoCode && promoCode.length) {
		var div = document.createElement('div');
		$jq(div).addClass('notification');

		var date = new Date();
		var lastDay = new Date(date.getFullYear(), date.getMonth() + 1, 0);
		var dateFormated = getMonthName(lastDay.getMonth()) + ' ' + lastDay.getDate() + ', ' + lastDay.getFullYear();

		var html = `<p>Limited time offer! Get 30% off for 3 months by using promo code <b>${promoCode}</b> by ${dateFormated}</p><span class="promoClose"></span>`;
		$jq(div).html(html);
		$jq('body').append(div);

		}

		$jq('.notification .promoClose').click(function(e) {
			e.preventDefault();
			$jq(this).closest('.notification').css('display', 'none');
		})
	});


	function getParameterByName(name, url) {
		if (!url) url = window.location.href;
		name = name.replace(/[\[\]]/g, "\\$&");
		var regex = new RegExp("[?&]" + name + "(=([^&#]*)|&|#|$)"),
			results = regex.exec(url);
		if (!results) return null;
		if (!results[2]) return '';
		return decodeURIComponent(results[2].replace(/\+/g, " "));
	}

	function getMonthName(month) {
		var monthNames = ["January", "February", "March", "April", "May", "June",
		"July", "August", "September", "October", "November", "December"
		];
		return monthNames[month];
	}
	</script>
    
    <script type="text/javascript">
        jQuery( document ).ready(function() {
            var home_url = "<?php echo home_url(); ?>";
            jQuery( ".get-started-btn" ).on( "click", function() {
                var email = jQuery("#email").val();
                var company = jQuery("#company_name").val();
                var password = jQuery("#password").val();
                var rep_password = jQuery("#verify_password").val();
                var opt_redirect = '';
                if( jQuery("#opt_redirect").length ) {
                    opt_redirect = 'simplysend';
                }

                if( company == '' ) {
                    alert("You can not leave Company blank");
                } else if( email == '' ) {
                    alert("You can not leave Email blank");
                } else if( !validateEmail( email ) ) {
                    alert("Please enter a valid email address");
                } else if( password == '' ) {
                    alert("You can not leave Password blank");
                } else if( password.length < 4 ) {
                    alert("Password mush be at least 4 characters long");
                } else if( password != rep_password ) {
                    alert("Passwords don't match");
                } else {
                    var formArr = [];
                    formArr.push({
                        name: 'email',
                        value: email
                    });
                    formArr.push({
                        name: 'companyTitle',
                        value: company
                    });
                    //addContact(formArr);

					var lmref = null;
					try {
						lmref = lmFinished();
					}
					catch(err) {
						console.log(err.message);
                    }
					
                    jQuery.ajax({
                        type : "post",
                        dataType: "json",
                        url : et_pb_custom.ajaxurl,
                        data : {action : 'connect_fieldpl_api', email: email, company: company, password: password, isSimplySend: opt_redirect, link_mink_ref: lmref},
                        beforeSend: function() {
							jQuery(".get-started-btn i").removeClass("fa-check");
							jQuery(".get-started-btn i").addClass("fa-spinner fa-spin");
                        }, 
                        success: function(response) {
                            if(response.error == true) {
                                alert(response.details.email);
							    jQuery(".get-started-btn i").removeClass("fa-spinner fa-spin");
                                jQuery(".get-started-btn i").addClass("fa-check");
                            } else {
                                //alert(JSON.stringify(response));
                                //var sso_token_id = response.company._id;
                                var sso_token_id = response.sso_token_id;
                                var gs_id = response.company._id;
                                var gs_name = response.company.title;
                                var gs_email = response.user.email;
								console.log(response.user.email);
								try {
                                    growsumo.data.name = gs_name;
                                    growsumo.data.email = gs_email;
                                    growsumo.data.customer_key = gs_id;
                                    growsumo.createSignup(function(){
                                    console.log('create signup was called successfully');
                                    })
                                }
                                catch(err) {
                                  console.log(err.message);
                                }
                                //addContact(formArr);

                                // Redirect To Success Page
                                if(opt_redirect == 'simplysend') {
                                    window.location.href = home_url+"/registration/simply-send-success?sso_token_id=" + sso_token_id + "&gsid=" + gs_id + "&gsn=" + gs_name + "&gsem=" + gs_email + "&is_freemium=1";
                                } else {
                                    window.location.href = home_url+"/registration/success?sso_token_id=" + sso_token_id + "&gsid=" + gs_id + "&gsn=" + gs_name + "&gsem=" + gs_email + "&is_freemium=0";
                                }
                            }
                        }
                    });
                }
            });
            jQuery( ".button-free-trial" ).on( "click", function() {
                var popid = jQuery(this).attr("data-num");
                var email = jQuery("input[name=email"+popid+"]").val();
                var company = jQuery("input[name=comapany"+popid+"]").val();
                if( email == '' ) {
                    alert("You can not leave Email blank");
                } else if( !validateEmail( email ) ) {
                    alert("Please enter a valid email address");
                } else if( company == '' ) {
                    alert("You can not leave Company blank");
                } else {
                    jQuery("#email"+popid+"-wrap").html(email);
                    jQuery(this).next(".fancybox-inline").click();
                }
            });
            jQuery( ".get-started-trial" ).on( "click", function() {
                var popid = jQuery(this).attr("data-num");
                var email = jQuery("input[name=email"+popid+"]").val();
                var company = jQuery("input[name=comapany"+popid+"]").val();
                var password = jQuery("input[name=password"+popid+"]").val();
                var rep_password = jQuery("input[name=verify_password"+popid+"]").val();

                //https://www.fieldpulse.com/registration/success?sso_token_id=5c5ee262989f7e1606513c0d&gsid=5c5ee260989f7e1606513c05&gsn=htghfgfdsg&gsem=fdgdfgfgf@ymail.com

                if( company == '' ) {
                    alert("You can not leave Company blank");
                } else if( email == '' ) {
                    alert("You can not leave Email blank");
                } else if( !validateEmail( email ) ) {
                    alert("Please enter a valid email address");
                } else if( password == '' ) {
                    alert("You can not leave Password blank");
                } else if( password.length < 4 ) {
                    alert("Password mush be at least 4 characters long");
                } else if( password != rep_password ) {
                    alert("Passwords don't match");
                } else {
					var lmref = null;
					try {
						lmref = lmFinished();
					}
					catch(err) {
						console.log(err.message);
                    }
					
                    jQuery.ajax({
                        type : "post",
                        dataType: "json",
                        url : et_pb_custom.ajaxurl,
                        data : {action : 'connect_fieldpl_api', email: email, company: company, password: password, link_mink_ref: lmref},
                        beforeSend: function() {
							jQuery(".get-started-trial[data-num="+popid+"] i").removeClass("fa-check");
							jQuery(".get-started-trial[data-num="+popid+"] i").addClass("fa-spinner fa-spin");
                        },
                        success: function(response) {
                            if(response.error == true) {
                                alert(response.details.email);
							    jQuery(".get-started-trial[data-num="+popid+"] i").removeClass("fa-spinner fa-spin");
                                jQuery(".get-started-trial[data-num="+popid+"] i").addClass("fa-check");
                            } else {
                                //var sso_token_id = response.company._id;
                                var sso_token_id = response.sso_token_id;
                                var gs_id = response.company._id;
                                var gs_name = response.company.title;
                                var gs_email = response.user.email;
								console.log(response.user.email);
								
								try {
                                    growsumo.data.name = gs_name;
                                    growsumo.data.email = gs_email;
                                    growsumo.data.customer_key = gs_id;
                                    growsumo.createSignup(function(){
                                    console.log('create signup was called successfully')
                                })
                                }
                                catch(err) {
                                  console.log(err.message);
                                }

                                // Redirect To Success Page
                                window.location.href = home_url+"/registration/success?sso_token_id=" + sso_token_id + "&gsid=" + gs_id + "&gsn=" + gs_name + "&gsem=" + gs_email;
                            }
                        }
                    });
                }
            });
            jQuery( ".trial-start-btn" ).on( "click", function() {
                var company = jQuery("#company_name").val();
                var first_name = jQuery("#first_name").val();
                var last_name = jQuery("#last_name").val();
                var company = jQuery("#company_name").val();
                var email = jQuery("#email").val();
                var password = jQuery("#password").val();
                var rep_password = jQuery("#verify_password").val();

                //https://www.fieldpulse.com/registration/success?sso_token_id=5c5ee262989f7e1606513c0d&gsid=5c5ee260989f7e1606513c05&gsn=htghfgfdsg&gsem=fdgdfgfgf@ymail.com

                if( company == '' ) {
                    alert("You can not leave Company blank");
                } else if( first_name == '' ) {
                    alert("You can not leave first name blank");
                } else if( last_name == '' ) {
                    alert("You can not leave last name blank");
                } else if( email == '' ) {
                    alert("You can not leave Email blank");
                } else if( !validateEmail( email ) ) {
                    alert("Please enter a valid email address");
                } else if( password == '' ) {
                    alert("You can not leave Password blank");
                } else if( password.length < 4 ) {
                    alert("Password mush be at least 4 characters long");
                } else if( password != rep_password ) {
                    alert("Passwords don't match");
                } else {
					
					var lmref = null;
					try {
						lmref = lmFinished();
					}
					catch(err) {
						console.log(err.message);
                    }
					
                    jQuery.ajax({
                        type : "post",
                        dataType: "json",
                        url : et_pb_custom.ajaxurl,
                        data : {action : 'connect_fieldpl_api', email: email, company: company, first_name: first_name, last_name: last_name, password: password, link_mink_ref: lmref},
                        beforeSend: function() {
							jQuery(".trial-start-btn i").remove();
							jQuery(".trial-start-btn").append(' <i class="fa fa-spinner fa-spin" aria-hidden="true"></i>');
                        }, 
                        success: function(response) {
                            if(response.error == true) {
                                alert(response.details.email);
							    jQuery(".trial-start-btn i").remove();
                                jQuery(".trial-start-btn").append(' <i class="fa fa-check" aria-hidden="true"></i>');
                            } else {
                                //var sso_token_id = response.company._id;
                                var sso_token_id = response.sso_token_id;
                                var gs_id = response.company._id;
                                var gs_name = response.company.title;
                                var gs_email = response.user.email;
								console.log(response.user.email);

								try {
                                    growsumo.data.name = gs_name;
                                    growsumo.data.email = gs_email;
                                    growsumo.data.customer_key = gs_id;
                                    growsumo.createSignup(function(){
                                    console.log('create signup was called successfully');
                                    })
                                }
                                catch(err) {
                                  console.log(err.message);
                                }
								
                                // Redirect To Success Page
                                window.location.href = home_url+"/registration/success?sso_token_id=" + sso_token_id + "&gsid=" + gs_id + "&gsn=" + gs_name + "&gsem=" + gs_email;
                            }
                        }
                    });
                }
            });
            function validateEmail( email ) {
                var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
                return emailReg.test( email );
            }

            var mHandle = jQuery( "#managers-handle" );
            var initPrice = 39;            
            jQuery( "#managers-slider" ).slider({
                range: "max",
                min: 0,
                max: 11,
                value: 1,
                create: function() {
                    mHandle.html( '<span>'+jQuery( this ).slider( "value" )+'</span>' );
                },
                slide: function( event, ui ) {
                    if(ui.value < 1){
                        return false;
                    }
                    if(ui.value > 10) {
                        mHandle.html( '<span>10+</span>' );
                    } else {
                        mHandle.html( '<span>'+ui.value+'</span>' );
                    }
                    var managersArr = [0,39,59,79,99,119,139,159,179,199,219];
                    var agentsArr = [0,10,20,30,40,50,60,70,80,90,100,110,120,130,140,150,160,170,180,190,200,210,220,230,240,250,260];
                    var agentsVal = parseInt(jQuery("#agents-handle span").text());
                    jQuery( ".calc-amount span" ).text(managersArr[ui.value]+agentsArr[agentsVal]);
                    var calcAmount = parseInt(jQuery( ".calc-amount span" ).text());
                    if( calcAmount > 249 ) {
                        jQuery( ".calc-amount" ).hide();
                        jQuery( "#managers-info" ).hide();
                        jQuery( "#agents-info" ).hide();
                        jQuery(".contact-msg").show();
                    } else if(ui.value > 10) {
                        jQuery( ".calc-amount" ).hide();
                        jQuery( "#managers-info" ).hide();
                        jQuery( "#agents-info" ).hide();
                        jQuery(".contact-msg").show();
                    } else {
                        jQuery( ".calc-amount" ).show();
                        jQuery( "#managers-info" ).show();
                        jQuery( "#agents-info" ).show();
                        jQuery(".contact-msg").hide();
                    }
                    jQuery( "#managers-info span" ).text(managersArr[ui.value]);
                },
                change: function( event, ui ) {
                    // run on change script
                    // if(ui.value > 10) {
                    //     jQuery("#managers-handle span").text("10+");
                    // }
                }
            });

            var aHandle = jQuery( "#agents-handle" );
            jQuery( "#agents-slider" ).slider({
                range: "max",
                min: 0,
                max: 26,
                value: 0,
                create: function() {
                    aHandle.html( '<span>'+jQuery( this ).slider( "value" )+'</span>' );
                },
                slide: function( event, ui ) {
                    if(ui.value > 25) {
                        aHandle.html( '<span>25+</span>' );
                    } else {
                        aHandle.html( '<span>'+ui.value+'</span>' );
                    }
                    var managersArr = [0,39,59,79,99,119,139,159,179,199,219];
                    var agentsArr = [0,10,20,30,40,50,60,70,80,90,100,110,120,130,140,150,160,170,180,190,200,210,220,230,240,250,260];
                    var managersVal = parseInt(jQuery("#managers-handle span").text());
                    jQuery( ".calc-amount span" ).text(managersArr[managersVal]+agentsArr[ui.value]);
                    var calcAmount = parseInt(jQuery( ".calc-amount span" ).text());
                    if( calcAmount > 249 ) {
                        jQuery( ".calc-amount" ).hide();
                        jQuery( "#managers-info" ).hide();
                        jQuery( "#agents-info" ).hide();
                        jQuery(".contact-msg").show();
                    } else if(ui.value > 21) {
                        jQuery( ".calc-amount" ).hide();
                        jQuery( "#managers-info" ).hide();
                        jQuery( "#agents-info" ).hide();
                        jQuery(".contact-msg").show();
                    } else {
                        jQuery( ".calc-amount" ).show();
                        jQuery( "#managers-info" ).show();
                        jQuery( "#agents-info" ).show();
                        jQuery(".contact-msg").hide();
                    }
                    jQuery( "#agents-info span" ).text(agentsArr[ui.value]);
                },
                change: function( event, ui ) {
                    // run on change script
                    // if(ui.value > 25) {
                    //     jQuery("#agents-handle span").text("25+");
                    // }
                }
            });
			
			var screenHeight = jQuery(window).height();
			if(screenHeight > 900) {
				/*jQuery("#home-hero").css("min-height", screenHeight+"px");
				jQuery("#home-hero").css("padding-top", "14%");*/
				jQuery("#home-hero").css("height", "100vh");
			}

            function addContact(currentForm) {
            // return;

            var serializedArr = jQuery(currentForm).serializeArray();
            /*var utmArr = makeUtmArr();
            var data = utmArr.concat(serializedArr);*/

            var actionArr = [];
            actionArr.push({
                name: 'action',
                value: 'fieldpl_active_campaign_api'
            });
            var data_new = actionArr.concat(serializedArr);

            jQuery.ajaxSetup({
            headers: { 'X-CSRF-Token' : '{!! e1846beb0ef64af2e45019ff7d64cd40 !!}' }
            });
            jQuery.ajax({
                type: "POST",
                //url: "{{ url() }}/add-active-campaign",
                url: et_pb_custom.ajaxurl,
                //data: data,
                data: data_new,
                dataType: 'json',
                error: function (data) {
                console.log("Error: "+JSON.stringify(data));
                },
                success: function (data) {
                    console.log("Success: "+JSON.stringify(data));
                }
            }); // End AJAX
            //alert(JSON.stringify(data_new));
            }

            function makeUtmArr() {
            var utm_source = getCookie('fieldpulse_utm_source');
            var utm_medium = getCookie('fieldpulse_utm_medium');
            var utm_campaign = getCookie('fieldpulse_utm_campaign');
            var utm_term = getCookie('fieldpulse_utm_term');
            var utm_content = getCookie('fieldpulse_utm_content');
            var gclid = getCookie('fieldpulse_gclid');
            var referer = getCookie('fieldpulse_referer');

            var utmArr = [];

            utmArr.push({
                name: 'utm_source',
                value: utm_source
            });

            utmArr.push({
                name: 'utm_medium',
                value: utm_medium
            });

            utmArr.push({
                name: 'utm_campaign',
                value: utm_campaign
            });

            utmArr.push({
                name: 'utm_term',
                value: utm_term
            });

            utmArr.push({
                name: 'utm_content',
                value: utm_content
            });

            utmArr.push({
                name: 'gclid',
                value: gclid
            });

            utmArr.push({ 
                name: 'referer',
                value: referer
            });

            var isSimplySend =  window.location.href.includes("simplysend") ? 1 : 0;

            utmArr.push({ 
                name: 'is_freemium',
                value: isSimplySend
            });

            return utmArr;


            }

            /*function getCookie(cname) {
            var name = cname + "=";
            var decodedCookie = decodeURIComponent(document.cookie);
            var ca = decodedCookie.split(';');
            for(var i = 0; i <ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') {
                    c = c.substring(1);
                }
                if (c.indexOf(name) == 0) {
                    return c.substring(name.length, c.length);
                }
            }
            return "";
            }*/
        });
    </script>
    <style type="text/css">
        .get-started-btn, .get-started-trial { cursor: pointer; background: #5BBD72; color: #ffffff; padding: 10px; display: inline-block; }

        @media screen and (min-width:2500px) {
            #home-title { max-width: 700px; margin: 250px 0 0 75px; }
        }
    </style>
    <?php
}
add_action("wp_head", "enque_custom_scripts");

add_action("wp_ajax_connect_fieldpl_api", "connect_fieldpl_api");
add_action("wp_ajax_nopriv_connect_fieldpl_api", "connect_fieldpl_api");
function connect_fieldpl_api() {
    //$post_url = "https://sandbox.fieldpulse.com/registration-handler";
    $body = array(
        "email" => trim($_POST["email"]),
        "companyTitle" => trim($_POST["company"]),
        "password" => trim($_POST["password"])
        );    
    if( isset($_POST['first_name']) ) {
        $body["firstName"] = trim($_POST["first_name"]);
    }
    if( isset($_POST['last_name']) ) {
        $body["lastName"] = trim($_POST["last_name"]);
    }
    if( isset($_POST['isSimplySend']) && $_POST['isSimplySend'] == "simplysend" ) {
		$body["is_freemium"] = "true";
    }
	if( isset($_POST['link_mink_ref'])) {
        $body["link_mink_ref"] = $_POST['link_mink_ref'];
    }

    $data = json_encode( $body );
    //$args = array( 'headers' => array( 'Content-Type' => 'application/json' ), 'body' => $data );
    //$response = wp_remote_post( esc_url_raw( $post_url ), $args );
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => "https://sandbox.fieldpulse.com/registration-handler",
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 30,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => "POST",
      CURLOPT_POSTFIELDS => $data,
      CURLOPT_HTTPHEADER => array(
        "Content-Type: application/json",
        "cache-control: no-cache"
      ),
    ));
    
    $response = curl_exec($curl);
    //$err = curl_error($curl);
    
    curl_close($curl);
	$response = str_replace("CompanyManagers","",$response);
    echo $response;
	exit;
}


//add_action("wp_ajax_fieldpl_active_campaign_api", "fieldpl_active_campaign_api");
//add_action("wp_ajax_nopriv_fieldpl_active_campaign_api", "fieldpl_active_campaign_api");
function fieldpl_active_campaign_api() {
    //$data = $_POST["api_data"];

    if(isset($_GET['is_freemium']) && $_GET['is_freemium'] == "1") {
        $listID = 8;
    } else {
        $listID = 2;
    }

      // echo $listID;

      /*$client = new Client();
      $res = $client->request('POST', 'https://fieldpulse52859.api-us1.com/admin/api.php?api_action=contact_add', [
            'form_params' => [
                'api_key' => '16a6d27f2a60e25716e14ea6e8a06caec8c980652ef05340838b6a6c626691f9f5c35834',
                'actid' => '649256415',
                'api_action' => 'contact_add',
                'api_output' => 'json',
                'email' => $_POST['email'],
                'orgname' => $_POST['companyTitle'],

                // UTM Params
                'field[%UTMSOURCE%, 0]' => $_POST['utm_source'],
                'field[%UTMMEDIUM%, 0]' => $_POST['utm_medium'],
                'field[%UTMCAMPAIGN%, 0]' => $_POST['utm_campaign'],
                'field[%UTMTERM%, 0]' => $_POST['utm_term'],
                'field[%UTMCONTENT%, 0]' => $_POST['utm_content'],
                'field[%GCLID%, 0]' => $_POST['gclid'],
                'field[%REFERER%, 0]' => $_POST['referer'],

                'p[123]' => $listID,
                'field[%REFERRAL_PAGE%, 0]' => $_SERVER['HTTP_REFERER']
            ]
      ]);

      echo $res->getBody();*/
      echo $_POST['email'];
      exit;
}

function get_token_shortcode() {
    ob_start();
	$content = '';
    if(isset($_GET['sso_token_id']) && $_GET['sso_token_id'] != "") {
		$content .='<div class="success_wrap">';
        $content .='<h1>Success!</h1>';
        $heading = 'Get started now by logging into the FieldPulse WebApp';
        $launchText = 'Launch FieldPulse WebApp';
        $launchLink = 'https://webapp.fieldpulse.com';
        $appleLink = 'https://itunes.apple.com/us/app/fieldpulse/id1100839834';
        $googleLink = 'https://play.google.com/store/apps/details?id=com.flicent.fieldpulse&hl=en';
        if( is_page('simply-send-success') ) {
            $heading = 'Get started now by logging into the SimplySend WebApp';
            $launchText = 'Launch SimplySend WebApp';
            $launchLink = 'https://simplysend.fieldpulse.com';
            $appleLink = 'https://itunes.apple.com/us/app/simplysend-estimates-invoices/id1438355977?ls=1&mt=8';
            $googleLink = 'https://play.google.com/store/apps/details?id=com.flicent.simplysend&hl=en';
            }
        $content .='<h2 style="font-family:lato">'.$heading.'</h2>';
        if( ! is_page('simply-send-success') ) {
            $content .="<p>If you'd like help in getting your account setup, or if you'd like a one-on-one walk-through of FieldPulse with a member of our customer success team,
            <a href='https://calendly.com/greg-116/15min?back=1'>click here</a> to schedule a time.</p>";
        }
		$content .='<p class="emailaddress"><strong>Your email:</strong> '.$_GET['gsem'].'</p>';
		$content .='<p class="companyname"><strong>Your company name:</strong> '.$_GET['gsn'].'</p>';
		$content .='<a href="'.$launchLink.'/auth/login?sso_token_id='.$_GET['sso_token_id'].'" class="btn_webapp">'.$launchText.'</a>';
		$content .='<div class="horizontal divider"><span>OR</span></div>';
		$content .='<h3>Download the mobile app for Android or iOS</h3>';
		$content .='<div class="appstore_wrap"><a class="playstor" href="'.$appleLink.'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/images/appstore.jpg"/></a> <a class="appstore" href="'.$googleLink.'" target="_blank"><img src="'.get_stylesheet_directory_uri().'/images/playstore.jpg"/></a></div>';
		$content .='</div><!--success_wrap-->';
        //echo $_GET['sso_token_id'];

        $listID = 2;
        if(isset($_GET['is_freemium']) && $_GET['is_freemium'] == "1") {
        //if(isset($_GET['is_freemium']) && $_GET['is_freemium'] == "simplysend") {
            $listID = 8;
        }
		//echo $listID;

        $curl = curl_init();
        /*$fields = array(
            'api_key' => '16a6d27f2a60e25716e14ea6e8a06caec8c980652ef05340838b6a6c626691f9f5c35834',
            'actid' => '649256415',
            'api_action' => 'contact_add',
            'api_output' => 'json',
            'email' => $_GET['gsem'],
            'orgname' => $_GET['gsn'],

            // UTM Params
            'field[%UTMSOURCE%, 0]' => $_COOKIE['fieldpulse_utm_source'],
            'field[%UTMMEDIUM%, 0]' => $_COOKIE['fieldpulse_utm_medium'],
            'field[%UTMCAMPAIGN%, 0]' => $_COOKIE['fieldpulse_utm_campaign'],
            'field[%UTMTERM%, 0]' => $_COOKIE['fieldpulse_utm_term'],
            'field[%UTMCONTENT%, 0]' => $_COOKIE['fieldpulse_utm_content'],
            'field[%GCLID%, 0]' => $_COOKIE['fieldpulse_gclid'],
            'field[%REFERER%, 0]' => $_COOKIE['fieldpulse_referer'],

            'p[123]' => $listID,
            'field[%REFERRAL_PAGE%, 0]' => $_SERVER['HTTP_REFERER']
        );
        CURLOPT_POSTFIELDS => http_build_query($fields),*/

        curl_setopt_array($curl, array(
          CURLOPT_URL => "https://fieldpulse52859.api-us1.com/admin/api.php?api_action=contact_add",
          CURLOPT_RETURNTRANSFER => true,
          CURLOPT_ENCODING => "",
          CURLOPT_MAXREDIRS => 10,
          CURLOPT_TIMEOUT => 30,
          CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
          CURLOPT_CUSTOMREQUEST => "POST",
          CURLOPT_POSTFIELDS => "api_key=16a6d27f2a60e25716e14ea6e8a06caec8c980652ef05340838b6a6c626691f9f5c35834&actid=649256415&api_action=contact_add&api_output=json&email=".$_GET['gsem']."&orgname=".$_GET['gsn']."&p%5B123%5D=".$listID."&field%5B%25UTMSOURCE%25%2C%200%5D=".$_COOKIE['fieldpulse_utm_source']."&field%5B%25UTMMEDIUM%25%2C%200%5D=".$_COOKIE['fieldpulse_utm_medium']."&field%5B%25UTMCAMPAIGN%25%2C%200%5D=".$_COOKIE['fieldpulse_utm_campaign']."&field%5B%25UTMTERM%25%2C%200%5D=".$_COOKIE['fieldpulse_utm_term']."&field%5B%25UTMCONTENT%25%2C%200%5D=".$_COOKIE['fieldpulse_utm_content']."&field%5B%25GCLID%25%2C%200%5D=".$_COOKIE['fieldpulse_gclid']."&field%5B%25REFERER%25%2C%200%5D=".$_COOKIE['fieldpulse_referer']."&field%5B%25REFERRAL_PAGE%25%2C%200%5D=".$_SERVER['HTTP_REFERER'],
          CURLOPT_HTTPHEADER => array(
            "Content-Type: application/x-www-form-urlencoded",
            "cache-control: no-cache"
          ),
        ));
        
        $response = curl_exec($curl);
        $err = curl_error($curl);
        
        curl_close($curl);
        
        if ($err) {
          //echo "cURL Error #:" . $err;
        } else {
          //echo $response;
        }
    }
    $content .= ob_get_clean();
    return $content;
}
add_shortcode("get_token", "get_token_shortcode");

function get_pricing_slider_shortcode() {
    ob_start();
?>
    <div class="price-sliders">
        <p class="calc-amount">$ <span>39</span> per month</p>
        <p class="contact-msg" style="display:none;">Contact Us</p>
        <div class="slider-wrap clearfix">
            <div class="slider-label">Number of Managers</div>
            <div id="managers-slider">
                <div id="managers-handle" class="ui-slider-handle custom-swiper"></div>
            </div>
            <div class="price-info">
                <div id="managers-info">$ <span>39</span></div>
                <p class="contact-msg" style="display:none;">Contact Us</p>
            </div>
        </div>
        <div class="slider-wrap clearfix">
            <div class="slider-label">Number of Service Agents</div>
            <div id="agents-slider">
                <div id="agents-handle" class="ui-slider-handle custom-swiper"></div>
            </div>
            <div class="price-info">
                <div id="agents-info">$ <span>0</span></div>
                <p class="contact-msg" style="display:none;">Contact Us</p>
            </div>
        </div>
    </div>
<?php
    $content .= ob_get_clean();
    return $content;
}
add_shortcode("get_pricing_slider", "get_pricing_slider_shortcode");

function get_register_form_shortcode() {
    ob_start();
    ?>
    <div id="start-trial" class="full-register-form">
        <div class="form_header">
            <h1>You're 1 step away!</h1>
        </div>
        <div class="form_wrap clearfix">
            <div class="field-full">
                <label for="company_name">Company Name</label>
                <input type="text" name="company_name" id="company_name" autocomplete="off" />
            </div>
            <div class="one_half">
                <label for="first_name">First Name</label>
                <input type="text" name="first_name" id="first_name" autocomplete="off" />
            </div>
            <div class="one_half et_column_last">
                <label for="last_name">Last Name</label>
                <input type="text" name="last_name" id="last_name" autocomplete="off" />
            </div>
            <div class="clearfix"></div>
            <div>
                <label for="email">Email</label>
                <input type="text" name="email" id="email" autocomplete="off" />
            </div>
            <div class="clearfix"></div>
            <div class="one_half field_pass">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" />
                <i class="fa fa-lock" aria-hidden="true"></i>
            </div>
            <div class="one_half et_column_last field_pass">
                <label for="verify_password">Repeat Password</label>
                <input type="password" name="verify_password" id="verify_password" />
                <i class="fa fa-lock" aria-hidden="true"></i>
            </div>
            <div class="clearfix"></div>
        </div>
        <div class="reg-button">
            <div class="form_wrap"><span class="trial-start-btn">Start My Free Trial Now</span></div>
        </div>
    </div>
    <?php
    $content = ob_get_clean();
    return $content;
}
add_shortcode("get_register_form", "get_register_form_shortcode");

function add_file_types_to_uploads($file_types){
$new_filetypes = array();
$new_filetypes['svg'] = 'image/svg+xml';
$file_types = array_merge($file_types, $new_filetypes );
return $file_types;
}
add_action('upload_mimes', 'add_file_types_to_uploads');

add_action( 'wp_enqueue_scripts', 'tthq_add_custom_fa_css' );

function tthq_add_custom_fa_css() {
wp_enqueue_style( 'custom-fa', 'https://use.fontawesome.com/releases/v5.0.6/css/all.css' );
}


add_filter( 'wpseo_sitemap_index', 'add_sitemap_custom_items' );
function add_sitemap_custom_items() {
	$todayDate = date("Y-m-d H:i:s");
	$sitemap_custom_items = '
<sitemap>
<loc>https://www.fieldpulse.com/academy/sitemap_index.xml</loc>
<lastmod>' . $todayDate . ' +01:00</lastmod>
</sitemap>';
/* DO NOT REMOVE ANYTHING BELOW THIS LINE
 * Send the information to Yoast SEO
 */
return $sitemap_custom_items;
}

?>