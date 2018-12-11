(function($){
	var initLayout = function() {
        $('#color').ColorPicker({
            onSubmit: function(hsb, hex, rgb, el) {
                $(el).val(hex);
                $(el).ColorPickerHide();
            },
            onBeforeShow: function () {
                $(this).ColorPickerSetColor(this.value);
            },
            onChange: function (hsb, hex, rgb) {
                $('#color').val('#' + hex);
            }
        })
            .bind('keyup', function(){
                $(this).ColorPickerSetColor(this.value);
            });
	};
	EYE.register(initLayout, 'init');
})(jQuery)