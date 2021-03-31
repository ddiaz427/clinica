if (typeof autocomplete_options != "undefined" && autocomplete_options != null){
	var ComponentsTypeahead = function () {
		var handleTwitterTypeahead = function() {
			$('.autocompletar').typeahead('destroy');
			var custom = new Bloodhound({
			  datumTokenizer: function(d) { return d.tokens; },
			  queryTokenizer: Bloodhound.tokenizers.whitespace,
			  remote: {
				url: autocomplete_options.url+'?query=%QUERY',
				wildcard: '%QUERY'
			  }
			});
	 
			custom.initialize();
			if (App.isRTL()) {
			  $('.autocompletar').attr("dir", "rtl"); 
			} 
			$('.autocompletar').typeahead(null, {
				name: autocomplete_options.name,
				displayKey: 'value',
				source: custom.ttAdapter(),
				templates: {
					suggestion: Handlebars.compile([
					  '<div class="media">',
							'<div class="media-body">',
								'<p>{{value}}</p>',
							'</div>',
					  '</div>',
					].join(''))
				}
			});
	   }
	
		return {
			//main function to initiate the module
			init: function () {
				handleTwitterTypeahead();
			}
		};
	
	}();
	$(document).on("typeahead:select",".autocompletar", function(ev, suggestion) {
		console.log($(this).parent().next());
		$(this).parent().next().val(suggestion.id);
	});	

}
