(function() {
	tinymce.create('tinymce.plugins.YourYouTube', {
		init : function(ed, url) {
			ed.addButton('youryoutube', {
				title : 'RsimplePLX',
				image : url+'../img/lead_logo.png',
				onclick : function() {
					idPattern = /(?:(?:[^v]+)+v.)?([^&=]{11})(?=&|$)/;
					rSimpleButtonClick(ed);
					
						//ed.execCommand('mceInsertContent', false, '[leadGenEditorShortCode id="'+m[1]+'"]');
				}
			});
		},
		createControl : function(n, cm) {
			return null;
		},
		getInfo : function() {
			return {
				longname : "Lead Generation Shortcode",
				author : 'Emre Esirik',
				authorurl : 'http://www.emreesirik.com/',
				infourl : 'http://www.emreesirik.com/',
				version : "1.0"
			};
		}
	});
	tinymce.PluginManager.add('youryoutube', tinymce.plugins.YourYouTube);
})();