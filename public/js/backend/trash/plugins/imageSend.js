window.imageSend = new function(){

	/* Settings */
	var debug = true;
	var class_name = "image-send";
    var input_name = "image-url";
	var csrf_token = "";
	var preload_var = "imagePreload";

	/* API */
	this.setCsrfToken = function(token){
        csrf_token = token;
    }

	/* Event Handlers */
	var input_cache = document.getElementsByClassName(class_name);

	if(input_cache.length > 0){
		Array.from(input_cache).map(obj => {
			// 1. init input
			// create a new input element : hidden
			var new_dom_input =  document.createElement("input");
			new_dom_input.setAttribute("type", "input");
			new_dom_input.setAttribute("hidden", "hidden");
			
			// get current attributes 
			for (var att, i = 0, atts = obj.attributes, n = atts.length; i < n; i++){
				att = atts[i];
				var attr = att.nodeName;
				if(attr == "type"){
					if(!debug){ return true; }
					console.log('init skipped attr ' + attr + " = " + att.nodeValue);
				}else{
					if(attr.toLocaleLowerCase() == preload_var.toLocaleLowerCase()){
						// is any preload value
						var canvas = findSibling(obj, "img")
						canvas[0].setAttribute("src", obj.getAttribute(preload_var));
						new_dom_input.setAttribute('value', obj.getAttribute(preload_var));						
						obj.setAttribute(attr, "");
					}else{
						// copy attribute to new created input
						new_dom_input.setAttribute(attr, att.nodeValue);
						obj.setAttribute(attr, "");
					}
				}
			}

			// append hook class
			new_dom_input.setAttribute("class", new_dom_input.getAttribute("class") + " " + input_name);

			// append new element
			obj.parentNode.appendChild(new_dom_input);

			// 2. add event listener
			obj.addEventListener('change', function(e){
				UploadSequence(obj);
			});
		});
	}else{
		if(debug){ console.log("Warning! no any 'image-send' class was found on this document"); }
		return false;
	}

	/* Modules */
	// sequencer
	function UploadSequence(input){
		// check any process running for this input
		if(checkLock(input)){  return false; }

		// check if value exists
		if(!input.value){ return false; };

		// lock the input until upload finsihed
		lockInput(input);

		// ajax upload image
		var url = 'https://thunderlab.id/dashboard/media/uploaders';
		var upl = uploader;
		upl.defineOnSuccess(function(resp){
			drawImage(input);
			unlockInput(input);
			input.parentNode.getElementsByClassName(input_name)[0].setAttribute('value', resp.url);
		});
		upl.defineOnError(function(resp){
			unlockInput(input);
			alert("Cant upload image, please try again. \nError : " + resp.statusText + " (" + resp.status + ")");
		});
		upl.defineOnLoading(function(percentage){
			var parentofSelected = input.parentNode; 
			if(percentage < 100){
				parentofSelected.getElementsByTagName('a')[0].textContent = "Uploading " + percentage + " %";
			}else{
				parentofSelected.getElementsByTagName('a')[0].textContent = "Change";
			}
		})
		upl.upload(url, input, null);
	}

	// wait process to finish / lock input
	function checkLock(target){
		return (target.getAttribute('input-uploading') == true ? true: false );
	}
	function lockInput(target){
		target.setAttribute('input-uploading', true);
	}
	function unlockInput(target){
		target.setAttribute('input-uploading', false);
	}


	/* Uploader */
	var uploader = new function () {
		// internal declare
		var on_success, on_error, on_loading, xhr, token;

		// interface uploader actions
		this.defineOnSuccess = function (syntax) {
			on_success = syntax;
		}
		this.defineOnError = function (syntax) {
			on_error = syntax;
		}
		this.defineOnLoading = function (syntax) {
			on_loading = syntax;
		}	
		this.defineToken = function (tkn) {
			token = tkn;
		}
		
		this.upload = function(url, input, token) {
			if (debug == true) {
				console.log('Uploading Image ... ');
				console.log('URL : ' + url);
                console.log('Token : ' + token);
                console.log('CSRF : ' + csrf_token);
			}

			var data = new FormData();
			var request = new XMLHttpRequest();

			// File selected by the user
			// In case of multiple files append each of them
			data.append('image', input.files[0]);

			// AJAX request finished
			request.addEventListener('load', function(e) {
				// request.response will hold the response from the server
				if(request.status == 200 && request.statusText){
					on_success(request.response);
				}else{
					on_error(request);
				}
			});

			// Upload progress on request.upload
			request.upload.addEventListener('progress', function(e) {
				var percent_complete = Math.ceil((e.loaded / e.total)*100);
				on_loading(percent_complete);
			});

			// If server is sending a JSON response then set JSON response type
			request.responseType = 'json';

			// Send POST request to the server side script
			try{
				request.open('post', url); 
				request.setRequestHeader('X-CSRF-TOKEN', csrf_token);
				request.send(data);
			}catch(ex){
				on_error(request.response);
				console.log('Uploader Error : ' + ex.message);
			}
		}
	}
	function setLoadingState(){

	}
	function releaseLoadingState(){

	}


	// image drawing / previewer
	function drawImage(input) {
		if (input.files && input.files[0]) {
			var reader = new FileReader();
			reader.onload = function(e) {
				var parentofSelected = input.parentNode; 
				parentofSelected.getElementsByTagName('img')[0].setAttribute('src', e.target.result);
			}
			reader.readAsDataURL(input.files[0]);
		}
	}


	/* Helpers */
	function findSibling(currObj, searchTag){
		var parentofSelected = currObj.parentNode; 
		return parentofSelected.getElementsByTagName(searchTag);
	}
}