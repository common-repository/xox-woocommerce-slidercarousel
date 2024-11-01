(function() {
    var $sliders = [];
    //alert(xox_options);
    jQuery.each(xox_options, function(i){
        $sliders.push({text: xox_options[i], value: xox_options[i]});
    });
    tinymce.create('tinymce.plugins.Xoxscbtn', {
        /**
         * Initializes the plugin, this will be executed after the plugin has been created.
         * This call is done before the editor instance has finished it's initialization so use the onInit event
         * of the editor instance to intercept that event.
         *
         * @param {tinymce.Editor} ed Editor instance that the plugin is initialized in.
         * @param {string} url Absolute URL to where the plugin is located.
         */
        //var $sliders = [];
        
        init : function(ed, url) {
            ed.addButton('xoxscbtn', {
                //text: 'Add XoX Shortcode',
                image : url + '/logo.png',
                icon: false,
                //type: 'menubutton',
                title : 'XoxSCBtn',
                onclick: function() {
                    ed.windowManager.open( {
                        title: 'Select the Slider or Carousel',
                        body: [
                            {
                                type: 'listbox',
                                name: 'listboxName',
                                label: 'Slider or Carousel Name: ',
                                values: $sliders
                            }
                        ],
                        onsubmit: function( e ) {
                            ed.insertContent( '[xoxslider name="' + e.data.listboxName + '"]');
                        }
                    });
                }
                
            });
 
        },
 
        /**
         * Creates control instances based in the incomming name. This method is normally not
         * needed since the addButton method of the tinymce.Editor class is a more easy way of adding buttons
         * but you sometimes need to create more complex controls like listboxes, split buttons etc then this
         * method can be used to create those.
         *
         * @param {String} n Name of the control to create.
         * @param {tinymce.ControlManager} cm Control manager to use inorder to create new control.
         * @return {tinymce.ui.Control} New control instance or null if no control was created.
         */
        createControl : function(n, cm) {
            return null;
        },
 
        /**
         * Returns information about the plugin as a name/value array.
         * The current keys are longname, author, authorurl, infourl and version.
         *
         * @return {Object} Name/value array containing information about the plugin.
         */
        getInfo : function() {
            return {
                longname : 'XOX SC Button',
                author : 'Arung Isyadi',
                authorurl : 'http://xoxslider.xolluteon.com/',
                infourl : 'http://wiki.moxiecode.com/index.php/TinyMCE:Plugins/example',
                version : "0.1"
            };
        }
    });
 
    // Register plugin
    tinymce.PluginManager.add( 'xoxscbtn', tinymce.plugins.Xoxscbtn );
})();