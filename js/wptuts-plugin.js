(function() {
    tinymce.create('tinymce.plugins.Wptuts', {
        init : function(ed, url) {
            ed.addButton('dropcap', {
                title : 'DropCap',
                cmd : 'dropcap',
                image : url + '/dropcap.jpg'
            });
 
            ed.addButton('showrecent', {
                title : 'Add recent posts shortcode',
                cmd : 'showrecent',
                image : url + '/recent.jpg'
            });
        },
        // ... Hidden code
    });
    // Register plugin
    tinymce.PluginManager.add( 'wptuts', tinymce.plugins.Wptuts );
})();