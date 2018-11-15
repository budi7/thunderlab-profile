/*
	=====================================================================
	FormValidation
	=====================================================================
	Version		: 0.2.1
	Author 		: Budi
	Requirement : jQuery, bootstrap

	Notes
	1. reference input label
		- make sure to have label beside input
		- use 'for' attribute inside label tag and set with input id
	2. error msg styling
		- this plugin rely on bootstrap policy, you need wrapp your 
			input with form-group div class
		- also, you need to add 'control-label' class to your input label
		- and also you need 'form-control' class into your input
*/


window.formValidation = new function () {


	/* --------------------------
	Setting & Parameter 
	-------------------------- */

	/* behavior */
	/*
		1. Continue Validating On Error
		Description 	: set false if you want validation breaks on first fail
		Note 			: Validation order follows your html validation rules 
							(param inside 'thunder-validation-rules' *by default )
	*/	
	const continue_validating_on_error = false;

	/*
		2. Validate on lost focus
		Description 	: set false if you dont want validate input on input's lost focus event
	*/	
	const validate_on_lost_focus = false;

	/*
		3. Validate on disabled
		Description 	: continue validate on disabled
	*/	
	const validate_on_disabled = true;

	/*
		4. Validate on hidden
		Description 	: continue validate on disabled
	*/	
	const validate_on_hidden = true;		


	/* overrides core settings */

	/*
		1. Target Input Class Name
		Description 	: input html class selector that will be validated on lost focus.
	*/
	const target_input_class = 'thunder-validation-input';

	/*
		2. Target Form Class Name
		Description 	: form html class selector that will be validated on submit.
	*/
	const target_form_class = 'thunder-validation-form';	

	/*
		3. Target Attribute Name
		Description 	: Attribute name for defining rules.
	*/
	const target_attr_name = 'thunder-validation-rules';

	/*
		4. Error Messages
		Description 	: List of error messages
		Note 			: 	-. use &label& markup to use current input label
							-. use &parameter& markup to use parameter, ie: on validate min/max (ie: validation min=2, parameter = 2)

	*/
	const error_message = {
		"required" : "&label& can't be empty",
		"email" : "Not a valid email address",
		"number" : "Must be number",
		'numbermin' : "Tidak boleh kurang dari &parameter&",
		'numbermax' : "Tidak boleh lebih dari &parameter&",
		"string" : "Harus berupa huruf",
		'minLength' : "Can't be less than &parameter& characters",
		'maxLength' : "Can't be more than &parameter& characters",
		'password' : "Password harus 8-20 karakter dan terdiri dari 3 hal berikut: huruf besar, huruf kecil, angka",
		'minCurrency' : "Not a valid value",
		'maxCurrency' : "Not a valid valu",
	};

	/*
		5. Ui Validate Success
		Description 	: Need to display success style after validation return true?
		Note 			: use bool true/false, false will reset form style to its 
							original styling after validation return true
	*/
	const ui_validate_success = false;

	/*
		6. Target Custom Error Message Attribute 
		Description 	: Selector used to retrieve custom error msg from html, rather than this default error msg.
	*/
	const target_custom_error_message_attribute = 'thunder-validation-custom-message';

	/*
		7. Validate On Submit
		Description 	: Selector used to determine validate on submit or not
	*/
	const target_validate_on_submit_attribute = 'thunder-validation-submitvalidation';

	/*
		8. Target No Message Attribute 
		Description 	: Selector used to define no message label
	*/
	const target_no_msg_attribute = 'thunder-validation-no-message';

	/*
		8. Ui Caption
		Description 	: Prefix caption for error msg label
	*/
	const ui_caption = "";

	/*
		9. error using feedback bs
		Description 	: set true if u want add some fancy icons inside input
	*/	
	const error_using_feedback = false;	


	/* bootstrap classes */
	// you need change this part, based on bootstrap class rules

	/*
		1. Class has feedback
		Description 	: using class form has feedback name
	*/
	const bs_feedback 	 = 'has-feedback';

	/*
		2. Class input error
		Description 	: using class error name
	*/
	const bs_danger 	 = 'has-error';

	/*
		3. Class input success
		Description 	: using class success name
	*/
	const bs_success 	 = 'has-success';

    /*
        4. Class input warning
        Description 	: using class warning name
    */
	const bs_warning    = 'has-warning';
	
	/*
		5. Selector Form Group
		Description 	: using bs form group. used as selector. Use '.'' for class or '#'' for id
	*/
	const bs_form_group	 = '.form-group';

	/*
		6. Error Message Css Class
		Description 	: list of css style class that used to decorate error message
		Note 			: you can use default bootstrap class like: text-danger
	*/
	const bs_error_message_css_class = 'text-danger'	

    /*
		7. Warning Message Css Class
		Description 	: list of css style class that used to decorate error message
		Note 			: you can use default bootstrap class like: text-warning
	*/
	const bs_warning_message_css_class = 'text-warning'	


	/* --------------------------
	Core Engine
	-------------------------- */

	/* Interface Functions */

	// initialize
	this.init = function() {
		// validate inputs on form submit
		$(document).on( "submit", document.getElementsByClassName(target_form_class), function(e) {
			if($(e.target).attr(target_validate_on_submit_attribute) && $(e.target).attr(target_validate_on_submit_attribute) != false){
				e.preventDefault();

				// validate, if everything good, continue posting
				if(validateForm($(e.target)) == true){
					// post form
					e.target.submit();
				}
			}
		});

		// validate input on lost focus event
		if(validate_on_lost_focus == true){
			$( document ).on( "blur", "." + target_input_class, function(e) {
				// fix jQuery Blur and Submit propagation issue: blur firstly fire rather than submit 
				if(!e.relatedTarget || e.relatedTarget.type != "submit"){
					validateInput($(e.target));
				}
			});
		}

		return true;
	}
	this.validateInput = function(el){
		return validateInput(el);
	}
	this.validateForm = function(el){
	    // el will be the form target
		return validateForm(el);
	}

	/* backend functions */

	// UI input validation
	var validateInput = function(el) {
		var result = true; 

		/* fuse */
		// if requirement satisfied
		if(el.closest( bs_form_group ).length <= 0){
			console.log("%cWarning: formValidation" + "\n" + "on: validateInput" + "\n" + "detail: Can't validate because 'form-group' class that should wrapp this following input not found (Validation rules will be ignored)" + "\n" + "input id : " + el.attr('id'), 'color: orange;');
			return true;
		}

		// handling disabled
		if(validate_on_disabled == false){
			if(el.prop('disabled') == true){
				return true;
			}
		}

		// handling hidden
		if (validate_on_hidden == false) {
		    // if(el.css('display') == 'none' || el.attr('type') == 'hidden' || el.closest('.form-group').css('display') == 'none' || el.closest('.form-group').attr('type') == 'hidden'){
			if(el.attr('type') == 'hidden' || el.closest('.form-group').css('display') == 'none' || el.closest('.form-group').attr('type') == 'hidden'){
				return true;
			}
		}		

		var err_msg = [];

		// get rules from element
		var rules = el.attr(target_attr_name).split(" ");

		// iterate rules
		rules.every(function(rule, index, _ary) {

			// is rule has parameter
			var epos = rule.search("=");
			var rule_parameter = null;
			if (epos >= 0)
			{
				rule_parameter = rule.substr(epos + 1);
				rule = rule.substring(0, epos);
			}

			// interpret rules & check for status error
			if(ruleInterpreter(el, rule, rule_parameter) == false){
				// on validation fail
				if(error_message[rule]){
					tmp_msg=error_message[rule];
					// is it parameter inside? replace if yes
					if(rule_parameter){
						if(isMarkedUp(error_message[rule], '&parameter&')){
							// replace parameter
							// console.log(rule_parameter);
							tmp_msg =  tmp_msg.replace("&parameter&", rule_parameter).replace("  ", " ");
						}
					}

					err_msg.push(tmp_msg);

					// behavior: breaks on fail?
					if(continue_validating_on_error == false){
						return false;
					}
				}else{
					console.log("%cError: formValidation" + "\n" + "on: validateInput" + "\n" + "detail: error message for " + rule + " validation has not been set" + "\n" + "input element id: " + el.attr('id') , 'color: red;');
				}
			}

			return true;
		});

		// draw ui based on error state
		if (err_msg[0] != null) {
			// validation fail
			drawError(err_msg, el);
			result = false;
		}else{
			// validation ok
			// check if success ui needed
			if(ui_validate_success == true){
				drawSuccess(el);
			}else{
				drawReset(el)
			}
		}

		return result;
	}


	// UI form validation
	var validateForm = function(el) {
		var result = true;

		// event on submit
		$(el).find(':input.' + target_input_class).each(function () {
			var tmp_res = validateInput($(this));

			if(tmp_res == false){
				result = false;
			}
		});

		return result;
	}


	// list of rules
	var ruleInterpreter = function(object, rule, rule_parameter){		
		// interpret the rule
		var result = true;

		switch (rule.toLowerCase()){
			case "required":
			{
				result = TestRequiredInput(object);
				break;
			}
			case "number":
			{
				result = TestNumberInput(object);
				break;
			}
			case "numbermax":
			{
				result = TestNumberMax(object, rule_parameter);
				break;
			}
			case "numbermin":
			{
				result = TestNumberMin(object, rule_parameter);
				break;
			}						
			case "string":
			{
				result = TestStringInput(object);
				break;
			}
			case "minlength":
			{
				result = TestMinLength(object, rule_parameter);
				break;
			}
			case "maxlength":
			{
				result = TestMaxLength(object, rule_parameter);
				break;
			}						
			case "email":
			{
				result = TestEmailInput(object);
				break;
			}
			case "password":
			{
				result = TestPassword(object);
				break;
			}
			case "mincurrency":
			{
				result = TestMinCurrency(object, rule_parameter);
				break;
			}	
			case "maxcurrency":
			{
				result = TestMaxCurrency(object, rule_parameter);
				break;
			}							
		}

		// returns
		return result;
	}

	/* validation functions */
	// required
	var TestRequiredInput = function(object){
		//cek validation
		var ret = true;

		if(object.val() == null){
			ret = false;
		}else{
			if (IsEmpty(object.val())){
				ret = false;
			}else if (object.getcal && !object.getcal()){
				ret = false;
			}
		}

		// return
		return ret;	
	}

	// number
	var TestNumberInput = function(object){
		// empty set handler
		if(object.val() == ''){
			return isEmptySetAllowed(object);
		}

		// validation
		return $.isNumeric(object.val().split('.').join(""));
	}
	var TestNumberMin = function (object, rule) {
		// empty set handler
		if(object.val() == ''){
			return isEmptySetAllowed(object);
		}

		// is it number
		if (TestNumberInput(object) == false) {
			return false;
		}

		// validation
		return parseInt(object.val()) < parseInt(rule) ? false : true;
	}	
	var TestNumberMax = function(object, rule){
		// empty set handler
		if(object.val() == ''){
			return isEmptySetAllowed(object);
		}

		// is it number
		if(TestNumberInput(object) == false){
			return false;
		}

		// validation
		return parseInt(object.val()) > parseInt(rule) ? false : true;
	}

	// string
	var TestStringInput = function(object){
		// empty set handler
		if(object.val() == ''){
			return isEmptySetAllowed(object);
		}

		// validation
		var letters = /^[A-Za-z ]+$/;  
		if(object.val().match(letters))  {  
			return true;
		}  
		return false;  
	}  

	// min length
	var TestMinLength = function(object, rule_parameter){
		// empty set handler
		if(object.val() == ''){
			return isEmptySetAllowed(object);
		}

		//validation
		return object.val().length < rule_parameter ? false : true;
	}

	// max length
	var TestMaxLength = function(object, rule_parameter){
		// empty set handler
		if(object.val() == ''){
			return isEmptySetAllowed(object);
		}

		//validation
		return object.val().length > rule_parameter ? false : true;
	}

	// email
	var TestEmailInput = function(object){
		// empty set handler
		if(object.val() == ''){
			return isEmptySetAllowed(object);
		}

		// validation
		var splitted = object.val().match("^(.+)@(.+)$");
		if (splitted == null) return false;
		if (splitted[1] != null)
		{
			var regexp_user = /^\"?[\w-_\.]*\"?$/;
			if (splitted[1].match(regexp_user) == null) return false;
		}
		if (splitted[2] != null)
		{
			var regexp_domain = /^[\w-\.]*\.[A-Za-z]{2,4}$/;
			if (splitted[2].match(regexp_domain) == null)
			{
				var regexp_ip = /^\[\d{1,3}\.\d{1,3}\.\d{1,3}\.\d{1,3}\]$/;
				if (splitted[2].match(regexp_ip) == null) return false;
			} // if
			return true;
		}
		return false;
	}

	// password
	var TestPassword = function(object){
		// password regex validation 
		var passw = /^(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,20}$/; 

		// validate
		return object.val().match(passw) ? true : false; 
	}

	// currency
	var TestMinCurrency = function(object, rule_parameter){
		// empty set handler
		if(isEmptySetAllowed(object)){
			return false;
		}

		// setups
		val = object.val().replace(/\./g,'');
		val = val.replace('Rp ','');

		// validate
		if(IsEmpty(val)){
			return false;
		}
		return parseInt(val) < parseInt(rule_parameter) ? false : true;
	}

	var TestMaxCurrency = function(object, rule_parameter){
		// empty set handler
		if(isEmptySetAllowed(object)){
			return false;
		}

		// setups
		val = object.val().replace(/\./g,'');
		val = val.replace('Rp ','');

		// validate
		if(IsEmpty(val)){
			return false;
		}
		return parseInt(val) > parseInt(rule_parameter) ? false : true;
	}

	/* ui */
	function drawError(msg, object){
		/* settings & default */
		var label = '';
		var err_msg = '';

		/* msg processing */
		// custom msg, yes?
		if(object.attr(target_custom_error_message_attribute)){
			// custom msg
			// produce msg
			err_msg = err_msg + ui_caption + object.attr(target_custom_error_message_attribute) + "\n";	
		}else{
			// default msg
			// check is array
			if( Object.prototype.toString.call( msg ) === '[object Array]' ) {
				// msg is array
				msg.forEach(function(value, idx, array){

					if(isMarkedUp(value)){
						// get label if needed
						if(label == ''){
							label = getLabel();
						}

						// produce msg
						err_msg = err_msg + ui_caption + value.replace("&label&", label).replace("  ", " ") + "</br>";					
					}else{
						// produce msg
						err_msg = err_msg + ui_caption + value + "\n";					
					}				
				});
			}else{
				// msg is not array
				if(isMarkedUp(msg, '&label&')){
					label = getLabel();

					// produce msg
					err_msg = ui_caption + msg.replace("&label&", label).replace("  ", " ");
				}else{
					// produce msg
					err_msg = ui_caption + msg;
				}
			}
		}


		/* UI */
		// handle error styling
		if(error_using_feedback == true){
			object.closest( bs_form_group ).addClass( bs_feedback + ' ' + bs_danger );
		}else{
			object.closest( bs_form_group ).addClass( bs_danger );
		}

		// display error msg
		removeErrorMessage(object);
		if((object.attr(target_no_msg_attribute)) != true){
			object.closest('.form-group').append('<div class="' + bs_error_message_css_class + ' thunder-validation-msg thunder-validation-msg-for-' + object.attr('id') + '"><small>' + err_msg + '</small></div>');
			// object.parent().append('<div class="' + bs_error_message_css_class + ' thunder-validation-msg thunder-validation-msg-for-' + object.attr('id') + '"><small>' + err_msg + '</small></div>');
		} else {
		    object.siblings().addClass(bs_error_message_css_class);
		}


		/* functions */

		// Get label
		function getLabel(){
			var label = "";

			try {
				var label = $("label[for='"+ object.attr("id")+"']");
				if(label.length <= 0) {
					var parentElem = object.parent(),
						parentTagName = parentElem.get(0).tagName.toLowerCase();

					if(parentTagName == "label") {
						label = parentElem;
					}
				}

				label = $(label).text();

			} catch(e) {
				console.log("%cError: formValidation" + "\n" + "on: drawError:getLabel" + "\n" + "detail" + e, 'color: red;');
			}

			return label;
		} 
	}

	function drawSuccess(object){
		// handle success styling
		removeErrorMessage(object);
		object.closest( bs_form_group ).addClass( bs_feedback + ' ' + bs_success );
		object.closest(bs_form_group).removeClass(bs_warning);
		object.closest(bs_form_group).removeClass(bs_danger);
	}

	function drawWarning(msg, object) {
	    /* settings & default */
	    var label = '';
	    var err_msg = '';

	    /* msg processing */
	    // custom msg, yes?
	    if (object.attr(target_custom_error_message_attribute)) {
	        // custom msg
	        // produce msg
	        err_msg = err_msg + ui_caption + object.attr(target_custom_error_message_attribute) + "\n";
	    } else {
	        // default msg
	        // check is array
	        if (Object.prototype.toString.call(msg) === '[object Array]') {
	            // msg is array
	            msg.forEach(function (value, idx, array) {

	                if (isMarkedUp(value)) {
	                    // get label if needed
	                    if (label == '') {
	                        label = getLabel();
	                    }

	                    // produce msg
	                    err_msg = err_msg + ui_caption + value.replace("&label&", label).replace("  ", " ") + "</br>";
	                } else {
	                    // produce msg
	                    err_msg = err_msg + ui_caption + value + "\n";
	                }
	            });
	        } else {
	            // msg is not array
	            if (isMarkedUp(msg, '&label&')) {
	                label = getLabel();

	                // produce msg
	                err_msg = ui_caption + msg.replace("&label&", label).replace("  ", " ");
	            } else {
	                // produce msg
	                err_msg = ui_caption + msg;
	            }
	        }
	    }


	    /* UI */
	    // handle error styling
	    if (error_using_feedback == true) {
	        object.closest(bs_form_group).addClass(bs_feedback + ' ' + bs_warning);
	    } else {
	        object.closest(bs_form_group).addClass(bs_warning);
	    }

	    // display error msg
	    removeErrorMessage(object);
	    if ((object.attr(target_no_msg_attribute)) != true) {
	        object.closest('.form-group').append('<div class="' + bs_warning_message_css_class + ' thunder-validation-msg thunder-validation-msg-for-' + object.attr('id') + '"><small>' + err_msg + '</small></div>');
	        // object.parent().append('<div class="' + bs_error_message_css_class + ' thunder-validation-msg thunder-validation-msg-for-' + object.attr('id') + '"><small>' + err_msg + '</small></div>');
	    } else {
	        object.siblings().addClass(bs_warning_message_css_class);
	    }


	    /* functions */

	    // Get label
	    function getLabel() {
	        var label = "";

	        try {
	            var label = $("label[for='" + object.attr("id") + "']");
	            if (label.length <= 0) {
	                var parentElem = object.parent(),
						parentTagName = parentElem.get(0).tagName.toLowerCase();

	                if (parentTagName == "label") {
	                    label = parentElem;
	                }
	            }

	            label = $(label).text();

	        } catch (e) {
	            console.log("%cError: formValidation" + "\n" + "on: drawWarning:getLabel" + "\n" + "detail" + e, 'color: red;');
	        }

	        return label;
	    }
	}



	function drawReset(object){
		// Reset styling
		removeErrorMessage(object);
		object.closest( bs_form_group ).removeClass( bs_feedback );
		object.closest( bs_form_group ).removeClass( bs_success );
		object.closest(bs_form_group).removeClass(bs_warning);
		object.closest(bs_form_group).removeClass(bs_danger);
	}

	function removeErrorMessage(object){
		object.closest('.form-group').find('.thunder-validation-msg').remove();
		// object.closest('.form-group').find( '.thunder-validation-msg-for-' + object.attr('id') ).remove();
	}
	function removeWarningMessage(object) {
	    object.closest('.form-group').find('.thunder-validation-msg').remove();
	}

	this.setError = function (object, msg) {
	    drawError(msg, object);
	}
	this.setWarning= function (object, msg) {
	    drawWarning(msg, object);
	}
	this.removeError = function (object) {
	    removeErrorMessage(object);
	    drawReset(object);
	}
	this.removeWarning = function (object) {
	    removeWarningMessage(object);
	    drawReset(object);
	}

	/* --------------------------
	Modules
	-------------------------- */
	function IsEmpty(value)
	{
		value = sfm_str_trim(value);
		return (value.length) == 0 ? true : false;
	}	
	function sfm_str_trim(strIn)
	{
		return strIn.replace(/^\s\s*/, '').replace(/\s\s*$/, '');
	}
	function isEmptySetAllowed(obj){
		if (obj.attr('thunder-validation-rules').indexOf('required') >= 0){
			return false;
		}

		return true;
	}
	// Chek for markup
	function isMarkedUp(err_msg, markup){
		if(err_msg.indexOf(markup)){	
			return true;
		}
		return false;
	}	
}